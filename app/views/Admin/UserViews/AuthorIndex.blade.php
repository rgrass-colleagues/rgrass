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
        <td>笔名</td>
        <td>作者语</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    @foreach($author_info as $v)
    <tr>
        <td>{{ViewSpalls_AdminViewSpallsModel::getUserNameByUserIdS($v->user_id)}}</td>
        <td>{{$v->pen_name}}</td>
        <td>{{$v->author_in_mind}}</td>
        <td>{{$v->addtime}}</td>
        <td><a href="/rgrassAdmin/ModifyAuthorInfo?id={{$v->id}}" class="btn blue">修改</a></td>
    </tr>
    @endforeach
</table>
@stop