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
<form action="/rgrassAdmin/doAddChapterDynamic" method="post">
    选择执行动态的用户:<br><select name="user_id" id="">
        @foreach($user_info as $v)
        <option value="{{$v->user_id}}">{{$v->username}}</option>
        @endforeach
    </select><br>
    用户行为:<br><select name="behavior" id="">
        <option value="1">投推荐票</option>
        <option value="2">打赏</option>
    </select><br>
    值:<br><input type="text" name="action_value"/>
    <input type="hidden" name="book_id" value="{{$book_id}}"/>
    <br><input type="submit" value="确定添加" class="btn blue"/>
</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop