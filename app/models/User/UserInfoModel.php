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
    private $property = 'user_property';
    private $tag = 'user_tag';
    private $author = 'author';
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
    /*
     * 根据user_id查到user_name
     * */
    public function getUserNameByUserId($user_id){
        return DB::table($this->users)
            ->where('user_id',$user_id)
            ->select('username')
            ->first();
    }
    public function getUserIdByUserName($user_name){
        return DB::table($this->users)
            ->where('username',$user_name)
            ->lists('user_id');
    }
    /*
     * 根据user_id查询用户详情
     * */
    public function getUserDetailByUserId($user_id){
        return DB::table($this->user_detail)
            ->where('user_id',$user_id)
            ->first();
    }
    /*
     * 添加新用户
     * */
    public function insertNewUser($content){
        return DB::table($this->users)
            ->insertGetId($content);
    }
    /*
     * 添加新详情
     * */
    public function insertNewUserDetail($content){
        return DB::table($this->user_detail)
            ->insert($content);
    }
    /*
     * 修改用户信息
     * */
    public function modifyUserInfoByUid($content,$uid){
        return DB::table($this->users)
            ->where('user_id',$uid)
            ->update($content);
    }
    /*
     * 修改用户详情
     * */
    public function modifyUserDetailByUid($content,$uid){
        return DB::table($this->user_detail)
            ->where('user_id',$uid)
            ->update($content);
    }
    /*
     * 根据用户名获取用户信息
     * */
    public function getUserInfoByUserName($username){
        return DB::table($this->users)
            ->where('username',$username)
            ->first();
    }
    /*
     * 统计用户数量
     * */
    public function getCountUserNumber(){
        return DB::table($this->users)->count();
    }
    /*
     * 删除该用户
     * */
    public function delUserByUId($user_id){
        return DB::table($this->users)
            ->where('user_id',$user_id)
            ->delete();
    }
    /*创建用户的时候同时创建用户财产*/
    public function createUserProperty($user_id){
        $content = array('user_id'=>$user_id);
        return DB::table($this->property)
            ->insert($content);
    }
    /*通过id查看用户财产情况*/
    public function getUserPropertyByUserId($user_id){
        return DB::table($this->property)
            ->where('user_id',$user_id)
            ->first();
    }
    /*通过id修改用户财产*/
    public function modifyUserProperty($user_id,$content){
        return DB::table($this->property)
            ->where('user_id',$user_id)
            ->update($content);
    }



    /*添加一条用户标签*/
    public function addUserTags($user_id){
        $content = array('user_id'=>$user_id);
        return DB::table($this->tag)
            ->insert($content);
    }


    /*把非作者状态改成作者状态*/
    public function TransferToAuthor($user_id){
        $content = array('is_author'=>1);
        return DB::table($this->users)
            ->where('user_id',$user_id)
            ->update($content);
    }

    /*变为作者状态后对作者数据表插入*/
    public function insertAuthorData($user_id){
        $username = $this->getUserNameByUserId($user_id)->username;
        $content = array(
            'user_id'=>$user_id,
            'pen_name'=>$username,
            'addtime'=>time(),
        );
        return DB::table($this->author)
            ->insert($content);
    }

    /*查询所有作者*/
    public function getAllAuthorInfo(){
        return DB::table($this->author)
            ->get();
    }

    /*查询一条作者信息*/
    public function getAuthorById($id){
        return DB::table($this->author)
            ->where('id',$id)
            ->first();
    }

    /*修改对应的作者信息*/
    public function modifyAuthorInfo($user_id,$content){
        return DB::table($this->author)
            ->where('user_id',$user_id)
            ->update($content);
    }


    /*查询所有标签*/
    public function getAllSelftag(){
        return DB::table($this->tag)
            ->get();
    }
}