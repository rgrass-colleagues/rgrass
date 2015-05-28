<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-28
 * Time: 下午17:01
 */
class Book_dataListInfoModel extends Eloquent{
    /*
     * 设置连接表
     * */
    protected $book_info = 'book_info';
    protected $book_detail = 'book_detail';
    protected $data_list = 'data_list';
    /*
     * 查询本周的强烈推荐
     * */
    public function getTWeekStronglyRecommend(){
        $curmon = $this->getMondayOTime();
        return DB::table($this->data_list)
            ->where('time',$curmon)
            ->select('strongly_recommend')
            ->first();
    }
    public function getMondayOTime(){
        $curtime=strtotime(date("Y-m-d"));
        $curweekday = date('w');
        $curweekday = $curweekday?$curweekday:7;
        $curmon = $curtime - ($curweekday-1)*86400;
        return $curmon;
    }
}