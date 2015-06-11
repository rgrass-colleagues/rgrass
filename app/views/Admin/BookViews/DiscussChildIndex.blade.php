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
<a href="/rgrassAdmin/AddDiscussChild?book_id={{$book_id}}&&discuss_id={{$discuss_info->id}}" class="btn blue-stripe">添加子评论</a><br><br>
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
    <tr>
        <td>{{ViewSpalls_AdminViewSpallsModel::getUserNameByUserIdS($discuss_info->user_id)}}</td>
        <td>{{$discuss_info->estimate_title}}</td>
        <td>{{$discuss_info->estimate_content}}</td>
        <td>{{ViewSpalls_AdminViewSpallsModel::showNiceDiscuss($discuss_info->nice_discuss)}}</td>
        <td>{{$discuss_info->top=='0'?'否':'是'}}</td>
        <td>{{date('Y-m-d H:i:s',$discuss_info->addtime)}}</td>
        <td>
            <a href="/rgrassAdmin/DiscussChildIndex?book_id={{$book_id}}&&discuss_id={{$discuss_info->id}}" class="btn green">查看详评</a>
            <a href="/rgrassAdmin/ModifyChildDiscuss?book_id={{$book_id}}&&id={{$discuss_info->id}}" class="btn blue">修改</a>
        </td>

    </tr>
    @foreach($discuss_child as $v)
    <tr>
        <td>{{ViewSpalls_AdminViewSpallsModel::getUserNameByUserIdS($v->user_id)}}</td>
        <td>子楼层</td>
        <td colspan="3">{{$v->estimate_content}}</td>
        <td>{{date('Y-m-d H:i:s',$v->addtime)}}</td>
        <td>
            <a href="" class="btn green">查看回复</a>
            <a href="/rgrassAdmin/ModifyChildDiscuss?book_id={{$book_id}}&&id={{$v->id}}" class="btn blue">修改</a>
        </td>
    </tr>
    @endforeach
</table>
@stop
