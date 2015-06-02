@extends('layouts.admin_master')
@section('title')
文章管理
@stop
@section('pagetitle')
文章列表
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="ArticleLists">文章管理</a></li>

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
<a href="/rgrassAdmin/addBookChapter?book_id={{$book_id}}" class="btn blue">添加新章节</a>
<a href="/rgrassAdmin/addNewOrganization?book_id={{$book_id}}" class="btn green">添加新卷</a>
<br/><br/>
<table class="table table-hover book_content">
    <tr><td style="text-align: left" colspan="3"><span>全书共<span style="color:red;">xx</span><span>张</span></span></td></tr>
    {{$showCatalog}}
</table>
<script>

</script>
@stop