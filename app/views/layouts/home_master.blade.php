<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Bob的个人技术博客</title>
        <!-- 新 Bootstrap 核心 CSS 文件 -->
        {{HTML::style('Home/css/bootstrap.min.css')}}
        <!-- 可选的Bootstrap主题文件（一般不用引入） -->
        {{HTML::style('Home/css/bootstrap-theme.min.css')}}
        <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
        {{HTML::script('Home/js/jquery.min.js')}}
        <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
        {{HTML::script('Home/js/bootstrap.min.js')}}

        <style type="text/css">
            *{margin:0px;padding:0px;list-style:none;text-decoration:none}
            .fl{
                float:left;
            }
            .fr{
                float:right;
            }
            /*header开始*/
            header{
                width:100%;
                height:90px;
            }
            .header{
                width:980px;
                height:90px;
                margin:0 auto;
            }
            .logo{
                width:250px;
                height:90px;
                background: orangered;
            }
            .logo img{
                width:250px;
                height:90px;
            }
            .banner{
                width:730px;
                height:90px;
                background:green;
            }
            .user_login{
                width:100%;
                height: 25px;
                background:#F8F8F6;
            }
            .user_login ul li{
                float:right;
                margin-left:10px;
                font-size:16px;
                font-family: '宋体';
            }
            .user_login ul li a{
                color:black;
            }
            /*.login{*/
                /*width:980px;*/
                /*height:25px;*/
                /**/
            /*}*/


            /*header结束*/
            /*nav开始*/
            nav{

            }
            .nav{
                width:980px;
                margin:0 auto;
            }
            .nav li{
                float:left;

            }
            /*nav结束*/
            /*section开始*/
            section{
                width:100%;
                height:800px;
                background:red;
            }
            aside{
                margin:0 auto;
                width:980px;
                height:800px;
                background:green;
            }
            .aside_left{
                width:780px;
                height:800px;
                background:cyan;
            }
            .aside_right{
                width:200px;
                height:800px;
                background:darkorange;
            }
            /*section结束*/
            footer{
                width:100%;
                height:200px;
                background:yellow;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="user_login">
                <ul class="login">
                    <li><a href="">登陆</a></li>
                    <li>|</li>
                    <li><a href="">注册</a></li>
                </ul>
            </div>
            <div class="header">

                <div class="logo fl"><img src="/rgrass/public/Home/img/logo.jpg" alt=""/></div>
                <div class="banner fl">banner</div>
            </div>
        </header>
        <nav>
            <ul class="nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page One</a></li>
                <li><a href="#">Page Two</a></li>
            </ul>
        </nav>
        <section>
            <aside>
                <div class="aside_left fl"></div>
                <div class="aside_right fl"></div>
            </aside>
        </section>
        <footer>

        </footer>
    </body>
    <script type="text/javascript">
        
    </script>
</html>