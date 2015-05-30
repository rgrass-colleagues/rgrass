<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-11
 * Time: 下午5:49
 */
class Home_IndexController extends BaseController{
    private $is_user_login=null;
    public function __construct(){
        parent::__construct();
        $this->is_user_login = $this->is_user_login();
    }
    public function showIndex(){
//        $session_username = $_SESSION['user_login'];
//        dd($this->is_user_login);
        return View::make('Home.index')->with(array(
            'is_user_login'=>$this->is_user_login
        ));
    }
}