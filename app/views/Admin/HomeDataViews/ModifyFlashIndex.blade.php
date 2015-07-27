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

    <li><a href="/rgrassAdmin/HomeData">前台数据</a> <i class="icon-angle-right"></i></li>
    <li><a href="">轮播修改</a></li>



</ul>
@stop
@section('content')
<form action="/rgrassAdmin/doModifyFlashIndex" method="post" enctype="multipart/form-data">
    书号:<select name="book_id" id="book_id_select">
        @foreach($book_list as $v)
        <option value="{{$v->book_id}}">{{$v->book_name}}</option>
        @endforeach
    </select><br>

    <input type="hidden" name="id" value="{{$flashData->id}}"/><br>
    <input type="submit" class="btn blue" value="确定修改"/>
</form>

<script>
    $("#book_id_select option[value={{$flashData->book_id}}]").attr('selected','true');
</script>
@stop