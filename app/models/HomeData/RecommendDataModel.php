<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-06-30
 * Time: 10:09
 */
class HomeData_RecommendDataModel extends Eloquent{
    static private $stronglyRecommend = 'data_stronglyRecommend';
    static private $recall = 'data_recall';
    static private $book = 'book_info';
    static private $book_detail = 'book_detail';
    static private $book_type = 'book_type';
    /****前台精品站强烈推荐相关******/


    /**
     * 取出所有[推荐&&追忆]数据
     * */
    static public function getAllRecommend($type,$table=false){
        if($table && $table=='recall'){
            $query = DB::table(self::$recall);
        }else{
            $query = DB::table(self::$stronglyRecommend);
        }
            return $query->where('type',$type)->get();
    }
    //当前[推荐&&追忆]的数量
    static public function getCountRecommend($type,$table=false){
        if($table && $table=='recall'){
            $query = DB::table(self::$recall);
        }else{
            $query = DB::table(self::$stronglyRecommend);
        }
        return $query->where('type',$type)
            ->where('state','1')
            ->count();
    }
    //通过id获取响应的[推荐&&追忆]的信息
    static public function getRecommendById($id,$table=false){
        if($table && $table=='recall'){
            $query = DB::table(self::$recall);
        }else{
            $query = DB::table(self::$stronglyRecommend);
        }
        return $query
            ->where('id',$id)
            ->first();
    }
    //插入一条[推荐&&追忆]
    static public function insertRecommend($content,$table=false){
        if($table && $table=='recall'){
            $query = DB::table(self::$recall);
        }else{
            $query = DB::table(self::$stronglyRecommend);
        }
        return $query
            ->insert($content);
    }
    //修改一条[推荐&&追忆]
    static public function modifyRecommend($id,$content,$table=false){
        if($table && $table=='recall'){
            $query = DB::table(self::$recall);
        }else{
            $query = DB::table(self::$stronglyRecommend);
        }
        return $query
            ->where('id',$id)
            ->update($content);
    }




    //连表查询关于book_id对应的小说,针对data_stronglyRecommend表
    static public function getStronglyRecommendBookInfo($type){
        //多表查询，data_list里面的book_id=book_info里面的book_id
        return DB::table(self::$stronglyRecommend)
            ->join(self::$book,'data_stronglyRecommend.book_id','=','book_info.book_id')
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
            ->where('data_stronglyRecommend.state','1')
            ->where('data_stronglyRecommend.type',$type)
            ->get();
    }
    static public function getRecallBookInfo($type){
        return DB::table(self::$recall)
            ->join(self::$book,'data_recall.book_id','=','book_info.book_id')
            ->where('data_recall.state','1')
            ->where('data_recall.type',$type)
            ->get();
    }

}