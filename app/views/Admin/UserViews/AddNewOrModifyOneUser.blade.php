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
<form action="doAddNewOrModifyOneUser" method="post" enctype = 'multipart/form-data'>
    ----------------用户基本信息--------------<br><br>
    @if(!empty($userInfo->user_picture))
    <img src="../../../uploads/users/{{$userInfo->user_picture}}" alt="" width="100px"/><br/>
    @endif
    <input type="hidden" name="info_last_user_picture" value="@if(!empty($userInfo)){{$userInfo->user_picture}}@endif"/>
    <input type='hidden' name='MAX_FILE_SIZE' value='2621114' />
    用户头像:<input type="file" name="user_picture"><br><br/>
    用户账号:<input type="text" name="info_username" value="@if(!empty($userInfo)){{$userInfo->username}}@endif"/><br>
    用户密码:<input type="text" name="info_password"><br>
    用户积分:<input type="text" name="info_credit" value="@if(!empty($userInfo)){{$userInfo->credit}}@endif"><br>
    用户邮箱:<input type="text" name="info_email" value="@if(!empty($userInfo)){{$userInfo->email}}@endif"><br>
    用户手机:<input type="text" name="info_telephone" value="@if(!empty($userInfo)){{$userInfo->telephone}}@endif"><br>
    用户权限:<select name="info_authority">
        <option value="0">管理员</option>
        <option value="1">会员</option>
    </select>
    <br>
    是否作者:<select name="info_is_author">
        <option value="0">他/她不是作者</option>
        <option value="1">他/她就是作者</option>
    </select>
    <br><br><br>
    ----------------用户详细信息--------------<br><br>
    用户昵称:<input type="text" name="nick_name" value="@if(!empty($userDetail)){{$userDetail->nick_name}}@endif"><br>
    用户性别:<select name="sex">
        <option value="0">男</option>
        <option value="1">女</option>
    </select><br>
    自我标签:<input type="text" name="user_sign_id" value="@if(!empty($userDetail)){{$userDetail->user_sign_id}}@endif"><br>
    自我评价:<textarea name="user_estimate">@if(!empty($userDetail)){{$userDetail->user_estimate}}@endif</textarea><br>
    @if($page_type=='modify')
    <input type="hidden" value="@if(!empty($userInfo)){{$userInfo->user_id}}@endif" name="info_user_id"/>
    @endif
    <input type="hidden" value="{{$page_type}}" name="page_type"/>
    <input type="submit" value="确定创建" class="btn blue"/>

</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop