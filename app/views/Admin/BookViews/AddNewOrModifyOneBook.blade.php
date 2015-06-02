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

        <a href="IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="ArticleLists">书籍管理</a></li>

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
<form action="doAddNewOrModifyOneBook" method="post">
    ----------------书籍基本信息--------------<br><br>
<!--    请选择封面:<input type="file" name="default_cover"><br>-->
    请选择封面:<input type="text" name="default_cover" value="@if(!empty($book_info)){{$book_info->cover}}@endif"><br>
    请输入书名:<input type="text" name="default_book_name" value="@if(!empty($book_info)){{$book_info->book_name}}@endif"/><br>
    请输入作者:<input type="text" name="default_author" value="@if(!empty($book_info)){{$book_info->author}}@endif"><br>
    请输入简介:<input type="text" name="default_detail" value="@if(!empty($book_info)){{$book_info->detail}}@endif"><br>
    请选择类型:
        <select name="default_book_type">
            <option value="0">其它书籍</option>
        </select>
    <br>
    请选择权限:
        <select name="default_book_authority">
            <option value="">0</option>
            <option value="">1</option>
        </select>
    <br><br><br>
    ----------------书籍详细信息--------------<br><br>
    书本章节数:<input type="text" name="book_length" value="@if(!empty($book_detail)){{$book_detail->book_length}}@endif"><br>
    书本总字数:<input type="text" name="word_number" value="@if(!empty($book_detail)){{$book_detail->word_number}}@endif"><br>
    最后的更新:<input type="text" name="last_update_time" value="@if(!empty($book_detail)){{$book_detail->last_update_time}}@endif"><br>
    书本的状态:
    <select name="state">
        <option value="1">新书首发</option>
    </select><br>
    书本总点击:<input type="text" name="click_number" value="@if(!empty($book_detail)){{$book_detail->click_number}}@endif"><br>
    是否藏经阁:
    <select name="is_store">
        <option value="0">否</option>
    </select><br>
    小编读后感:
    <textarea name="editor_estimate">@if(!empty($book_detail)){{$book_detail->editor_estimate}}@endif
    </textarea><br>
    @if($page_type=='modify')
    <input type="hidden" value="@if(!empty($book_info)){{$book_info->book_id}}@endif" name="default_book_id"/>
    @endif
    <input type="hidden" value="{{$page_type}}" name="page_type"/>
    <input type="submit" value="确定创建" class="btn blue"/>

</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@stop