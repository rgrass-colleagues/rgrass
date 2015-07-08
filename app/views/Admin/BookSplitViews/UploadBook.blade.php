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

    <li>
        <a href="/rgrassAdmin/BookSplit">小说分割</a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="">上传小说</a>
    </li>
</ul>
@stop
@section('content')
<form action="/rgrassAdmin/doUploadBook" method="post" enctype = 'multipart/form-data'>
    <input type="file" name="book"/>
    <input type="submit" value="确认上传" class="btn blue"/>
</form>
@stop
