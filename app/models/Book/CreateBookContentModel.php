<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-1
 * Time: 10:20
 */
class Book_CreateBookContentModel extends Eloquent{
    public function __construct(){

    }

    public function useDatabaseByBookId($book_id){
        //对书籍id取模,0~9
        $modulus_book_id = $book_id%10;
        //拼接得到对应的库
        $database = 'rgrass_book_'.$modulus_book_id;

        return $database;
    }
    public function createBookContentByBookId($book_id){
        $database = $this->useDatabaseByBookId($book_id);
        $table = "book_content_".$book_id;
        //拼接sql语句
        /*
         * chapter_name:章节名字
         * chapter_content:章节内容
         * update_time:修改该章节时间
         * update_users:修改该章节对应的用户
         * chapter_organization:章节对应的组
         * */
        //创建表
        Schema::connection($database)->create($table, function($table)
        {
            $table->increments('id');
            $table->string('chapter_name',255);
            $table->text('chapter_content');
            $table->integer('update_time');
            $table->integer('update_users');
            $table->integer('chapter_organization');
        });
        //还需要建立对应的txt文档文件夹,文件夹名字与数据库内一致
        $url = "./Book_List/".$book_id;
        $default_organization = $url.'/'.'正文';
        if(!file_exists($url)){//创建小说目录
            mkdir($url);
        }else{
            dd('创建书籍文件夹失败');

        }
        if(!file_exists($default_organization)){//创建默认正文目录
            mkdir($default_organization);
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

        $content=array(
            'chapter_name'=>$chapter_name,
            'chapter_content'=>$chapter_content,
            'update_time'=>$update_time,
            'update_users'=>$update_user,
            'chapter_organization'=>$chapter_organization
        );
        //执行插入
        return DB::connection($database)->table($table)->insert($content);
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
            $catalog[$v->organization_name] = DB::connection($database)
                ->table($table)
                ->where('chapter_organization',$v->id)
                ->select('id','chapter_name')
                ->get();
        }
            return $catalog;
    }
    /*
     * 通过章节名获取章节内容
     * */
    public function getChapterContentByChapterId($book_id,$chapter_id){
        $database = $this->useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        $res = DB::connection($database)->table($table)->where('id',$chapter_id)->first();
        if($res){
            return $res;
        }else{
            dd("数据库查询失败");
        }

    }
    /*
     * 通过书籍id和书籍表内的章节id得到该章节的信息
     * */
    public function getChapterInfoByBookIdAndChapterId($book_id,$chapter_id){
        $database = $this->useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        $res = DB::connection($database)->table($table)->where('id',$chapter_id)->first();
        if($res){
            return $res;
        }else{
            dd("数据库查询失败");
        }
    }
    /*
     * 修改小说的其中一章
     *
     * */
    public function modifyChapterContentById($book_id,$chapter_id,$content){
        $database = $this->useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->where('id',$chapter_id)
            ->update($content);
    }
    /*
     * 删除小说的其中一章
     * */
    public function delChapterContentById($book_id,$chapter_id){
        $database = $this->useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->where('id',$chapter_id)
            ->delete();
    }
    /*
     * 查询某一本小说的章节数
     * */
    public function countBookChapter($book_id){
        $database = $this->useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->count();
    }
    /*
     * 根据分卷删除小说
     * */
    public function delBookContentByOrganizaitonId($book_id,$chapter_organization){
        $database = $this->useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->where('chapter_organization',$chapter_organization)
            ->delete();
    }
}