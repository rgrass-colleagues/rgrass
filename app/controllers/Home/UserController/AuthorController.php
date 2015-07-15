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

    /******作者专区公告（首页）********/
    public function AuthorNotice(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $author_info = Author_AuthorInfoModel::getAuthorInfoByUserId($this->is_user_login()->user_id);
        return View::make('Home.UserViews.AuthorNotice')->with(array(
            'author_info'=>$author_info
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
    /*********作者专区，小说管理************/
    public function BookManager(){
        if($this->is_user_login()->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        if(!isset($_SESSION['author_login'])){
            return Redirect::to('/AuthorLogin');
        }
        $author_info = Author_AuthorInfoModel::getAuthorInfoByUserId($this->is_user_login()->user_id);

        return View::make('Home.UserViews.BookManager')->with(array(
            'author_info'=>$author_info
        ));
    }


}