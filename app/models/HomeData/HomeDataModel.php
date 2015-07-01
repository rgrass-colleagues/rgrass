<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-06-30
 * Time: 10:09
 */
class HomeData_HomeDataModel extends Eloquent{
    static private $dataList = 'data_list';
    static private $book = 'book_info';
    static private $book_detail = 'book_detail';
    static private $book_type = 'book_type';
    /****前台强烈推荐相关******/
    static public function getStronglyRecommend(){
        return DB::table(self::$dataList)
            ->where('type','1')
            ->get();
    }
    static public function getStronglyRecommendStateShow(){
        return DB::table(self::$dataList)
            ->where('type','1')
            ->where('state','1')
            ->get();
    }
    //连表查询关于book_id对应的小说
    static public function getStronglyRecommendBookInfo(){
        //多表查询，data_list里面的book_id=book_info里面的book_id
        return DB::table(self::$dataList)
            ->join(self::$book,'data_list.book_id','=','book_info.book_id')
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
            ->where('data_list.state','1')
            ->where('data_list.type','1')
            ->get();
    }
    static public function getCountStronglyRecommend(){
        return DB::table(self::$dataList)
            ->where('type','1')
            ->where('state','1')
            ->count();
    }
    static public function getStronglyRecommendById($id){
        return DB::table(self::$dataList)
            ->where('id',$id)
            ->first();
    }
    static public function insertStronglyRecommend($content){
        return DB::table(self::$dataList)
            ->insert($content);
    }
    static public function modifyStronglyRecommend($id,$content){
        return DB::table(self::$dataList)
            ->where('id',$id)
            ->update($content);
    }


    /*轮播图相关*/
    static public function getFlashData(){
        return DB::table(self::$dataList)
            ->where('type','2')
            ->get();
    }
    static public function getFlashDataStateShow(){
        return DB::table(self::$dataList)
            ->where('type','2')
            ->where('state','1')
            ->get();
    }
    static public function getCountFlashData(){
        return DB::table(self::$dataList)
            ->where('type','2')
            ->where('state','1')
            ->count();
    }
    static public function getFlashDataById($id){
        return DB::table(self::$dataList)
            ->where('id',$id)
            ->first();
    }
    static public function modifyFlashDataById($id,$content){
        return DB::table(self::$dataList)
            ->where('id',$id)
            ->update($content);
    }
    static public function insertFlashData($content){
        return DB::table(self::$dataList)
            ->insert($content);
    }
    //显示隐藏的相互转换
    static public function changeFlashState($type,$id){
        $query = DB::table(self::$dataList)
        ->where('id',$id);
        switch($type){
            case 'show':
                return $query->update(array('state'=>1));
            break;
            case 'hide':
                return $query->update(array('state'=>0));
            break;
        }
    }


}