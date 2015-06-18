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
        $this->is_admin_login();
        $this->userModel = new User_UserInfoModel();
        $this->commonModel = new Common_ChangeTimeModel();
    }
    //在页面中列表显示
    public function showAdminUserInfo(){
        $userBaseInfo = $this->userModel->getUserBaseInfoAll();
        foreach($userBaseInfo as $k=>$v){
            $userBaseInfo[$k]->authority=$this->showUserAuthoirtysign($v->authority);
            $userBaseInfo[$k]->is_author = $this->showUserIsAuthorSign($userBaseInfo[$k]->is_author);//是否作者
            $userBaseInfo[$k]->addtime=$this->commonModel->Inttotime($v->addtime);
            $userBaseInfo[$k]->last_login_time=$this->commonModel->Inttotime($v->last_login_time);
        }
        return View::make('Admin.UserViews.UserCenter')->with(array(
            'user_info'=>$userBaseInfo
        ));
    }
    /*
     * 显示用户权限的
     * */
    protected function showUserAuthoirtysign($user_authority){
        switch($user_authority){
            case 0:
                return '管理员';break;
            case 1:
                return '会员';break;
        }
    }
    /*
     * 显示用户性别
     * */
    public function showUserSexSign($user_sex){
        switch($user_sex){
            case 0:
                return '男';break;
            case 1:
                return '女';break;
        }
    }
    /*
     * 显示该用户是否是作者
     * */
    public function showUserIsAuthorSign($is_author){
        switch($is_author){
            case 0:
                return '否';break;
            case 1:
                return '是';break;
        }
    }
    /*
     * 用户详情
     * */
    public function showUserDetail(){
        $user_id=$this->get('id');
        $user_info = $this->userModel->getUserBaseInfoById($user_id);
        $user_detail=$this->userModel->getUserDetailByUserId($user_id);
        if(!$user_detail){
            throw new exception("该用户没有详情");
        }
        $user_info->authority = $this->showUserAuthoirtysign($user_info->authority);//权限
        $user_detail->sex = $this->showUserSexSign($user_detail->sex);//性别
        $user_info->is_author = $this->showUserIsAuthorSign($user_info->is_author);//是否作者
        return View::make('Admin.UserViews.UserDetail')->with(array(
            'userInfo'=>$user_info,
            'userDetail'=>$user_detail
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
        return View::make('Admin.UserViews.AddNewOrModifyOneUser')->with(array(
            'page_type'=>$page_type,
            'userInfo'=>$userInfo,
            'userDetail'=>$userDetail
        ));
    }
    public function doAddNewOrModifyOneUser(){
        $file_upload = new Common_FileUploadsModel();
        $userInfo['user_picture'] = $file_upload->FileUpload('user_picture','users');//图片上传处理
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
        $auth_code = new Login_LoginModel();
        $userInfo['password'] = $auth_code->authcode($userInfo['password'],'www.rgrass.com');
        $userInfo['addtime']=time();
        $userInfo['last_login_time']=0;
        //删掉以前的图片
        $del_file_url = './uploads/users/'.$userInfo['last_user_picture'];
        //判断是否有进行图片上传
        if(!$userInfo['user_picture']){
            $userInfo['user_picture']=$userInfo['last_user_picture'];
        }else{//有进行图片上传才把以前的图片给删了
            if(file_exists($del_file_url) && is_file($del_file_url)){
                unlink($del_file_url);
            }
        }
        unset($userInfo['last_user_picture']);
        //删除多余的变量
        unset($userDetail['MAX_FILE_SIZE']);
        //此处结束数据进入
//        dd($userDetail);
//        dd($userInfo);
        //用户处在修改状态的时候
        if($page_type == 'modify'){
            $modifyDetail = $this->userModel->modifyUserDetailByUid($userDetail,$userInfo['user_id']);
            $this->userModel->modifyUserInfoByUid($userInfo,$userInfo['user_id']);
            if(!$modifyDetail){
                $userDetail['user_id']=$userInfo['user_id'];
                if(!$this->userModel->insertNewUserDetail($userDetail)){
                    dd('创建user_detail内容失败');
                }

            }
        }else{
            //用户处在增添状态的时候
            $user_create_id = $this->userModel->insertNewUser($userInfo);
            if(isset($user_create_id)){
                $userDetail['user_id']=$user_create_id;
                if(!$this->userModel->insertNewUserDetail($userDetail)){
                    dd('创建用户详情失败');
                }
                if(!$this->userModel->createUserProperty($user_create_id)){
                    dd('创建用户财产失败');
                }
            }
        }
        return Redirect::to('/rgrassAdmin/UserInfo');
    }

    /*
     * 删除用户
     * */
    /*//现在不能删除用户了
    public function doDelUser(){
        $user_id = $this->get('user_id');
        $this->userModel->delUserByUId($user_id);
        return Redirect::to('/rgrassAdmin/UserInfo');
    }*/
    /*查看用户财产*/
    public function showUserPropertyIndex(){
        $user_id = $this->get('user_id');
        $user_property = $this->userModel->getUserPropertyByUserId($user_id);
        return View::make('Admin.UserViews.UserPropertyIndex')->with(array(
            'user_property'=>$user_property
        ));
    }
    public function ModifyUserProperty(){
        $user_id = $this->get('user_id');
        $user_property = $this->userModel->getUserPropertyByUserId($user_id);
        return View::make('Admin.UserViews.ModifyUserProperty')->with(array(
            'user_property'=>$user_property
        ));
    }
    public function doModifyUserProperty(){
        $user_id = $this->post('user_id');
        $content = array(
            'user_id'=>$user_id,
            'points'=>$this->post('points'),
            'rgrass_coin'=>$this->post('rgrass_coin'),
            'recommend_ticket'=>$this->post('recommend_ticket'),
        );
        if($this->userModel->modifyUserProperty($user_id,$content)){
            return Redirect::to('/rgrassAdmin/UserPropertyIndex?user_id='.$user_id);
        }

    }
    public function doUserTransferAuthor(){
        $user_id = $this->get('user_id');
        if($this->userModel->TransferToAuthor($user_id)){
            /*需要在此处对作者表插入数据(暂无此功能)*/
            if($this->userModel->insertAuthorData($user_id)){
                Return Redirect::to('/rgrassAdmin/UserInfo');
            }else{
                dd('插入作者表失败');
            }
        }else{
            dd('转职成作者失败');
        }
    }
    public function showAuthorIndex(){
        $author_info = $this->userModel->getAllAuthorInfo();
        return View::make('Admin.UserViews.AuthorIndex')->with(array(
            'author_info'=>$author_info
        ));
    }
    public function showModifyAuthorInfo(){
        $id = $this->get('id');
        $author = $this->userModel->getAuthorById($id);
        return View::make('Admin.UserViews.ModifyAuthorInfo')->with(array(
            'author'=>$author
        ));
    }

    public function doModifyAuthorInfo(){
        $user_id = $this->post('user_id');
        $content = array(
            'pen_name'=>$this->post('pen_name'),
            'author_in_mind'=>$this->post('author_in_mind'),
            'addtime'=>time(),
        );
        if($this->userModel->modifyAuthorInfo($user_id,$content)){
            return Redirect::to('/rgrassAdmin/AuthorIndex');
        }else{
            dd('修改失败');
        }
    }
}