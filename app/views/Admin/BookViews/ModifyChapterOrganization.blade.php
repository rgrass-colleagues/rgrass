@extends('layouts.admin_master')
@section('title')
文章管理
@stop
@section('pagetitle')
添加新书籍
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/BookLists">书籍管理</a></li>

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
<span>书名:</span><a href="/rgrassAdmin/chapter_manager?book_id={{$book_info->book_id}}" style="color:#060">{{$book_info->book_name}}</a>
<table class="table table-hover">
    <tr>
        <td>分卷id</td>
        <td>分卷名</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    @foreach($chapter_organization as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->organization_name}}</td>
        <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
        <td><a href="/rgrassAdmin/ModifyChapterOrganizationInfo?id={{$v->id}}" class="btn blue">修改</a>
            <a href="/rgrassAdmin/DelChapterOrganization?id={{$v->id}}" class="btn red" onclick="return confirm('删除分卷后会把该分卷的章节全部删除,慎用!确定删除该分卷吗?')">删除</a></td>
    </tr>
    @endforeach
</table>

{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop