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
    static public function getAllBookInfo($nav=false){
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
        return $query->get();

    }


}