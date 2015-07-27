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
    /***首页轮播**/
    public function HomeFlashIndex(){
        $flashIndex =HomeData_HomeDataModel::getFlashData(1);
        $flashDataCount = HomeData_HomeDataModel::getCountFlashData(1);
        return View::make("Admin.HomeDataViews.FlashIndex")->with(array(
            'flashData'=>$flashIndex,
            'count'=>$flashDataCount
        ));
    }
    /**首页轮播修改**/
    public function ModifyFlashIndex(){
        $id = $this->get('id');
        $book_list = $this->BookModel->getBookBaseInfoAll();
        $flashData = HomeData_HomeDataModel::getFlashDataById($id);
        return View::make("Admin.HomeDataViews.ModifyFlashIndex")->with(array(
            'flashData'=>$flashData,
            'book_list'=>$book_list
        ));
    }
    public function doModifyFlashIndex(){
        $id = $this->post('id');
        $book_id = $this->post('book_id');
        $content = array(
            'type'=>1,
            'book_id'=>$book_id,
            'add_time'=>time()

        );
        if(!HomeData_HomeDataModel::modifyFlashDataById($id,$content)){
            dd('修改失败');
        }else{
            $this->redis->del('flashIndexData');//修改成功的时候清除相关redis
            return Redirect::to('/rgrassAdmin/HomeFlashIndex');
        }
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
                //轮播
                case 'flash':
                    $this->redis->del('flashHomeData');
                    return Redirect::to('/rgrassAdmin/HomeFlash');
                break;
                case 'flashIndex':
                    $this->redis->del('flashIndexData');
                    return Redirect::to('/rgrassAdmin/HomeFlashIndex');
                    break;
                //强烈推荐
                case 'tongrenfanRecommend':
                    $this->redis->del('stronglyRecommend');
                    return Redirect::to('/rgrassAdmin/StronglyRecommend?nav=tongrenfan');
                break;
                case 'boutiqueRecommend':
                    $this->redis->del('boutiqueStronglyRecommend');
                    return Redirect::to('/rgrassAdmin/StronglyRecommend?nav=boutique');
                break;
                case 'animeRecommend':
                    $this->redis->del('animeStronglyRecommend');
                    return Redirect::to('/rgrassAdmin/StronglyRecommend?nav=anime');
                    break;
                case 'martialRecommend':
                    $this->redis->del('martialStronglyRecommend');
                    return Redirect::to('/rgrassAdmin/StronglyRecommend?nav=martial');
                    break;
                case 'filmRecommend':
                    $this->redis->del('filmStronglyRecommend');
                    return Redirect::to('/rgrassAdmin/StronglyRecommend?nav=film');
                    break;
                case 'classicRecommend':
                    $this->redis->del('classicStronglyRecommend');
                    return Redirect::to('/rgrassAdmin/StronglyRecommend?nav=classic');
                    break;
                case 'originalRecommend':
                    $this->redis->del('originalStronglyRecommend');
                    return Redirect::to('/rgrassAdmin/StronglyRecommend?nav=original');
                    break;



                //追忆
                case 'boutiqueRecall':
                    $this->redis->del('boutiqueRecall');
                    return Redirect::to('/rgrassAdmin/Recall?nav=boutique');
                break;
                case 'animeRecall':
                    $this->redis->del('animeRecall');
                    return Redirect::to('/rgrassAdmin/Recall?nav=anime');
                    break;
                case 'martialRecall':
                    $this->redis->del('martialRecall');
                    return Redirect::to('/rgrassAdmin/Recall?nav=martial');
                    break;
                case 'filmRecall':
                    $this->redis->del('filmRecall');
                    return Redirect::to('/rgrassAdmin/Recall?nav=film');
                    break;
                case 'classicRecall':
                    $this->redis->del('classicRecall');
                    return Redirect::to('/rgrassAdmin/Recall?nav=classic');
                    break;
                case 'originalRecall':
                    $this->redis->del('originalRecall');
                    return Redirect::to('/rgrassAdmin/Recall?nav=original');
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
    //强烈推荐
    public function StronglyRecommend(){
        $nav = $this->get('nav');
        switch($nav){
            case 'tongrenfan':
                $table_num = 1;
                $site_name = '同人坊';
                break;
            case 'boutique':
                $table_num = 2;
                $site_name= '精品站';
                break;
            case 'anime':
                $table_num = 3;
                $site_name= '动漫';
                break;
            case 'martial':
                $table_num = 4;
                $site_name= '武侠';
                break;
            case 'film':
                $table_num = 5;
                $site_name= '影视';
                break;
            case 'classic':
                $table_num = 6;
                $site_name= '经典';
                break;
            case 'original':
                $table_num = 7;
                $site_name= '原创';
                break;
        }
        $count = HomeData_RecommendDataModel::getCountRecommend($table_num);
        $stronglyRecommend = HomeData_RecommendDataModel::getAllRecommend($table_num);
        return View::make('Admin.HomeDataViews.StronglyRecommend')->with(array(
            'stronglyRecommend'=>$stronglyRecommend,
            'count'=>$count,
            'site_name'=>$site_name,
            'nav'=>$nav
        ));
    }

    /*****针对强烈推荐的添加与修改(同人坊,精品站,动漫,武侠,影视,经典,原创,这些栏目中的强烈推荐共用)****/
    //添加
    public function AddHideStronglyRecommend(){
        $column = $this->get('column');
        $book_list = Book_BookNewInfoModel::getAllBookInfo($column);
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
            break;
            case 'boutique':
                $this->doInsertStronglyRecommend('2',$book_id);
                $this->redis->del('boutiqueStronglyRecommend');
            break;
            case 'anime':
                $this->doInsertStronglyRecommend('3',$book_id);
                $this->redis->del('animeStronglyRecommend');
            break;
            case 'martial':
                $this->doInsertStronglyRecommend('4',$book_id);
                $this->redis->del('martialStronglyRecommend');
            break;
            case 'film':
                $this->doInsertStronglyRecommend('5',$book_id);
                $this->redis->del('filmStronglyRecommend');
            break;
            case 'classic':
                $this->doInsertStronglyRecommend('6',$book_id);
                $this->redis->del('classicStronglyRecommend');
            break;
            case 'original':
                $this->doInsertStronglyRecommend('7',$book_id);
                $this->redis->del('originalStronglyRecommend');
            break;
        }
        return Redirect::to('/rgrassAdmin/StronglyRecommend?nav='.$column);

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
        $book_list = Book_BookNewInfoModel::getAllBookInfo($column);
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
            break;
            case 'boutique':
                $this->doUpdateStronglyRecommend('2',$book_id,$id);
                $this->redis->del('boutiqueStronglyRecommend');
            break;
            case 'anime':
                $this->doUpdateStronglyRecommend('3',$book_id,$id);
                $this->redis->del('animeStronglyRecommend');
                break;
            case 'film':
                $this->doUpdateStronglyRecommend('4',$book_id,$id);
                $this->redis->del('filmStronglyRecommend');
                break;
            case 'classic':
                $this->doUpdateStronglyRecommend('5',$book_id,$id);
                $this->redis->del('classicStronglyRecommend');
                break;
            case 'original':
                $this->doUpdateStronglyRecommend('6',$book_id,$id);
                $this->redis->del('originalStronglyRecommend');
                break;

        }
        return Redirect::to('/rgrassAdmin/StronglyRecommend?nav='.$column);
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


    /******追忆*********/
    public function Recall(){
        $nav = $this->get('nav');
        switch($nav){
            case 'boutique':
                $table_num = 1;
                $site_name= '精品站';
                break;
            case 'anime':
                $table_num = 2;
                $site_name= '动漫';
                break;
            case 'martial':
                $table_num = 3;
                $site_name= '武侠';
                break;
            case 'film':
                $table_num = 4;
                $site_name= '影视';
                break;
            case 'classic':
                $table_num = 5;
                $site_name= '经典';
                break;
            case 'original':
                $table_num = 6;
                $site_name= '原创';
                break;
        }
        $boutique =HomeData_RecommendDataModel::getAllRecommend($table_num,'recall');
        $count = HomeData_RecommendDataModel::getCountRecommend($table_num,'recall');
        return View::make('Admin.HomeDataViews.Recall')->with(array(
            'count'=>$count,
            'boutique'=>$boutique,
            'site_name'=>$site_name,
            'nav'=>$nav
        ));
    }

    /*****针对追忆的添加与修改(精品站,动漫,武侠,影视,经典,原创,这些栏目中的追忆共用)****/
//添加
    public function AddHideRecall(){
        $column = $this->get('column');
        $book_list = Book_BookNewInfoModel::getAllBookInfo($column);
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
                break;
            case 'anime':
                $this->doInsertRecall('2',$book_id);
                $this->redis->del('animeRecall');
                break;
            case 'martial':
                $this->doInsertRecall('3',$book_id);
                $this->redis->del('martialRecall');
                break;
            case 'film':
                $this->doInsertRecall('4',$book_id);
                $this->redis->del('filmRecall');
                break;
            case 'classic':
                $this->doInsertRecall('5',$book_id);
                $this->redis->del('classicRecall');
                break;
            case 'original':
                $this->doInsertRecall('6',$book_id);
                $this->redis->del('originalRecall');
                break;
        }
        return Redirect::to('/rgrassAdmin/Recall?nav='.$column);
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
        $book_list = Book_BookNewInfoModel::getAllBookInfo($column);
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
                $this->redis->del('boutiqueRecall');
                break;
            case 'anime':
                $this->doUpdateRecall('2',$book_id,$id);
                $this->redis->del('animeRecall');
                break;
            case 'martial':
                $this->doUpdateRecall('3',$book_id,$id);
                $this->redis->del('martialRecall');
                break;
            case 'film':
                $this->doUpdateRecall('4',$book_id,$id);
                $this->redis->del('filmRecall');
                break;
            case 'classic':
                $this->doUpdateRecall('5',$book_id,$id);
                $this->redis->del('classicRecall');
                break;
            case 'original':
                $this->doUpdateRecall('6',$book_id,$id);
                $this->redis->del('originalRecall');
                break;
        }
        return Redirect::to('/rgrassAdmin/Recall?nav='.$column);

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