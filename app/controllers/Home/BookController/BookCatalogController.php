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
    private $BookContent = null;
    private $BookBaseInfo = null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
        $this->from_url = $this->from_url();
        $this->BookContent = new Book_CreateBookContentModel();
        $this->BookBaseInfo = new Book_BookInfoModel();
    }
    /*
     * 展示一本小说的目录
     * */
    public function showBookCatalog(){
        $book_id = $this->get('book_id');
        $catalog = $this->BookContent->getCatalog($book_id);//直接从数据库里获取目录
//        dd($catalog);
        /*测试*/
        //$catalog_html = ViewSpalls_BookViewSpallsModel::showHomeBookCatalog($catalog,$book_id);
        /*测试*/
        $book_info = $this->BookBaseInfo->getBookBaseInfoById($book_id);
        //var_dump($book_id);exit;
        if(!isset($book_id)||!$catalog){
            return View::make('Home.Book.Common.noneBook')->with(array(
                'from_url'=>$this->from_url
            ));
        }
        return View::make('Home.BookViews.BookCatalog')->with(array(
            'book_id'=>$book_id,
            'is_user_login'=>$this->is_user_login,
            'book_info'=>$book_info,
            'catalog'=>$catalog
        ));
    }

}