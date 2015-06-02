@extends('layouts.admin_master')
@section('title')
    日志管理
@stop
@section('pagetitle')
    日志详情
@stop
@section('ptitle')
    <ul class="breadcrumb" xmlns="http://www.w3.org/1999/html">

        <li>

            <i class="icon-home"></i>

            <a href="/rgrassAdmin/IndexCenter">后台首页</a>

            <i class="icon-angle-right"></i>

        </li>

        <li><a href="/rgrassAdmin/LogManager">日志管理</a></li>

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
<div id="log_title">
    <ul>
        <li><a href="/rgrassAdmin/LogManager">日志主页</a></li>
        <li><a href="/rgrassAdmin/IPManager">查看用户登录情况</a></li>
    </ul>
</div>
<div id="log_content"><br>
    <span>目前拥有用户数量:</span><span>{{$count_users}}</span><br>
    <span>当前作品数量:</span><span></span><br>
    <span>目前拥有作者数量:</span><span></span><br>


</div>
@stop