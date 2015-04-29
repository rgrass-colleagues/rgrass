<?php
/**
 * Created by PhpStorm.
 * User: bob
 * Date: 15-4-22
 * Time: 上午12:11
 */
class Home_LoginController extends BaseController{
    public function showLogin(){

        return View::make('Home.login_reg.login');
    }

}
