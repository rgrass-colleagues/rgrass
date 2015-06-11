@extends('layouts.admin_master')
@section('title')
文章管理
@stop
@section('pagetitle')
文章列表
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/BookLists">文章管理</a></li>

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
<a href="/rgrassAdmin/AddMainDiscuss?book_id={{$book_id}}" class="btn blue-stripe">添加主评</a><br><br>
<table class="table table-hover">
    <tr>
        <td>用户</td>
        <td>评论标题</td>
        <td>评论内容</td>
        <td>好评程度</td>
        <td>是否置顶</td>
        <td>时间</td>
        <td>操作</td>
    </tr>
    @foreach($discuss_info as $v)
    <tr>
        <td>{{ViewSpalls_AdminViewSpallsModel::getUserNameByUserIdS($v->user_id)}}</td>
        <td>{{$v->estimate_title}}</td>
        <td>{{$v->estimate_content}}</td>
        <td>{{ViewSpalls_AdminViewSpallsModel::showNiceDiscuss($v->nice_discuss)}}</td>
        <td>{{$v->top=='0'?'否':'是'}}</td>
        <td>{{date('Y-m-d H:i:s',$v->addtime)}}</td>
        <td>
            <a href="/rgrassAdmin/DiscussChildIndex?book_id={{$book_id}}&&discuss_id={{$v->id}}" class="btn green">查看详细评论</a>
            <a href="/rgrassAdmin/ModifyMainDiscuss?book_id={{$book_id}}&&id={{$v->id}}" class="btn blue">修改</a>
<!--            <a href="" class="btn red" onclick="return confirm('注意,删除主评论后里面的子评论也会全部删除,慎用!确定删除吗?')">删除</a>-->
        </td>
    </tr>
    @endforeach
</table>
@stop
