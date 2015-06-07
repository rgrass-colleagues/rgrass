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
        foreach($admin_message as $v){
            //此处对从数据库里查询的信息作处理
            $v->sender_name = $this->messageViewSpall('user_id',$v->sender);
            $v->receiver_name = $this->messageViewSpall('admin_id',$v->receiver);
            $v->to_user_name = $this->messageViewSpall('to_user',$v->to_user);
            $v->addtime = $this->messageViewSpall('addtime',$v->addtime);
        }
        return View::make('Admin.MessageViews.MessageIndex')->with(array(
            'admin_message'=>$admin_message
        ));
    }
    /*
     * 处理传进来的信息data
     * */
    public function messageViewSpall($spall,$val){
        switch($spall){
            case 'user_id':
                return $this->user->getUserNameByUserId($val)[0];
            case 'admin_id':
                return $this->user->getUserNameByUserId($val)[0];
            break;
            case 'to_user';
                return $this->toUserCondition($val);
            break;
            case 'addtime';
                return date('Y-m-d H:i:s',$val);
            break;
            default:
                dd('error');
        }

    }
    /*
     * 处理信息的状态码(0,1)
     * */
    public function toUserCondition($to_user){
        switch($to_user){
            case 0:
                return '<span style=\'color:red\'>管理员查收</span>';
            break;
            case 1:
                return '<span style=\'color:#060\'>管理员回复</span>';
                break;
        }
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