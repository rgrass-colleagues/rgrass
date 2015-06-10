<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-27
 * Time: 下午18:43
 */
class Home_BookController_BookController extends BaseController{
    private $is_user_login=null;
    private $from_url = null;
    private $bookModel = null;
    private $dynamic=null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->from_url = $this->from_url();
        $this->bookModel = new Book_BookInfoModel();
    }
    /*
     * 展示一本书籍的首页
     * 获取的是进行过静态化处理的书籍
     * */
    public function showBookIndex(){
        $book_id = $this->get('book_id');
        $book_info = $this->bookModel->getBookBaseInfoById($book_id);
        $book_detail = $this->bookModel->getOneBookAllDetailById($book_id);
//        dd($book_info);
        //var_dump($book_id);exit;
        if(empty($book_id)||!$book_info){//书籍id不存在,或者书籍不存在
            return View::make('Home.CommonViews.noneBook')->with(array(
                'from_url'=>$this->from_url
            ));
        }
        return View::make('Home.BookViews.BookIndex')->with(array(
            'is_user_login'=>$this->is_user_login,
            'book_info'=>$book_info,
            'book_detail'=>$book_detail
        ));
    }

}