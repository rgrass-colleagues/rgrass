<!DOCTYPE HTML>
<html>
    <head>
        <title>燃草中文社区--专业的经典同人小说社区网站</title>
        <meta charset="utf-8"/>
        @include('layouts.bootstrap')
        {{HTML::style('Home/css/search_index.css')}}
    </head>
    <body>
        <section class="container-flush">
            <div id="indexBody">
                <div id="indexLogo">
                    <a href="http://www.rgrass.com/index"><img src="../../Home/img/logo.jpg" alt="" width="100%" height="100%"/></a>
                </div>
                <div id="content_nav">
                    <ul id="Category">
                        <li><a href="index">同人坊</a></li>
                        <li><a href="">武侠</a></li>
                        <li><a href="">动漫</a></li>
                        <li><a href="">漫综</a></li>
                        <li><a href="">影视</a></li>
                        <li><a href="">历史</a></li>
                    </ul>
                    <ul id="hot_search">
                        <li><span>热门搜索：</span></li>
                        <li><a href="">火影</a></li>
                        <li><a href="">宠物小精灵</a></li>
                        <li><a href="">金庸</a></li>
                    </ul>
                </div>
                <div id="search_body">
                    <div id="search_input">
                        <div class="form-group row">
                            <input type="text" class="form-control" id="book_search_body" placeholder="亲，输入您想看的小说喔~">
                        </div>
                    </div>
                    <div id="search_button" class="row">
                        <input type="submit" class="btn btn-primary" id="btn_search" value="找小说"/>
                    </div>
                </div>
            </div>
        </section>
    <div id="login_module">
        @if(!isset($is_user_login))
        <span id="login">
            <a href="/login">登录</a>
        </span>
        <span>/</span>
        <span id="register" >
            <a href="/reg">注册</a>
        </span>
        @else
        <div id="user_sign">
            <ul>
                <li><a href="/error">消息(x)</a></li>
                <li><a href="/error">{{$is_user_login->username}}</a></li>
                <li><a href="/error">个人中心</a></li>
                <li><a href="/out" onclick="return confirm('确定退出吗?')">退出</a></li>
            </ul>
        </div>
        @endif
    </div>
    </body>
</html>