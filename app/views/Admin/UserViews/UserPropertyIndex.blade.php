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
<table class="table table-hover">
    <tr>
        <td>用户名</td>
        <td>用户积分</td>
        <td>燃草币</td>
        <td>推荐票</td>
        <td>操作</td>
    </tr>
    <tr>
        <td>{{ViewSpalls_AdminViewSpallsModel::getUserNameByUserIdS($user_property->user_id)}}</td>
        <td>{{$user_property->points}}</td>
        <td>{{$user_property->rgrass_coin}}</td>
        <td>{{$user_property->recommend_ticket}}</td>
        <td><a href="/rgrassAdmin/ModifyUserProperty?user_id={{$user_property->user_id}}" class="btn blue">修改</a></td>
    </tr>
    <tr><td>道具情况(后期制作)</td></tr>
</table>
@stop