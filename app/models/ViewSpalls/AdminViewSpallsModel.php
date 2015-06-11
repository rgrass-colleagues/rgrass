


<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-4-3
 * Time: 00:08
 */
class ViewSpalls_AdminViewSpallsModel extends Eloquent{
    /*
     * 通过user_id获得username
     * */
    static public function getUserNameByUserIdS($user_id){
        $query = DB::table('user_info')
            ->where('user_id',$user_id)
            ->select('username')
            ->first();
        return $query->username;
    }
    /*
     * 解析用户对小说行为
     * */
    static public function expressiveBehavior($user_id,$behavior,$value){
        $username = self::getUserNameByUserIdS($user_id);
        if($behavior=='1'){
            return "<span style='color:#060;'>{$username}</span>投了<span style='color:red;'>{$value}</span>张推荐票";
        }else if($behavior=='2'){
            return "<span style='color:#060;'>{$username}</span>打赏了<span style='color:red;'>{$value}</span>元燃草币";
        }
    }
    /*@用户*/
    static public function getAtUserNameByUserIdS($user_id){
        $query = DB::table('user_info')
            ->where('user_id',$user_id)
            ->select('username')
            ->first();
        return "<span style=\"color:#060\">@</span><span style='color:darkred'>{$query->username}</span>";
    }
    /*
     * 解析评论好坏程度
     * */
    static public function showNiceDiscuss($nice_discuss){
        switch($nice_discuss){
            case 0:
                return "<span style=\"color:gray;\">普通评论</span>";
                break;
            case 1:
                return "<span style=\"color:black\">好评</span>";
                break;
            case 2:
                return "<span style=\"color:gold\">精华评论</span>";
            break;
            case 3:
                return "<span style=\"color:red;font-size:18px;\">绝世好评!!</span>";

        }
    }
}