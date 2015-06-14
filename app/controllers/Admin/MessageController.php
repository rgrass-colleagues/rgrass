<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-3
 * Time: 下午17:55
 */
class Admin_MessageController extends BaseController{
    private $msg = null;
    private $user = null;
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
        $this->msg = new Message_MessageAdminModel();
        $this->user = new User_UserInfoModel();
    }
    /*
     * 展示所有针对管理员的message
     * */
    public function showMessageIndex(){
        $admin_message = $this->msg->getAllAdminMessage();

        return View::make('Admin.MessageViews.MessageIndex')->with(array(
            'admin_message'=>$admin_message
        ));
    }
    /*
     * 管理员对留言用户的回复
     * */
    public function replyAdminMessage(){
        $to_user = $this->get('to_user');
        $sender = $this->get('sender');
        $receiver = $this->get('receiver');
        if($to_user=="1"){
            return '该信息已经属于回复';
        }else{
            return View::make('Admin.MessageViews.replyAdminMessage')->with(array(
                'sender'=>$sender,
                'receiver'=>$receiver
            ));
        }
    }
    /*
     * 执行回复
     * */
    public function doReplyAdminMessage(){
        $estimate_content = $this->post('estimate_content');
        $sender = $this->post('sender');
        $receiver = $this->post('receiver');
        $content = array('sender'=>$sender,'receiver'=>$receiver,'estimate_content'=>$estimate_content,'to_user'=>1,'addtime'=>time());
        if($this->msg->insertReplyAdminMessage($content)){
            return Redirect::to('/rgrassAdmin/MessageManager');
        }else{
            dd('添加失败');
        }

    }
    /*
     * 删除某一条针对管理员信息
     * */
    public function delAdminMessage(){
        $message_id = $this->get('message_id');
        if($this->msg->delAdminMessage($message_id)){
            return Redirect::to('/rgrassAdmin/MessageManager');
        }else{
            dd('删除失败');
        }
    }
}