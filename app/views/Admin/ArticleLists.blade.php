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
<a href="AddNewArticle" class="btn blue">添加新文章</a>
<br/><br/>
<table class="table table-hover">
    <tr>
        <th>文章id</th>
        <th>文章名称</th>
        <th>文章类型</th>
        <th>操作</th>
    </tr>
    @foreach($article as $art)
    <tr>
        <td>{{$art->article_id}}</td>
        <td>{{$art->article_title}}</td>
        <td>{{$art->article_type}}</td>
        <td>
            <a href="AddNewArticle?id={{$art->article_id}}" class="btn blue">修改文章</a>
            <a href="ArticleContent?id={{$art->article_id}}" class="btn black">查看文章<i class="m-icon-swapright m-icon-white"></i></a>
            <a href="delUser" class="btn red">删除</a>
        </td>
    </tr>
    @endforeach
</table>
@stop