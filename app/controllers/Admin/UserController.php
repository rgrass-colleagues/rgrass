<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-12-28
 * Time: 上午10:17
 */
class Admin_UserController extends BaseController{
    private $userModel = null;
    public function __construct(){
        $this->userModel = new User_UserInfoModel();
    }
    public function showAdminUserInfo(){
        session_start();
        if (!isset($_SESSION['login']))
        {
            throw new Exception('登陆失败');
        }
        $UserBaseInfo = $this->userModel->getUserBaseInfoAll();
        return View::make('Admin.UserCenter')->with(array(
            'Uinfo'=>$UserBaseInfo
        ));
//        return '来自AdminUserInfo';
    }
}