<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-5
 * Time: 下午10:42
 */
class Admin_BookTypeController extends BaseController{
    private $TypeModel = null;
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
        $this->TypeModel = new Type_TypeInfoModel();
    }
    /*
     * 展示类型
     * */
    public function showTypeIndex(){
        $allType = $this->TypeModel->getTypeBaseInfoAll();
        return View::make('Admin.TypeViews.ShowTypeIndex')->with(array(
            'allType'=>$allType
        ));
    }
    /*
     * 添加新类型
     * */
    public function addNewType(){
        $firstType = $this->TypeModel->getBookFirstType();
        return View::make('Admin.TypeViews.AddNewType')->with(array(
            'Ftype'=>$firstType
        ));
    }
    public function doAddNewType(){
        $type_name = $this->post('type_name');
        $parent_type = $this->post('parent_type');
        $content = array('type_name'=>$type_name,'parent_type'=>$parent_type);
        if($this->TypeModel->insertNewBookType($content)){
            return Redirect::to('/rgrassAdmin/BookTypeManager');
        }else{
            dd("添加失败");
        }
    }
    /*
     * 删除类型
     * */
    public function doDelType(){
        $type_id = $this->get('type_id');
        if($this->TypeModel->delBookType($type_id)){
            return Redirect::to('/rgrassAdmin/BookTypeManager');
        }else{
            dd("删除失败");
        }
    }
    /*
     * 修改类型
     * */
    public function modifyType(){
        $type_id = $this->get('type_id');
        $type_condition = $this->TypeModel->getTypeInfoById($type_id);
        $firstType = $this->TypeModel->getBookFirstType();
        return View::make('Admin.TypeViews.ModityType')->with(array(
            'Ftype'=>$firstType,
            'type_id'=>$type_id,
            'type_condition'=>$type_condition
        ));
    }
    public function doModifyType(){
        $type_id = $this->post('type_id');
        $type_name = $this->post('type_name');
        $parent_type = $this->post('parent_type');
        $content = array('type_name'=>$type_name,'parent_type'=>$parent_type);
        if($this->TypeModel->modifyBookType($type_id,$content)){
            return Redirect::to('/rgrassAdmin/BookTypeManager');
        }else{
            dd("修改失败");
        }

    }
}