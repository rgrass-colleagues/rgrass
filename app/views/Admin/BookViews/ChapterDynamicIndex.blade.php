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
    <table class="table table-hover">
        <tr>
            <td>用户</td>
            <td>行为</td><!--行为与值拼接-->
            <td>时间</td>
            <td>操作</td>
        </tr>
        @foreach($dynamic_info as $v)
        <tr>
            <td>
                <?php
                //$user_info = new User_UserInfoModel();
                //$user_infos = $user_info->getUserBaseInfoById($v->user_id);
                ?>
                {{User_UserInfoModel::getUserInfoByUserIdS($v->user_id)->username}}
            </td>
            <td>{{$v->behavior}}</td>
            <td>{{$v->addtime}}</td>
            <td><a href="" class="btn green-stripe">修改</a></td>
            <td><a href="" class="btn red">删除</a></td>
        </tr>
        @endforeach
    </table>
@stop
