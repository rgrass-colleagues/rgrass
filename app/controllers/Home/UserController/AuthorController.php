<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-26
 * Time: 下午23:20
 */
class Home_UserController_AuthorController extends BaseController{
    private $redis =null;
    public function __construct(){
        parent::__construct();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }
    public function __destruct(){
    }
    /***申请成为作者****/
    public function ActivateAuthor(){
        return View::make('Home.UserViews.ActivateAuthor')->with(array(

        ));
    }
    public function AuthorReg(){
        return View::make('Home.UserViews.AuthorReg')->with(array(

        ));
    }
    public function doAuthorReg(){
        $user_id = $this->post('user_id');
        if(Author_AuthorInfoModel::confirmUserIsAuthor($user_id)){
            dd('该用户已经是作者');
        }
        $pen_name = $this->post('pen_name');
        if(Author_AuthorInfoModel::confirmAuthorPenNameExists($pen_name)){
            dd('笔名已经存在');
        }
        $author_pass1 = $this->post('author_password1');
        $author_pass2 = $this->post('author_password2');
        if(strlen($author_pass1)<5){
            dd('密码长度需要大于6位');
        }
        if($author_pass1 != $author_pass2){
            dd('两次输入的密码要一致');
        }
        $author_email = $this->post('author_email');
        $author_qq = $this->post('author_qq');
        $true_name = $this->post('true_name');
        $true_identify = $this->post('true_identify');
        $true_telephone = $this->post('true_telephone');
        if(!$this->post('read_confirm')){
            dd('请勾选作者协议书');
        }
        $content = array(
            'user_id' => $user_id,
            'pen_name' => $pen_name,
            'addtime' => time(),
            'author_password' => Login_LoginModel::authNewCode($author_pass1),
            'author_email' => $author_email,
            'author_qq' => $author_qq,
            'true_name' => $true_name,
            'true_identify' => $true_identify,
            'true_telephone' => $true_telephone,
        );
        if(User_UserNewInfoModel::TransferToAuthor($user_id)&&Author_AuthorInfoModel::insertIntoAuthor($content)){
            return Redirect::to('/AuthorNotice');
        }else{
            dd('插入数据失败');
        }
    }
    /*****作者专区进入口*******/
    public function AuthorLogin(){
        return View::make('Home.UserViews.AuthorLogin');
    }

    public function doAuthorLogin(){
        $author_password = $this->post('author_password');
        $user_id = $this->post('user_id');
        //验证登陆，并设置session值
        if($author_info = Author_AuthorInfoModel::AuthorLoginByPassword($user_id,$author_password)){
            session_start();
            $_SESSION['author_login'] = $author_info->id;
            session_write_close();
            return Redirect::to('/AuthorNotice');
        }else{
            dd('登陆失败');
        }

    }
    /*****退出作者专区*******/
    public function AuthorOut(){
        session_start();
        unset($_SESSION['author_login']);
        session_write_close();
        return Redirect::to('/AuthorLogin');
    }
    /******作者专区公告（首页）********/
    public function AuthorNotice(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        return View::make('Home.UserViews.AuthorNotice')->with(array(
        ));
    }
    /**********作者专区，作家信息***************/
    public function showAuthorCenter(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $author_info = Author_AuthorInfoModel::getAuthorInfoByUserId($this->is_user_login()->user_id);
        return View::make('Home.UserViews.AuthorCenter')->with(array(
            'author_info'=>$author_info
        ));
    }
    //修改作家信息
    public function AuthorInfoModify(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        return View::make('Home.UserViews.AuthorInfoModify')->with(array(

        ));
    }
    public function doAuthorInfoModify(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $id = $this->post('id');
        $author_email = $this->post('author_email');
        $author_qq = $this->post('author_qq');
        $content = array(
            'author_email'=>$author_email,
            'author_qq'=>$author_qq
        );
        Author_AuthorInfoModel::updateAuthorInfo($id,$content);
        return Redirect::to('/Author');
    }
    public function AuthorPasswordModify(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        return View::make('Home.UserViews.AuthorPasswordModify');
    }
    public function doAuthorPasswordModify(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $id = $this->post('id');
        $user_id = $this->post('user_id');
        $old_pass = $this->post('old_pass');
        if(!Author_AuthorInfoModel::AuthorLoginByPassword($user_id,$old_pass)){
            dd('请输入正确的旧密码');
        }
        $new_pass1 = $this->post('new_pass1');
        $new_pass2 = $this->post('new_pass2');
        if($new_pass1!=$new_pass2){
            dd('两次输入的密码不一致');
        }

        $content = array('author_password'=>Login_LoginModel::authNewCode($new_pass1));
        Author_AuthorInfoModel::updateAuthorInfo($id,$content);
        return Redirect::to('/AuthorNotice');

    }



    /*********作者专区，小说管理************/
    public function BookManager(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $author_id = $_SESSION['author_login'];
        $author = Author_AuthorInfoModel::getAuthorInfoByAuthorId($author_id)->pen_name;
        $author_book_info = Book_BookNewInfoModel::getBookInfoByAuthor($author);
        return View::make('Home.UserViews.BookManager')->with(array(
            'author_book_info'=>$author_book_info
        ));
    }

    /***添加新小说****/
    public function AddNewBook(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $type = Type_TypeInfoModel::getNBookTypeNotPidByZero();
        return View::make('Home.UserViews.AddNewBook')->with(array(
            'type'=>$type
        ));
    }
    public function doAddNewBook(){
        $book_name = $this->post('book_name');
        if($book_name==""){
            dd('小说名不可为空');
        }
        if(Common_TextBeautifyModel::strLength($book_name)>12){
            dd('小说名不可超过12个字');
        }
        if(Book_BookNewInfoModel::getBookInfoByBookName($book_name)){
            dd('小说名已经存在');
        }
        $book_type = $this->post('book_type');
        if($book_type==0){
            dd('请选择小说类型');
        }
        $book_from_status = $this->post('book_status_from');
        $book_from_url = $this->post('book_from_url');
        $detail = $this->post('detail');
        if(Common_TextBeautifyModel::strLength($detail)>400){
            dd('简介不可大于400字');
        }
        $author = $this->post('author');
        //-------------------------
        $content_info = array(
            'book_name'=>$book_name,
            'author'=>$author,
            'detail'=>$detail,
            'book_add_time'=>time(),
            'book_authority'=>0,
            'book_type'=>$book_type,
            'book_from_status'=>$book_from_status,
            'book_from_url'=>$book_from_url,
        );

        if($book_id = Book_BookNewInfoModel::insertBookInfo($content_info)){
            /**
             * 需要进行3步创建
             * 1,book_info内容创建
             * 2,book_detail内容创建
             * 3,对应小说content创建
             * 4,如果是燃草中文首发，还需要修改book_from_url
             */
            if($book_from_status==0){
                Book_BookNewInfoModel::updateBookInfo($book_id,array('book_from_url'=>'http://www.rgrass.com/Book?book_id='.$book_id));
            }
            $content_detail = array(
                'book_id'=>$book_id,
                'last_update_time'=>time(),
                'state'=>1,
            );
            if(Book_BookNewInfoModel::insertBookDetail($content_detail)){
                if(!Book_CreateNewBookContentModel::createBookContentByBookId($book_id)){
                    dd('创建小说表失败');
                }else{
                    return Redirect::to('/BookManager');
                }
            }else{
                dd('创建小说详情失败');
            }
        }else{
            dd('创建书籍失败');
        }
    }
    /***修改小说***/
    public function ModifyBook(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $book_id = $this->get('book_id');
        $author_book_info = Book_BookNewInfoModel::getBookInfoDetailByBookId($book_id);
        return View::make('Home.UserViews.ModifyBook')->with(array(
            'author_book_info'=>$author_book_info
        ));
    }
    public function doModifyBook(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $book_id = $this->post('book_id');
        $state = $this->post('state');
        $detail = $this->post('detail');
        $cover = Common_FileUploadsModel::NewFileUploads('cover','covers');
        $cover_last = Book_BookNewInfoModel::getBookInfoDetailByBookId($book_id)->cover;
        if(!$cover){
            $cover = $cover_last;
        }else{
            if(file_exists($cover_last)&&$cover_last!='default.jpg'){
                unlink('./uploads/covers/'.$cover_last);
            }
        }
        $content_info = array(
            'cover'=>$cover,
            'detail'=>$detail,
        );
        $content_detail = array(
            'state'=>$state
        );
        Book_BookNewInfoModel::updateBookInfo($book_id,$content_info);
        Book_BookNewInfoModel::updateBookDetail($book_id,$content_detail);
        return Redirect::to('/BookManager');
    }

    /****操作书籍中心***/
    public function OperateBook(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $book_id = $this->get('book_id');
        $catalog = Book_CreateNewBookContentModel::getCatalog($book_id);
        return View::make('Home.UserViews.OperateBook')->with(array(
            'catalog'=>$catalog,
            'book_id'=>$book_id
        ));
    }

    /**
     * 添加新章节
     * */
    public function AddNewChapter(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $book_id = $this->get('book_id');
        $chapter_organization = Book_BookNewInfoModel::getChapterOrganization($book_id);//该书号对应的所有分卷
        return View::make('Home.UserViews.AddNewChapter')->with(array(
            'book_id'=>$book_id,
            'chapter_organization'=>$chapter_organization
        ));
    }
    public function doAddNewChapter(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $book_id = $this->post('book_id');
        $chapter_name = $this->post('chapter_name');
        $chapter_content = $this->post('chapter_content');
        $update_users = $this->post('update_users');
        $chapter_organization = $this->post('chapter_organization');
        $book_path = './Book_List/'.$book_id;
        $chapter_path = $book_path.'/'.$chapter_organization.'/'.$chapter_name.'.txt';//章节所在的txt文本路径
        if(empty($chapter_name))dd('章节名不能为空');
        if(empty($chapter_content))dd('章节内容不能为空');
        $content = array(
            'chapter_name'=>$chapter_name,
            'chapter_content'=>$chapter_content,
            'update_time'=>time(),
            'update_users'=>$update_users,
            'chapter_organization'=>$chapter_organization,
            'chapter_path'=>$chapter_path
        );
        if(Book_CreateNewBookContentModel::addNewBookContent($book_id,$content)){
            //如果插入数据成功，进行一些额外的修改
            $this->InsertOrUpdateSuccessThen($book_id);

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
            return Redirect::to('/OperateBook?book_id='.$book_id);
        }else{
            dd('插入数据库失败');
        }

    }
    public function InsertOrUpdateSuccessThen($book_id){
        //1,最后一次修改时间的更新
        if(!Book_BookNewInfoModel::modifyLastUpdateTime($book_id)){
            dd('最后一次修改时间更新失败');
        }
        //2，redis中上一页下一页排列组删除
        $redis = new Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->del($book_id.'pre_list');
        $redis->del($book_id.'next_list');
        return true;
    }

    /*添加新分卷*/
    public function AddNewOrganization(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $book_id = $this->get('book_id');
        return View::make('Home.UserViews.AddNewOrganization')->with(array(
            'book_id'=>$book_id,
        ));
    }
    public function doAddNewOrganization(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $book_id = $this->post('book_id');
        $organization_name = $this->post('organization_name');
        $content = array(
            'book_id'=>$book_id,
            'organization_name'=>$organization_name,
            'add_time'=>time(),
        );
        if(Book_BookNewInfoModel::insertNewChapterOrganization($content)){
            return Redirect::to('/OperateBook?book_id='.$book_id);
        }
    }

    /**
     * 修改分卷
     * */
    public function OrganizationModify(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $organization_id = $this->get('organization_id');
        $organization = Book_BookNewInfoModel::getChapterOrganizationInfoByOid($organization_id);
        return View::make('Home.UserViews.OrganizationModify')->with(array(
            'organization'=>$organization
        ));
    }

    public function doOrganizationModify(){
        $book_id = $this->post('book_id');
        $organization_id = $this->post('id');
        $organization_name = $this->post('organization_name');
        $content = array(
            'organization_name'=>$organization_name,
            'add_time'=>time(),
        );
        Book_BookNewInfoModel::updateChapterOrganization($organization_id,$content);
        return Redirect::to('/OperateBook?book_id='.$book_id);
    }

    /**删除分卷**/
    public function doOrganizationDel(){
        $organization_id = $this->get('organization_id');
        $organization = Book_BookNewInfoModel::getChapterOrganizationInfoByOid($organization_id);
        $book_id = $organization->book_id;
        $is_organization_exist = Book_CreateNewBookContentModel::checkChapterInOrganization($book_id,$organization_id);
        if(empty($is_organization_exist)){
            //检测结果为章节不存在，删除该卷
            Book_BookNewInfoModel::delChapterOrganization($organization_id);
            return Redirect::to('/OperateBook?book_id='.$book_id);
        }else{
            dd('请确定已经删除所有卷内的章节');
        }
    }

    /**
     * 章节删除
     * */
    public function doChapterDel(){
        $book_id = $this->get('book_id');
        $chapter_id = $this->get('chapter_id');
        Book_CreateNewBookContentModel::delChapterContentById($book_id,$chapter_id);
        return Redirect::to('/OperateBook?book_id='.$book_id);
    }
    /**
     * 章节修改
     * */
    public function ChapterModify(){
        $book_id = $this->get('book_id');
        $chapter_id = $this->get('chapter_id');
        $chapter = Book_CreateNewBookContentModel::getChapterContentByChapterId($book_id,$chapter_id);
        $chapter_organization = Book_BookNewInfoModel::getChapterOrganization($book_id);//该书号对应的所有分卷
        return View::make('Home.UserViews.ChapterModify')->with(array(
            'chapter'=>$chapter,
            'book_id'=>$book_id,
            'chapter_organization'=>$chapter_organization
        ));
    }
    public function doChapterModify(){
        $book_id = $this->post('book_id');
        $chapter_name = $this->post('chapter_name');
        $chapter_content = $this->post('chapter_content');
        $update_users = $this->post('update_users');
        $chapter_id = $this->post('id');
        $chapter_organization = $this->post('chapter_organization');
        $book_path = './Book_List/'.$book_id;
        $chapter_path = $book_path.'/'.$chapter_organization.'/'.$chapter_name.'.txt';//章节所在的txt文本路径
        $content = array(
            'chapter_name'=>$chapter_name,
            'chapter_content'=>$chapter_content,
            'update_time'=>time(),
            'update_users'=>$update_users
        );
        if(Book_CreateNewBookContentModel::modifyChapterContentById($book_id,$chapter_id,$content)){
            //如果插入数据成功，进行一些额外的修改
            $this->InsertOrUpdateSuccessThen($book_id);

            //如果插入数据库成功，再进行txt文档存储

            $dir_url = $book_path.'/'.$chapter_organization;//对应的卷名的文件夹路径
            if(!file_exists($book_path)){
                mkdir($book_path);//如果连小说主文件夹都不存在,创建
            }
            if(!file_exists($dir_url)){
                mkdir($dir_url);
                if(!file_exists($chapter_path)){
                    touch($chapter_path);
                }
                file_put_contents($chapter_path,$chapter_content);
                //echo '成功执行所有操作0';
            }else{
                if(!file_exists($chapter_path)){
                    if(!file_exists($chapter_path)){
                        touch($chapter_path);
                    }
                    file_put_contents($chapter_path,$chapter_content);
                    //echo '成功执行所有操作1';
                }else{
                    file_put_contents($chapter_path,$chapter_content);
                    //echo '成功执行所有操作2';
                }
            }
        }
        return Redirect::to('/OperateBook?book_id='.$book_id);
    }
}