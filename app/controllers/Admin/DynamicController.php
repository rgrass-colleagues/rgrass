<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-2
 * Time: 下午9:28
 */
class Admin_DynamicController extends BaseController{
    private $chapter_dynamic=null;
    private $user = null;
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
        $this->chapter_dynamic = new Book_ChapterDynamicModel();
        $this->user = new User_UserInfoModel();
    }

    /*
     * 查看所有的动态
     * */
    public function showChapterDynamic(){
        $book_id=$this->get('book_id');
        $dynamic_info = $this->chapter_dynamic->getDynamicAll($book_id);
        return View::make('Admin.BookViews.ChapterDynamicIndex')->with(array(
            'book_id'=>$book_id,
            'dynamic_info'=>$dynamic_info
        ));
    }
    /*
     * 删除某一条动态
     * */
    public function doDelChapterDynamic(){
        $book_id=$this->get('book_id');
        $id = $this->get('id');
        if($this->chapter_dynamic->delDynamicByid($book_id,$id)){
            return Redirect::to('/rgrassAdmin/showChapterDynamic?book_id='.$book_id);
        }else{
            dd('删除失败');
        }
    }
    /*
     * 添加一条新的动态消息
     * */
    public function AddChapterDynamic(){
        $book_id = $this->get('book_id');
        $user_info = $this->user->getUserBaseInfoAll();
        return View::make('Admin.BookViews.ChapterAddDynamic')->with(array(
            'book_id'=>$book_id,
            'user_info'=>$user_info
        ));
    }
    /*
     * 执行添加
     * */
    public function doAddChapterDynamic(){
        $user_id = $this->post('user_id');
        $book_id = $this->post('book_id');
        $behavior = $this->post('behavior');
        $action_value = $this->post('action_value');
        $addtime = time();
        $content = array(
            'user_id'=>$user_id,
            'book_id'=>$book_id,
            'behavior'=>$behavior,
            'action_value'=>$action_value,
            'addtime'=>$addtime
        );
        if($this->chapter_dynamic->InsertNewDynamic($book_id,$content)){
            return Redirect::to('/rgrassAdmin/showChapterDynamic?book_id='.$book_id);
        }else{
            dd('插入数据库失败');
        }
    }
    /*
     * 修改某一条动态
     * */
    public function ModifyChapterDynamic(){
        $book_id = $this->get('book_id');
        $id = $this->get('id');
        $user_info = $this->user->getUserBaseInfoAll();
        $dynamic = $this->chapter_dynamic->getDynamicById($book_id,$id);
        return View::make('Admin.BookViews.ChapterModifyDynamic')->with(array(
            'book_id'=>$book_id,
            'user_info'=>$user_info,
            'dynamic'=>$dynamic
        ));
    }
    public function doModifyChapterDynamic(){
        $id = $this->post('id');
        $user_id = $this->post('user_id');
        $book_id = $this->post('book_id');
        $behavior = $this->post('behavior');
        $action_value = $this->post('action_value');
        $addtime = time();
        $content = array(
            'user_id'=>$user_id,
            'book_id'=>$book_id,
            'behavior'=>$behavior,
            'action_value'=>$action_value,
            'addtime'=>$addtime
        );
        if($this->chapter_dynamic->modifyDynamic($book_id,$id,$content)){
            return Redirect::to('/rgrassAdmin/showChapterDynamic?book_id='.$book_id);
        }else{
            dd('修改数据库失败');
        }
    }
}