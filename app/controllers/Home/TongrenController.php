<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-5-26
 * Time: 下午23:20
 */
class Home_TongrenController extends BaseController{
    public function showTongrenIndex(){
        session_start();
//        $session_username = $_SESSION['user_login'];
        return View::make('Home.Tongrenfang.tongrenIndex');
    }
}