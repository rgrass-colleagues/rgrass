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
    @include('layouts.bootstrap')
    <link href="../../../Tongrenfang/css/tongrenfang.css" class="pc_css" rel="stylesheet" type="text/css">
    <link href="../../../Tongrenfang/css/showIndex.css" class="pc_css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="../../../Tongrenfang/js/respond.min.js"></script>
    <script type="text/javascript" src="../../Expression/jquery.min.js"></script>
    <script>
        /****判断是否PC端,自适应****/
//        function IsPC() {
//            var userAgentInfo = navigator.userAgent;
//            var Agents = ["Android", "iPhone",
//                "SymbianOS", "Windows Phone",
//                "iPad", "iPod"];
//            var flag = true;
//            for (var v = 0; v < Agents.length; v++) {
//                if (userAgentInfo.indexOf(Agents[v]) > 0) {
//                    flag = false;
//                    break;
//                }
//            }
//            return flag;
//        }
//        if(IsPC()){
//            $('<link>',{type:'text\/css',href:'../../../Tongrenfang/css/tongrenfang.css',rel:'stylesheet'}).appendTo('head');
//            $('<link>',{type:'text\/css',href:'../../../Tongrenfang/css/showIndex.css',rel:'stylesheet'}).appendTo('head');
//        }
    </script>
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
