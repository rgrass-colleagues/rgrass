<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-12-28
 * Time: 上午11:24
 */
class User_UserInfoModel extends Eloquent{
    /*
     * 设置连接表
     * */
    protected $users = 'user_info';
    protected $user_detail = 'user_detail';
    /*
     * 查询users表全部数据
     * */
    public function getUserBaseInfoAll(){
        return DB::table($this->users)
            ->get();
    }
    /*
     * 根据ID查询users一条用户信息
     * */
    public function getUserBaseInfoById($id){
        return DB::table($this->users)
            ->where('user_id',$id)
            ->first();
    }
    public function getUserDetailByUserId($user_id){
        return DB::table($this->user_detail)
            ->where('user_id',$user_id)
            ->first();
    }
    public function insertNewUser($content){
        return DB::table($this->users)
            ->insertGetId($content);
    }
    public function insertNewUserDetail($content){
        return DB::table($this->user_detail)
            ->insert($content);
    }
    public function modifyUserInfoByUid($content,$uid){
        return DB::table($this->users)
            ->where('user_id',$uid)
            ->update($content);
    }
    public function modifyUserDetailByUid($content,$uid){
        return DB::table($this->user_detail)
            ->where('user_id',$uid)
            ->update($content);
    }
    public function getUserInfoByUserName($username){
        return DB::table($this->users)
            ->where('username',$username)
            ->first();
    }
}