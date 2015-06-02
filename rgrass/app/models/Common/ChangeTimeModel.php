<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-4-3
 * Time: 00:08
 */
class Common_ChangeTimeModel extends Eloquent{
    /*
     * 把时间戳转化成具体时间
     * */
    public function Inttotime($strtotime,$default=null){
        return date('Y-m-d H:i:s',$strtotime);
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