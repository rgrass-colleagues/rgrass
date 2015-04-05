<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-12-28
 * Time: 上午10:17
 */
class Admin_UserController extends BaseController{
    private $userModel = null;
    private $commonModel = null;
    public function __construct(){
        parent::__construct();
        $this->userModel = new User_UserInfoModel();
        $this->commonModel = new Common_ChangeTimeModel();
    }
    //在页面中列表显示
    public function showAdminUserInfo(){
        $userBaseInfo = $this->userModel->getUserBaseInfoAll();
        //
        foreach($userBaseInfo as $k=>$v){
            $userBaseInfo[$k]->authority=$this->showUserAuthoirtysign($v->authority);
            $userBaseInfo[$k]->addtime=$this->commonModel->Inttotime($v->addtime);
            $userBaseInfo[$k]->last_login_time=$this->commonModel->Inttotime($v->last_login_time);
        }
        return View::make('Admin.UserCenter')->with(array(
            'user_info'=>$userBaseInfo
        ));
//        return '来自AdminUserInfo';
    }
    //显示用户权限的class
    protected function showUserAuthoirtysign($user_authority){
        switch($user_authority){
            case 0:
                return '管理员';break;
            case 1:
                return '会员';break;
        }
    }
}