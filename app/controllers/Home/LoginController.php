<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 15-4-22
 * Time: 上午12:11
 */
class Home_LoginController extends BaseController{
    public function showLogin(){
        return View::make('Home.login_reg.login');
    }
    public function showReg(){
        return View::make('Home.login_reg.reg');
    }
    public function doLogin(){
        $name=$this->post('email');
        $pass=$this->post('password');
        $type = $this->isEmail($name);
        $login=new Login_LoginModel();
        $doLogin=$login->isHomeLogin($name,$pass,$type);
        if(is_null($doLogin)){
            return View::make("Home.login_reg.loginError");

        }else{
            session_start();
            $_SESSION['user_login']=$name;
            return View::make("Home.login_reg.loginSuccess");
        }
    }
    /*
     * 注册过程
     * */
    public function doReg(){
        $username = $this->post('email');
        $password = $this->post('password');
        $pwdCache = md5($password.'rgrass.com');//设置密码缓存
        $type = $this->isEmail($username);
        $reg = new Login_LoginModel();
        $doReg = $reg->doHomeReg($username,$password,$type);
        if($doReg){
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            $redis->set($username,$pwdCache,3600);//设置redis
            $sendEmail = new Email_SendEmail();
            $sendEmail->sendEmail($username,$pwdCache);//发送邮件
            return View::make("Home.login_reg.regSuccess");
        }else{
            return View::make('Home.login_reg.regError');
        }
    }

    /*
     * ajax验证用户名是否已经存在
     * */
    public function ajaxUserConfirm(){
        $name = $this->post('email');
        $type = $this->isEmail($name);
        $login = new Login_LoginModel();
        if($type == 'username'){
            echo 2;
        }else{
            $doConfirm = $login->isUsernameEsist($name,$type);
            if(!empty($doConfirm)){
                echo 0;
            }else{
                echo 1;
            }
        }


    }
    /*
     * 判断是否为邮件格式
     * */
    public function isEmail($email){
        $pattern_email ='/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
        $pattern_telephone = '/\d+/';
        if(preg_match($pattern_email,$email)){
            $type='email';
        }else if(preg_match($pattern_telephone,$email)){
            $type='phone';
        }else{
            $type='username';
        }
        return $type;
    }

    /*
     * 进行邮件激活操作
     * */
    public function accountAcitvate(){
        $token = $this->get('token');
        $username = $this->get('username');
        if($token!=""){
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            $pwdCache = $redis->get($username);//设置redis
            if($token==$pwdCache){
                $activate=new Login_LoginModel();
                if($activate->toActivate($username)){
                    return View::make("Home.login_reg.activate");
                }else{
                    var_dump("激活失败");
                }
            }else{
                var_dump("激活失败");
            }

        }
    }

    /*
     * 退出登陆操作
     * */
    public function out(){
        session_start();
        unset($_SESSION['user_login']);
        return View::make("Home.login_reg.out");
    }
}
