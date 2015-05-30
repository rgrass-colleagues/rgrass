<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-26
 * Time: 下午23:20
 */
class Home_TongrenController extends BaseController{
    private $is_user_login=null;
    private $data_list=null;
    private $redis =null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->data_list = new Book_dataListInfoModel();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);

    }
    public function showTongrenIndex(){
        $stronglyRecommend = $this->getStronglyRecommend();//每一周强烈推荐
        return View::make('Home.Tongrenfang.tongrenIndex')->with(array(
            'is_user_login'=>$this->is_user_login,
            'stronglyRecommend'=>$stronglyRecommend
        ));
    }
    /*
     * 每一周的强烈推荐
     * */
    public function getStronglyRecommend(){
        $stronglyRecommend = $this->redis->get('stronglyRecommend');//获取redis里面的数据
        if(!$stronglyRecommend){
            //如果不存在,调用前面的方法,重新进行查询
            $stronglyRecommend = $this->showStrongRecommend();
        }
        $stronglyRecommend = unserialize($stronglyRecommend);
        return $stronglyRecommend;
    }
    /*
     * 查询每一周强烈推荐的数据,并写入redis
     * */
    public function showStrongRecommend(){
        $strongly_recommend = $this->data_list->getTWeekStronglyRecommend();
        $arr_strongly_commend = explode(',',$strongly_recommend->strongly_recommend);
        $book_info = new Book_BookInfoModel();
        foreach($arr_strongly_commend as $val){
            $srecommend[] =  $book_info->getBookBaseInfoById($val);
        }
        $stronglyRecommend = serialize($srecommend);//序列化
        $this->redis->set('stronglyRecommend',$stronglyRecommend);//把数据存进redis
        return $stronglyRecommend;
    }
}