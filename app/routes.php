<?php
//后台

//登陆
Route::get('rgrassBlogAdminLogin','Admin_LoginController@LoginIndex');
Route::post('doLoginAdmin','Admin_LoginController@doLoginAdmin');
//主页
Route::get('/rgrassAdmin/IndexCenter','Admin_IndexController@showAdminIndex');
//用户(首页，详情，添加+修改，删除）
Route::get('/rgrassAdmin/UserInfo', 'Admin_UserController@showAdminUserInfo');
Route::get('/rgrassAdmin/UserDetail','Admin_UserController@showUserDetail');
Route::get('/rgrassAdmin/AddNewOrModifyOneUser','Admin_UserController@AddNewOrModifyOneUser');
Route::post('/rgrassAdmin/doAddNewOrModifyOneUser','Admin_UserController@doAddNewOrModifyOneUser');
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
//类型
Route::get('/rgrassBlogAdmin/TypeManager','Admin_TypeArticleController@TypeManager');
//



//前台
Route::get('/','Home_IndexController@showIndex');
Route::get('/login','Home_LoginController@showLogin');
Route::get('/Home/ShowArticle','Home_ShowArticleController@ShowArticleIndex');