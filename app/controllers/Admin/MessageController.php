<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-3
 * Time: 下午17:55
 */
class Admin_MessageController extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
    }
    public function showMessageIndex(){
        return View::make('Admin.MessageViews.MessageIndex');
    }

}