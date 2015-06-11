<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-10
 * Time: 23:42
 */
class Book_ChapterDynamicModel extends Eloquent{
    private $dynamic='dynamic_book_';
    /*
     * 通过book_id获取不同的表
     * */
    public function dynamicTable($book_id){
        $modulus_book_id = $book_id%10;
        return $this->dynamic.$modulus_book_id;
    }
    /*
     * 获取当前小说的所有动态
     * */
    public function getDynamicAll($book_id){
        $table = $this->dynamicTable($book_id);
        return DB::table($table)
            ->where('book_id',$book_id)
            ->orderby('addtime','desc')
            ->get();
    }
    /*
     * 获取一条动态
     * */
    public function getDynamicById($book_id,$id){
        $table = $this->dynamicTable($book_id);
            return DB::table($table)
            ->where('id',$id)
            ->first();
    }
    /*
     * 删除某一条动态
     * */
    public function delDynamicByid($book_id,$id){
        $table = $this->dynamicTable($book_id);
        return DB::table($table)
            ->where('id',$id)
            ->delete();
    }
    /*
     * 添加一条新的动态
     * */
    public function InsertNewDynamic($book_id,$content){
        $table = $this->dynamicTable($book_id);
        return DB::table($table)
            ->insert($content);
    }
    public function modifyDynamic($book_id,$id,$content){
        $table = $this->dynamicTable($book_id);
        return DB::table($table)
            ->where('id',$id)
            ->update($content);
    }
}