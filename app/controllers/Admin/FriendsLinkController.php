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
        $links = $this->friends_link->getFriendsLinksAll();
        return View::make('Admin.FriendsLinkViews.FriendsLinkIndex')->with(array(
            'links'=>$links
        ));
    }


}