<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-07-08
 * Time: 16:28
 */
class Book_BookSplitModel extends Eloquent{
    static public function getBookSplitInfo(){
        $book_all = Book_BookNewInfoModel::getAllBookInfo();
        foreach($book_all as $v){
            $book_all_arr[]=$v->book_name;
        }
        $book_info = array();
        $dir = scandir("./BookWhole");
        foreach($dir as $v){
            if($v=='.'||$v=='..'){
                continue;
            }
            $book_url = './BookWhole/'.$v;
            $book_name = explode('.',$v)[0];
            if(in_array($book_name,$book_all_arr)){
                $book_in = '<span style="color:green;">已存在</span>';
            }else{
                $book_in = '<span style="color:gray;">未存在</span>';

            }
            $book = (object)array(
                'book_name'=>$book_name,
                'book_url'=>$book_url,
                'book_in'=>$book_in,
                'book_create_time'=>filectime($book_url),
                'book_modify_time'=>filemtime($book_url),
            );
            $book_info[] = $book;
        }
        return $book_info;
    }


    /**
     * 小说正则格式:
     * 格式一:章一 绯色之夜;章二 站着沉默;
     * /章(一|二|三|四|五|六|七|八|九|十){0,10}\s(\S+)\s/
     *
     *
     *
     *
     * */
    static public function getSplitBookRegular($split_role){
        switch($split_role){
            case '1':
                return '/章(一|二|三|四|五|六|七|八|九|十){0,10}\s(\S+)\s/';
            break;
        }
    }
}