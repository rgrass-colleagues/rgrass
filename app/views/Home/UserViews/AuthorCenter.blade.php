@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
<div id="user_section">
    @include('layouts.authorLeft')
    <div class="user_section_right">
        @include('layouts.authorRightTitle')
        <div class="user_section_right_content">
            <p>作者ID：<span>{{$author_info->id}}</span></p>
            <p>笔名：<span>{{$author_info->pen_name}}</span><a href="/AuthorInfoModify" class="user_info_modify">修改</a></p>
            <p>邮箱：<span>{{$author_info->author_email}}</span><a href="/AuthorInfoModify" class="user_info_modify">修改</a></p>
            <p>qq：<span>{{$author_info->author_qq}}</span><a href="/AuthorInfoModify" class="user_info_modify">修改</a></p>
            ----------------------------------
            ----------------------------------
        </div>
    </div>

</div>
@include('layouts.footer')
@stop