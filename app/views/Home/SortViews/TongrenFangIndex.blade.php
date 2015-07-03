@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
@include('layouts.search')
<section>
    <!--------------第一层内容开始---------->

    <!------------强烈推荐---------------->
    @include('layouts.stronglyRecommend')
    <!------------强烈推荐---------------->
    <div id="flash_beat">
<!--------------------------- 轮播----------------------->

        <div id="myCarousel" class="carousel slide">
            <ol class="carousel-indicators">

                <li data-target="#myCarousel" data-slide-to="0"  class="" ></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
            </ol>
            <div class="carousel-inner">
                @foreach($flashData as $v)
                <div class="item">
                    <a href="/Book?book_id={{$v->book_id}}">
                        <img src="/uploads/special_picture/{{$v->special_picture}}" alt="">
                    </a>
                    <div class="carousel-caption">
                        <h4></h4>
                        <p></p>
                    </div>
                </div>
                @endforeach
            </div>
            <script>
                $('.item').eq(4).addClass('active');
            </script>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
        </div>
        <!--------------------------- 轮播----------------------->


    </div>


    <!--------------------------公告栏---------------------------------->
    <div id="net_notice">
        <div class="net_notice_title">本站公告</div>
        <div class="net_notice_content">
            <ul>
                <li><span>>></span><a href="" target="_blank">本网站还处于开发状态</a></li>
                <li><span>>></span><a href="" target="_blank">本网站还处于开发状态</a></li>
                <li><span>>></span><a href="" target="_blank">本网站还处于开发状态</a></li>
                <li><span>>></span><a href="" target="_blank">本网站还处于开发状态</a></li>
            </ul>
        </div>
    </div>
    <!--------------------------公告栏---------------------------------->
    <!--------------------------作者访谈---------------------------------->
    <div id="author_invite">
        <div class="author_invite_title">作者访谈</div>

        <div class="author_invite_content">
            <img src="../../../Tongrenfang/img/1.jpeg" alt="" class="author_pic"/>
            <br>
            <a href="" target="_blank" class="author_name">作者:bob</a>
            <br>
            <a href="" target="_blank" class="author_say">引领小说文化从我做起,推进网络文明阅读</a>
        </div>
    </div>
    <!--------------------------作者访谈---------------------------------->

    <!--------------第一层内容结束---------->
    <div class="m_floor_10"></div>
    <div id="ad_center"><a href=""><img src="../../../Tongrenfang/img/ad1.jpg" alt=""/></a></div>
    <div class="m_floor_10"></div>
    <!--------------第二层内容开始---------->

    <!--------------------------书籍更新状态栏--------------------->
    <div id="book_update">
        <div id="book_update_title"><img src="../../../Tongrenfang/img/brown_book_icon.jpg" alt="小说列表"/><span>小说更新列表栏</span></div>
        <!--书籍更新内容-->
        <div id="book_update_content" class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <td>类别</td>
                    <td>书名</td>
                    <td>作者</td>
                    <td>更新时间</td>

                </tr>
                <!--总共23本放在首页作为更新栏-->
                @foreach($bookUpdateData as $k=>$v)
                <tr>
                    <td><a href="" class="book_update_content_style">[{{$v->type_name}}]</a></td>
                    <td><a href="Book?book_id={{$v->book_id}}" class="book_update_content_bname">{{$v->book_name}}</a></td>
                    <td><a href="" class="book_update_content_author">{{$v->author}}</a></td>
                    <td>{{date('Y-m-d H:i:s',$v->last_update_time)}}</td>
                </tr>
                @endforeach
            </table>

        </div>
        <div id="book_update_foot">
            <a href=""><span>更多...</span></a>
        </div>
    </div>

    <!--------------------------书籍更新状态栏--------------------->
    <!--------------------------数据列(点击,推荐)周,月,总-------------->
    @include('layouts.book_data')
    <!--------------------------数据列(点击,推荐)日,周,月,总结束-------------->

    <!--------------第二层内容结束---------->
    <!---------如果有必要,可以继续添加内容--第三层,第四层...-------------->
</section>
<div class="m_floor_10"></div>
@include('layouts.frendsLink')
<div class="m_floor_10"></div>
@include('layouts.footer')
@stop

