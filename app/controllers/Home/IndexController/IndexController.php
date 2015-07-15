<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-11
 * Time: 下午5:49
 */
class Home_IndexController_IndexController extends BaseController{
    public function __construct(){
        parent::__construct();
    }
    public function showIndex(){
        return View::make('Home.index')->with(array(

        ));
    }
}