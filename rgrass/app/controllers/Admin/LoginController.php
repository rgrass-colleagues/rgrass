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
        parent::__construct();
        $this->loginModel = new Login_LoginModel();
    }
    public function LoginIndex(){
        return View::make('Admin.LoginIndex');
    }
    //do login
    public function doLoginAdmin(){
        $name=$this->post('username');
        $pass=$this->post('password');
        $login=$this->loginModel->isConfirm($name,$pass);
        if(is_null($login)){
            throw new Exception('登陆后台失败');
        }else{
            session_start();
            $_SESSION['admin_login']=$pass;
            return Redirect::to('rgrassAdmin/IndexCenter');
        }
    }
}