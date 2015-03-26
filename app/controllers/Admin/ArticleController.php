<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-3
 * Time: 下午8:53
 */
class Admin_ArticleController extends BaseController{
    private $articleModel = null;
    private $TypeModel = null;
    public function __construct(){
        $this->articleModel = new Article_ArticleInfoModel();
        $this->TypeModel = new Type_TypeInfoModel();
    }
    public function showArticleLists(){
        session_start();
        if (!isset($_SESSION['login']))
        {
            throw new Exception('登陆失败');
        }
        $articleBaseInfo = $this->articleModel->getArticleBaseInfoAll();
        return View::make('Admin.ArticleLists')->with(array(
            'article'=> $articleBaseInfo
        ));
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