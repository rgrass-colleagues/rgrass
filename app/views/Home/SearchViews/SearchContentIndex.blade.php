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
            &nbsp;
            &nbsp;
            <img src="../../Tongrenfang/img/refresh.jpg"/>
            <a href="" class="clear_change_condition">清除筛选条件</a>
        </div>
        <div class="search_content_show_left_content">
            <div class="search_content_data">
                <p>首发分类</p>
                <p><a href="">不限</a></p>
                <p><a href="" class="native">燃草</a></p>
                <p><a href="">起点</a></p>
                <p><a href="">纵横</a></p>
                <p><a href="">创世</a></p>
                <p><a href="">飞卢</a></p>
            </div>
            <div class="search_content_data">
                <p>书籍分类</p>
                <p><a href="">不限</a></p>
                <p><a href="" class="native">动漫</a></p>
                <p><a href="">武侠</a></p>
                <p><a href="">影视</a></p>
                <p><a href="">经典</a></p>
                <p><a href="">原创</a></p>
            </div>
            <div class="search_content_data">
                <p>小说细分</p>
                <p><a href="" class="native">不限</a></p>
                <p>
                    <a href="">周点击</a>
                    <a href="">月点击</a>
                    <a href="">总点击</a>
                </p>
                <p>
                    <a href="">周推荐</a>
                    <a href="">月推荐</a>
                    <a href="">总推荐</a>
                </p>
                <p>
                    <a href="">总字数</a>
                    <a href=""><30W</a>
                    <a href="">30W-100W</a>
                    <a href="">>100W</a>
                </p>
                <p><a href="">总收藏</a></p>
            </div>
        </div>
    </div>
    <div id="search_content_show_right">
        <div class="search_content_show_right_title">
            <p>搜索
                <span style="color:#060">
                    {{$search_content}}
                </span>
                的结果:</p>
        </div>
        <div class="search_content_show_right_content">
            @if($search_book)
            @foreach($search_book as $v)
            <div class="search_content_show_right_content_child">
                <div class="search_content_show_right_content_child_img">
                    <a href="/Book?book_id={{$v->book_id}}">
                        <img src="./uploads/covers/{{$v->cover}}" title="某小说" width="150px" height="200px"/>
                    </a>
                </div>
                <div class="search_content_show_right_content_child_data">
                    <p>
                        <a href="/Book?book_id={{$v->book_id}}" style="font-size:20px;color:#060">{{$v->book_name}}</a>
                    </p>
                    <p>
                        <span>作者:</span>
                        <span>{{$v->author}}</span>
                        <span>分类:</span>
                        <span>{{$v->book_type}}</span>
                    </p>
                    <p>
                        {{$v->detail}}
                    </p>
                    <p>
                        <span style="float:left;">最新章节:<a href="">123</a></span>
                        <a href="">阅读本书</a>
                        <a href="">加入书架</a>
                    </p>
                </div>
            </div>
            <div class="m_floor_10"></div>
            <div class="m_floor_10"></div>
            @endforeach
            @else
            <div>没有找到相关小说,请重新输入!</div>
            @endif
        </div>
    </div>
</div>
<script>
//    $('.search_content_data a').click(function(){
//        $('.search_content_data a').removeClass('active');
//        $(this).addClass('active');
//    });
</script>
@include('layouts.footer')
@stop