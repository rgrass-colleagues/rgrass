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
        session_write_close();
    }
    public function SearchIndex(){
        $search_content = $this->get('search_content')?$this->get('search_content'):'XX';
        if(!$search_book = $this->search->showSearchResult($search_content)){
            $search_book = false;
        }
//        dd($search_book);
        return View::make('Home.SearchViews.SearchContentIndex')->with(array(
            'search_content'=>$search_content,
            'search_book'=>$search_book
        ));
    }
}
