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

    <li>
        <a href="/rgrassAdmin/BookSplit">小说分割</a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="">分割规则</a>
    </li>
</ul>
@stop
@section('content')
<form action="/rgrassAdmin/doSplitABook" method="post" enctype = 'multipart/form-data'>
    分割正则:<input type="text" name="split_role"/>(输入1，2，3，4...)<br>
    <div class="regular_content" style="display:inline-block;width:300px;height:200px;border:1px solid black;">
        查看常用小说分割正则<br>
        <a href="/rgrassAdmin/AfterSplitChapter?book_url={{$book_url}}&&format=1">格式一</a>:章一 绯色之夜;章二 站着沉默;(1)<br>
        <a href="/rgrassAdmin/AfterSplitChapter?book_url={{$book_url}}&&format=2">格式二</a>:第一章【走向外面的世界】;第五百八十五章 【大结局】
    </div>
    <br>
    <br>
    小说封面:<input type="file" name="cover"><br><br>
    小说作者:<input type="text" name="author"><br>
    小说简介:<textarea name="detail" id="" cols="30" rows="10"></textarea><br>
    小说类型:<select name="book_type" id="">
        <option value="0">初始化</option>
        @foreach($type as $v)
        <option value="{{$v->type_id}}">{{ViewSpalls_AdminViewSpallsModel::showBookType($v->type_id)}}</option>
        @endforeach
    </select><br>
    是否精品:<select name="is_boutiques" id="boutiques">
        <option value="0">否</option>
        <option value="1">是</option>
    </select><br>
    小说首发:<select name="book_from_status" id="book_from">
        <option value="0">本站首发</option>
        <option value="1">它站首发</option>
        <option value="2">起点首发</option>
        <option value="3">纵横首发</option>
        <option value="4">创世首发</option>
        <option value="5">逐浪首发</option>
        <option value="6">飞卢首发</option>
    </select><br>
    首发连接:<input type="text" name="book_from_url" value="http://www.rgrass.com"/><br>
    <br>
    书本状态:<select name="state" id="book_state">
        <option value="1">新书首发</option>
        <option value="2">渐入佳境</option>
        <option value="3">步入高潮</option>
        <option value="4">曲终人散</option>
    </select><br>
    小编点评:<textarea name="editor_estimate"></textarea><br>

    <input type="hidden" name="book_url" value="{{$book_url}}"/>
    <br><input type="submit" value="确认上传" class="btn blue"/>
</form>
@stop
