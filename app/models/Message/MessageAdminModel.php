<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-5
 * Time: 11:12
 */
class Message_MessageAdminModel extends Eloquent{
    private $msg='message_admin';
    /*
     * 查询所有的针对管理员的消息
     * */
    public function getAllAdminMessage(){
        return DB::table($this->msg)
            ->orderBy('message_id', 'desc')
            ->get();
    }
    /*
     * 删除某一条针对管理员的信息
     * */
    public function delAdminMessage($message_id){
        return DB::table($this->msg)
            ->where('message_id',$message_id)
            ->delete();
    }
}