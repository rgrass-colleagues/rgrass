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
<a href="AddNewOrModifyOneBook?page_type=create" class="btn blue">添加</a>
<br/><br/>
<table class="table table-hover">
    <tr>
        <th>封面</th>
        <th>书号</th>
        <th>书名</th>
        <th>作者</th>
        <th>书权限</th>
        <th>入库时间</th>
        <th>操作</th>
    </tr>
    @foreach($bookBaseInfo as $bookList)
    <tr>
        <td><img src="../../Cover/{{$bookList->cover}}" alt="" width="70px"/></td>
        <td>{{$bookList->book_id}}</td>
        <td>{{$bookList->book_name}}</td>
        <td>{{$bookList->author}}</td>
        <td>{{$bookList->book_authority}}</td>
        <td>{{$bookList->book_add_time}}</td>
        <td>
            <a href="AddNewOrModifyOneBook?page_type=modify&&book_id={{$bookList->book_id}}" class="btn blue">修改</a>
            <a href="/rgrassAdmin/chapter_manager?book_id={{$bookList->book_id}}" class="btn green">章节管理</a>
            <button class="btn blue blue_book_detail" id="book_detail" value="{{$bookList->book_id}}">简介</button>
            <a href="" class="btn black">详情<i class="m-icon-swapright m-icon-white"></i></a>
            <a href="delBook?id={{$bookList->book_id}}" class="btn red">删除</a>
        </td>
    </tr>
    @endforeach
</table>
@stop