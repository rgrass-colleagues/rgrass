<?php
/**
 * @author bob
 * Date: 15-7-8 下午4:10
 */
class Admin_BookSplitController extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->is_admin_login();
    }
    /**章节分割**/
    public function showSplitIndex(){
        $book_info = Book_BookSplitModel::getBookSplitInfo();
        return View::make('Admin.BookSplitViews.BookSplitIndex')->with(array(
            'book_info'=>$book_info
        ));
    }
    /****小说整本上传*****/
    public function UploadBook(){
        return View::make('Admin.BookSplitViews.UploadBook');
    }
    public function doUploadBook(){
        if(!Common_FileUploadsModel::BookUpload()){
            dd('文件上传失败');
        }
        return Redirect::to('/rgrassAdmin/BookSplit');
    }

    /**删除小说文件***/
    public function doDelBook(){
        $book_url = $this->get('book_url');
        if(file_exists($book_url)){
            unlink($book_url);
        }else{
            dd('该文件不存在');
        }

        return Redirect::to('/rgrassAdmin/BookSplit');
    }


    /*切割一本小说*/
    public function SplitABook(){
        $book_url = $this->get('book_url');
        $bookTypeInfo = Type_TypeInfoModel::getNBookTypeNotPidByZero();
        return View::make('Admin.BookSplitViews.SplitRole')->with(array(
            'book_url'=>$book_url,
            'type'=>$bookTypeInfo
        ));
    }
    public function doSplitABook(){
        $split_role_num = $this->post('split_role');
        $split_role = Book_BookSplitModel::getSplitBookRegular($split_role_num);//获取对应正则
        $book_url = $this->post('book_url');
        $book_name = preg_replace('/^.+[\\\\\\/]/', '', $book_url);
        $book_name = explode('.',$book_name)[0];
        //需要判断这本书是否已经存在
//        if(Book_BookNewInfoModel::isExistByBookName($book_name)){
//            dd('该小说已经存在');
//        }
        $book = file_get_contents($book_url);
        $chapter_name_arr = preg_match_all($split_role,$book,$chapter_all_name)[0];//获取全部章节名
        $chapter_content_arr = preg_split($split_role,$book);//获取全部章节内容


        /*****创建书籍******/
        $cover = Common_FileUploadsModel::NewFileUploads('cover','covers');
        //info
        $info_content = array(
            'book_name'=>$book_name,
            'cover'=>$cover,
            'author'=>$this->post('author'),
            'detail'=>$this->post('detail'),
            'book_add_time'=>time(),
            'book_authority'=>1,
            'book_type'=>$this->post('book_type'),
            'is_boutiques'=>$this->post('is_boutiques'),
            'book_from_status'=>$this->post('book_from_status'),
            'book_from_url'=>$this->post('book_from_url'),
        );
        //detail
        $detail_content = array(
            'last_update_time'=>time(),
            'state'=>$this->post('state'),
            'editor_estimate'=>$this->post('editor_estimate'),
        );
        //先插入info表
        if(!$book_id = Book_BookNewInfoModel::insertBookInfo($info_content)){
            dd('插入book_info表失败');
        }else{
            $detail_content['book_id'] = $book_id;
            if(!Book_BookNewInfoModel::insertBookDetail($detail_content)){
                dd('插入book_detail失败');
            }else{
                //book_info表与book_detail表都插入成功，开始插入章节
                //创建小说表
                if(!Book_CreateNewBookContentModel::createBookContentByBookId($book_id)){
                    dd('创建小说表失败');
                }else{
                    foreach($chapter_all_name[0] as $k=>$v){
                        $chapter_content_text = $chapter_content_arr[$k+1];
                        $chapter_content_text = $v.$chapter_content_text;
                        $chapter_content_text = Common_TextBeautifyModel::addNewPInText($chapter_content_text);
//                        $chapter_content_text = $chapter_content_arr[$k+1];
                        $book_dir_path = './Book_List/'.$book_id;
                        $organization_path = './Book_List/'.$book_id.'/0/';
                        $file_path = './Book_List/'.$book_id.'/0/'.$v.'.txt';
                        $chapter_content = array(
                            'chapter_name'=>$v,
                            'chapter_content'=>$chapter_content_text,
                            'update_time'=>time(),
                            'update_users'=>'1',
                            'chapter_organization'=>0,
                            'chapter_path'=>$file_path,
                        );
                        if(!Book_CreateNewBookContentModel::addNewBookContent($book_id,$chapter_content)){
                            dd('插入小说章节'.$v.'失败');
                        }else{
                            if(!file_exists($book_dir_path)){
                                mkdir($book_dir_path);
                            }
                            if(!file_exists($organization_path)){
                                mkdir($organization_path);
                            }
                            file_put_contents($file_path,$chapter_content_text);
                        }
                    }
                    return Redirect::to('/rgrassAdmin/BookLists');
                }
            }
        }
    }
    public function AfterSplitChapter(){
        $book_url = $this->get('book_url');
        $format = $this->get('format');
        $split_role = Book_BookSplitModel::getSplitBookRegular($format);//获取对应正则
        $book = file_get_contents($book_url);
        $chapter_name_arr = preg_match_all($split_role,$book,$chapter_all_name)[0];//获取全部章节名
        $catalog = $this->ChapterPreView($chapter_all_name[0],3);
        return View::make('Admin.BookSplitViews.AfterSplitChapter')->with(array(
                'catalog'=>$catalog,
        ));
    }
    private function ChapterPreView($catalog,$page){
        $page=$page?$page:3;
        $html = "<tr>";
        $i=1;
        $html .='<tr><td style="text-align: left" colspan="3"><span>正文</span></td></tr>';
        foreach($catalog as $key=>$val){
                if((($i)%$page)!=0){
                    $html .= "<td>$val</td>";
                }else{
                    $html .= "<td>$val</td></tr><tr>";
                }
                $i++;
            }
            $html .="</tr>";
        return $html;
    }
}