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
            ->get();
    }
}