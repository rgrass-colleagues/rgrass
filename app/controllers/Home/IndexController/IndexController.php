<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-11
 * Time: 下午5:49
 */
class Home_IndexController_IndexController extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }
    public function showIndex(){
        $flashData = $this->getFlashIndexData();//获取首页轮播

        return View::make('Home.index')->with(array(
            'flashData'=>$flashData
        ));
    }
    public function getFlashIndexData(){
        $flash_data = $this->redis->get('flashIndexData');
        if(!$flash_data){
            $flashIndex =HomeData_HomeDataModel::getFlashData(1);
            $html_li = "";
            foreach($flashIndex as $v){
                $html_li .= "<li><a href='/Book?book_id={$v->book_id}'><img src='./uploads/covers/".Book_BookNewInfoModel::getBookInfoDetailByBookId($v->book_id)->cover."'/></a></li>";
            }
            $flash_data = $html_li;
            $flash_data = serialize($flash_data);
            $this->redis->set('flashIndexData',$flash_data);//把数据存进redis
        }
        return $flash_data;

    }
}