<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-07-2
 * Time: 00:16
 */
class Book_BookNewInfoModel extends Eloquent{
    static private $book_info = 'book_info';
    static private $book_detail = 'book_detail';
    static private $book_type = 'book_type';

    /**
     * 对book_detail里的某一字段进行递增或递减
     * values:一次间隔的值，如果是递减，直接在这里输入也可以
     * 只针对总的
     * */
    static public function incrementFields($fields,$book_id=false,$values=false){
        $query = DB::table(self::$book_detail);
        if($book_id){
            $query->where('book_id',$book_id);
        }
        if($values){
                $query->increment($fields,$values);
        }else{
            $query->increment($fields);
        }
        return $query;
    }


    /**
     * 获取小说总点击榜的数据
     *
     * */
    static public function clickNumberAll(){
        return DB::table(self::$book_info)
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->orderBy('book_detail.click_number_all','desc')
            ->limit(11)
            ->get();
    }
    /**
     * 获取小说总推荐榜的数据
     *
     * */
    static public function RecommendAll(){
        return DB::table(self::$book_info)
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->orderBy('book_detail.recommend_all','desc')
            ->limit(11)
            ->get();
    }
    /**
     * 获取最近更新的小说
     *
     * */
    static public function BookUpdateData(){
        return DB::table(self::$book_info)
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
            ->orderBy('book_detail.last_update_time','desc')
            ->limit(23)
            ->get();
    }

}