<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-10
 * Time: 18:07
 */
class Home_BookController_ChapterContentController extends BaseController{
    private $from_url = null;
    private $BookContent = null;
    private $BookBaseInfo = null;
    private $redis = null;
    public function __construct(){
        parent::__construct();
        $this->from_url = $this->from_url();
        $this->BookContent = new Book_CreateBookContentModel();
        $this->BookBaseInfo = new Book_BookInfoModel();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1',6379);
    }
    /**
     * 展示一本小说的内容...其中一章
     * */
    public function showChapterContent(){
        $book_id = $this->get('book_id');
        if(!$book_info = Book_BookNewInfoModel::getBookInfoDetailByBookId($book_id)){
            dd('抱歉，没有这本书');
        }
        if($book_info->book_authority==0){
            dd('该书还没有通过审核，请耐心等待!');
        }
        if(!Book_BookNewInfoModel::incrementFields('click_number_all',$book_id)){
            //每看一张，点击数+1
            dd('数据库执行错误');
        }
        $chapter_id = $this->get('chapter_id');
        $pre_list = $this->redis->get($book_id.'pre_list');
        $next_list = $this->redis->get($book_id.'next_list');
        if((!$pre_list)||(!$next_list)){//只要有一个不存在于redis里面,从新获取
            $pn_list = $this->getBookCatalogIntoPreAndNext($book_id);
            $pre_list = $pn_list[0];
            $next_list = $pn_list[1];
            $this->redis->set($book_id.'pre_list',$pre_list);
            $this->redis->set($book_id.'next_list',$next_list);
        }
        $pre_arr = explode(',',$pre_list);
        $next_arr = explode(',',$next_list);

        //然后是得到该键对应的id
        $pre_target = array_search($chapter_id,$pre_arr);
        $pre_val = $pre_target?$pre_arr[$pre_target-1]:$pre_arr[count($pre_arr)-1];
        $next_target = array_search($chapter_id,$next_arr);
        $next_val = $next_target||$next_target===0?$next_arr[$next_target+1]:$next_arr[$next_target];


        $chapter_info = $this->BookContent->getChapterContentByChapterId($book_id,$chapter_id);
        $book_info = $this->BookBaseInfo->getBookBaseInfoById($book_id);
        if(!isset($book_id)){
            return View::make('Home.CommonViews.noneBook')->with(array(
                'from_url'=>$this->from_url
            ));
        }
        return View::make('Home.BookViews.ChapterContent')->with(array(
            '$book_id'=>$book_id,
            'pre'=>$pre_val,
            'next'=>$next_val,
            'chapter_info'=>$chapter_info,
            'book_info'=>$book_info
        ));
    }
    /*
     * 获取小说的上一页下一页的序列
     * */
    public function getBookCatalogIntoPreAndNext($book_id){
        $catalog = Book_CreateNewBookContentModel::getCatalog($book_id);
//直接从数据库里获取目录
        $pn_arr = ViewSpalls_BookViewSpallsModel::getPreNextList($catalog);//获取上一页，下一页的序列组
        return $pn_arr;
    }

}