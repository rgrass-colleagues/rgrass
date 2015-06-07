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

    <li><a href="/rgrassAdmin/MessageManager">消息管理</a></li>

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
<a href="/rgrassAdmin/MessageManager" class="btn gray">给管理员的留言</a>
<a href="/rgrassAdmin/BookDiscuss" class="btn blue">书籍评论</a>
<br>
<br>
<form action="/rgrassAdmin/doReplyAdminMessage" method="post">
    <textarea name="estimate_content" id="" cols="100" rows="10"></textarea>
    <!--此处进行角色互换-->
    <input type="hidden" name="receiver" value="{{$sender}}"/>
    <input type="hidden" name="sender" value="{{$receiver}}"/>
    <br/>
    <input type="submit" class="btn blue" value="回复"/>
</form>
@stop