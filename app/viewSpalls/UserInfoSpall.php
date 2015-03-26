<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-1-3
 * Time: 下午9:08
 */
class UserInfoSpall{
    public static function showUserAuthority($i){
        return $i==0?'管理员':'会员';
    }
}