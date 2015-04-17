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

        <a href="IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="ArticleLists">用户管理</a></li>

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
<form action="doAddNewOrModifyOneUser" method="post">
    ----------------用户基本信息--------------<br><br>
    <!--    请选择封面:<input type="file" name="default_cover"><br>-->
    用户头像:<input type="text" name="info_user_picture" value="@if(!empty($book_info)){{$book_info->cover}}@endif"><br>
    用户名:<input type="text" name="info_username" value="@if(!empty($book_info)){{$book_info->book_name}}@endif"/><br>
    密码:<input type="text" name="info_password" value="@if(!empty($book_info)){{$book_info->author}}@endif"><br>
    用户积分:<input type="text" name="info_credit" value="@if(!empty($book_info)){{$book_info->detail}}@endif"><br>
    用户权限:
    <select name="info_authority">
        <option value="0">管理员</option>
    </select>
    <br>
    是否作者:
    <select name="info_is_author">
        <option value="">1</option>
        <option value="">2</option>
    </select>
    <br><br><br>
    ----------------用户详细信息--------------<br><br>
    昵称:<input type="text" name="nick_name" value="@if(!empty($book_detail)){{$book_detail->book_length}}@endif"><br>
    邮箱:<input type="text" name="email" value="@if(!empty($book_detail)){{$book_detail->word_number}}@endif"><br>
    电话:<input type="text" name="telephone" value="@if(!empty($book_detail)){{$book_detail->last_update_time}}@endif"><br>
    性别:
    <select name="sex">
        <option value="1">女</option>
    </select><br>
    用户标签:<input type="text" name="user_sign_id" value="@if(!empty($book_detail)){{$book_detail->last_update_time}}@endif"><br>
    自我评价:
    <textarea name="user_estimate">@if(!empty($book_detail)){{$book_detail->editor_estimate}}@endif
    </textarea><br>
    @if($page_type=='modify')
    <input type="hidden" value="@if(!empty($book_info)){{$book_info->book_id}}@endif" name="default_book_id"/>
    @endif
    <input type="hidden" value="{{$page_type}}" name="page_type"/>
    <input type="submit" value="确定创建" class="btn blue"/>

</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop