<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-10
 * Time: 下午11:22
 */
class Admin_LoginController extends BaseController{
    private $loginModel = null;
    public function __construct(){
        $this->loginModel = new Login_LoginModel();
    }
    public function LoginIndex(){
        return View::make('Admin.LoginIndex');
    }
    public function doLoginAdmin(){
        $name=$_POST['username'];
        $pass=$_POST['password'];
        $pass = md5(md5($pass));
        $login=$this->loginModel->isConfirm($name,$pass);
        if(is_null($login)){
            throw new Exception('登陆后台失败');
        }else{
            session_start();
            $_SESSION['login']=md5(md5($pass));
            return Redirect::to('rgrassBlogAdmin/IndexCenter');
        }
    }
}