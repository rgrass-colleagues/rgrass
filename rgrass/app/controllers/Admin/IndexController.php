<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-2
 * Time: 下午9:28
 */
class Admin_IndexController extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
    }
    public function showAdminIndex(){

        return View::make('Admin.IndexCenter');
    }

}