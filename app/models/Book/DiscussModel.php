<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-11
 * Time: 11:35
 */
class Book_DiscussModel extends Eloquent{
    private $discuss='discuss_book_';
    private $discuss_child = 'discuss_child_';
    /*
     * 通过book_id获取不同的表
     * */
    public function discussTable($book_id){
        $modulus_book_id = $book_id%10;
        return $this->discuss.$modulus_book_id;
    }
    public function discussChildTable($book_id){
        $modulus_book_id = $book_id%10;
        return $this->discuss_child.$modulus_book_id;
    }
    /*
     * 获取该小说所有主评论
     * */
    public function getDiscussAll($book_id){
        $table = $this->discussTable($book_id);
        return DB::table($table)
            ->where('book_id',$book_id)
            ->orderby('addtime','desc')
            ->get();
    }
    /*通过id查找主评论*/
    public function getDiscussById($book_id,$id){
        $table = $this->discussTable($book_id);
        return DB::table($table)
            ->where('id',$id)
            ->first();
    }
    /*插入评论*/
    public function insertNewMainDiscuss($book_id,$content){
        $table = $this->discussTable($book_id);
        return DB::table($table)
            ->insert($content);
    }
    /*修改评论*/
    public function updateMainDiscuss($book_id,$id,$content){
        $table = $this->discussTable($book_id);
        return DB::table($table)
            ->where('id',$id)
            ->update($content);
    }
    /*查询子评论*/
    public function getDiscussChildByDId($book_id,$discuss_id){
        $table = $this->discussChildTable($book_id);
        return DB::table($table)
            ->where('discuss_id',$discuss_id)
            ->get();
    }
    /*插入数据*/
    public function insertDiscussChild($book_id,$content){
        $table = $this->discussChildTable($book_id);
        return DB::table($table)
            ->insert($content);
    }
    /*通过id获取一条子评论的数据*/
    public function getDiscussChildById($book_id,$id){
        $table = $this->discussChildTable($book_id);
        return DB::table($table)
            ->where('id',$id)
            ->first();
    }
    /*修改子评论*/
    public function modifyDiscussChild($book_id,$id,$content){
        $table = $this->discussChildTable($book_id);
        return DB::table($table)
            ->where('id',$id)
            ->update($content);
    }
}