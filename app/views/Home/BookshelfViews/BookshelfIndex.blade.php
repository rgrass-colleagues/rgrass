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
        
    </div>
</div>
@include('layouts.footer')
@stop