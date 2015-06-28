@extends('layouts.home_master')
@section('title')
搜索结果--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
@include('layouts.search')
<div id="search_content_show">
    <div id="search_content_show_left">
        <div class="search_content_show_left_title">
            <img src="../../Home/img/black_ico.gif" alt="强烈推荐">
            <span>搜索条件</span>
        </div>
        <div class="search_content_show_left_content">
            <div class="search_content_show_left_content_book_type">
                <p>书籍分类</p>
                <p><a href="">不限</a></p>
                <a href="">动漫</a><br>
                <a href="">武侠</a><br>
                <a href="">影视</a><br>
                <a href="">经典</a><br>
                <a href="">原创</a><br>
            </div>
            <div class="search_content_show_left_content_book_data">
                <p>其它条件</p>
                <p><a href="">不限</a></p>
            </div>
        </div>
    </div>
    <div id="search_content_show_right">
        此处显示的是查询后结果
    </div>
</div>
@include('layouts.footer')
@stop