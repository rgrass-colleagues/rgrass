<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-29
 * Time: 下午9:59
 */
class Home_BookController_BookCatalogController extends BaseController{
    private $is_user_login=null;
    private $from_url = null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->from_url = $this->from_url();
    }
    /*
     * 展示一本小说的目录
     * */
    public function showBookCatalog(){
        $book_id = $this->get('book_id');
        //var_dump($book_id);exit;
        if(!isset($book_id)){
            return View::make('Home.Book.Common.noneBook')->with(array(
                'from_url'=>$this->from_url
            ));
        }
        return View::make('Home.BookViews.BookCatalog')->with(array(
            'is_user_login'=>$this->is_user_login
        ));
    }

}