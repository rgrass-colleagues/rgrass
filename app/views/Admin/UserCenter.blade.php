@extends('layouts.admin_master')
@section('title')
用户管理
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

                <li><a href="UserInfo">用户管理</a></li>

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
        <th>用户id</th>
        <th>用户账号</th>
        <th>用户权限</th>
        <th>操作</th>
    </tr>
    @foreach($Uinfo as $Uinfo)
    <tr>
    <td>{{$Uinfo->user_id}}</td>
    <td>{{$Uinfo->user_username}}</td>
    <td>{{$Uinfo->user_status}}</td>
    <td><a href="delUser" class="btn red">删除</a></td>
    </tr>
    @endforeach
</table>
@stop