<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-11
 * Time: 上午12:23
 */
class Login_LoginModel extends Eloquent{
    protected $login = 'user_info';
    /*
     * 验证后台登陆账号密码是否正确
     */
    public  function isConfirm($user,$pwd){
        return DB::table($this->login)
            ->where(array('username'=>$user,'password'=>$pwd,'authority'=>0))
            ->first();
    }

    /*
     * 验证前台登陆账号密码
     * */
    public function isHomeLogin($user,$pwd,$type){
        $pwd = $this->authcode($pwd,$key="www.rgrass.com");
        $query = DB::table($this->login);
        if($type=='username'){
            return $query->where(array('username'=>$user,'password'=>$pwd,'authority'=>1))->first();
        }else if($type=='email'){
            return $query->where(array('email'=>$user,'password'=>$pwd,'authority'=>1))->first();
        }else if($type=='phone'){
            return $query->where(array('telephone'=>$user,'password'=>$pwd,'authority'=>1))->first();
        }
    }
    /*
     * 验证用户名是否存在
     * */
    public function isUsernameEsist($username,$type){
        return DB::table($this->login)
            ->where(array('email'=>$username,'authority'=>1))
            ->first();
    }
    /*
     * 注册
     * */
    public function doHomeReg($username,$password,$type){
        $content = $this->regContent($username,$password,$type);
        if($type=='email'){
            return DB::table($this->login)
                ->insert($content);
        }
    }
    /*
     * 注册内容
     * */
    public function regContent($username,$password,$type){
        $content = array();
        $email="";
        $telphone="";
        if($type=='email'){
            $email = $username;//输入进来的是邮箱
            $username = explode('@',$username);
            $username = $username[0];//截取邮箱@前面的部分,当做用户名
        }

        $content['username']=$username;
        $content['password'] = $this->authcode($password,$key="www.rgrass.com");
        $content['user_picture']='0.jpg';
        $content['authority']=1;
        $content['credit']=0;
        $content['is_author']=0;
        $content['addtime']=time();
        $content['last_login_time']=time();
        $content['email']=$email;
        $content['telephone']=$telphone;
        $content['is_activate']=0;
        return $content;
    }
    /*
     *  加密
     *
     * */
    public function authcode($str, $key = '') {
        return md5($str.$key.$str).md5($key.$str.$key);
    }
    /*
     * 激活
     * */
    public function toActivate($username){
        $username = explode('@',$username);
        $username = $username[0];//截取邮箱@前面的部分,当做用户名
        return DB::table($this->login)
            ->where(array('username'=>$username))
            ->update(array('is_activate'=>1));
    }
}