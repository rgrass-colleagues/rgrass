<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-10
 * Time: 下午11:22
 */
class Admin_HomeDataController extends BaseController{
    private $BookModel = null;
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
        $this->BookModel = new Book_BookInfoModel();
    }
    /*选择前台数据的类型*/
    public function HomeDataIndex(){
        return View::make("Admin.HomeDataViews.HomeDataIndex")->with(array(

        ));
    }
    /*前台轮播图*/
    public function HomeFlashUpdate(){
        $flashData = HomeData_HomeDataModel::getFlashData();//获取轮播小说信息
        $flashDataCount = HomeData_HomeDataModel::getCountFlashData();
        return View::make("Admin.HomeDataViews.UpdateHomeFlash")->with(array(
            'flashData'=>$flashData,
            'count'=>$flashDataCount
        ));
    }
    public function showModifyHomeFlash(){
        $id = $this->get('id');
        $book_list = $this->BookModel->getBookBaseInfoAll();
        $flashData = HomeData_HomeDataModel::getFlashDataById($id);
        return View::make("Admin.HomeDataViews.ModifyHomeFlash")->with(array(
            'flashData'=>$flashData,
            'book_list'=>$book_list
        ));
    }
    public function doModifyHomeFlash(){
        $id = $this->post('id');
        $book_id = $this->post('book_id');
        $last_special_picture = $this->post('last_special_picture');
        $file_upload = new Common_FileUploadsModel();
        $special_picture = $file_upload->FileUpload('special_picture','special_picture');//图片上传处理
        //删除旧有图片
        if(isset($special_picture)){
            $del_file_url = './uploads/special_picture/'.$last_special_picture;
        }else{
            $del_file_url="";
        }
        //判断是否有进行图片上传
        if(!$special_picture){//没有上传
            $special_picture=$last_special_picture;
        }else{
            if(file_exists($del_file_url) && is_file($del_file_url)){
                unlink($del_file_url);
            }
        }
        $content = array(
            'type'=>2,
            'book_id'=>$book_id,
            'special_picture'=>$special_picture,
            'add_time'=>time()

        );
        if(!HomeData_HomeDataModel::modifyFlashDataById($id,$content)){
            dd('修改失败');
        }else{
            return Redirect::to('/rgrassAdmin/HomeFlash');
        }
    }
    public function doChangeFlashState(){
        $state = $this->get('state');
        $id = $this->get('id');
        if(!HomeData_HomeDataModel::changeFlashState($state,$id)){
            dd('修改失败');
        }else{
            return Redirect::to('/rgrassAdmin/HomeFlash');
        }

    }
    /*前台强烈推荐*/
    public function HomeStronglyRecommend(){
        return View::make('Admin.HomeDataViews.StronglyRecommend');
    }
}