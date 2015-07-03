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
        if(!HomeData_HomeDataModel::changeFlashState($state,$id,$redirect)){
            dd('修改失败');
        }else{
            switch($redirect){
                case 'flash':
                    $this->redis->del('flashHomeData');
                    return Redirect::to('/rgrassAdmin/HomeFlash');
                break;


                case 'stronglyRecommend':
                    $this->redis->del('stronglyRecommend');
                    return Redirect::to('/rgrassAdmin/HomeStronglyRecommend');
                break;
                case 'boutiqueRecommend':
                    $this->redis->del('boutiqueStronglyRecommend');
                    return Redirect::to('/rgrassAdmin/BoutiqueStronglyRecommend');
                break;



                case 'boutiqueRecall':
                    $this->redis->del('boutiqueRecall');
                    return Redirect::to('/rgrassAdmin/BoutiqueRecall');
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

    /*****强烈推荐****/
    //同人坊强烈推荐
    public function HomeStronglyRecommend(){
        $count = HomeData_RecommendDataModel::getCountRecommend('1');
        $stronglyRecommend = HomeData_RecommendDataModel::getAllRecommend('1');
        return View::make('Admin.HomeDataViews.StronglyRecommend')->with(array(
            'stronglyRecommend'=>$stronglyRecommend,
            'count'=>$count
        ));
    }
    //精品站强烈推荐
    public function BoutiqueStronglyRecommend(){
        $boutique =HomeData_RecommendDataModel::getAllRecommend('2');
        $count = HomeData_RecommendDataModel::getCountRecommend('2');
        return View::make('Admin.HomeDataViews.Boutique.BoutiqueStronglyRecommendIndex')->with(array(
            'boutique'=>$boutique,
            'count'=>$count
        ));
    }
    /*****针对强烈推荐的添加与修改(同人坊,精品站,动漫,武侠,影视,经典,原创,这些栏目中的强烈推荐共用)****/
    //添加
    public function AddHideStronglyRecommend(){
        $column = $this->get('column');
        $book_list = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.HomeDataViews.AddHideStronglyRecommend')->with(array(
            'book_list'=>$book_list,
            'column'=>$column
        ));
    }
    public function doAddHideStronglyRecommend(){
        $column = $this->post('column');
        $book_id = $this->post('book_id');
        switch($column){
            case 'tongrenfan':
                $this->doInsertStronglyRecommend('1',$book_id);
                $this->redis->del('stronglyRecommend');
                return Redirect::to('/rgrassAdmin/HomeStronglyRecommend');
            break;
            case 'boutique':
                $this->doInsertStronglyRecommend('2',$book_id);
                $this->redis->del('boutiqueStronglyRecommend');
                return Redirect::to('/rgrassAdmin/BoutiqueStronglyRecommend');
            break;
        }

    }
    public function doInsertStronglyRecommend($type,$book_id){
        $content = array(
            'type'=>$type,
            'book_id'=>$book_id,
            'add_time'=>time(),
            'state'=>0
        );
        return HomeData_RecommendDataModel::insertRecommend($content);
    }

    //修改
    public function ModifyStronglyRecommend(){
        $column = $this->get('column');
        $id = $this->get('id');
        $data = HomeData_RecommendDataModel::getRecommendById($id);
        $book_list = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.HomeDataViews.ModifyStronglyRecommend')->with(array(
            'book_list'=>$book_list,
            'data'=>$data,
            'column'=>$column
        ));
    }
    public function doModifyStronglyRecommend(){
        $column = $this->post('column');
        $id = $this->post('id');
        $book_id = $this->post('book_id');
        switch($column){
            case 'tongrenfan':
                $this->doUpdateStronglyRecommend('1',$book_id,$id);
                $this->redis->del('stronglyRecommend');
                return Redirect::to('/rgrassAdmin/HomeStronglyRecommend');
            break;
            case 'boutique':
                $this->doUpdateStronglyRecommend('2',$book_id,$id);
                $this->redis->del('stronglyRecommend');
                return Redirect::to('/rgrassAdmin/BoutiqueStronglyRecommend');
            break;
        }
    }
    public function doUpdateStronglyRecommend($type,$book_id,$id){
        $content = array(
            'type'=>$type,
            'book_id'=>$book_id,
            'add_time'=>time(),
        );
        return HomeData_RecommendDataModel::modifyRecommend($id,$content);
    }
    /*****强烈推荐****/


    /******精品追忆*********/
    public function BoutiqueRecall(){
        $boutique =HomeData_RecommendDataModel::getAllRecommend('1','recall');
        $count = HomeData_RecommendDataModel::getCountRecommend('1','recall');
        return View::make('Admin.HomeDataViews.Boutique.BoutiqueRecall')->with(array(
            'count'=>$count,
            'boutique'=>$boutique
        ));
    }

    /*****针对追忆的添加与修改(精品站,动漫,武侠,影视,经典,原创,这些栏目中的追忆共用)****/
//添加
    public function AddHideRecall(){
        $column = $this->get('column');
        $book_list = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.HomeDataViews.AddHideRecall')->with(array(
            'book_list'=>$book_list,
            'column'=>$column
        ));
    }
    public function doAddHideRecall(){
        $column = $this->post('column');
        $book_id = $this->post('book_id');
        switch($column){
            case 'boutique':
                $this->doInsertRecall('1',$book_id);
                $this->redis->del('boutiqueRecall');
                return Redirect::to('/rgrassAdmin/BoutiqueRecall');
                break;
        }

    }
    public function doInsertRecall($type,$book_id){
        $content = array(
            'type'=>$type,
            'book_id'=>$book_id,
            'add_time'=>time(),
            'state'=>0
        );
        return HomeData_RecommendDataModel::insertRecommend($content,'recall');
    }

    //修改
    public function ModifyRecall(){
        $column = $this->get('column');
        $id = $this->get('id');
        $data = HomeData_RecommendDataModel::getRecommendById($id,'recall');
        $book_list = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.HomeDataViews.ModifyRecall')->with(array(
            'book_list'=>$book_list,
            'data'=>$data,
            'column'=>$column
        ));
    }
    public function doModifyRecall(){
        $column = $this->post('column');
        $id = $this->post('id');
        $book_id = $this->post('book_id');
        switch($column){
            case 'boutique':
                $this->doUpdateRecall('1',$book_id,$id);
                $this->redis->del('stronglyRecommend');
                return Redirect::to('/rgrassAdmin/BoutiqueRecall');
                break;
        }
    }
    public function doUpdateRecall($type,$book_id,$id){
        $content = array(
            'type'=>$type,
            'book_id'=>$book_id,
            'add_time'=>time(),
        );
        return HomeData_RecommendDataModel::modifyRecommend($id,$content,'recall');
    }
    /******精品追忆*********/

}