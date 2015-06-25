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
<a href="/rgrassAdmin/AddNewUserTag" class="btn green">添加标签</a><br><br>
<table class="table table-hover">
    <tr>
        <td>添加用户</td>
        <td>标签名</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    @foreach($tag as $v)
    <tr>
        <td>{{ViewSpalls_AdminViewSpallsModel::getUserNameByUserIdS($v->add_user_id)}}</td>
        <td>{{$v->tag_name}}</td>
        <td>{{date('Y-m-d H:i:s',$v->addtime)}}</td>
        <td><a href="" class="btn blue">修改</a></td>
    </tr>
    @endforeach
</table>
@stop