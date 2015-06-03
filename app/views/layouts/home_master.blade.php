<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>@section('title')燃草中文社区@show</title>
    <!--<link href="../../../Tongrenfang/css/boilerplate.css" rel="stylesheet" type="text/css">-->

    <link href="../../../Tongrenfang/css/tongrenfang.css" rel="stylesheet" type="text/css">
    <link href="../../../Tongrenfang/css/showIndex.css" rel="stylesheet" type="text/css">
    @include('layouts.bootstrap')
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="../../../Tongrenfang/js/respond.min.js"></script>
    <script type="text/javascript" src="../../Expression/jquery.min.js"></script>
</head>
<body>
<div class="gridContainer clearfix">
    <div id="div1" class="fluid">
        @yield('content')
    </div>
</div>
</body>
<script src="../../Home/js/main.js"></script>
</html>
