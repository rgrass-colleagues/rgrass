<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-1
 * Time: 10:20
 */
class Book_CreateNewBookContentModel extends Eloquent{
    static private function useDatabaseByBookId($book_id){
        //对书籍id取模,0~9
        $modulus_book_id = $book_id%10;
        //拼接得到对应的库
        $database = 'rgrass_book_'.$modulus_book_id;

        return $database;
    }
    /*创建小说表*/
    static public function createBookContentByBookId($book_id){
        $database = self::useDatabaseByBookId($book_id);
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
            $table->string('chapter_path',255);
        });
        //还需要建立对应的txt文档文件夹,文件夹名字与数据库内一致
        $url = "./Book_List/".$book_id;
        $default_organization = $url.'/'.'0';//这个是正文
        if(!file_exists($url)){//创建小说目录
            mkdir($url);
        }else{
            dd('创建书籍文件夹失败');
        }
        if(!file_exists($default_organization)){//创建默认的正文目录
            mkdir($default_organization);
        }
        return true;
    }
    /*
     * 添加新章节到数据库
     * */
    static function addNewBookContent($book_id,$content){
        $database = self::useDatabaseByBookId($book_id);
        //拼接table
        $table = "book_content_".$book_id;
        //执行插入
        return DB::connection($database)
            ->table($table)
            ->insert($content);
    }



    /*
     * 获取小说目录
     * */
    static public function getCatalog($book_id){
        $database = self::useDatabaseByBookId($book_id);
        //拼接table
        $table = 'book_content_'.$book_id;
        $chapter_organization = Book_BookNewInfoModel::getChapterOrganization($book_id);


        $text = (object)array(
        "id"=>"0",
        "book_id"=>"20",
        "organization_name"=>"作品相关",
        "add_time"=>"0");
        array_push($chapter_organization,$text);
        foreach ($chapter_organization as $v) {
            $content_info = DB::connection($database)
                ->table($table)
                ->where('chapter_organization',$v->id)
                ->select('id','chapter_name','chapter_organization')
                ->get();
            if($content_info){
                $catalog[] = $content_info;
            }else{
                $catalog[][0] = (object)array(
                    'chapter_organization'=>$v->id,
                    'null_chapter'=>1
                );

            }
        }
            return $catalog;
    }
    /*
 * 通过章节id获取章节内容
 * */
    static public function getChapterContentByChapterId($book_id,$chapter_id){
        $database = self::useDatabaseByBookId($book_id);
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
        $database = self::useDatabaseByBookId($book_id);
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
    static public function modifyChapterContentById($book_id,$chapter_id,$content){
        $database = self::useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->where('id',$chapter_id)
            ->update($content);
    }
    /*
 * 删除小说的其中一章
 * */
    static public function delChapterContentById($book_id,$chapter_id){
        $database = self::useDatabaseByBookId($book_id);
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
        $database = self::useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->count();
    }
    /*
     * 根据分卷删除小说
     * */
    public function delBookContentByOrganizaitonId($book_id,$chapter_organization){
        $database = self::useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->where('chapter_organization',$chapter_organization)
            ->delete();
    }

    /**
     * 检测当前卷里面还有没有章节,获取当前卷里的小说章节
     * */
    static public function checkChapterInOrganization($book_id,$organization_id){
        $database = self::useDatabaseByBookId($book_id);
        $table = 'book_content_'.$book_id;
        return DB::connection($database)
            ->table($table)
            ->where('chapter_organization',$organization_id)
            ->get();
    }
}