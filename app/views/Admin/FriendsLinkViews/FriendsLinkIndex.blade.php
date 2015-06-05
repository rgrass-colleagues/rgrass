@extends('layouts.admin_master')
@section('title')
友情链接
@stop
@section('pagetitle')
链接列表
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="UserInfo">友情链接</a></li>

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
<a href="AddNewOrModifyOneUser?page_type=create" class="btn blue">添加</a>
<br/><br/>
<table class="table .table-hover">
    <tr>
        <th>链接ID</th>
        <th>链接名称</th>
        <th>链接URL</th>
        <th>链接Logo</th>
    </tr>
    @foreach($links as $link)
    <tr>
        <td>{{$link->link_id}}</td>
        <td>{{$link->link_name}}</td>
        <td>{{$link->link_address}}</td>
        <td>{{$link->link_logo}}</td>
    </tr>
    @endforeach
</table>
@stop