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
<br/>
<br/>
    <table class="table table-hover">
        <tr>
            <td>id</td>
            <td>用户名</td>
            <td>收信人</td>
            <td>发送内容</td>
            <td>信息状态</td>
            <td>发送时间</td>
            <td>操作</td>
        </tr>
        @foreach($admin_message as $msg)
        <tr>
            <td>{{$msg->message_id}}</td>
            <td>{{$msg->user_name}}</td>
            <td>{{$msg->admin_id}}</td>
            <td>{{$msg->estimate_content}}</td>
            <td>{{$msg->to_user_name}}</td>
            <td>{{$msg->addtime}}</td>
            <td><a href="/rgrassAdmin/ReplyAdminMessage?to_user={{$msg->to_user}}&&user_id={{$msg->user_id}}" class="btn green">回复</a> <a href="/rgrassAdmin/DelAdminMessage?message_id={{$msg->message_id}}" class="btn red" onclick="return confirm('确定删除该信息吗?')">删除</a></td>
        </tr>
        @endforeach
    </table>
@stop