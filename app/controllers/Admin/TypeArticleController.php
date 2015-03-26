<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-5
 * Time: 下午10:42
 */
class Admin_TypeArticleController extends BaseController{
    private $TypeModel = null;
    public function __construct(){
        $this->TypeModel = new Type_TypeInfoModel();
    }
    public function TypeManager(){
        session_start();
        if (!isset($_SESSION['login']))
        {
            throw new Exception('登陆失败');
        }
        $allType = $this->TypeModel->getTypeBaseInfoAll();
        return View::make('Admin.TypeManager')->with(array(
            'allType'=>$allType
        ));
    }
}