<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>Metronic | Login Page</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
<!--    {{HTML::style('css/a.css')}}-->
<!--    {{HTML::script('js/b.js')}}-->
<!--    {{HTML::image('img/c.jpg')}}-->
    {{HTML::style('Admin/css/bootstrap.min.css')}}
    {{HTML::style('Admin/css/bootstrap-responsive.min.css')}}
    {{HTML::style('Admin/css/font-awesome.min.css')}}
    {{HTML::style('Admin/css/style-metro.css')}}
    {{HTML::style('Admin/css/style.css')}}
    {{HTML::style('Admin/css/style-responsive.css')}}
    {{HTML::style('Admin/css/default.css')}}
    {{HTML::style('Admin/css/uniform.default.css')}}
    {{HTML::style('Admin/css/login.css')}}
<!--    <link rel="shortcut icon" href="media/image/favicon.ico" />-->

</head>

<body class="login">

<div class="content" style="margin-top:150px">

<!-- BEGIN LOGIN FORM -->

<form class="form-vertical login-form" action="doLoginAdmin" method="post">

    <h3 class="form-title">小草网博客后台登陆</h3>

    <div class="alert alert-error hide">

        <button class="close" data-dismiss="alert"></button>

        <span>Enter any username and password.</span>

    </div>

    <div class="control-group">

        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

        <label class="control-label visible-ie8 visible-ie9">Username</label>

        <div class="controls">

            <div class="input-icon left">

                <i class="icon-user"></i>

                <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="username"/>

            </div>

        </div>

    </div>

    <div class="control-group">

        <label class="control-label visible-ie8 visible-ie9">Password</label>

        <div class="controls">

            <div class="input-icon left">

                <i class="icon-lock"></i>

                <input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password"/>

            </div>

        </div>

    </div>
    <input type="submit" value="提交" class="btn blue"/>
</form>

<!-- END LOGIN FORM -->

<!-- BEGIN FORGOT PASSWORD FORM -->

<!-- END FORGOT PASSWORD FORM -->

<!-- BEGIN REGISTRATION FORM -->

<!-- END REGISTRATION FORM -->

</div>

<!--[if lt IE 9]>

<![endif]-->

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->


<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->



<!-- END JAVASCRIPTS -->


</html>