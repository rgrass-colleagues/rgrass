<?php
//后台

//登陆
Route::get('rgrassBlogAdminLogin','Admin_LoginController@LoginIndex');
Route::post('doLoginAdmin','Admin_LoginController@doLoginAdmin');
//主页
Route::get('/rgrassAdmin/IndexCenter','Admin_IndexController@showAdminIndex');
//用户
Route::get('/rgrassAdmin/UserInfo', 'Admin_UserController@showAdminUserInfo');
//文章
Route::get('/rgrassAdmin/BookLists','Admin_BookController@showBookLists');
Route::get('/rgrassAdmin/BookDetail','Admin_BookController@showBookDetail');
Route::get('/rgrassAdmin/BookAllDetail','Admin_BookController@showBookAllDetail');
/*
 * 添加文章与修改文章合并为一个
 * */
Route::get('/rgrassAdmin/AddNewOrModifyOneBook','Admin_BookController@AddNewOrModifyOneBook');
Route::post('/rgrassAdmin/doAddNewOrModifyOneBook','Admin_BookController@doAddNewOrModifyOneBook');
//类型
Route::get('/rgrassBlogAdmin/TypeManager','Admin_TypeArticleController@TypeManager');




//前台
Route::get('/index','Home_IndexController@showIndex');
Route::get('/Home/ShowArticle','Home_ShowArticleController@ShowArticleIndex');