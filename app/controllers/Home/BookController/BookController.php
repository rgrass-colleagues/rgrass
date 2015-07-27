<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-27
 * Time: 下午18:43
 */
class Home_BookController_BookController extends BaseController{
    private $from_url = null;
    private $bookModel = null;
    private $dynamic=null;
    public function __construct(){
        parent::__construct();
        $this->from_url = $this->from_url();
        $this->bookModel = new Book_BookInfoModel();
    }
    /*
     * 展示一本书籍的首页
     * 获取的是进行过静态化处理的书籍
     * */
    public function showBookIndex(){
        $clickNumAll = Book_BookNewInfoModel::clickNumberAll();//获取小说总点击榜
        $recommendAll = Book_BookNewInfoModel::RecommendAll();//获取小说总推荐榜
        $book_id = $this->get('book_id');
        if(!$book_info = Book_BookNewInfoModel::getBookInfoDetailByBookId($book_id)){
            dd('抱歉，没有这本书');
        }
        if($book_info->book_authority==0){
            dd('该书还没有通过审核，请耐心等待!');
        }
        if($book_detail = $this->bookModel->getOneBookAllDetailById($book_id)){
//            dd('抱歉，这本书没有详情');
        }
//        dd($book_info);
        //var_dump($book_id);exit;
        if(empty($book_id)||!$book_info){//书籍id不存在,或者书籍不存在
            return View::make('Home.CommonViews.noneBook')->with(array(
                'from_url'=>$this->from_url
            ));
        }
        return View::make('Home.BookViews.BookIndex')->with(array(
            'book_info'=>$book_info,
            'book_detail'=>$book_detail,
            'clickNumAll'=>$clickNumAll,
            'recommendAll'=>$recommendAll
        ));
    }

}