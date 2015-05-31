<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 15-5-31
 * Time: 下午10:00
 */
class FriendsLink_FriendsLinkModel extends Eloquent{
    private $friends_link = 'friends_link';

   /* 获取全部信息*/
    public function getFriendsLinksAll(){
        return DB::table($this->friends_link)
            ->get();
    }

    /*根据id获取*/

    public function getFriendsLinksbyId($id){
        return DB::table($this->friends_link)
            ->where('link_id',$id)
            ->get();
    }

    /*
    * 添加和修改
    * @param1 传入数据库的内容
    * @param2 判断 添加||修改
    * @param3 修改链接id
    */

    public function addFriends_Link($link_content,$type,$id){
        if($type == '') return false;
        $query= DB::table($this->friends_link);
        switch ($type){
            case 'create':
                return $query
                    ->insertGetId($link_content);
            case 'modify':
                return $query
                    ->where('link_id',$id)
                    ->update($link_content);
        }

    }
    /*
     * 根据id删除*/
    public function deleteFriends_Link($id){
        return DB::table($this->friends_link)
            ->where('link_id',$id)
            ->delete();
    }
}