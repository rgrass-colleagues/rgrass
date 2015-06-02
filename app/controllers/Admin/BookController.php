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
    public function __construct(){
        $this->is_admin_login();
        parent::__construct();
        $this->BookModel = new Book_BookInfoModel();
        $this->BookContent = new Book_CreateBookContentModel();
        $this->UserInfo = new User_UserInfoModel();
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
        $page_type=$this->get('page_type');
        if($page_type=='create'){
            //创建新书籍
            return View::make('Admin.BookViews.AddNewOrModifyOneBook')->with(array(
                'page_type'=>$page_type
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
                'book_detail'=>$book_detail
            ));
        }
    }
    /*
     * 创建书籍或修改旧书籍的处理过程
     * */
    public function doAddNewOrModifyOneBook(){
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
        $book_insert_base = $this->BookModel->AddOrModifyNewBook($bookBaseInfo,'info',$page_type,$book_id);
        if($book_insert_base&&$page_type=='create'){
            $bookDetailInfo['book_id']=$book_insert_base;
        }
        $book_insert_detail = $this->BookModel->AddOrModifyNewBook($bookDetailInfo,'detail',$page_type,$book_id);
        if(!($book_insert_base||$book_insert_detail))return false;
        return Redirect::to('/rgrassAdmin/BookLists');
    }
    /*删除书籍*/
    public function delBook(){
        $delete_book=$this->BookModel->delBookById($this->get('id'));
        if($delete_book){
            return Redirect::to('/rgrassAdmin/BookLists');
        }else{
            echo '删除书籍失败';
        }
    }

    /*
     * 对书籍内容进行管理
     * */
    public function booksManager(){
        $book_id = $this->get('book_id');
        //获取章节目录，需要以分卷作为排序(快速遍历文件夹获取同样的目录树：未完成)
        //$dir_url = "./Book_List/{$book_id}";
        $catalog = $this->BookContent->getCatalog($book_id);
        $showCatalog = $this->showBookCatalog($catalog,$book_id);
        return View::make('Admin.BookViews.BookChapterManager')->with(array(
            'book_id'=>$book_id,
            'showCatalog'=>$showCatalog
        ));
    }
    /*
     * 对目录数组进行拼接排列
     * */
    public function showBookCatalog($catalog,$book_id){
        /*
         * 需要对表格对照$catalog的内容进行拼接
         * 有点难度,需要认真浏览
        */
        $html = "<tr>";
        foreach($catalog as $key=>$val){
            $i=1;
            $html .='<tr><td style="text-align: left" colspan="3"><span>'.$key.'</span>
            <span style="float:right">该分卷共写了<span style="color:green">12312</span>字</span></td></tr>';
            if(!is_array($val)){//如果该分卷里面的内容不是数组,略过去
                continue;
            }
            foreach($val as $k=>$v){
                    if((($i)%3)!=0){
                        $html .= "<td><a href=\"/rgrassAdmin/showChapterContent?book_id={$book_id}&&organization_name={$key}&&chapter_name={$v['chapter_name']}&&chapter_id={$v['id']}\">{$v['chapter_name']}</a><a href=\"\"><i class=\"icon-pencil\" style='margin-left:10px;'></i></a></td>";
                    }else{
                        $html .= "<td><a href=\"/rgrassAdmin/showChapterContent?book_id={$book_id}&&organization_name={$key}&&chapter_name={$v['chapter_name']}&&chapter_id={$v['id']}\">{$v['chapter_name']}</a><a href=\"\"><i class=\"icon-pencil\" style='margin-left:10px;'></i></a></td></tr><tr>";
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
        if(!file_exists($file_url)){
            //如果该章节对应的txt文档不存在,先从数据库中查询得到,再重新创建一个新的txt文档
        $chapter_content = $this->BookContent->getChapterContentByChapterId($book_id,$chapter_id);
            //获取内容
            $str_chapter_content = $chapter_content[0]['chapter_content'];

            touch($file_url);
            file_put_contents($file_url,$str_chapter_content);//把内容放进新创建的txt文档里面
        }else{
            //获取内容
            $str_chapter_content = file_get_contents($file_url);
        }
        $count_chapter = strlen($str_chapter_content);
        return View::make('Admin.BookViews.BookChapterContent')->with(array(
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
        /*
         * 对章节内容进行处理
         * 1,把\n=><br/>
         * 2,在除第一段外的段首空两格
         * 3,在第一段段首空两格
         * */
        $chapter_content = nl2br($chapter_content);
        $chapter_content = str_replace("<br />","<br>&nbsp;&nbsp;&nbsp;&nbsp;",$chapter_content);
        $chapter_content = "&nbsp;&nbsp;&nbsp;&nbsp;".$chapter_content;
        //通过username获取uid
        $update_user = $this->UserInfo->getUserInfoByUserName($update_user);
        $update_user = $update_user->user_id;
        if($this->BookContent->addNewBookContent($book_id,$chapter_name,$chapter_content,$update_time,$update_user,$chapter_organization)){
            //如果插入数据库成功，再进行txt文档存储
            $chapter_organization_info = $this->BookModel->getChapterOrganizationInfoByOid($chapter_organization);
            $chapter_organization_name = $chapter_organization_info->organization_name;
            $dir_url = './Book_List/'.$book_id.'/'.$chapter_organization_name;//对应的卷名的文件夹路径
            $file_url = './Book_List/'.$book_id.'/'.$chapter_organization_name.'/'.$chapter_name.'.txt';//对应的章节路径
            if(!file_exists($dir_url)){
                mkdir($dir_url);
                touch($file_url);
                file_put_contents($file_url,$chapter_content);
                echo '成功执行所有操作0';
            }else{
                if(!file_exists($file_url)){
                    touch($file_url);
                    file_put_contents($file_url,$chapter_content);
                    echo '成功执行所有操作1';
                }else{
                    file_put_contents($file_url,$chapter_content);
                    echo '成功执行所有操作2';
                }
            }
        }else{
            echo '插入数据库失败';
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
            dd('添加成功');
        }else{
            dd('添加失败');
        }

    }
}