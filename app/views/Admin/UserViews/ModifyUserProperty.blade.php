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
<form action="/rgrassAdmin/doModifyUserProperty" method="post">
    <span>用户：{{ViewSpalls_AdminViewSpallsModel::getUserNameByUserIdS($user_property->user_id)}}</span><br>
    用户积分<input type="text" name="points" value="{{$user_property->points}}"/><br/>
    燃草币：<input type="text" name="rgrass_coin" value="{{$user_property->rgrass_coin}}"><br>
    推荐票：<input type="text" name="recommend_ticket" value="{{$user_property->recommend_ticket}}"><br>
    <input type="hidden" name="user_id" value="{{$user_property->user_id}}"/>
    <input type="submit" value="确认修改" class="btn blue"/>
</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop