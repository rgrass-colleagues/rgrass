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
    protected $book_detail = 'book_detail';
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
     * 根据ID查询该书所有详细信息
     * 表为book_detail
     *
     * */
    public function getOneBookAllDetailById($id){
        return DB::table($this->book_detail)
            ->where('book_id',$id)
            ->first();
    }
    /*
     * 书籍的状态显示
     *
     * */
    public function bookState($book_state){
        switch($book_state){
            case 0:
                $state='无效书籍';
                break;
            case 1:
                $state='新书连载';
                break;
            case 2:
                $state='渐入高潮';
                break;
            case 3:
                $state='曲终人散';
                break;
        }
        return $state;
    }
    /*
     * 是否被录入藏经阁
     * */
    public function isStore($is_store){
        if($is_store=='0'){
            $isStore='未录入';
        }else{
            $isStore='已录入';
        }
        return $isStore;
    }
    /*
     * 书籍类型
     * */
    public function bookType($type){
        if($type=='0'){
            $type='其它书籍';
        }
        return $type;
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