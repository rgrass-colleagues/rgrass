@extends('layouts.admin_master')
@section('title')
类型管理
@stop
@section('pagetitle')
类型树
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="TypeManger">类型管理</a></li>

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
        <th>类型id</th>
        <th>类型名</th>
        <th>父节点</th>
        <th>操作</th>
    </tr>
    @foreach($allType as $allType)
    <tr>
        <td>{{$allType->type_id}}</td>
        <td>{{$allType->type_name}}</td>
        <td>{{$allType->type_pid}}</td>
        <td><a href="delType" class="btn red">删除</a></td>
    </tr>
    @endforeach
</table>
@stop