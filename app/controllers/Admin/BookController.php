<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-3
 * Time: 下午8:53
 */
class Admin_BookController extends BaseController{
    private $BookModel = null;
    private $BookContent = null;
    private $UserInfo=null;
    private $book_type = null;
    public function __construct(){
        $this->is_admin_login();
        parent::__construct();
        $this->BookModel = new Book_BookInfoModel();
        $this->BookContent = new Book_CreateBookContentModel();
        $this->UserInfo = new User_UserInfoModel();
        $this->book_type = new Type_TypeInfoModel();
    }
    public function showBookLists(){
        $BookBaseInfo = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.BookViews.BookLists')->with(array(
            'bookBaseInfo'=> $BookBaseInfo
        ));
    }
    public function showBookDetail(){
        $id=$this->get('id');
        $oneBookInfo = $this->BookModel->getBookBaseInfoById($id);
        return $oneBookInfo->detail;
    }
    public function showBookAllDetail(){
        $id=$this->get('id');
        $oneBookDetail = $this->BookModel->getBookBaseInfoById($id);
        $oneBookAllDetail = $this->BookModel->getOneBookAllDetailById($id);
        //书名
        $oneBookAllDetail->book_name = $oneBookDetail->book_name;
        //最后一次更新时间
        $oneBookAllDetail->last_update_time = date('Y-m-d H:i:s',$oneBookAllDetail->last_update_time);
        //书籍状态
        $oneBookAllDetail->state=$this->BookModel->bookState($oneBookAllDetail->state);
        //是否被录入藏经阁
        $oneBookAllDetail->is_store=$this->BookModel->isStore($oneBookAllDetail->is_store);
        //书的类型
        $oneBookAllDetail->book_type=$this->BookModel->bookType($oneBookDetail->book_type);
        return json_encode($oneBookAllDetail);
    }
    /*
     * 添加书籍与修改书籍
     * 共同使用一个方法
     * */
    public function AddNewOrModifyOneBook(){
        $page_type=$this->get('page_type');//create&modify判断修改删除
        $bookTypeInfo = $this->book_type->getBookTypeNotPidByZero();
        if($page_type=='create'){
            //创建新书籍
            return View::make('Admin.BookViews.AddNewOrModifyOneBook')->with(array(
                'page_type'=>$page_type,
                'book_type'=>$bookTypeInfo
            ));
        }else if($page_type=="modify"){
            //修改旧书籍
            $book_id=$this->get('book_id');
            //取出该旧书籍info表的数据
            $book_info=$this->BookModel->getBookBaseInfoById($book_id);
            //取出该旧书籍detail表的数据
            $book_detail=$this->BookModel->getOneBookAllDetailById($book_id);
            return View::make('Admin.BookViews.AddNewOrModifyOneBook')->with(array(
                'page_type'=>$page_type,
                'book_info'=>$book_info,
                'book_detail'=>$book_detail,
                'book_type'=>$bookTypeInfo
            ));
        }
    }
    /*
     * 创建书籍或修改旧书籍的处理过程
     * */
    public function doAddNewOrModifyOneBook(){
        $file_upload = new Common_FileUploadsModel();
        $bookBaseInfo['cover'] = $file_upload->FileUpload('cover','covers');//图片上传处理
        foreach($_POST as $k=>$v){
            if($k=='page_type'){
                $page_type=$_POST[$k];
                continue;
            }
            //通过default甄别把书籍的基础信息和详情信息分开，方便等下插入数据库中
            $str=substr($k,0,7);
            if($str&&$str=='default'){
                $key=substr($k,8);
                $bookBaseInfo[$key]=$v;
            }else{
                $bookDetailInfo[$k]=$v;
            }
        }
        $bookBaseInfo['book_add_time']=time();
        if(!empty($bookBaseInfo['book_id'])){
            $book_id=$bookBaseInfo['book_id'];
        }else{
            $book_id=null;
        }
        //删掉以前的图片
        if(isset($bookBaseInfo['last_book_picture'])){
            $del_file_url = './uploads/covers/'.$bookBaseInfo['last_book_picture'];
        }else{
            $del_file_url="";
        }
        //判断是否有进行图片上传
        if(!$bookBaseInfo['cover']){
            $bookBaseInfo['cover']=$bookBaseInfo['last_book_picture'];
        }else{
            if(file_exists($del_file_url) && is_file($del_file_url)){
                unlink($del_file_url);
            }
        }
        unset($bookBaseInfo['last_book_picture']);
        //删除多余的变量
        unset($bookDetailInfo['MAX_FILE_SIZE']);

        /*对小说简介的处理*/
        $Text = new Common_TextBeautifyModel();
        $bookBaseInfo['detail'] = $Text->addPInText($bookBaseInfo['detail']);
        if(mb_strlen($bookBaseInfo['detail'],'UTF-8')>2000){
            dd('简介不要大于2000字符(加上p标签,真实汉字大约1000)');
        }
        /********截止数据录入*********/
        $book_insert_base = $this->BookModel->AddOrModifyNewBook($bookBaseInfo,'info',$page_type,$book_id);
        if($book_insert_base&&$page_type=='create'){
            $bookDetailInfo['book_id']=$book_insert_base;
        }
        $book_insert_detail = $this->BookModel->AddOrModifyNewBook($bookDetailInfo,'detail',$page_type,$book_id);
        if(!($book_insert_base||$book_insert_detail))return false;
        return Redirect::to('/rgrassAdmin/BookLists');
    }
    /*
     * 通过审核
     * 不通过审核是无法对书籍内容进行编写
    */
    public function doBookReview(){
        $book_id = $this->get('book_id');
        if($this->BookModel->crossReview($book_id)){
            //修改完权限,通过审核后,需要在对应的库里面需要创建小说内容表
            $book_rgrass = new Book_CreateBookContentModel();
            $create_book_content = $book_rgrass->createBookContentByBookId($book_id);
            if($create_book_content){
                return Redirect::to('/rgrassAdmin/BookLists');
            }else{
                return '创建小说内容表失败';
            }
        }else{
            return '审核过程出错';
        }
    }
    /*删除书籍(禁用删除小说)*/
    /*
    public function delBook(){
        $delete_book=$this->BookModel->delBookById($this->get('id'));
        if($delete_book){
            return Redirect::to('/rgrassAdmin/BookLists');
        }else{
            echo '删除书籍失败';
        }
    }*/

    /*
     * 对书籍内容进行管理
     * */
    public function booksManager(){
        $book_id = $this->get('book_id');
        /*******本书共多少章*********/
       $chapter_count = $this->BookContent->countBookChapter($book_id);
        /*******本书共多少章*********/
        //获取章节目录，需要以分卷作为排序(快速遍历文件夹获取同样的目录树：未完成)
        //$dir_url = "./Book_List/{$book_id}";
        $catalog = $this->BookContent->getCatalog($book_id);//直接从数据库里获取目录
        $showCatalog = $this->showBookCatalog($catalog,$book_id);
        return View::make('Admin.BookViews.BookChapterManager')->with(array(
            'book_id'=>$book_id,
            'chapter_count'=>$chapter_count,
            'showCatalog'=>$showCatalog
        ));
    }
    /*
     * 对目录数组进行拼接排列
     * */
    public function showBookCatalog($catalog,$book_id,$page=false){
        /*
         * 需要对表格对照$catalog的内容进行拼接
         * 有点难度,需要认真浏览
        */
        $organization = new Book_BookInfoModel();
        $page=$page?$page:3;
        $html = "<tr>";
        foreach($catalog as $key=>$val){
            if(!is_array($val)){//如果该分卷里面的内容不是数组,略过去
                continue;
            }
            if(empty($val)){
                continue;
            }
            //通过卷id号获取卷名
            if(isset($catalog[$key][0])){
                $organization_name = ($organization_info = $organization->getChapterOrganizationInfoByOid($catalog[$key][0]->chapter_organization))?$organization_info->organization_name:'正文';//通过卷id号获取卷名
            }
            $i=1;
            $html .='<tr><td style="text-align: left" colspan="3"><span>'.$organization_name.'</span></td></tr>';

            foreach($val as $k=>$v){
                    if((($i)%$page)!=0){
                        $html .= "<td><a href=\"/rgrassAdmin/showChapterContent?book_id={$book_id}&&organization_name={$key}&&chapter_name={$v->chapter_name}&&chapter_id={$v->id}\">{$v->chapter_name}</a><a href=\"/rgrassAdmin/ModifyChapterContent?book_id={$book_id}&&chapter_id={$v->id}\"<i class=\"icon-pencil\" style='margin-left:10px;cursor: pointer;'></i></a><a href=\"/rgrassAdmin/DelChapterContent?book_id={$book_id}&&chapter_id={$v->id}\"  onclick=\"return confirm('确定删除吗?')\"><i class=\"icon-pencil\" style='margin-left:10px;cursor: pointer;'></i></a></td>";
                    }else{
                        $html .= "<td><a href=\"/rgrassAdmin/showChapterContent?book_id={$book_id}&&organization_name={$key}&&chapter_name={$v->chapter_name}&&chapter_id={$v->id}\">{$v->chapter_name}</a><a href=\"/rgrassAdmin/ModifyChapterContent?book_id={$book_id}&&chapter_id={$v->id}\"<i class=\"icon-pencil\" style='margin-left:10px;cursor: pointer;'></i></a><a href=\"/rgrassAdmin/DelChapterContent?book_id={$book_id}&&chapter_id={$v->id}\"  onclick=\"return confirm('确定删除吗?')\"><i class=\"icon-pencil\" style='margin-left:10px;cursor: pointer;'></i></a></td></tr><tr>";
                    }
                $i++;
            }
            $html .="</tr>";
        }
        return $html;
    }
    /*
     * 显示章节内容
     *
     * */
    public function showChapterContent(){
        $book_id = $this->get('book_id');
        $organization_name = $this->get('organization_name');
        $chapter_name = $this->get('chapter_name');
        $chapter_id = $this->get('chapter_id');
        //拼接章节对应的路径
        $file_url = './Book_List/'.$book_id.'/'.$organization_name.'/'.$chapter_name.'.txt';
        $dir_path = './Book_List/'.$book_id.'/'.$organization_name;
        if(!file_exists($file_url)){
            //如果该章节对应的txt文档不存在,先从数据库中查询得到,再重新创建一个新的txt文档
        $chapter_content = $this->BookContent->getChapterContentByChapterId($book_id,$chapter_id);
            //获取内容
            $str_chapter_content = $chapter_content->chapter_content;
            if(!file_exists($dir_path)){//如果文件夹不存在,先创建文件夹
                mkdir($dir_path);
            }
            touch($file_url);
            file_put_contents($file_url,$str_chapter_content);//把内容放进新创建的txt文档里面
        }else{
            //获取内容
            $str_chapter_content = file_get_contents($file_url);
        }
        $count_chapter = mb_strlen($str_chapter_content,'UTF-8');
        return View::make('Admin.BookViews.BookChapterContent')->with(array(
            'book_id'=>$book_id,
            'chapter_id'=>$chapter_id,
            'chapter_title'=>$chapter_name,//标题
            'count_chapter'=>$count_chapter,//本章字数
            'str_chapter_content'=>$str_chapter_content//内容
        ));
    }

    /*
     * 添加新章节
     * */
    public function addBookChapter(){
        $book_id = $this->get('book_id');//书本对应书号
        $chapter_organization = $this->BookModel->getChapterOrganization($book_id);//该书号对应的所有分卷
        return View::make('Admin.BookViews.AddBookChapter')->with(array(
            'book_id'=>$book_id,
            'chapter_organization'=>$chapter_organization,
            'update_user'=>$_SESSION['admin_login']
        ));
    }
    /*
     * 进行添加新章节的操作
     * */
    public function doAddBookChapter(){
        $book_id = $this->post('book_id');
        $chapter_name = $this->post('chapter_name');
        $chapter_content = $this->post('chapter_content');
        $update_time = time();
        $update_user = $this->post('update_user');
        $chapter_organization = $this->post('chapter_organization');
        $book_path = './Book_List/'.$book_id;
        $chapter_path = $book_path.'/'.$chapter_organization.'/'.$chapter_name.'.txt';//章节所在的txt文本路径
        if(empty($chapter_name))dd('章节名不能为空');
        if(empty($chapter_content))dd('章节内容不能为空');

        /*
         * 对章节内容进行处理
         * 1,把\n=><br/>
         * 2,在除第一段外的段首空两格
         * 3,在第一段段首空两格
         * */
        $Text = new Common_TextBeautifyModel();
        $chapter_content = $Text->addPInText($chapter_content);

        //通过username获取uid,得到修改本章节的人
        $update_user = $this->UserInfo->getUserInfoByUserName($update_user);
        $update_user = $update_user->user_id;

        /*拼接插入的数据*/
        $content=array(
            'chapter_name'=>$chapter_name,
            'chapter_content'=>$chapter_content,
            'update_time'=>$update_time,
            'update_users'=>$update_user,
            'chapter_organization'=>$chapter_organization,
            'chapter_path'=>$chapter_path
        );
        if($this->BookContent->addNewBookContent($book_id,$content)){
            //如果插入数据库成功，再进行txt文档存储

            $dir_url = $book_path.'/'.$chapter_organization;//对应的卷名的文件夹路径
            if(!file_exists($book_path)){
                mkdir($book_path);//如果连小说主文件夹都不存在,创建
            }
            if(!file_exists($dir_url)){
                mkdir($dir_url);
                touch($chapter_path);
                file_put_contents($chapter_path,$chapter_content);
                //echo '成功执行所有操作0';
            }else{
                if(!file_exists($chapter_path)){
                    touch($chapter_path);
                    file_put_contents($chapter_path,$chapter_content);
                    //echo '成功执行所有操作1';
                }else{
                    file_put_contents($chapter_path,$chapter_content);
                    //echo '成功执行所有操作2';
                }
            }
            return Redirect::to('rgrassAdmin/chapter_manager?book_id='.$book_id);
        }else{
            dd('插入数据库失败');
        }
    }

    /*
     * 添加新分卷
     * */
    public function addNewOrganization(){
        $book_id = $this->get('book_id');
        $bookInfo = $this->BookModel->getBookBaseInfoById($book_id);
        return View::make('Admin.BookViews.AddNewOrganization')->with(array(
           'book_id'=>$book_id,
            'book_info'=>$bookInfo
        ));
    }
    /*
     * 执行添加新分卷操作
     * */
    public function doAddOrganization(){
        $book_id = $this->post('book_id');
        $organization_name = $this->post('organization_name');
        $addtime = time();
        $content = array('book_id'=>$book_id,'organization_name'=>$organization_name,'add_time'=>$addtime);
        if($this->BookModel->insertNewChapterOrganization($content)){
            return Redirect::to('/rgrassAdmin/chapter_manager?book_id='.$book_id);
        }else{
            dd('添加失败');
        }

    }
    /*
     * 修改章节内容
     *
     * */
    public function showModifyChapterContent(){
        $book_id = $this->get('book_id');
        $chapter_id = $this->get('chapter_id');
        $chapter_organization = $this->BookModel->getChapterOrganization($book_id);//该书号对应的所有分卷
        $chapter_info = $this->BookContent->getChapterInfoByBookIdAndChapterId($book_id,$chapter_id);//获取该章节的信息
        $update_user_name = $this->UserInfo->getUserNameByUserId($chapter_info->update_users)->username;//通过userid获取username
        $update_user = array('user_id'=>$chapter_info->update_users,'user_name'=>$update_user_name);
        return View::make('Admin.BookViews.ModifyChapterContent')->with(array(
            'book_id'=>$book_id,
            'chapter_id'=>$chapter_id,
            'chapter_info'=>$chapter_info,
            'update_user'=>$update_user,
            'chapter_organization'=>$chapter_organization
        ));
    }
    /*
     * 修改章节
     * */
    public function doModifyChapterContent(){
        $book_id = $this->post('book_id');
        $chapter_id = $this->post('chapter_id');
        $chapter_name = $this->post('chapter_name');
        $chapter_content = $this->post('chapter_content');
        $update_time = time();
        $update_users = $this->post('update_user');
        $chapter_organization = $this->post('chapter_organization');
        /****对内容进行编辑****/
        $Text = new Common_TextBeautifyModel();
        $chapter_content = $Text->addPInText($chapter_content);
        /****对内容进行编辑****/
        $content = array('chapter_name'=>$chapter_name,'chapter_content'=>$chapter_content,'update_time'=>$update_time,'update_users'=>$update_users,'chapter_organization'=>$chapter_organization);
        /*获取以前的文件夹信息*/
        $last_path = $this->getFilePathByBookIdAndChapterId($book_id,$chapter_id);
        /*现在文件夹信息*/
        if($chapter_organization=='0'){
            $new_chapter_organization_name = '正文';
        }else{
            $new_chapter_organization_name = $this->BookModel->getChapterOrganizationInfoByOid($chapter_organization)->organization_name;
        }
        $new_chapter_name = $chapter_name;
        $new_path = './Book_List/'.$book_id.'/'.$new_chapter_organization_name.'/'.$new_chapter_name.'.txt';
        if($this->BookContent->modifyChapterContentById($book_id,$chapter_id,$content)){
            //修改成功后把以前的文本删除,重新建立文本
            if(file_exists($last_path)){/*删除旧文件*/
                unlink($last_path);
            }
            if(!file_exists($new_path)){/*添加新文件*/
                touch($new_path);
                file_put_contents($new_path,$chapter_content);
            }
            return Redirect::to('rgrassAdmin/chapter_manager?book_id='.$book_id);
        }
    }
    /*
     * 删除某一章节
     * */
    public function doDelChapterContent(){
        $book_id = $this->get('book_id');
        $chapter_id = $this->get('chapter_id');


        $del_path = $this->getFilePathByBookIdAndChapterId($book_id,$chapter_id);
        if($this->BookContent->delChapterContentById($book_id,$chapter_id)){
            if(file_exists($del_path)){
                unlink($del_path);
            }
            return Redirect::to('rgrassAdmin/chapter_manager?book_id='.$book_id);
        }
    }
    /*
     * 获取小说某一章节的路径(根据book_id,chapter_id)
     * */
    public function getFilePathByBookIdAndChapterId($book_id,$chapter_id){
        $chapter_info = $this->BookContent->getChapterContentByChapterId($book_id,$chapter_id);
        if($chapter_info->chapter_organization=='0'){
            $chapter_organization_name = '正文';
        }else{
            $chapter_organization_name = $this->BookModel->getChapterOrganizationInfoByOid($chapter_info->chapter_organization)->organization_name;
        }
        $chapter_name = $chapter_info->chapter_name;
        return './Book_List/'.$book_id.'/'.$chapter_organization_name.'/'.$chapter_name.'.txt';
    }
    /*
     * 对分卷信息进行修改
     * */
    public function showModifyChapterOrganization(){
        $book_id = $this->get('book_id');
        $book_info = $this->BookModel->getBookBaseInfoById($book_id);
        $chapter_organization = $this->BookModel->getChapterOrganization($book_id);//该书号对应的所有分卷
        return View::make('Admin.BookViews.ModifyChapterOrganization')->with(array(
            'chapter_organization'=>$chapter_organization,
            'book_info'=>$book_info
        ));
    }
    /*
     * 删除某一分卷
     * */
    public function doDelChapterOrganization(){
        $id = $this->get('id');
        $organization_info = $this->BookModel->getChapterOrganizationInfoByOid($id);
        $dir_path = './Book_List/'.$organization_info->book_id.'/'.$organization_info->organization_name;//该分卷对应的文件夹
        if($this->BookModel->delChapterOrganization($id)){
            //删除成功后,同时删除分卷对应的书籍
            if($this->BookContent->delBookContentByOrganizaitonId($organization_info->book_id,$id)){
                //删除对应的文件
                if(file_exists($dir_path)){
                    if($this->delDirAndDirFile($dir_path)){
                        return Redirect::to('/rgrassAdmin/ModifyChapterOrganization?book_id='.$organization_info->book_id);
                    }else{
                        dd('删除文件夹失败');
                    }
                }
            }else{
                dd('删除对应的书籍失败');
            }
        }else{
            dd('删除分卷失败');
        }
    }
    /*
     * 删除文件夹与文件夹下的文件
     * */
    public function delDirAndDirFile($dir){
        //先删除目录下的文件：
        $dh=opendir($dir);
        while ($file=readdir($dh)){
            if($file!="." && $file!=".."){
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)){
                    unlink($fullpath);
                }else{
                    deldir($fullpath);
                }
            }
        }
        closedir($dh);
        //删除当前文件夹：
        if(rmdir($dir)){
            return true;
        }else{
            return false;
        }
    }
    /*
     * 修改某一分卷
     * */
    public function showModifyChapterOrganizationInfo(){
        $id = $this->get('id');
        $organization_info = $this->BookModel->getChapterOrganizationInfoByOid($id);
        return View::make('Admin.BookViews.ModifyChapterOrganizationInfo')->with(array(
            'organization_info'=>$organization_info
        ));
    }
    /*
     * 执行修改
     * */
    public function doModifyChapterOrganizationInfo(){
        $id = $this->post('id');
        $book_id = $this->post('book_id');
        $usual_organization_name = $this->post('usual_organization_name');//旧名字
        $organization_name = $this->post('organization_name');//新修改的名字
        $usual_dir_path = './Book_List/'.$book_id.'/'.$usual_organization_name;
        $new_dir_path = './Book_List/'.$book_id.'/'.$organization_name;
        $content = array('organization_name'=>$organization_name,'add_time'=>time());
        if($this->BookModel->modifyChapterOrganizaiton($id,$content)){
            if(file_exists($usual_dir_path)){
                if(rename($usual_dir_path,$new_dir_path)){
                    return Redirect::to('/rgrassAdmin/ModifyChapterOrganization?book_id='.$book_id);
                }else{
                    dd('文件名修改失败');
                }
            }
        }else{
            dd('数据库修改失败');
        }
    }
}