<?php
//后台管理

//登陆
Route::get('wwwdotrgrassdotcomAdministrationLogin','Admin_LoginController@LoginIndex');
Route::post('doLoginAdmin','Admin_LoginController@doLoginAdmin');
//主页
Route::get('/rgrassAdmin/IndexCenter','Admin_IndexController@showAdminIndex');
//用户(首页，详情，添加+修改，删除）
Route::get('/rgrassAdmin/UserInfo', 'Admin_UserController@showAdminUserInfo');
Route::get('/rgrassAdmin/UserDetail','Admin_UserController@showUserDetail');
Route::get('/rgrassAdmin/AddNewOrModifyOneUser','Admin_UserController@AddNewOrModifyOneUser');
Route::post('/rgrassAdmin/doAddNewOrModifyOneUser','Admin_UserController@doAddNewOrModifyOneUser');
Route::get('rgrassAdmin/doDelUser','Admin_UserController@doDelUser');

//用户财产
Route::get('/rgrassAdmin/UserPropertyIndex','Admin_UserController@showUserPropertyIndex');
Route::get('/rgrassAdmin/ModifyUserProperty','Admin_UserController@ModifyUserProperty');
Route::post('/rgrassAdmin/doModifyUserProperty','Admin_UserController@doModifyUserProperty');
//作者专区
Route::get('/rgrassAdmin/UserTransferAuthor','Admin_UserController@doUserTransferAuthor');
Route::get('/rgrassAdmin/AuthorIndex','Admin_UserController@showAuthorIndex');
Route::get('/rgrassAdmin/ModifyAuthorInfo','Admin_UserController@showModifyAuthorInfo');
Route::post('/rgrassAdmin/doModifyAuthorInfo','Admin_UserController@doModifyAuthorInfo');
/*个人标签*/
Route::get('/rgrassAdmin/SelfTagIndex','Admin_UserController@showSelfTagIndex');
Route::get('/rgrassAdmin/AddNewUserTag','Admin_UserController@showAddNewUserTag');



//书籍
Route::get('/rgrassAdmin/BookLists','Admin_BookController@showBookLists');
Route::get('/rgrassAdmin/BookDetail','Admin_BookController@showBookDetail');
Route::get('/rgrassAdmin/BookAllDetail','Admin_BookController@showBookAllDetail');
/*
 * 添加文章与修改文章合并为一个
 * */
Route::get('/rgrassAdmin/AddNewOrModifyOneBook','Admin_BookController@AddNewOrModifyOneBook');
Route::post('/rgrassAdmin/doAddNewOrModifyOneBook','Admin_BookController@doAddNewOrModifyOneBook');
/*
 * 删除书籍 
 * */
Route::get('/rgrassAdmin/delBook','Admin_BookController@delBook');
/*
 * 审核
 * */
Route::get('/rgrassAdmin/BookReview','Admin_BookController@doBookReview');
/*
 * 书本内容,章节管理
 * */
Route::get('/rgrassAdmin/chapter_manager','Admin_BookController@booksManager');
Route::get('/rgrassAdmin/addBookChapter','Admin_BookController@addBookChapter');//添加章节
Route::post('/rgrassAdmin/doAddBookChapter','Admin_BookController@doAddBookChapter');//执行添加
Route::get('/rgrassAdmin/showChapterContent','Admin_BookController@showChapterContent');//显示章节内容
Route::get('/rgrassAdmin/ModifyChapterContent','Admin_BookController@showModifyChapterContent');//修改章节内容
Route::post('/rgrassAdmin/doModifyChapterContent','Admin_BookController@doModifyChapterContent');
Route::get('/rgrassAdmin/DelChapterContent','Admin_BookController@doDelChapterContent');//删除章节
Route::get('/rgrassAdmin/addNewOrganization','Admin_BookController@addNewOrganization');//添加分卷
Route::post('/rgrassAdmin/doAddOrganization','Admin_BookController@doAddOrganization');
Route::get('/rgrassAdmin/ModifyChapterOrganization','Admin_BookController@showModifyChapterOrganization');//修改分卷信息
Route::get('/rgrassAdmin/DelChapterOrganization','Admin_BookController@doDelChapterOrganization');
Route::get('/rgrassAdmin/ModifyChapterOrganizationInfo','Admin_BookController@showModifyChapterOrganizationInfo');
Route::post('/rgrassAdmin/doModifyChapterOrganizationInfo','Admin_BookController@doModifyChapterOrganizationInfo');
/*用户对小说的动态*/
Route::get('/rgrassAdmin/showChapterDynamic','Admin_DynamicController@showChapterDynamic');
Route::get('/rgrassAdmin/DelChapterDynamic','Admin_DynamicController@doDelChapterDynamic');
Route::get('/rgrassAdmin/AddChapterDynamic','Admin_DynamicController@AddChapterDynamic');
Route::post('/rgrassAdmin/doAddChapterDynamic','Admin_DynamicController@doAddChapterDynamic');
Route::get('/rgrassAdmin/ModifyChapterDynamic','Admin_DynamicController@ModifyChapterDynamic');
Route::post('/rgrassAdmin/doModifyChapterDynamic','Admin_DynamicController@doModifyChapterDynamic');

/*小说评论*/
Route::get('/rgrassAdmin/showBookDiscuss','Admin_DiscussController@showBookDiscuss');
Route::get('/rgrassAdmin/AddMainDiscuss','Admin_DiscussController@AddMainDiscuss');
Route::post('/rgrassAdmin/doAddMainDiscuss','Admin_DiscussController@doAddMainDiscuss');
Route::get('/rgrassAdmin/ModifyMainDiscuss','Admin_DiscussController@ModifyMainDiscuss');
Route::post('/rgrassAdmin/doModifyMainDiscuss','Admin_DiscussController@doModifyMainDiscuss');
Route::get('/rgrassAdmin/DiscussChildIndex','Admin_DiscussController@showDiscussChildIndex');
Route::get('/rgrassAdmin/AddDiscussChild','Admin_DiscussController@AddDiscussChild');
Route::post('/rgrassAdmin/doAddDiscussChild','Admin_DiscussController@doAddDiscussChild');
Route::get('/rgrassAdmin/ModifyChildDiscuss','Admin_DiscussController@ModifyChildDiscuss');
Route::post('/rgrassAdmin/doModifyDiscussChild','Admin_DiscussController@doModifyDiscussChild');

//类型
Route::get('/rgrassAdmin/BookTypeManager','Admin_BookTypeController@showTypeIndex');
Route::get('/rgrassAdmin/AddNewType','Admin_BookTypeController@addNewType');
Route::post('/rgrassAdmin/doAddNewType','Admin_BookTypeController@doAddNewType');
Route::get('/rgrassAdmin/ModifyType','Admin_BookTypeController@modifyType');
Route::post('/rgrassAdmin/doModifyType','Admin_BookTypeController@doModifyType');
Route::get('/rgrassAdmin/DelType','Admin_BookTypeController@doDelType');




//
//日志管理
Route::get('/rgrassAdmin/LogManager','Admin_LogController@showLogIndex');
Route::get('/rgrassAdmin/IPManager','Admin_LogController@showUserIPconditions');
Route::get('/rgrassAdmin/IPtoAddress','Admin_LogController@IPtoAddress');
/*友情链接*/
Route::get('/rgrassAdmin/FriendsLink','Admin_FriendsLinkController@showFriendsLink');
//消息管理
Route::get('/rgrassAdmin/MessageManager','Admin_MessageController@showMessageIndex');
Route::get('/rgrassAdmin/DelAdminMessage','Admin_MessageController@delAdminMessage');
Route::get('/rgrassAdmin/ReplyAdminMessage','Admin_MessageController@replyAdminMessage');
Route::post('/rgrassAdmin/doReplyAdminMessage','Admin_MessageController@doReplyAdminMessage');

/*前台数据管理*/
Route::get('/rgrassAdmin/HomeData','Admin_HomeDataController@HomeDataIndex');
//轮播图的
Route::get('/rgrassAdmin/HomeFlash','Admin_HomeDataController@HomeFlashUpdate');
Route::get('/rgrassAdmin/ModifyHomeFlash','Admin_HomeDataController@showModifyHomeFlash');
Route::post('/rgrassAdmin/doModifyHomeFlash','Admin_HomeDataController@doModifyHomeFlash');
Route::get('/rgrassAdmin/doChangeFlashState','Admin_HomeDataController@doChangeFlashState');
//强烈推荐的
Route::get('/rgrassAdmin/HomeStronglyRecommend','Admin_HomeDataController@HomeStronglyRecommend');
//前台管理

/****首页******/
Route::get('/','Home_IndexController_IndexController@showIndex');
/****首页******/


/****登陆注册*****/
Route::get('/Login','Home_LoginControllerLoginController@showLogin');
Route::get('/Reg','Home_LoginControllerLoginController@showReg');
Route::get('/Out','Home_LoginControllerLoginController@out');
Route::post('/doLogin','Home_LoginControllerLoginController@doLogin');
Route::post('/doReg','Home_LoginControllerLoginController@doReg');
Route::post('/ajax/user_confirm','Home_LoginControllerLoginController@ajaxUserConfirm');
Route::get('/Activate','Home_LoginControllerLoginController@accountAcitvate');
/****登陆注册*****/

/****分类栏目****/
Route::get('/Index','Home_SortController_TongrenController@showTongrenIndex');
/****分类栏目****/

/*****小说相关*****/
Route::get('/Book','Home_BookController_BookController@showBookIndex');
Route::get('/Catalog','Home_BookController_BookCatalogController@showBookCatalog');
Route::get('/ChapterContent','Home_BookController_ChapterContentController@showChapterContent');
/*****小说相关*****/
/*****小说搜索****/
Route::get('/Search','Home_SearchController_SearchIndexController@SearchIndex');




Route::get('/error','ErrorController@showError');

Route::get('/Home/ShowArticle','Home_ShowArticleController@ShowArticleIndex');
Route::get('/showTest','TestController@test');