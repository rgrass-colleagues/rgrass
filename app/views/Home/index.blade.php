<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8"/>
    <title>燃草中文社区--专业的经典同人小说社区网站</title>
    @include('layouts.bootstrap')
    <!--<link href="../../../Tongrenfang/css/boilerplate.css" rel="stylesheet" type="text/css">-->
    {{HTML::style('Home/css/search_index.css')}}
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="../../../Tongrenfang/js/respond.min.js"></script>
    <script type="text/javascript" src="../../Expression/jquery.min.js"></script>
</head>
<body>
<div class="gridContainer clearfix">
    <div id="div1" class="fluid">
        <div id="login_module">
            @if(!isset($is_user_login))
        <span id="login">
            <a href="/Login">登录</a>
        </span>
            <span>/</span>
        <span id="register" >
            <a href="/Reg">注册</a>
        </span>
            @else
            <div id="user_sign">
                <ul>
                    <li><a href="/error">消息(x)</a></li>
                    <li><a href="/error">{{$is_user_login->username}}</a></li>
                    <li><a href="/User">个人中心</a></li>
                    <li><a href="/Out" onclick="return confirm('确定退出吗?')">退出</a></li>
                </ul>
            </div>
            @endif
        </div>
        <div id="indexBody">
            <div id="indexLogo">
                <a href="http://www.rgrass.com/Index"><img src="../../Home/img/logo.jpg" alt="" width="450px" height="200px"/></a>
            </div>
            <div id="content_nav">
                <form action="/Search" method="get">
                    <div id="display_input">
                        <input type="text" class="form-control" id="book_search_body" placeholder="亲，输入您想看的小说喔~" name="search_content">
                        <input type="submit" class="btn btn-primary" id="btn_search" value="找小说"/>
                    </div>
                </form>

<!--                <div>-->
<!--                    <ul id="Category">-->
<!--                        <li><a href="/Index">同人坊</a></li>-->
<!--                        <li><a href="">动漫</a></li>-->
<!--                        <li><a href="">武侠</a></li>-->
<!--                        <li><a href="">漫综</a></li>-->
<!--                        <li><a href="">影视</a></li>-->
<!--                        <li><a href="">历史</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <ul id="hot_search">-->
<!--                        <li><span>热门搜索：</span></li>-->
<!--                        <li><a href="">火影</a></li>-->
<!--                        <li><a href="">宠物小精灵</a></li>-->
<!--                        <li><a href="">金庸</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
<!--            <form action="/Search" method="get">-->
<!--                <div id="search_body">-->
<!--                    <div id="search_input">-->
<!--                        <div class="form-group row">-->
<!--                            <input type="text" class="form-control" id="book_search_body" placeholder="亲，输入您想看的小说喔~" name="search_content">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div id="search_button" class="row">-->
<!--                        <input type="submit" class="btn btn-primary" id="btn_search" value="找小说"/>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
        </div>

    </div>
</div>
</body>
<script src="../../Home/js/main.js"></script>
</html>