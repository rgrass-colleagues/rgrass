@extends('layouts.admin_master')
@section('title')
燃草中文同人坊后台管理系统
@stop
@section('pagetitle')
后台管理系统首页
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/BookSplit">小说分割</a><i class="icon-angle-right"></i></li>
    <li><a href="">章节预览</a></li>


</ul>
@stop
@section('content')
<table class="table table-hover">
{{$catalog}}
</table>
@stop
