@extends('layouts.home_master')
@section('title')
精品书坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
@include('layouts.search')
<section>
@include('layouts.stronglyRecommend')
@include('layouts.recallRecommend')
</section>
<div class="m_floor_10"></div>
@include('layouts.footer')
@stop