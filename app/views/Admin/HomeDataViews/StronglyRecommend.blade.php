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

    <li><a href="/rgrassAdmin/HomeData">前台数据</a></li>

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
<a href="" class="btn blue">一键轮换</a>
<br><br>
<span>目前处在显示状态的书籍有</span>
<span style="color:red"></span>
<span>本（超过5本后不能再选择显示）</span>
<br><br>
<table class="table table-hover">
    <tr>
        <td>id</td>
        <td>书号</td>
        <td>特制图片</td>
        <td>可用</td>
        <td>更改时间</td>
        <td>操作</td>
    </tr>
</table>
@stop