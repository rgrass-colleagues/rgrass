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
<form action="/rgrassAdmin/doModifyMainDiscuss" method="post">
    选择评论用户:<br><select name="user_id" id="S_user">
        @foreach($user_info as $v)
        <option value="{{$v->user_id}}">{{$v->username}}</option>
        @endforeach
    </select><br>
    评论标题:<br><input type="text" name="estimate_title" value="{{$discuss_info->estimate_title}}"/><br>
    评论内容:<br><textarea name="estimate_content" id="" cols="30" rows="10">{{$discuss_info->estimate_content}}</textarea><br>
    选择评价等级:<br><select name="nice_discuss" id="S_discuss_grade">
        <option value="0">普通评价</option>
        <option value="1">好评</option>
        <option value="2">精华评价</option>
        <option value="3">绝世好评</option>
    </select><br>
    是否置顶:<br><select name="top" id="S_top">
        <option value="0">否</option>
        <option value="1">是</option>
    </select>
    <input type="hidden" name="id" value="{{$discuss_info->id}}"/>
    <input type="hidden" name="book_id" value="{{$book_id}}"/><br>
    <input type="submit" class="btn blue" value="添加"/>
</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
<script>
    $('#S_user option[value={{$discuss_info->user_id}}]').attr('selected','true');
    $('#S_discuss_grade option[value={{$discuss_info->nice_discuss}}]').attr('selected','true');
    $('#S_top option[value={{$discuss_info->top}}]').attr('selected','true');
</script>
@stop