<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-31
 * Time: 0:41
 */
/*该类记录一些日志*/
class Admin_LogController extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
    }
    public function showLogIndex(){
        $count_users = $this->countUserNumber();
        return View::make("Admin.LogViews.LogIndex")->with(array(
            'count_users'=>$count_users
        ));

    }
    /*
     * 查询所有用户数量
     * */
    public function countUserNumber(){
        $userInfo = new User_UserInfoModel();
        return $userInfo->getCountUserNumber();
    }
    /*
     * 查询书本数量(未完成)
     * */
    public function countBookNumber(){
        $bookInfo = new Book_BookInfoModel();
        return $bookInfo->getCountBookNumber();
    }
    /*进来浏览网站的IP情况*/
    public function showUserIPconditions(){
        $ip_filter = file_get_contents('./Logs/logFilter.txt');
        $arr_ip_filter = explode(',',$ip_filter);
        $day = $this->get('input_day');
        if(empty($day)){
            $day = date('Y-m-d',time());
        }
        $path_today = './Logs/log_'.$day.'.txt';
        $user_sign_by_ip = file_get_contents($path_today);
        $user_sign_by_ip = explode(',',$user_sign_by_ip);
        array_pop($user_sign_by_ip);
        foreach($user_sign_by_ip as $k=>$v){
            $ip_sign[$k]=unserialize($v);
            if(in_array($ip_sign[$k]['ip'],$arr_ip_filter)){
                unset($ip_sign[$k]);
            }
        }
        return View::make('Admin.LogViews.LogUsersCondition')->with(array(
            'ip_filter'=>$ip_filter,
            'ip_sign'=>$ip_sign
        ));
    }
    /*
     * 根据IP获取地址，需要开启curl功能
     * 新浪插件
     * */
    public function IPtoAddress(){
        dd($this->GetIpLookup($_GET['ip']));
    }

    /*
     * IP转换地址插件
     * 新浪插件
     * */
    function GetIpLookup($ip = ''){
        if(empty($ip)){
            return "";
        }
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
        if(empty($res)){ return false; }
        $jsonMatches = array();
        preg_match('#\{.+?\}#', $res, $jsonMatches);
        if(!isset($jsonMatches[0])){ return false; }
        $json = json_decode($jsonMatches[0], true);
        if(isset($json['ret']) && $json['ret'] == 1){
            $json['ip'] = $ip;
            unset($json['ret']);
        }else{
            return false;
        }
        return $json;
    }
}