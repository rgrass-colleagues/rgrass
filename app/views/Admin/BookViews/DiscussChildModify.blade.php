@extends('layouts.admin_master')
@section('title')
文章管理
@stop
@section('pagetitle')
添加新书籍
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/BookLists">书籍管理</a></li>

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
<form action="/rgrassAdmin/doModifyDiscussChild" method="post">
    请选择评论用户：<br>
    <select name="user_id" id="S_user_name">
        @foreach($user_info as $v)
        <option value="{{$v->user_id}}">{{$v->username}}</option>
        @endforeach
    </select><br>
    填写需要评论的内容：<br>
    <textarea name="estimate_content" id="" cols="30" rows="10">{{$discuss_child_info->estimate_content}}</textarea>
    <input type="hidden" name="discuss_id" value="{{$discuss_child_info->discuss_id}}"/>
    <input type="hidden" name="book_id" value="{{$book_id}}"/>
    <input type="hidden" name="id" value="{{$id}}"/><br>
    <input type="submit" value="添加" class="btn blue"/>
</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
<script>
    $('#S_user_name option[value={{$discuss_child_info->user_id}}]').attr('selected','true');
</script>
@stop