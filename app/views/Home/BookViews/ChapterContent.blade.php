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
            <a href="http://www.rgrass.com/Book?book_id={{$book_info->book_id}}">{{$book_info->book_name}}</a>
            <span>(书号：{{$book_info->book_id}})</span>
        </div>
        <div id="book_sign_left_title_right">
            <a href="http://www.rgrass.com/Catalog?book_id={{$book_info->book_id}}" class="btn-primary">书籍目录列表</a>

        </div>
    </div>
    <div id="chapter_content">
        <div><b>{{$chapter_info->chapter_name}}</b></div>
{{$chapter_info->chapter_content}}
        <div>
            @if($pre!='none')
            <a href="/ChapterContent?book_id={{$book_info->book_id}}&&chapter_id={{$pre}}" class="btn btn-primary js_input js_left" >上一页</a>
            @endif
            <a href="http://www.rgrass.com/Catalog?book_id={{$book_info->book_id}}" class="btn btn-success">回到目录</a>
            @if($next!='none')
            <a href="/ChapterContent?book_id={{$book_info->book_id}}&&chapter_id={{$next}}" class="btn btn-primary js_input js_right">下一页</a>
            @else
                没有下一章
                @endif
        </div>
    </div>
</div>
<div class="m_floor_10"></div>
@include('layouts.footer')
<script>
    var pre = "{{$pre}}";
    var next = "{{$next}}";
    $(document).keydown(function(event){
//判断当event.keyCode 为37时（即左方面键），执行跳转上一页;
//判断当event.keyCode 为39时（即右方面键），执行跳转下一页;
        if(event.keyCode == 37){
            if(pre != 'none'){
                window.location.href="/ChapterContent?book_id={{$book_info->book_id}}&&chapter_id={{$pre}}";
            }
        }else if (event.keyCode == 39){
            if(next != 'none'){
                window.location.href="/ChapterContent?book_id={{$book_info->book_id}}&&chapter_id={{$next}}";
            }
        }
    });
</script>
@stop