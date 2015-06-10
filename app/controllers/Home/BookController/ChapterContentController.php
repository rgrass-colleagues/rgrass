<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-10
 * Time: 18:07
 */
class Home_BookController_ChapterContentController extends BaseController{
    private $is_user_login=null;
    private $from_url = null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->from_url = $this->from_url();
    }
    /*
     * 展示一本小说的内容
     * */
    public function showChapterContent(){
        $book_id = $this->get('book_id');
        //var_dump($book_id);exit;
        if(!isset($book_id)){
            return View::make('Home.Book.Common.noneBook')->with(array(
                'from_url'=>$this->from_url
            ));
        }
        return View::make('Home.BookViews.ChapterContent')->with(array(
            'is_user_login'=>$this->is_user_login
        ));
    }

}