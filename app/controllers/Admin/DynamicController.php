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
    public function showChapterDynamic(){
        $book_id=$this->get('book_id');
        $dynamic_info = $this->chapter_dynamic->getDynamicAll($book_id);
        return View::make('Admin.BookViews.ChapterDynamicIndex')->with(array(
            'dynamic_info'=>$dynamic_info
        ));
    }

}