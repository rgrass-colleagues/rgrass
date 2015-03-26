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
    protected $users = 'blog_users';
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
            ->where('id',$id)
            ->first();
    }

}