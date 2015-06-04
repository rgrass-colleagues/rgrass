<?php
//后台

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
 * 书本内容,章节管理
 * */
Route::get('/rgrassAdmin/chapter_manager','Admin_BookController@booksManager');
Route::get('/rgrassAdmin/addBookChapter','Admin_BookController@addBookChapter');
Route::get('/rgrassAdmin/addNewOrganization','Admin_BookController@addNewOrganization');
Route::post('/rgrassAdmin/doAddOrganization','Admin_BookController@doAddOrganization');
Route::post('/rgrassAdmin/doAddBookChapter','Admin_BookController@doAddBookChapter');
Route::get('/rgrassAdmin/showChapterContent','Admin_BookController@showChapterContent');

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



//前台
Route::get('/','Home_IndexController@showIndex');
Route::get('/login','Home_LoginController@showLogin');
Route::get('/reg','Home_LoginController@showReg');
Route::get('/out','Home_LoginController@out');
Route::post('/doLogin','Home_LoginController@doLogin');
Route::post('/doReg','Home_LoginController@doReg');
Route::post('/ajax/user_confirm','Home_LoginController@ajaxUserConfirm');
Route::get('/activate','Home_LoginController@accountAcitvate');
Route::get('/index','Home_TongrenController@showTongrenIndex');
Route::get('/book','Home_BookController@showBookIndex');
Route::get('/catalog','Home_BookCatalogController@showBookCatalog');




Route::get('/error','ErrorController@showError');

Route::get('/Home/ShowArticle','Home_ShowArticleController@ShowArticleIndex');
Route::get('/showTest','TestController@test');