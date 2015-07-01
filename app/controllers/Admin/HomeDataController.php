<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-10
 * Time: 下午11:22
 */
class Admin_HomeDataController extends BaseController{
    private $BookModel = null;
    private $redis = null;
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
        $this->BookModel = new Book_BookInfoModel();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }
    /*选择前台数据的类型*/
    public function HomeDataIndex(){
        return View::make("Admin.HomeDataViews.HomeDataIndex")->with(array(

        ));
    }
    /******前台轮播图**********/
    public function HomeFlashUpdate(){
        $flashData = HomeData_HomeDataModel::getFlashData();//获取轮播小说信息
        $flashDataCount = HomeData_HomeDataModel::getCountFlashData();
        return View::make("Admin.HomeDataViews.UpdateHomeFlash")->with(array(
            'flashData'=>$flashData,
            'count'=>$flashDataCount
        ));
    }
    //修改
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
            $this->redis->del('flashHomeData');//修改成功的时候清除相关redis
            return Redirect::to('/rgrassAdmin/HomeFlash');
        }
    }
    public function doChangeState(){
        $state = $this->get('state');
        $id = $this->get('id');
        $redirect = $this->get('redirect');
        if(!HomeData_HomeDataModel::changeFlashState($state,$id)){
            dd('修改失败');
        }else{
            switch($redirect){
                case 'stronglyrecommend':
                    $this->redis->del('stronglyRecommend');
                    return Redirect::to('/rgrassAdmin/HomeStronglyRecommend');
                break;
                case 'flash':
                    $this->redis->del('flashHomeData');
                    return Redirect::to('/rgrassAdmin/HomeFlash');
                break;
            }
        }

    }
    //添加
    public function AddHideHomeFlash(){
        $book_list = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.HomeDataViews.AddHideHomeFlash')->with(array(
            'book_list'=>$book_list
        ));
    }
    public function doAddHideHomeFlash(){
        $book_id = $this->post('book_id');
        $file_upload = new Common_FileUploadsModel();
        $special_picture = $file_upload->FileUpload('special_picture','special_picture');//图片上传处理
        if(!$special_picture){
            $special_picture = 0;
        }
        $content = array(
            'type'=>2,
            'book_id'=>$book_id,
            'special_picture'=>$special_picture,
            'add_time'=>time(),
            'state'=>0
        );
        if(HomeData_HomeDataModel::insertFlashData($content)){
            return Redirect::to('/rgrassAdmin/HomeFlash');
        }else{
            dd('插入数据库失败');
        }
    }

    /*前台强烈推荐*/
    public function HomeStronglyRecommend(){
        $count = HomeData_HomeDataModel::getCountStronglyRecommend();
        $stronglyRecommend = HomeData_HomeDataModel::getStronglyRecommend();
        return View::make('Admin.HomeDataViews.StronglyRecommend')->with(array(
            'stronglyRecommend'=>$stronglyRecommend,
            'count'=>$count
        ));
    }
    //添加
    public function AddHideStronglyRecommend(){
        $book_list = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.HomeDataViews.AddHideStronglyRecommend')->with(array(
            'book_list'=>$book_list
        ));
    }
    public function doAddHideStronglyRecommend(){
        $book_id = $this->post('book_id');
        $content = array(
            'type'=>1,
            'book_id'=>$book_id,
            'add_time'=>time(),
            'state'=>0
        );
        if(HomeData_HomeDataModel::insertStronglyRecommend($content)){
            return Redirect::to('/rgrassAdmin/HomeStronglyRecommend');
        }else{
            dd('插入数据库失败');
        }
    }

    //修改
    public function ModifyStronglyRecommend(){
        $id = $this->get('id');
        $data = HomeData_HomeDataModel::getStronglyRecommendById($id);
        $book_list = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.HomeDataViews.ModifyStronglyRecommend')->with(array(
            'book_list'=>$book_list,
            'data'=>$data
        ));
    }
    public function doModifyStronglyRecommend(){
        $id = $this->post('id');
        $book_id = $this->post('book_id');
        $content = array(
            'type'=>1,
            'book_id'=>$book_id,
            'add_time'=>time(),
        );
        if(HomeData_HomeDataModel::modifyStronglyRecommend($id,$content)){
            $this->redis->del('stronglyRecommend');
            return Redirect::to('/rgrassAdmin/HomeStronglyRecommend');
        }else{
            dd('插入数据库失败');
        }
    }
}