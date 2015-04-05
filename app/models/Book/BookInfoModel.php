<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-12-28
 * Time: 上午11:24
 */
class Book_BookInfoModel extends Eloquent{
    /*
     * 设置连接表
     * */
    protected $book_info = 'book_info';
    /*
     * 查询book_info表全部数据
     * */
    public function getBookBaseInfoAll(){
        return DB::table($this->book_info)
            ->get();
    }
    /*
     * 根据ID查询
     * */
    public function getBookBaseInfoById($id){
        return DB::table($this->book_info)
            ->where('book_id',$id)
            ->first();
    }
    /*
     * 添加
     */
//    public function insertNewBook($title,$type,$content,$id){
//        if(is_null($id)){
//        return DB::table($this->article)
//            ->insert(array(
//                'article_title'=>$title,
//                'article_type'=>$type,
//                'article_content'=>$content
//            ));
//        }else{
//            return DB::table($this->article)
//                ->where('article_id',$id)
//                ->update(array(
//                    'article_title'=>$title,
//                    'article_type'=>$type,
//                    'article_content'=>$content
//                ));
//        }
//    }

}