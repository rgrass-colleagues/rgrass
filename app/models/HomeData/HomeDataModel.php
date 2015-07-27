<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-06-30
 * Time: 10:09
 */
class HomeData_HomeDataModel extends Eloquent{
    static private $dataList = 'data_list';
    static private $strongly_recommend='data_stronglyRecommend';
    static private $recall = 'data_recall';
    static private $book = 'book_info';
    static private $book_detail = 'book_detail';
    static private $book_type = 'book_type';
    /*轮播图相关*/
    static public function getFlashData($type=false){
        $query = DB::table(self::$dataList);
            if(!$type){
                $query->where('type','2');
            }else{
                $query->where('type',$type);
            }
            return $query->get();
    }
    static public function getFlashDataStateShow(){
        return DB::table(self::$dataList)
            ->where('type','2')
            ->where('state','1')
            ->get();
    }
    static public function getCountFlashData($type=false){
        $query = DB::table(self::$dataList);
        if($type){
            $query->where('type',$type);
        }else{
            $query->where('type','2');
        }
            return $query->where('state','1')
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
    static public function changeFlashState($type,$id,$column){
        switch($column){
            case 'flash':
                $query = DB::table(self::$dataList);
            break;
            case 'flashIndex':
                $query = DB::table(self::$dataList);
            break;

            case 'tongrenfanRecommend':
                $query = DB::table(self::$strongly_recommend);
            break;
            case 'boutiqueRecommend':
                $query = DB::table(self::$strongly_recommend);
            break;
            case 'animeRecommend':
                $query = DB::table(self::$strongly_recommend);
                break;
            case 'martialRecommend':
                $query = DB::table(self::$strongly_recommend);
                break;
            case 'filmRecommend':
                $query = DB::table(self::$strongly_recommend);
                break;
            case 'classicRecommend':
                $query = DB::table(self::$strongly_recommend);
                break;
            case 'originalRecommend':
                $query = DB::table(self::$strongly_recommend);
                break;



            case 'boutiqueRecall':
                $query = DB::table(self::$recall);
            break;
            case 'animeRecall':
                $query = DB::table(self::$recall);
                break;
            case 'martialRecall':
                $query = DB::table(self::$recall);
                break;
            case 'filmRecall':
                $query = DB::table(self::$recall);
                break;
            case 'classicRecall':
                $query = DB::table(self::$recall);
                break;
            case 'originalRecall':
                $query = DB::table(self::$recall);
                break;
        }
        $query->where('id',$id);
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