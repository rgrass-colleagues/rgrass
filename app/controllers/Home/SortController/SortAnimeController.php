<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-26
 * Time: 下午23:20
 */
class Home_SortController_SortAnimeController extends BaseController{
    private $redis =null;
    public function __construct(){
        parent::__construct();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }

    public function showAnime(){
        $stronglyRecommend = $this->getStronglyRecommend();//获取强烈推荐
        $recall = $this->getRecall();//获取追忆
        $clickNumAll = Book_BookNewInfoModel::clickNumberAll('anime');//获取小说总点击榜
        $recommendAll = Book_BookNewInfoModel::RecommendAll('anime');//获取小说总推荐榜
        $bookUpdateData = Book_BookNewInfoModel::BookUpdateData('anime');//获取小说近期更新状态

        $site_name = '动漫';
        return View::make('Home.SortViews.AnimeIndex')->with(array(
            'stronglyRecommend'=>$stronglyRecommend,
            'recall'=>$recall,
            'site_name'=>$site_name,
            'clickNumAll'=>$clickNumAll,
            'recommendAll'=>$recommendAll,
            'bookUpdateData'=>$bookUpdateData
        ));
    }

    /**
     * 精品站强烈推荐
     * */
    public function getStronglyRecommend(){
        $stronglyRecommend = $this->redis->get('animeStronglyRecommend');//获取redis里面的数据

        if(!$stronglyRecommend){
            //如果不存在,调用方法,重新进行查询
            $stronglyRecommend = $this->showStrongRecommend();
        }
        $stronglyRecommend = unserialize($stronglyRecommend);
        return $stronglyRecommend;
    }
    /**
     * 查询强烈推荐的数据,并写入redis
     * */
    public function showStrongRecommend(){
        //连表查询出所有需要的相关数据
        $strongly_recommend = HomeData_RecommendDataModel::getStronglyRecommendBookInfo('3');
        $stronglyRecommend = serialize($strongly_recommend);//序列化
        $this->redis->set('animeStronglyRecommend',$stronglyRecommend);//把数据存进redis
        return $stronglyRecommend;
    }

    /**
     * 获取精品追忆
     * */
    public function getRecall(){
        $recall = $this->redis->get('animeRecall');//获取redis里面的数据
        if(!$recall){
            //如果不存在,调用方法,重新进行查询
            $recall = $this->showRecall();
        }
        $recall = unserialize($recall);
        return $recall;
    }
    public function showRecall(){
        //连表查询出所有需要的相关数据
        $recall = HomeData_RecommendDataModel::getRecallBookInfo('2');//1为精品追忆
        $recall = serialize($recall);//序列化
        $this->redis->set('animeRecall',$recall);//把数据存进redis
        return $recall;
    }

}