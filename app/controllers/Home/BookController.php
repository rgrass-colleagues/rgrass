<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-27
 * Time: 下午18:43
 */
class Home_BookController extends BaseController{
    public function showBookIndex(){
        session_start();
//        $session_username = $_SESSION['user_login'];
        //var_dump($_GET);
        return View::make('Home.Tongrenfang.BookIndex');
    }
}