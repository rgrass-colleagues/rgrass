<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-26
 * Time: 下午23:20
 */
class Home_UserController_AuthorController extends BaseController{
    private $is_user_login=null;
    private $redis =null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }
    /***申请成为作者****/
    public function ActivateAuthor(){
        $userBase = $this->getUserInfoDetailProperty();
        return View::make('Home.UserViews.ActivateAuthor')->with(array(
            'is_user_login'=>$this->is_user_login,
            'user_info'=>$userBase->user_info,
            'user_detail'=>$userBase->user_detail,
            'user_property'=>$userBase->user_property,
            'user_picture_url'=>$userBase->user_picture_url
        ));
    }
    public function doActivateAuthor(){
        $user_id = $this->get('user_id');
        if(User_UserNewInfoModel::TransferToAuthor($user_id)){
            User_UserNewInfoModel::insertAuthorData($user_id);
        }else{
            dd('您已经是作者');
        }
        return Redirect::to('/Author');
    }

    public function showAuthorCenter(){
        if($this->is_user_login->is_author != '1'){
            return Redirect::to('/ActivateAuthor');
        }
        $userBase = $this->getUserInfoDetailProperty();
        return View::make('Home.UserViews.AuthorCenter')->with(array(
            'is_user_login'=>$this->is_user_login,
            'user_info'=>$userBase->user_info,
            'user_detail'=>$userBase->user_detail,
            'user_property'=>$userBase->user_property,
            'user_picture_url'=>$userBase->user_picture_url
        ));
    }






    /***获取用户基本信息***/
    private function getUserInfoDetailProperty(){
        if(!isset($this->is_user_login)){
            return Redirect::to('/Login');
        }
        $user_property = User_UserNewInfoModel::getUserPropertyByUserId($this->is_user_login->user_id);
        $user_detail = User_UserNewInfoModel::getUserDetailById($this->is_user_login->user_id);


        //用户头像url
        $p_url = './uploads/users/'.$this->is_user_login->user_picture;
        $default_picture_url = './Home/img/user_default_picture.png';
        if($this->is_user_login->user_picture != ''){
            if(file_exists($p_url)){
                $user_picture_url = $p_url;
            }else{
                $user_picture_url = $default_picture_url;
            }
        }else{
            $user_picture_url = $default_picture_url;
        }
        //用户头像url end

        return $userBase = (object)array(
            'user_info'=>$this->is_user_login,
            'user_detail'=>$user_detail,
            'user_property'=>$user_property,
            'user_picture_url'=>$user_picture_url
        );
    }
}