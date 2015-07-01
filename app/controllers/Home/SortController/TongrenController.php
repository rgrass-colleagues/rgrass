<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-26
 * Time: 下午23:20
 */
class Home_SortController_TongrenController extends BaseController{
    private $is_user_login=null;
    private $redis =null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }
    public function showTongrenIndex(){
        $stronglyRecommend = $this->getStronglyRecommend();//获取强烈推荐
        $flashData = $this->getFlashData();//获取首页轮播
        $clickNumAll = Book_BookNewInfoModel::clickNumberAll();//获取小说总点击榜
        $recommendAll = Book_BookNewInfoModel::RecommendAll();//获取小说总推荐榜
        $bookUpdateData = Book_BookNewInfoModel::BookUpdateData();//获取小说近期更新状态
        return View::make('Home.SortViews.TongrenFangIndex')->with(array(
            'is_user_login'=>$this->is_user_login,
            'stronglyRecommend'=>$stronglyRecommend,//首页强烈推荐
            'flashData'=>$flashData,//轮播图
            'clickNumAll'=>$clickNumAll,//小说总点击榜
            'recommendAll'=>$recommendAll,//小说推荐榜
            'bookUpdateData'=>$bookUpdateData,//最近更新的小说
        ));
    }
    /*
     * 强烈推荐
     * */
    public function getStronglyRecommend(){
        $stronglyRecommend = $this->redis->get('stronglyRecommend');//获取redis里面的数据
        if(!$stronglyRecommend){
            //如果不存在,调用方法,重新进行查询
            $stronglyRecommend = $this->showStrongRecommend();
        }
        $stronglyRecommend = unserialize($stronglyRecommend);
        return $stronglyRecommend;
    }
    /*
     * 查询强烈推荐的数据,并写入redis
     * */
    public function showStrongRecommend(){
        //连表查询出所有需要的相关数据
        $strongly_recommend = HomeData_HomeDataModel::getStronglyRecommendBookInfo();
        $stronglyRecommend = serialize($strongly_recommend);//序列化
        $this->redis->set('stronglyRecommend',$stronglyRecommend);//把数据存进redis
        return $stronglyRecommend;
    }
    /*
     * 获取轮播图
     * */
    public function getFlashData(){
        $flash_data = $this->redis->get('flashHomeData');
        if(!$flash_data){
            $flash_data = HomeData_HomeDataModel::getFlashDataStateShow();
            $flash_data = serialize($flash_data);
            $this->redis->set('flashHomeData',$flash_data);//把数据存进redis
        }
        $flash_data = unserialize($flash_data);
        return $flash_data;
    }
}