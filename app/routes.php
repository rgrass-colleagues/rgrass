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




/***前台数据管理(轮播,推荐,追忆,各种榜单)***/
Route::get('/rgrassAdmin/HomeData','Admin_HomeDataController@HomeDataIndex');
//轮播图的
Route::get('/rgrassAdmin/HomeFlash','Admin_HomeDataController@HomeFlashUpdate');
Route::get('/rgrassAdmin/ModifyHomeFlash','Admin_HomeDataController@showModifyHomeFlash');
Route::post('/rgrassAdmin/doModifyHomeFlash','Admin_HomeDataController@doModifyHomeFlash');
Route::get('/rgrassAdmin/doChangeState','Admin_HomeDataController@doChangeState');
Route::get('/rgrassAdmin/AddHideHomeFlash','Admin_HomeDataController@AddHideHomeFlash');
Route::post('/rgrassAdmin/doAddHideHomeFlash','Admin_HomeDataController@doAddHideHomeFlash');
//强烈推荐的
/****强烈推荐****/
Route::get('/rgrassAdmin/StronglyRecommend','Admin_HomeDataController@StronglyRecommend');
//添加与修改,同人坊,精品站,动漫,武侠,影视,经典,原创共用
Route::get('/rgrassAdmin/AddHideStronglyRecommend','Admin_HomeDataController@AddHideStronglyRecommend');
Route::post('/rgrassAdmin/doAddHideStronglyRecommend','Admin_HomeDataController@doAddHideStronglyRecommend');
Route::get('/rgrassAdmin/ModifyStronglyRecommend','Admin_HomeDataController@ModifyStronglyRecommend');
Route::post('/rgrassAdmin/doModifyStronglyRecommend','Admin_HomeDataController@doModifyStronglyRecommend');
/****同人坊强烈推荐****/
/****精品站强烈推荐*****/
Route::get('/rgrassAdmin/BoutiqueStronglyRecommend','Admin_HomeDataController@BoutiqueStronglyRecommend');
/****精品站强烈推荐*****/

/******追忆********/
Route::get('/rgrassAdmin/Recall','Admin_HomeDataController@Recall');
//添加修改,追忆list,精品站,动漫,武侠,影视,经典,原创共用
Route::get('/rgrassAdmin/AddHideRecall','Admin_HomeDataController@AddHideRecall');
Route::post('/rgrassAdmin/doAddHideRecall','Admin_HomeDataController@doAddHideRecall');
Route::get('/rgrassAdmin/ModifyRecall','Admin_HomeDataController@ModifyRecall');
Route::post('/rgrassAdmin/doModifyRecall','Admin_HomeDataController@doModifyRecall');



/******精品追忆********/






//前台管理

/****首页******/
Route::get('/','Home_IndexController_IndexController@showIndex');
/****首页******/


/****登陆注册*****/
Route::get('/Login','Home_LoginController_LoginController@showLogin');
Route::get('/Reg','Home_LoginController_LoginController@showReg');
Route::get('/Out','Home_LoginController_LoginController@out');
Route::post('/doLogin','Home_LoginController_LoginController@doLogin');
Route::post('/doReg','Home_LoginController_LoginController@doReg');
Route::post('/ajax/user_confirm','Home_LoginController_LoginController@ajaxUserConfirm');
Route::get('/Activate','Home_LoginController_LoginController@accountAcitvate');
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
/*****搜索相关******/


/*****子栏目*****/
Route::get('/Boutique','Home_SortController_SortBoutiqueController@showBoutique');//全站精品书籍栏
Route::get('/Anime','Home_SortController_SortAnimeController@showAnime');//动漫小说子栏目
Route::get('/Martial','Home_SortController_SortMartialController@showMartial');//武侠小说子栏目
Route::get('/Film','Home_SortController_SortFilmController@showFilm');//影视小说子栏目
Route::get('/Classic','Home_SortController_SortClassicController@showClassic');//经典小说子栏目
Route::get('/Original','Home_SortController_SortOriginalController@showOriginal');//原创小说子栏目


/*****子栏目*****/

/*****用户中心*****/
Route::get('/User','Home_UserController_UserController@showUserCenter');
/*****用户中心*****/






















Route::get('/error','ErrorController@showError');

Route::get('/Home/ShowArticle','Home_ShowArticleController@ShowArticleIndex');
Route::get('/showTest','TestController@test');