@extends('layouts.home_master')
@section('title')
精品书坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
@include('layouts.search')
<section>
@include('layouts.stronglyRecommend')<!--强烈推荐-->
@include('layouts.recallRecommend')<!--追忆-->
<div class="m_floor_10"></div>
<div id="ad_center"><a href=""><img src="../../../Tongrenfang/img/ad1.jpg" alt=""/></a></div>
<div class="m_floor_10"></div>
<!--------------------------书籍更新状态栏--------------------->
@include('layouts.book_update')

<!--------------------------书籍更新状态栏--------------------->
<!--------------------------数据列(点击,推荐)周,月,总-------------->
@include('layouts.book_data')
<!--------------------------数据列(点击,推荐)日,周,月,总结束-------------->
</section>
<div class="m_floor_10"></div>
@include('layouts.footer')
@stop