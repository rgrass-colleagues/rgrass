<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-11
 * Time: 11:58
 */
class Admin_DiscussController extends BaseController{
    private $discuss = null;
    private $user = null;
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
        $this->discuss = new Book_DiscussModel();
        $this->user = new User_UserInfoModel();
    }
    /*显示当前小说的所有主评论*/
    public function showBookDiscuss(){
        $book_id = $this->get('book_id');
        $discuss_info = $this->discuss->getDiscussAll($book_id);
        return View::make('Admin.BookViews.DiscussIndex')->with(array(
            'book_id'=>$book_id,
            'discuss_info'=>$discuss_info
        ));
    }
    /*
     * 添加一条主评论
     * */
    public function AddMainDiscuss(){
        $book_id = $this->get('book_id');
        $user_info = $this->user->getUserBaseInfoAll();
        return View::make('Admin.BookViews.DiscussMainAdd')->with(array(
            'book_id'=>$book_id,
            'user_info'=>$user_info
        ));
    }
    /*执行添加主评论*/
    public function doAddMainDiscuss(){
        $user_id = $this->post('user_id');
        $book_id = $this->post('book_id');
        $estimate_title = $this->post('estimate_title');
        $estimate_content = $this->post('estimate_content');
        $nice_discuss = $this->post('nice_discuss');
        $top = $this->post('top');
        $content = array(
            'user_id'=>$user_id,
            'book_id'=>$book_id,
            'estimate_title'=>$estimate_title,
            'estimate_content'=>$estimate_content,
            'nice_discuss'=>$nice_discuss,
            'top'=>$top,
            'addtime'=>time()
        );
        if($this->discuss->insertNewMainDiscuss($book_id,$content)){
            return Redirect::to('/rgrassAdmin/showBookDiscuss?book_id='.$book_id);
        }else{
            dd('插入数据库失败');
        }
    }
    /*修改主评论*/
    public function ModifyMainDiscuss(){
        $book_id = $this->get('book_id');
        $id = $this->get('id');
        $user_info = $this->user->getUserBaseInfoAll();
        $discuss_info = $this->discuss->getDiscussById($book_id,$id);
        return View::make('Admin.BookViews.DiscussMainModify')->with(array(
            'book_id'=>$book_id,
            'user_info'=>$user_info,
            'discuss_info'=>$discuss_info

        ));
    }
    /*执行修改*/
    public function doModifyMainDiscuss(){
        $id = $this->post('id');
        $user_id = $this->post('user_id');
        $book_id = $this->post('book_id');
        $estimate_title = $this->post('estimate_title');
        $estimate_content = $this->post('estimate_content');
        $nice_discuss = $this->post('nice_discuss');
        $top = $this->post('top');
        $content = array(
            'user_id'=>$user_id,
            'book_id'=>$book_id,
            'estimate_title'=>$estimate_title,
            'estimate_content'=>$estimate_content,
            'nice_discuss'=>$nice_discuss,
            'top'=>$top,
            'addtime'=>time()
        );
        if($this->discuss->updateMainDiscuss($book_id,$id,$content)){
            return Redirect::to('/rgrassAdmin/showBookDiscuss?book_id='.$book_id);
        }else{
            dd('修改数据库失败');
        }
    }
    /*显示子评论(主评论+子楼层)*/
    public function showDiscussChildIndex(){
        $book_id = $this->get('book_id');
        $discuss_id = $this->get('discuss_id');
        $discuss_child = $this->discuss->getDiscussChildByDId($book_id,$discuss_id);
        $discuss_info = $this->discuss->getDiscussById($book_id,$discuss_id);
        return View::make('Admin.BookViews.DiscussChildIndex')->with(array(
            'book_id'=>$book_id,
            'discuss_child'=>$discuss_child,
            'discuss_info'=>$discuss_info
        ));
    }
    /*添加子评论*/
    public function AddDiscussChild(){
        $book_id = $this->get('book_id');
        $discuss_id = $this->get('discuss_id');
        $user_info = $this->user->getUserBaseInfoAll();
        return View::make('Admin.BookViews.DiscussChildAdd')->with(array(
            'book_id'=>$book_id,
            'discuss_id'=>$discuss_id,
            'user_info'=>$user_info
        ));
    }
    /*执行添加子评论*/
    public function doAddDiscussChild(){
        $user_id = $this->post('user_id');
        $book_id = $this->post('book_id');
        $discuss_id = $this->post('discuss_id');
        $estimate_content = $this->post('estimate_content');
        $addtime = time();
        $content = array(
            'user_id'=>$user_id,
            'book_id'=>$book_id,
            'discuss_id'=>$discuss_id,
            'estimate_content'=>$estimate_content,
            'addtime'=>$addtime
        );
        if($this->discuss->insertDiscussChild($book_id,$content)){
            return Redirect::to("/rgrassAdmin/DiscussChildIndex?book_id={$book_id}&&discuss_id={$discuss_id}");
        }else{
            dd('插入数据库失败');
        }
    }
    public function ModifyChildDiscuss(){
        $book_id = $this->get('book_id');
        $id = $this->get('id');
        $discuss_child_info = $this->discuss->getDiscussChildById($book_id,$id);
        $user_info = $this->user->getUserBaseInfoAll();
        return View::make('Admin.BookViews.DiscussChildModify')->with(array(
            'book_id'=>$book_id,
            'user_info'=>$user_info,
            'id'=>$id,
            'discuss_child_info'=>$discuss_child_info
        ));
    }
    /*执行修改*/
    public function doModifyDiscussChild(){
        $id = $this->post('id');
        $user_id = $this->post('user_id');
        $book_id = $this->post('book_id');
        $discuss_id = $this->post('discuss_id');
        $estimate_content = $this->post('estimate_content');
        $addtime = time();
        $content = array(
            'user_id'=>$user_id,
            'book_id'=>$book_id,
            'discuss_id'=>$discuss_id,
            'estimate_content'=>$estimate_content,
            'addtime'=>$addtime
        );
        if($this->discuss->modifyDiscussChild($book_id,$id,$content)){
            return Redirect::to("/rgrassAdmin/DiscussChildIndex?book_id={$book_id}&&discuss_id={$discuss_id}");
        }else{
            dd('修改数据库失败');
        }
    }
}