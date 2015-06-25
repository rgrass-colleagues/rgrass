<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-06-25
 * Time: 12:04
 */
class Book_SearchModel extends Eloquent{
    /*
     * 设置连接表
     * */
    protected $book_info = 'book_info';
    protected $book_detail = 'book_detail';
    protected $chapter_organization = 'book_content_organization';
    /*查询出所有与之关键字相关的书籍*/
    public function showSearchResult($keywords){
        return DB::table($this->book_info)
            ->where('book_name','like','%'.$keywords.'%')
            ->get();
    }
}