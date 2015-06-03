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

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/BookTypeManager">类型管理</a></li>

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
<form action="/rgrassAdmin/doAddNewType" method="post">
    <span>输入新类型名:</span><input type="text" name="type_name"/><br>
    <span>请选择父类型:</span><select name="parent_type" id="">
        <option value="0">初始</option>
        @foreach($Ftype as $ftype)
        <option value="{{$ftype->type_id}}">{{$ftype->type_name}}</option>
        @endforeach
    </select><br/>
    <input type="submit" value="添加" class="btn blue"/>
</form>
</table>
@stop