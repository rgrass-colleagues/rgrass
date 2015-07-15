<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-26
 * Time: 下午23:20
 */
class Home_UserController_UserController extends BaseController{
    private $redis =null;
    public function __construct(){
        parent::__construct();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }
    public function showUserCenter(){
        return View::make('Home.UserViews.UserCenter')->with(array(

        ));
    }


    /**修改用户昵称，修改email，修改电话号码，修改qq**/
    public function UserInfoModify(){
        return View::make('Home.UserViews.UserInfoModify')->with(array(

        ));
    }
    public function doUserInfoModify(){
        $username=$this->post('username')?$this->post('username'):false;
        $telephone = $this->post('telephone');
        $qq = $this->post('qq');
        $user_id = $this->post('user_id');
        if($username){
            $content = array(
                'username'=>$username,
                'telephone'=>$telephone,
                'qq'=>$qq,
                'is_uname_modify'=>0
            );
        }else{
            $content = array(
                'telephone'=>$telephone,
                'qq'=>$qq,
            );
        }
        User_UserNewInfoModel::modifyUserInfo($user_id,$content);
        return Redirect::to('/User');
    }


    /**修改detail，性别，自我描述**/
    public function UserDetailModify(){
        return View::make('Home.UserViews.UserDetailModify')->with(array(

        ));
    }
    public function doUserDetailModify(){
        $user_id = $this->post('user_id');
        $content = array(
            'sex'=>$this->post('sex'),
            'user_estimate'=>$this->post('user_estimate'),
        );
        User_UserNewInfoModel::modifyUserDetail($user_id,$content);
        return Redirect::to('/User');
    }
    /***修改照片***/
    public function UserPictureModify(){
        return View::make('Home.UserViews.UserPictureModify')->with(array(

        ));
    }
    public function doUserPictureModify(){
        $user_id = $this->post('user_id');
        $user_picture = Common_FileUploadsModel::NewFileUploads('user_picture','users');
        $content = array('user_picture'=>$user_picture);
        User_UserNewInfoModel::modifyUserInfo($user_id,$content);
        return Redirect::to('/User');
    }


    /****找回密码（简易版，以后迭代重做）***/
    public function UserPasswordModify(){
        return View::make('Home.UserViews.UserPasswordModify')->with(array(

        ));
    }
    public function doUserPasswordModify(){
        $old_pass = $this->post('old_password');
        $user_id = $this->post('user_id');
        if($user_info = User_UserNewInfoModel::getUserInfoByUserId($user_id)){
            $old_pass = Login_LoginModel::authNewCode($old_pass,'www.rgrass.com');
            if(!($old_pass == $user_info->password)){
                dd('您输入的旧密码不正确');
            }
        }
        $new1_pass = $this->post('new1_password');
        $new2_pass = $this->post('new2_password');
        if(($new1_pass == $new2_pass) && (strlen($new1_pass) > 5)){
            $content = array(
                'password'=> Login_LoginModel::authNewCode($new1_pass,'www.rgrass.com'),
            );
            User_UserNewInfoModel::modifyUserInfo($user_id,$content);
        }else{
            dd('新密码两次输入要一致,且要大于5位字符');
        }
        return Redirect::to('/User');
    }
}