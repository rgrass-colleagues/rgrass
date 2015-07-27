<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-7-27
 * Time: 下午23:20
 */
class Home_UserController_BookshelfController extends BaseController{
    private $redis =null;
    public function __construct(){
        parent::__construct();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }
    public function Bookshelf(){
        return View::make('Home.BookshelfViews.BookshelfIndex')->with(array(

        ));
    }

}