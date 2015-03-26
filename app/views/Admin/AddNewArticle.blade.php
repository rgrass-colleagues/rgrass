@extends('layouts.admin_master')
@section('title')
文章管理
@stop
@section('pagetitle')
添加新文章
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="ArticleLists">文章管理</a></li>

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
<form action="doAddNewArticle" method="post">
请输入文章名：<input type="text" name="title" value="@if(isset($article->article_title)){{$article->article_title}}@endif"/><br>
选择文章类型：
<select name="type">
    @foreach($type as $tp)
    <option value="{{$tp->type_id}}">{{$tp->type_name}}</option>
    @endforeach
</select>
<script id="container" name="content" type="text/plain">@if(isset($article->article_content)){{$article->article_content}}@endif</script>
    <br>
    <input type="hidden" value="@if(isset($article->article_id)){{$article->article_id}}@endif" name="id"/>
    <input type="submit" value="添加文章" class="btn blue"/>
</form>




{{HTML::script('ueditor/ueditor.config.js')}}
{{HTML::script('ueditor/ueditor.all.min.js')}}
<script type="text/javascript">
    var ue = UE.getEditor('container',{
        initialFrameWidth: 800,
        initialFrameHeight:300
    });
</script>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
<script>
    $("option[value={{$article->article_type}}]").attr('selected',true);
</script>
@stop