


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
    /*
 * 处理信息的状态码(0,1)
 * */
    static public function toUserCondition($to_user){
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
     * 显示书籍类型
     * */
    static public function showBookType($type_id){
        if($type_id==0){
            return '初始化';
        }else{
            $type = new Type_TypeInfoModel();
            $type_info = $type->getTypeInfoById($type_id);
            if($type_info->parent_type==0){
                return '分类错误';
            }else{
                $p_type_info = $type->getTypeInfoById($type_info->parent_type);
                return $p_type_info->type_name.'->'.$type_info->type_name;
            }
        }
    }
    /*
     * 通过书籍id得到书名
     * */
    static public function changeBookIdIntoBookName($book_id){
        $book = new Book_BookInfoModel();
        $book_name = $book->getBookBaseInfoById($book_id)->book_name;
        return $book_name;
    }
}