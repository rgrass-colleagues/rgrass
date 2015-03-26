<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-11
 * Time: 上午12:23
 */
class Login_LoginModel extends Eloquent{
    protected $login = 'blog_users';
    /*
     * 验证后台登陆账号密码是否正确
     */
    public  function isConfirm($user,$pwd){
        return DB::table($this->login)
            ->where(array('user_username'=>$user,'user_password'=>$pwd,'user_status'=>0))
            ->first();
    }
}