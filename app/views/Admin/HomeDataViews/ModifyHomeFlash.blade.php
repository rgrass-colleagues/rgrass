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
<form action="/rgrassAdmin/doModifyHomeFlash" method="post" enctype="multipart/form-data">
    书号:<select name="book_id" id="book_id_select">
        @foreach($book_list as $v)
        <option value="{{$v->book_id}}">{{$v->book_name}}</option>
        @endforeach
    </select><br>
    特制图片:<br>
    <img src="/uploads/special_picture/{{$flashData->special_picture}}" alt="{{$flashData->special_picture}}"/><br>
    <input type="file" name="special_picture"/><br>
    <input type="hidden" name="last_special_picture" value="{{$flashData->special_picture}}"/>
    <input type="hidden" name="id" value="{{$flashData->id}}"/><br>
    <input type="submit" class="btn blue" value="确定修改"/>
</form>

<script>
    $("#book_id_select option[value={{$flashData->book_id}}]").attr('selected','true');
</script>
@stop