<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-12-28
 * Time: 上午11:24
 */
class Author_AuthorInfoModel extends Eloquent{
    static private $author = 'author';
    /****添加新作者****/
    static public function insertIntoAuthor($content){
        return DB::table(self::$author)
            ->insert($content);
    }
    /*****验证该用户是否已经是作者*******/
    static public function confirmUserIsAuthor($user_id){
        return DB::table(self::$author)
            ->where('user_id',$user_id)
            ->first();
    }
    /****验证此笔名是否已经存在*****/
    static public function confirmAuthorPenNameExists($pen_name){
        return DB::table(self::$author)
            ->where('pen_name',$pen_name)
            ->first();
    }

    /***通过user_id获取作者信息*******/
    static public function getAuthorInfoByUserId($user_id){
        return DB::table(self::$author)
            ->where('user_id',$user_id)
            ->first();
    }
    static public function AuthorLoginByPassword($user_id,$password){
        $password = Login_LoginModel::authNewCode($password);
        return DB::table(self::$author)
            ->where('user_id',$user_id)
            ->where('author_password',$password)
            ->first();
    }
}