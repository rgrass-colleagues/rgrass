@extends('layouts.admin_master')
@section('css')
{{HTML::style('Admin/css/showArticle.css')}}
@stop
@section('title')
文章管理
@stop
@section('pagetitle')
文章内容
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
<div class="article">
    <div class="title">{{$articleContent->article_title}}</div>
    <div class="content">{{$articleContent->article_content}}</div>
</div>
@stop