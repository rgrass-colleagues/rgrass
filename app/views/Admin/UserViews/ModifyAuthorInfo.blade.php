@extends('layouts.admin_master')
@section('title')
用户管理
@stop
@section('pagetitle')
添加新用户
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/UserInfo">用户管理</a></li>

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
<form action="/rgrassAdmin/doModifyAuthorInfo" method="post">
    输入笔名<br><input type="text" name="pen_name" value="{{$author->pen_name}}"/><br>
    输入作者语:<br><input type="text" name="author_in_mind" value="{{$author->author_in_mind}}"/><br>
    <input type="hidden" name="user_id" value="{{$author->user_id}}"/>
    <input type="submit" value="确认" class="btn blue"/>
</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop