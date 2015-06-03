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

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

                        <i class="icon-angle-right"></i>

    </li>

                <li><a href="/rgrassAdmin/UserInfo">用户详情</a></li>

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

    ----------------用户基本信息--------------<br><br>
    @if(!empty($userInfo->user_picture))
    <img src="../../../uploads/users/{{$userInfo->user_picture}}" alt="" width="100px"/><br/>
    @endif
    用户账号:<input type="text" name="info_username" value="@if(!empty($userInfo)){{$userInfo->username}}@endif" disabled/><br>
    用户积分:<input type="text" name="info_credit" value="@if(!empty($userInfo)){{$userInfo->credit}}@endif" disabled><br>
    用户邮箱:<input type="text" name="info_email" value="@if(!empty($userInfo)){{$userInfo->email}}@endif" disabled><br>
    用户手机:<input type="text" name="info_telephone" value="@if(!empty($userInfo)){{$userInfo->telephone}}@endif" disabled><br>
    用户权限:<input type="text" name="info_telephone" value="@if(!empty($userInfo)){{$userInfo->authority}}@endif" disabled><br>
    是否作者:<input type="text" name="info_telephone" value="@if(!empty($userInfo)){{$userInfo->is_author}}@endif" disabled><br>
    <br><br><br>
    ----------------用户详细信息--------------<br><br>
    用户昵称:<input type="text" name="nick_name" value="@if(!empty($userDetail)){{$userDetail->nick_name}}@endif" disabled><br>
    用户性别:<input type="text" name="nick_name" value="@if(!empty($userDetail)){{$userDetail->sex}}@endif" disabled><br>
    自我标签:<input type="text" name="user_sign_id" value="@if(!empty($userDetail)){{$userDetail->user_sign_id}}@endif" disabled><br>
    自我评价:<textarea name="user_estimate" disabled>@if(!empty($userDetail)){{$userDetail->user_estimate}}@endif</textarea><br>
@stop