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
<form action="/rgrassAdmin/doModifyChapterOrganizationInfo" method="post">
    修改卷名:<input type="text" name="organization_name" value="{{$organization_info->organization_name}}"/>
    <input type="hidden" name="book_id" value="{{$organization_info->book_id}}"/>
    <input type="hidden" name="usual_organization_name" value="{{$organization_info->organization_name}}"/>
    <input type="hidden" name="id" value="{{$organization_info->id}}"/>
    <br/>
    <input type="submit" class="btn blue" value="确定修改"/>
</form>

{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop