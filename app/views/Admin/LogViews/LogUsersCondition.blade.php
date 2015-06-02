@extends('layouts.admin_master')
@section('title')
    日志管理
@stop
@section('pagetitle')
    日志详情
@stop
@section('ptitle')
    <ul class="breadcrumb" xmlns="http://www.w3.org/1999/html">

        <li>

            <i class="icon-home"></i>

            <a href="/rgrassAdmin/IndexCenter">后台首页</a>

            <i class="icon-angle-right"></i>

        </li>

        <li><a href="/rgrassAdmin/LogManager">日志管理</a></li>

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
    <div id="changeIPtoAddress">
        <form action="/rgrassAdmin/IPManager" method="get">
            <span>输入查询的日期(格式:2015-05-31)</span><br>
            <input class="form-control" type="text" name="input_day"/><input type="submit" class="btn-success"/>
        </form>
        <form action="/rgrassAdmin/IPtoAddress" method="get">
            <span>输入转换的IP(可以查询该IP所对应的地址)</span><br>
            <input class="form-control" type="text" name="ip"/><input type="submit" class="btn-info"/>
        </form>
    </div><br>
    <p>
        已经过滤掉的IP：{{$ip_filter}}
    </p>
    <br/>
<table class="table table-hover">
    <tr>
        <td>时间</td>
        <td>IP(所在地)</td>
        <td>访问url</td>
        <td>从x页面跳转过来</td>
    </tr>
    @foreach($ip_sign as $k)
        <tr>
            <td>{{$k['time']}}</td>
            <td>{{$k['ip']}}</td>
            <td>{{$k['url']}}</td>
            @if(empty($k['from']))
                <td>当前刷新</td>
            @else
            <td>{{$k['from']}}</td>
            @endif
        </tr>
    @endforeach
</table>
@stop