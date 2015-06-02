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
    protected $chapter_organization = 'book_content_organization';
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
     *@param 是book_id 不是book_detail_id
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
     * 添加和修改
     * @param1 传入数据库的内容
     * @param2 判断是传入数据库里哪张表info&detail
     * @param3 判断是添加书籍还是修改书籍create&modify
     * @param4 当修改书籍的时候，标识书籍book_id
     */
    public function AddOrModifyNewBook($content,$table,$page_type,$id){
        if(is_null($page_type))return false;
        if(is_null($table))return false;
        switch($page_type){
            case 'create'://添加新书籍
                //添加书籍的时候进行分库分表添加书本内容操作
                if($table=='info'){//添加进book_info表中
                    $create_book_id = DB::table($this->book_info)
                        ->insertGetId($content);
                    //获取book_id后在对应的库内创建该书籍对应的表
                    $book_content = new Book_CreateBookContentModel();
                    $book_content->selectDatabaseByBookId($create_book_id);
                    $this->createBookContent($create_book_id);
                    return $create_book_id;
                }else{//添加进book_detail表中
                    return DB::table($this->book_detail)
                        ->insert($content);
                }
            break;
            case 'modify'://修改旧书籍
                if($table=='info'){
                    if(!$id)return false;
                    return DB::table($this->book_info)
                        ->where('book_id',$id)
                        ->update($content);
                }else{
                    if(!$id)return false;
                    return DB::table($this->book_detail)
                        ->where('book_id',$id)
                        ->update($content);
                }
            break;
        }
    }
/*
 * 通过id删除某本书籍
 * */
    public function delBookById($book_id){
        //删掉book_info表内数据
        $delete_book = DB::table($this->book_info)
            ->where('book_id',$book_id)
            ->delete();
        if($delete_book){
            //删掉book_detail表内数据
            DB::table($this->book_detail)
                ->where('book_id',$book_id)
                ->delete();
        }
        return $delete_book;
    }
    /*
     * 查询书本的数量
     * */
    public function countBookNumber(){

    }

    /*
     * 查询某书的分卷情况
     * */
    public function getChapterOrganization($book_id){
        return DB::table($this->chapter_organization)
            ->where('book_id',$book_id)
            ->get();
    }
    /*
     * 根据分卷ID获取该分卷情况
     * */
    public function getChapterOrganizationInfoByOid($id){
        return DB::table($this->chapter_organization)
            ->where('id',$id)
            ->first();
    }
    public function insertNewChapterOrganization($content){
        return DB::table($this->chapter_organization)
            ->insert($content);
    }
}