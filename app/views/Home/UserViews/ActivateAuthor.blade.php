@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
<div id="user_section">
    @include('layouts.userLeft')
    <div class="user_section_right">
        <div class="activate_author">
            <span class="nick_modify_explain btn_activate_author">你还不是作者喔~点击下面的按钮申请吧！</span><br><br>
            <a href="/AuthorReg" class="btn btn-primary btn-lg ">申请成为作者</a>

        </div>
    </div>
</div>
@include('layouts.footer')
@stop