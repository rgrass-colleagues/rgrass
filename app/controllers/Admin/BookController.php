<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-3
 * Time: 下午8:53
 */
class Admin_BookController extends BaseController{
    private $BookModel = null;
//    private $TypeModel = null;
    public function __construct(){
        $this->is_admin_login();
        parent::__construct();
        $this->BookModel = new Book_BookInfoModel();
//        $this->TypeModel = new Type_TypeInfoModel();
    }
    public function showBookLists(){
        $BookBaseInfo = $this->BookModel->getBookBaseInfoAll();
        return View::make('Admin.BookLists')->with(array(
            'bookBaseInfo'=> $BookBaseInfo
        ));
    }
    public function showBookDetail(){
        $id=$this->get('id');
        $oneBookInfo = $this->BookModel->getBookBaseInfoById($id);
        return $oneBookInfo->detail;
    }
    public function showBookAllDetail(){
        $id=$this->get('id');
        $oneBookDetail = $this->BookModel->getBookBaseInfoById($id);
        $oneBookAllDetail = $this->BookModel->getOneBookAllDetailById($id);
        //书名
        $oneBookAllDetail->book_name = $oneBookDetail->book_name;
        //最后一次更新时间
        $oneBookAllDetail->last_update_time = date('Y-m-d H:i:s',$oneBookAllDetail->last_update_time);
        //书籍状态
        $oneBookAllDetail->state=$this->BookModel->bookState($oneBookAllDetail->state);
        //是否被录入藏经阁
        $oneBookAllDetail->is_store=$this->BookModel->isStore($oneBookAllDetail->is_store);
        //书的类型
        $oneBookAllDetail->book_type=$this->BookModel->bookType($oneBookDetail->book_type);
        return json_encode($oneBookAllDetail);
    }
    /*
     * 添加书籍与修改书籍
     * 共同使用一个方法
     * */
    public function AddNewOrModifyOneBook(){
        $page_type=$this->get('page_type');
        if($page_type=='create'){
            //创建新书籍
            return View::make('Admin.AddNewOrModifyOneBook')->with(array(
                'page_type'=>$page_type
            ));
        }else if($page_type=="modify"){
            //修改旧书籍
            $book_id=$this->get('book_id');
            //取出该旧书籍info表的数据
            $book_info=$this->BookModel->getBookBaseInfoById($book_id);
            //取出该旧书籍detail表的数据
            $book_detail=$this->BookModel->getOneBookAllDetailById($book_id);
            return View::make('Admin.AddNewOrModifyOneBook')->with(array(
                'page_type'=>$page_type,
                'book_info'=>$book_info,
                'book_detail'=>$book_detail
            ));
        }
    }
    /*
     * 创建书籍或修改旧书籍的处理过程
     * */
    public function doAddNewOrModifyOneBook(){
        foreach($_POST as $k=>$v){
            if($k=='page_type'){
                $page_type=$_POST[$k];
                continue;
            }
            //通过default甄别把书籍的基础信息和详情信息分开，方便等下插入数据库中
            $str=substr($k,0,7);
            if($str&&$str=='default'){
                $key=substr($k,8);
                $bookBaseInfo[$key]=$v;
            }else{
                $bookDetailInfo[$k]=$v;
            }
        }
        $bookBaseInfo['book_add_time']=time();
        if(!empty($bookBaseInfo['book_id'])){
            $book_id=$bookBaseInfo['book_id'];
        }else{
            $book_id=null;
        }
        $book_insert_base = $this->BookModel->AddOrModifyNewBook($bookBaseInfo,'info',$page_type,$book_id);
        if($book_insert_base&&$page_type=='create'){
            $bookDetailInfo['book_id']=$book_insert_base;
        }
        $book_insert_detail = $this->BookModel->AddOrModifyNewBook($bookDetailInfo,'detail',$page_type,$book_id);
        if(!($book_insert_base||$book_insert_detail))return false;
        return Redirect::to('rgrassAdmin/BookLists');
    }
    /*删除书籍*/
    public function delBook(){
        $delete_book=$this->BookModel->delBookById($this->get('id'));
        if($delete_book){
            return Redirect::to('rgrassAdmin/BookLists');
        }else{
            echo '删除书籍失败';
        }
    }
}