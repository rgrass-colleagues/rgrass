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
        return View::make("Admin.LogIndex")->with(array(
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
     * 查询书本数量
     * */
    public function countBookNumber(){
        $bookInfo = new Book_BookInfoModel();
        return $bookInfo->getCountBookNumber();
    }




    /*进来浏览网站的IP情况*/
    public function userIP(){

    }
    /*
     * 根据IP获取地址，需要开启curl功能
     * */
    function getIPLoc_QQ($queryIP){
        $url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_ENCODING ,'gb2312');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
        $result = curl_exec($ch);
        $result = mb_convert_encoding($result, "utf-8", "gb2312"); // 编码转换，否则乱码
        curl_close($ch);
        preg_match("@<span>(.*)</span></p>@iU",$result,$ipArray);
        $loc = $ipArray[1];
        return $loc;
    }
}