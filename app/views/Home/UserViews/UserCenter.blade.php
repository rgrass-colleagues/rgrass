@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
<div id="user_section">
    <div class="user_section_left">
        <div class="user_picture">
            <a href=""><img src="./Home/img/user_default_picture.png" alt=""/></a>
            <span>用户名</span>
        </div>
    </div>
    <div class="user_section_right">
        
    </div>
</div>
@include('layouts.footer')
@stop