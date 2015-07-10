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
    static private $author = 'author';


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
    static public function getUserInfoByUserId($user_id){
        return DB::table(self::$user_info)
            ->where('user_id',$user_id)
            ->first();
    }
    /*
     * 获取用户财产情况
     * */
    static public function getUserPropertyByUserId($user_id){
        return DB::table(self::$user_property)
        ->where('user_id',$user_id)
        ->first();
    }

    /***获取用户详情***/
    static public function getUserDetailById($user_id){
        return DB::table(self::$user_detail)
            ->where('user_id',$user_id)
            ->first();
    }
    /**修改一条user_info表的用户数据**/
    static public function modifyUserInfo($user_id,$content){
        return DB::table(self::$user_info)
            ->where('user_id',$user_id)
            ->update($content);
    }

    /***修改一条user_detail表的用户数据**/
    static public function modifyUserDetail($user_id,$content){
        return DB::table(self::$user_detail)
            ->where('user_id',$user_id)
            ->update($content);
    }



    /*把非作者状态改成作者状态*/
    static public function TransferToAuthor($user_id){
        $content = array('is_author'=>1);
        return DB::table(self::$user_info)
            ->where('user_id',$user_id)
            ->update($content);
    }

    /*变为作者状态后对作者数据表插入*/
    static public function insertAuthorData($user_id){
        $username = self::getUserInfoByUserId($user_id)->username;
        $content = array(
            'user_id'=>$user_id,
            'pen_name'=>$username,
            'addtime'=>time(),
        );
        return DB::table(self::$author)
            ->insert($content);
    }
}