<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-3
 * Time: 下午8:53
 */
class Admin_BookController extends BaseController{
    private $BookModel = null;
//    private $TypeModel = null;
    public function __construct(){
        $this->BookModel = new Book_BookInfoModel();
//        $this->TypeModel = new Type_TypeInfoModel();
    }
    public function showBookLists(){
        parent::__construct();
        $BookBaseInfo = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.BookLists')->with(array(
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
        $oneBookAllDetail->book_type=$this->BookModel->bookType($oneBookAllDetail->book_type);
        return json_encode($oneBookAllDetail);
    }




    public function showArticleContent(){
        session_start();
        if (!isset($_SESSION['login']))
        {
            throw new Exception('登陆失败');
        }
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $articleContent = $this -> articleModel -> getArticleBaseInfoById($id);
            if($articleContent){
                return View::make('Admin.ArticleContent')->with(array(
                    'articleContent'=>$articleContent
                ));
            }else{
                throw new Exception('没有这篇文章');
            }
        }else{
            throw new Exception('没有这篇文章');
        }
    }
    public function AddNewArticle(){
        session_start();
        if (!isset($_SESSION['login']))
        {
            throw new Exception('登陆失败');
        }
        $type = $this->TypeModel->getTypeBaseInfoAll();
        for($i=0;$i<count($type);$i++){
            if($type[$i]->type_pid==0){
                unset($type[$i]);
            }
        }
        $id=isset($_GET['id'])?$_GET['id']:null;
        $article=$this->articleModel->getArticleBaseInfoById($id);
        return View::make('Admin.AddNewArticle')->with(array(
            'article'=>$article,
            'type'=>$type
        ));
    }
    public function doAddNewArticle(){
        session_start();
        if (!isset($_SESSION['login']))
        {
            throw new Exception('登陆失败');
        }
        $id=isset($_POST['id'])?$_POST['id']:null;
        $title = $_POST['title'];
        $type = $_POST['type'];
        $content = $_POST['content'];
        $newArticle = $this->articleModel->insertNewArticle($title,$type,$content,$id);
        if($newArticle){
            return '操作成功<script>setTimeout(function(){window.location.href="ArticleLists"},3000)</script>';
        }
    }
}