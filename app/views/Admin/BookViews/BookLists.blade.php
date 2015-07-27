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

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/BookLists">文章管理</a></li>

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
<a href="/rgrassAdmin/BookLists" class="btn blue">全部</a>
<a href="/rgrassAdmin/BookLists?book_authority=0" class="btn yellow-stripe">未审核</a>
<a href="/rgrassAdmin/BookLists?book_authority=1" class="btn green-stripe">已审核</a>
<!--<a href="AddNewOrModifyOneBook?page_type=create" class="btn blue">添加</a>-->
<br/><br/>
<table class="table table-hover">
    <tr>
        <th>封面</th>
        <th>书号</th>
        <th>书名</th>
        <th>作者</th>
        <th>类型</th>
        <th>书权限</th>
        <th>入库时间</th>
        <th>操作</th>
    </tr>
    @foreach($bookBaseInfo as $bookList)
    <tr>
        <td><img src="../../uploads/covers/{{$bookList->cover}}" alt="" width="70px"/></td>
        <td>{{$bookList->book_id}}</td>
        <td>{{$bookList->book_name}}</td>
        <td>{{$bookList->author}}</td>
        <td>{{ViewSpalls_AdminViewSpallsModel::showBookType($bookList->book_type)}}</td>
        @if($bookList->book_authority=='0')
        <td style="color:red">未审核</td>
        @else
        <td style="color:#060">已通过审核</td>
        @endif
        <td>{{date('Y-m-d H:i:s',$bookList->book_add_time)}}</td>
        <td>
            <a href="AddNewOrModifyOneBook?page_type=modify&&book_id={{$bookList->book_id}}" class="btn blue">修改</a>
        @if($bookList->book_authority=='0')
            <a href="javascript:;" class="btn green" onclick="alert('小说未审核')">章节管理</a>
        @else
        <a href="/rgrassAdmin/chapter_manager?book_id={{$bookList->book_id}}" class="btn green">章节管理</a>
        @endif
            <a target="_blank" href="/Book?book_id={{$bookList->book_id}}" class="btn black">详情<i class="m-icon-swapright m-icon-white"></i></a>
            <a href="/rgrassAdmin/BookReview?book_id={{$bookList->book_id}}" class="btn yellow" onclick="return confirm('是否让小说通过审核')">审核</a>
<!--            <a href="delBook?id={{$bookList->book_id}}" class="btn red" onclick="return confirm('确定要删除这本小说吗?')">删除</a>-->
        </td>
    </tr>
    @endforeach
</table>
@stop
