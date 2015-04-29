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
        $this->is_admin_login();
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
    /*
     * 用户详情
     * */
    public function showUserDetail(){
        $user_id=$this->get('id');
        $user_detail=$this->userModel->getUserDetailByUserId($user_id);
        if(!$user_detail){
            throw new exception("该用户没有详情");
        }
        return View::make('Admin.UserDetail')->with(array(
            'user_detail'=>$user_detail
        ));
    }
    /*
     * 添加和修改，通过page_type作为判断依据
     * */
    public function AddNewOrModifyOneUser(){
        $page_type = $this->get('page_type');
        $uid = $this->get('user_id');
        $userInfo = null;
        $userDetail = null;
        if($page_type == 'modify'){//如果是修改的
            $userInfo = $this->userModel->getUserBaseInfoById($uid);
            $userDetail = $this->userModel->getUserDetailByUserId($uid);
        }
        return View::make('Admin.AddNewOrModifyOneUser')->with(array(
            'page_type'=>$page_type,
            'userInfo'=>$userInfo,
            'userDetail'=>$userDetail
        ));
    }
    public function doAddNewOrModifyOneUser(){
        foreach($_POST as $k=>$v){
            if($k=='page_type'){
                $page_type=$_POST[$k];
                continue;
            }
            //通过info甄别把用户的基础信息和详情信息分开，方便等下插入数据库中
            $str=substr($k,0,4);
            if($str&&$str=='info'){
                $key=substr($k,5);
                $userInfo[$key]=$v;
            }else{
                $userDetail[$k]=$v;
            }
        }
        $userInfo['addtime']=time();
        $userInfo['last_login_time']=0;
        //用户处在修改状态的时候
        if($page_type == 'modify'){
            $modifyDetail = $this->userModel->modifyUserDetailByUid($userDetail,$userInfo['user_id']);
            $this->userModel->modifyUserInfoByUid($userInfo,$userInfo['user_id']);
            if(!$modifyDetail){
                $userDetail['user_id']=$userInfo['user_id'];
                $this->userModel->insertNewUserDetail($userDetail);
            }
        }else{
            //用户处在增添状态的时候
            $user_create_id = $this->userModel->insertNewUser($userInfo);
            if(isset($user_create_id)){
                $userDetail['user_id']=$user_create_id;
                $create_new_detail = $this->userModel->insertNewUserDetail($userDetail);
                if($create_new_detail){
                    echo '<script>alert("添加用户成功")</script>';
                }
            }
        }
        return Redirect::to('/rgrassAdmin/UserInfo');
    }
}