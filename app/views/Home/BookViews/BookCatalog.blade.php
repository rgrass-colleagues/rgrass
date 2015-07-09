@extends('layouts.home_master')
@section('title')
某目录--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')

<div id="book_sign_left">
    <div id="book_sign_left_title">
        <div id="book_sign_left_title_left">
            <img src="../../../Tongrenfang/img/zhujian.jpg"/>
            <a href="http://www.rgrass.com/book?book_id={{$book_info->book_id}}">{{$book_info->book_name}}</a>
            <span>(书号：{{$book_info->book_id}})</span>
        </div>
        <div id="book_sign_left_title_right">
            <a href="http://www.rgrass.com/Catalog?book_id={{$book_info->book_id}}" class="btn-primary">书籍目录列表</a>

        </div>
    </div>
    <table class="table table-hover" id="home_catalog">
        {{ViewSpalls_BookViewSpallsModel::showHomeBookCatalog($catalog,$book_id,3)}}
    </table>
</div>
<div class="m_floor_10"></div>
@include('layouts.footer')
@stop