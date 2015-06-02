<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-1
 * Time: 10:20
 */
class Book_CreateBookContentModel extends Eloquent{
    private $db = null;
    public function __construct(){
        $this->db = new SelfDatabase_DatabaseQuerySqlModel();
    }
    public function useDatabaseByBookId($book_id){
        //对书籍id取模,0~9
        $modulus_book_id = $book_id%10;
        //拼接得到对应的库
        $database = 'rgrass_book_'.$modulus_book_id;

        return $database;
    }
    public function selectDatabaseByBookId($book_id){
        $database = $this->useDatabaseByBookId($book_id);
        //拼接sql语句
        /*
         * chapter_name:章节名字
         * chapter_content:章节内容
         * update_time:修改该章节时间
         * update_users:修改该章节对应的用户
         * chapter_organization:章节对应的组
         * */
        $sql = "CREATE TABLE book_content_{$book_id}(
        id int not null auto_increment,
        chapter_name varchar(255) not null,
        chapter_content text not null,
        update_time int not null,
        update_users int not null,
        chapter_organization int not null,
        PRIMARY KEY (id)
        )engine=innodb default charset=utf8";
        //执行sql语句
        $this->db->querySql($sql,$database);
        //还需要建立对应的txt文档文件夹,文件夹名字与数据库内一致
        $url = "./Book_List/".$book_id;
        if(!file_exists($url)){
            mkdir($url);
        }
        return true;
    }
    /*
     * 添加新章节到数据库
     * */
    public function addNewBookContent($book_id,$chapter_name,$chapter_content,$update_time,$update_user,$chapter_organization){
        $database = $this->useDatabaseByBookId($book_id);
        //拼接table
        $table = "book_content_".$book_id;
        /*
         * 拼接sql语句
         * */
        $sql = "INSERT INTO {$table} (chapter_name,chapter_content,update_time,update_users,chapter_organization) VALUES('{$chapter_name}','{$chapter_content}','{$update_time}','{$update_user}','{$chapter_organization}')";
        //执行sql语句
        if($this->db->querySql($sql,$database)){
            return true;
        }else{
            dd('执行sql语句失败');
        }
    }
    /*
     * 获取小说目录
     * */
    public function getCatalog($book_id){
        $database = $this->useDatabaseByBookId($book_id);
        //拼接table
        $table = 'book_content_'.$book_id;
        $chapter_organization = new Book_BookInfoModel();
        $chapter_organization_info = $chapter_organization->getChapterOrganization($book_id);
        $text = (object)array(
        "id"=>"0",
        "book_id"=>"20",
        "organization_name"=>"正文",
        "add_time"=>"0");
        array_push($chapter_organization_info,$text);
        foreach ($chapter_organization_info as $v) {
            $sql = "SELECT id,chapter_name FROM {$table} WHERE chapter_organization={$v->id}";

            $catalog[$v->organization_name]=$this->db->querySql($sql,$database,true);
        }

            return $catalog;
    }
    /*
     * 通过章节名获取章节内容
     * */
    public function getChapterContentByChapterId($book_id,$chapter_id){
        $database = $this->useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        $sql = "SELECT chapter_content FROM {$table} WHERE id='".$chapter_id."'";
        $res = $this->db->querySqlSelect($sql,$database);
        if($res){
            return $res;
        }else{
            dd("数据库查询失败");
        }

    }

}