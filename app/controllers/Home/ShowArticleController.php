<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-10
 * Time: 下午8:49
 */
class Home_ShowArticleController extends BaseController{
    public function ShowArticleIndex(){
        return View::make('Home.ShowArticle');
    }
}