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
<form action="/rgrassAdmin/doModifyChapterContent" method="post">
    ----------------章节信息--------------<br><br>
    请你选择卷名:<select name="chapter_organization" class="select2-container" id="organization">
        <option value="0">正文</option>
        @foreach($chapter_organization as $v)
        <option value="{{$v->id}}">{{$v->organization_name}}</option>
        @endforeach
    </select><br>
    请输入章节名:<input type="text" name="chapter_name" value="{{$chapter_info->chapter_name}}" /><br>
    请输入修改者:<input type="text" value="{{$update_user['user_name']}}"  disabled><br>
    输入章节内容:<br><textarea name="chapter_content" class="form-control" style="width:1000px;height:500px;">{{$chapter_info->chapter_content}}</textarea><br>
    <input type="hidden" name="update_user" id="" value="{{$update_user['user_id']}}"/>
    <input type="hidden" value="{{$book_id}}" name="book_id"/>
    <input type="hidden" value="{{$chapter_id}}" name="chapter_id"/>
    <input type="submit" value="确定添加" class="btn blue"/>

</form>
<script>
    $("#organization option[value={{$chapter_info->chapter_organization}}]").attr('selected','true');//默认选择
</script>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop