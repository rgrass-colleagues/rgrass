@extends('layouts.admin_master')
@section('title')
用户详情
@stop
@section('pagetitle')
用户列表
@stop
@section('ptitle')
    <ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="IndexCenter">后台首页</a>

                        <i class="icon-angle-right"></i>

    </li>

                <li><a href="UserInfo">用户详情</a></li>

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
<table class="table table-hover">
    <tr>
        <td>昵称</td>
        <td>性别</td>
        <td>用户标签</td>
        <td>自我评价</td>
    </tr>
    <tr>
        <td>{{$user_detail->nick_name}}</td>
        <td>{{$user_detail->sex}}</td>
        <td>{{$user_detail->user_sign_id}}</td>
        <td>{{$user_detail->user_estimate}}</td>
    </tr>

</table>

@stop