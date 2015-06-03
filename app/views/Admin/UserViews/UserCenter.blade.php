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
<a href="AddNewOrModifyOneUser?page_type=create" class="btn blue">添加</a>
<br/><br/>
<table class="table table-hover">
    <tr>
        <th>用户id</th>
        <th>用户账号</th>
        <th>积分</th>
        <th>是否作者</th>
        <th>用户权限</th>
        <th>添加时间</th>
        <th>上次登录时间</th>
        <th>操作</th>
    </tr>
    @foreach($user_info as $user_info)
    <tr>
        <td>{{$user_info->user_id}}</td>
        <td>{{$user_info->username}}</td>
        <td>{{$user_info->credit}}</td>
        <td>{{$user_info->is_author}}</td>
        <td>{{$user_info->authority}}</td>
        <td>{{$user_info->addtime}}</td>
        <td>{{$user_info->last_login_time}}</td>
        <td>
            <a href="AddNewOrModifyOneUser?page_type=modify&&user_id={{$user_info->user_id}}" class="btn blue">修改</a>
            <a href="UserDetail?id={{$user_info->user_id}}" class="btn black" id="user_detail">详情<i class="m-icon-swapright m-icon-white"></i></a>
            <a href="doDelUser?user_id={{$user_info->user_id}}" class="btn red" onclick="return confirm('确定要删除吗?')">删除</a>
        </td>
    </tr>
    @endforeach
</table>
@stop