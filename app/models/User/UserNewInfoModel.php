<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-12-28
 * Time: 上午11:24
 */
class User_UserNewInfoModel extends Eloquent{
    /*
     * 设置连接表
     * */
    static private $user_info = 'user_info';
    static private $user_detail = 'user_detail';
    static private $user_property = 'user_property';


    /*
     * 添加添加一条用户记录,return user_id
     * */
    static public function insertUserByContent($content){
        return DB::table(self::$user_info)
            ->insertGetId($content);
    }


    /*
     * 添加一条用户数据成功后,一般需要相继添加对应用户的详情表和财产表的信息
     * */
    static public function insertUserDetail($content){
        return DB::table(self::$user_detail)
            ->insert($content);
    }
    static public function insertUserProperty($content){
        return DB::table(self::$user_property)
            ->insert($content);
    }


    /*
     * 验证该邮箱是否已经存在
     * */
    static public function isEmailExists($email){
        return DB::table(self::$user_info)
            ->where('email',$email)
            ->first();
    }
}