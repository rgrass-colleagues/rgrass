@extends('layouts.admin_master')
@section('title')
燃草中文同人坊后台管理系统
@stop
@section('pagetitle')
后台管理系统首页
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="">小说分割</a></li>

</ul>
@stop
@section('content')
<a href="" class="btn black">切割全部</a>
<a href="/rgrassAdmin/UploadBook" class="btn blue-stripe">上传小说</a>
<br/><br/>
<table class="table table-hover">
    <tr>
        <td>小说名</td>
        <td>路径</td>
        <td>是否入库</td>
        <td>上传时间</td>
        <td>修改时间</td>
        <td>操作</td>
    </tr>
    @foreach($book_info as $v)
    <tr>
        <td>{{$v->book_name}}</td>
        <td>{{$v->book_url}}</td>
        <td>{{$v->book_in}}</td>
        <td>{{date('Y-m-d',$v->book_create_time)}}</td>
        <td>{{date('Y-m-d',$v->book_modify_time)}}</td>
        <td>
            <a href="/rgrassAdmin/SplitABook?book_url={{$v->book_url}}" class="btn green">切割</a>

            <a href="/rgrassAdmin/doDelBook?book_url={{$v->book_url}}" class="btn red" onclick="return confirm('一旦删除,无法回复,确定删除吗?')">删除</a>
        </td>
    </tr>
    @endforeach
</table>
@stop
