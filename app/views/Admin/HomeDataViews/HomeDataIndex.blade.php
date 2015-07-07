@extends('layouts.admin_master')
@section('title')
用户管理
@stop
@section('pagetitle')
用户列表
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/HomeData">前台数据</a></li>

    <li class="pull-right no-text-shadow">

        <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">

            <i class="icon-calendar"></i>

            <span></span>

            <i class="icon-angle-down"></i>

        </div>

    </li>

</ul>
@stop
@section('content')
<a href="/rgrassAdmin/StronglyRecommend?nav=tongrenfan" class="btn blue">同人坊强烈推荐</a>
<a href="/rgrassAdmin/StronglyRecommend?nav=boutique" class="btn black">精品站强烈推荐</a>
<a href="/rgrassAdmin/StronglyRecommend?nav=anime" class="btn purple-stripe">动漫强烈推荐</a>
<a href="/rgrassAdmin/StronglyRecommend?nav=martial" class="btn yellow-stripe">武侠强烈推荐</a>
<a href="/rgrassAdmin/StronglyRecommend?nav=film" class="btn green-stripe">影视强烈推荐</a>
<a href="/rgrassAdmin/StronglyRecommend?nav=classic" class="btn blue-stripe">经典强烈推荐</a>
<a href="/rgrassAdmin/StronglyRecommend?nav=original" class="btn red-stripe">原创强烈推荐</a>


<br><br>


<a href="/rgrassAdmin/Recall?nav=boutique" class="btn black">精品追忆</a>
<a href="/rgrassAdmin/Recall?nav=anime" class="btn purple-stripe">动漫追忆</a>
<a href="/rgrassAdmin/Recall?nav=martial" class="btn yellow-stripe">武侠追忆</a>
<a href="/rgrassAdmin/Recall?nav=film" class="btn green-stripe">影视追忆</a>
<a href="/rgrassAdmin/Recall?nav=classic" class="btn blue-stripe">经典追忆</a>
<a href="/rgrassAdmin/Recall?nav=original" class="btn red-stripe">原创追忆</a>


<br><br>


<a href="/rgrassAdmin/HomeFlash" class="btn green">前台轮播</a>
@stop