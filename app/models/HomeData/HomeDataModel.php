<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-06-30
 * Time: 10:09
 */
class HomeData_HomeDataModel extends Eloquent{
    static private $dataList = 'data_list';
    static public function getStronglyRecommend(){
        return DB::table(self::$dataList)
            ->where('type','1')
            ->limit(10)
            ->get();
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