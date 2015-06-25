<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 15-6-25
 * Time: 11:32
 */
class Home_SearchController_SearchIndexController extends BaseController{
    private $from_url=null;
    private $search = null;
    function __construct(){
        parent::__construct();
        session_start();
        $this->from_url = $this->from_url();
        $this->search  =new Book_SearchModel();
    }
    public function SearchIndex(){
        $search_content = $this->get('search_content')?$this->get('search_content'):'输入关键字有误,请重新输入!';
        if(!$search_book = $this->search->showSearchResult($search_content)){
            $search_book = '没有找到该书籍相关信息,请重新输入!';
        }

        return View::make('Home.SearchViews.SearchContentIndex')->with(array(
            'search_content'=>$search_content,
            'search_book'=>$search_book
        ));
    }
}
