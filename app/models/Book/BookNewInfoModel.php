<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-07-2
 * Time: 00:16
 */
class Book_BookNewInfoModel extends Eloquent{
    static private $book_info = 'book_info';
    static private $book_detail = 'book_detail';
    static private $book_type = 'book_type';
    static private $chapter_organization = 'book_content_organization';
    /*
     * 查询book_info表全部数据(倒序)
     * */
    static public function getBookBaseInfoAllDesc(){
        return DB::table(self::$book_info)
            ->orderBy('book_id','desc')
            ->get();
    }
    /**
     * 对book_detail里的某一字段进行递增或递减
     * values:一次间隔的值，如果是递减，直接在这里输入也可以
     * 只针对总的
     * */
    static public function incrementFields($fields,$book_id=false,$values=false){
        $query = DB::table(self::$book_detail);
        if($book_id){
            $query->where('book_id',$book_id);
        }
        if($values){
                $query->increment($fields,$values);
        }else{
            $query->increment($fields);
        }
        return $query;
    }

    /**
     * 获取小说总点击榜的数据
     *
     * */
    static public function clickNumberAll($nav=false){
        $query = DB::table(self::$book_info)
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->where('book_authority','1')
            ->orderBy('book_detail.click_number_all','desc')
            ->limit(11);
            switch($nav){
                case 'boutique':
                    $query->where('is_boutiques','1');
                    break;
                case 'anime':
                    $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                        ->where('book_type.parent_type','1');
                    break;
                case 'martial':
                    $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                        ->where('book_type.parent_type','2');
                    break;
                case 'film':
                    $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                        ->where('book_type.parent_type','3');
                    break;
                case 'classic':
                    $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                        ->where('book_type.parent_type','4');
                    break;
                case 'original':
                    $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                        ->where('book_type.parent_type','5');
                    break;
            }
        return $query->get();
    }
    /**
     * 获取小说总推荐榜的数据
     *
     * */
    static public function RecommendAll($nav=false){
        $query = DB::table(self::$book_info)
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->where('book_authority','1')
            ->orderBy('book_detail.recommend_all','desc')
            ->limit(11);
        switch($nav){
            case 'boutique':
                $query->where('is_boutiques','1');
                break;
            case 'anime':
                $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                    ->where('book_type.parent_type','1');
                break;
            case 'martial':
                $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                    ->where('book_type.parent_type','2');
                break;
            case 'film':
                $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                    ->where('book_type.parent_type','3');
                break;
            case 'classic':
                $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                    ->where('book_type.parent_type','4');
                break;
            case 'original':
                $query->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
                    ->where('book_type.parent_type','5');
                break;
        }
        return $query->get();
    }
    /**
     * 获取最近更新的小说
     *
     * */
    static public function BookUpdateData($nav=false){
        $query = DB::table(self::$book_info)
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->join(self::$book_type,'book_info.book_type','=','book_type.type_id')
            ->where('book_authority','1')
            ->orderBy('book_detail.last_update_time','desc')
            ->limit(23);
        switch($nav){
            case 'boutique':
                $query->where('is_boutiques','1');
                break;
            case 'anime':
                $query
                    ->where('book_type.parent_type','1');
                break;
            case 'martial':
                $query
                    ->where('book_type.parent_type','2');
                break;
            case 'film':
                $query
                    ->where('book_type.parent_type','3');
                break;
            case 'classic':
                $query
                    ->where('book_type.parent_type','4');
                break;
            case 'original':
                $query
                    ->where('book_type.parent_type','5');
                break;
        }
        return $query->get();
    }

    /***根据类型条件获取书籍列(总书籍,精品书籍,动漫,武侠,影视,经典,原创)***/
    static public function getAllBookInfo($nav=false,$orderBy=false,$authority=false){
        $query = DB::table(self::$book_info);
        switch($nav){
            case 'boutique':
                $query->where('is_boutiques','1');
                break;
            case 'anime':
                $query->join('book_type','book_info.book_type','=','book_type.type_id')->where('book_type.parent_type','1');
                break;
            case 'martial':
                $query->join('book_type','book_info.book_type','=','book_type.type_id')->where('book_type.parent_type','2');
                break;
            case 'film':
                $query->join('book_type','book_info.book_type','=','book_type.type_id')->where('book_type.parent_type','3');
                break;
            case 'classic':
                $query->join('book_type','book_info.book_type','=','book_type.type_id')->where('book_type.parent_type','4');
                break;
            case 'original':
                $query->join('book_type','book_info.book_type','=','book_type.type_id')->where('book_type.parent_type','5');
                break;
        }
        if($orderBy){
            $query->orderBy('book_id','desc');
        }
        switch($authority){
            case '0'://未通过审核状态的
                $query->where('book_authority',$authority);
                break;
            case '1':
                $query->where('book_authority',$authority);
                break;
        }
        return $query->get();

    }

    /**
     * 插入book_info,return id
     * */
    static public function insertBookInfo($content){
        return DB::table(self::$book_info)
            ->insertGetId($content);
    }

    /**
     * 插入book_detail,return true
     * */
    static public function insertBookDetail($content){
        return DB::table(self::$book_detail)
            ->insert($content);
    }

    /**
     * 判断小说是否存在
     * */
    static public function isExistByBookName($book_name){
        return DB::table(self::$book_info)
            ->where('book_name',$book_name)
            ->first();
    }
    /**
     * 获取一本小说的分卷情况
     * */
    static public function getChapterOrganization($book_id){
        return DB::table(self::$chapter_organization)
            ->where('book_id',$book_id)
            ->get();
    }

    /**
     * 根据id获取一本小说的分卷
     * */
    static public function getChapterOrganizationInfoByOid($id){
        return DB::table(self::$chapter_organization)
            ->where('id',$id)
            ->first();
    }
    /***根据书名获取小说信息**/
    static public function getBookInfoByBookName($book_name){
        return DB::table(self::$book_info)
            ->where('book_name',$book_name)
            ->first();
    }

    /****修改一本小说*****/
    static public function updateBookInfo($book_id,$content){
        return DB::table(self::$book_info)
            ->where('book_id',$book_id)
            ->update($content);
    }
    static public function updateBookDetail($book_id,$content){
        return DB::table(self::$book_detail)
            ->where('book_id',$book_id)
            ->update($content);
    }
    /*****获取当前作者下的小说********/
    static public function getBookInfoByAuthor($author){
        return DB::table(self::$book_info)
            ->where('author',$author)
            ->get();
    }

    /*******通过id获取小说信息**********/
    static public function getBookInfoDetailByBookId($book_id){
        return DB::table(self::$book_info)
            ->join(self::$book_detail,'book_info.book_id','=','book_detail.book_id')
            ->where('book_info.book_id',$book_id)
            ->first();
    }

    /*更新最后一次修改时间*/
    static public function modifyLastUpdateTime($book_id){
        return DB::table(self::$book_detail)
            ->where('book_id',$book_id)
            ->update(array('last_update_time'=>time()));
    }
    /*
     * 添加分卷
     * */
    static public function insertNewChapterOrganization($content){
        return DB::table(self::$chapter_organization)
            ->insert($content);
    }

    /**修改分卷***/
    static public function updateChapterOrganization($id,$content){
        return DB::table(self::$chapter_organization)
            ->where('id',$id)
            ->update($content);
    }

    /***删除分卷*****/
    static public function delChapterOrganization($id){
        return DB::table(self::$chapter_organization)
            ->where('id',$id)
            ->delete();
    }
}