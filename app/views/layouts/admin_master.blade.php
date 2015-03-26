<!DOCTYPE html>

<!--

Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 2.3.1

Version: 1.3

Author: KeenThemes

Website: http://www.keenthemes.com/preview/?theme=metronic

Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469

-->

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>
    @yield('css')
    <meta charset="utf-8" />

    <title>@section('title')小草网博客后台管理系统@show</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{HTML::style('Admin/css/bootstrap.min.css')}}
    {{HTML::style('Admin/css/bootstrap-responsive.min.css')}}
    {{HTML::style('Admin/css/font-awesome.min.css')}}
    {{HTML::style('Admin/css/style-metro.css')}}
    {{HTML::style('Admin/css/style.css')}}
    {{HTML::style('Admin/css/style-responsive.css')}}
    {{HTML::style('Admin/css/default.css')}}
    {{HTML::style('Admin/css/uniform.default.css')}}
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    {{HTML::style('Admin/css/jquery.gritter.css')}}
    {{HTML::style('Admin/css/daterangepicker.css')}}
    {{HTML::style('Admin/css/fullcalendar.css')}}
    {{HTML::style('Admin/css/jqvmap.css')}}
    {{HTML::style('Admin/css/jquery.easy-pie-chart.css')}}
    <!-- END PAGE LEVEL STYLES -->
    {{HTML::style('Admin/css/jquery.easy-pie-chart.css')}}
    {{HTML::image('Admin/image/favicon.ico')}}
</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

<!-- BEGIN HEADER -->

<div class="header navbar navbar-inverse navbar-fixed-top">

<!-- BEGIN TOP NAVIGATION BAR -->

<div class="navbar-inner">

<div class="container-fluid">

<!-- BEGIN LOGO -->

<!--<a class="brand" href="index.html">-->
<!---->
<!--    <img src="media/image/logo.png" alt="logo"/>-->
<!---->
<!--</a>-->

<!-- END LOGO -->

<!-- BEGIN RESPONSIVE MENU TOGGLER -->




<!-- END TOP NAVIGATION MENU -->

</div>

</div>

<!-- END TOP NAVIGATION BAR -->

</div>

<!-- END HEADER -->

<!-- BEGIN CONTAINER -->

<div class="page-container">

<!-- BEGIN SIDEBAR -->

<div class="page-sidebar nav-collapse collapse">

<!-- BEGIN SIDEBAR MENU -->

<ul class="page-sidebar-menu">
<li class="start active ">

    <a href="IndexCenter">

        <i class="icon-home"></i>

        <span class="title">后台主页</span>

        <span class="selected"></span>

    </a>

</li>

<li class="">

    <a href="UserInfo">

        <i class="icon-user"></i>

        <span class="title">用户管理</span>

        <span class="arrow "></span>

    </a>
</li>
    <li class="">

        <a href="ArticleLists">

            <i class="icon-bookmark-empty"></i>

            <span class="title">文章管理</span>

            <span class="arrow "></span>

        </a>
    </li>
    <li class="">

        <a href="TypeManager">

            <i class="icon-tags"></i>

            <span class="title">类型管理</span>

            <span class="arrow "></span>

        </a>
    </li>
    <li class="">

        <a href="javascript:;">

            <i class="icon-cogs"></i>

            <span class="title">日志管理</span>

            <span class="arrow "></span>

        </a>
    </li>
</ul>

<!-- END SIDEBAR MENU -->

</div>

<!-- END SIDEBAR -->

<!-- BEGIN PAGE -->

<div class="page-content">

<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

<div id="portlet-config" class="modal hide">

    <div class="modal-header">

        <button data-dismiss="modal" class="close" type="button"></button>

        <h3>Widget Settings</h3>

    </div>

    <div class="modal-body">

        Widget settings form goes here

    </div>

</div>

<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

<!-- BEGIN PAGE CONTAINER-->

<div class="container-fluid">

<!-- BEGIN PAGE HEADER-->

<div class="row-fluid">

    <div class="span12">

        <!-- BEGIN STYLE CUSTOMIZER -->

        <div class="color-panel hidden-phone">

            <div class="color-mode-icons icon-color"></div>

            <div class="color-mode-icons icon-color-close"></div>

            <div class="color-mode">

                <p>THEME COLOR</p>

                <ul class="inline">

                    <li class="color-black current color-default" data-style="default"></li>

                    <li class="color-blue" data-style="blue"></li>

                    <li class="color-brown" data-style="brown"></li>

                    <li class="color-purple" data-style="purple"></li>

                    <li class="color-grey" data-style="grey"></li>

                    <li class="color-white color-light" data-style="light"></li>

                </ul>

                <label>

                    <span>Layout</span>

                    <select class="layout-option m-wrap small">

                        <option value="fluid" selected>Fluid</option>

                        <option value="boxed">Boxed</option>

                    </select>

                </label>

                <label>

                    <span>Header</span>

                    <select class="header-option m-wrap small">

                        <option value="fixed" selected>Fixed</option>

                        <option value="default">Default</option>

                    </select>

                </label>

                <label>

                    <span>Sidebar</span>

                    <select class="sidebar-option m-wrap small">

                        <option value="fixed">Fixed</option>

                        <option value="default" selected>Default</option>

                    </select>

                </label>

                <label>

                    <span>Footer</span>

                    <select class="footer-option m-wrap small">

                        <option value="fixed">Fixed</option>

                        <option value="default" selected>Default</option>

                    </select>

                </label>

            </div>

        </div>

        <!-- END BEGIN STYLE CUSTOMIZER -->

        <!-- BEGIN PAGE TITLE & BREADCRUMB-->

        <h3 class="page-title">
            @section('pagetitle')
            后台首页
            @show
        </h3>
        @section('ptitle')
        <ul class="breadcrumb">

            <li>

                <i class="icon-home"></i>

                <a href="IndexCenter">后台首页</a>

<!--                <i class="icon-angle-right"></i>-->

            </li>

<!--            <li><a href="#">Dashboard</a></li>-->

            <li class="pull-right no-text-shadow">

                <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">

                    <i class="icon-calendar"></i>

                    <span></span>

                    <i class="icon-angle-down"></i>

                </div>

            </li>

        </ul>
@show
        <!-- END PAGE TITLE & BREADCRUMB-->

    </div>

</div>

<!-- END PAGE HEADER-->

<div class="contents">
@yield('content')


</div>

</div>

<!-- END PAGE -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

<div class="footer">

    <div class="footer-inner">

        2013 &copy; Metronic by keenthemes.

    </div>

    <div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

    </div>

</div>

<!-- END FOOTER -->





</html>