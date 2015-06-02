<?php
/**
 * Created by PhpStorm.
 * User: merlin
 * Date: 15-5-31
 * Time: 下午8:34
 */

Class Admin_FriendsLinkController extends BaseController{
    private $friends_link = null;
/*初始化*/
    public function __construct(){
        $this->is_admin_login();
        parent::__construct();
        $this-> friends_link = new FriendsLink_FriendsLinkModel();

    }
/*展示友情链接*/
    public function showFriendsLink(){

        return View::make('Admin.FriendsLinkIndex')->with(array(
            'arr'=>'merlin',
        ));
    }


}