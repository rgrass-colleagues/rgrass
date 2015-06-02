@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
<section>
    <!--------------第一层内容开始---------->
    <div id="high_comment">
        <div class="high_comment_title">
            <span class="high_comment_title_left"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/></span><span class="high_comment_title_right">同人坊强烈推荐</span>
        </div>
        <div class="high_comment_content">
            <ul>
                @foreach($stronglyRecommend as $v)
                <li><a href="/error" target="_blank">[玄幻]</a><a href="/book?book_id={{$v->book_id}}" target="_blank">{{$v->book_name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="high_comment_footer">
            <a href=""><span>更多...</span></a>
        </div>
    </div>
    <div id="flash_beat">
<!--------------------------- 轮播----------------------->

        <div id="myCarousel" class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0"  class="" ></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item">
                    <img src="../../../Cover/4.jpg" alt="">
                    <div class="carousel-caption">
                        <h4></h4>
                        <p></p>
                    </div>
                </div>
                <div class="item">
                    <img src="../../../Cover/2.jpg" alt="">
                    <div class="carousel-caption">
                        <h4></h4>
                        <p></p>
                    </div>
                </div>
                <div class="item active">
                    <img src="../../../Cover/3.gif" alt="">
                    <div class="carousel-caption">
                        <h4></h4>
                        <p></p>
                    </div>
                </div>
            </div>
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
            <a href="" target="_blank" class="author_name">作者:陈诚城</a>
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
                    <td>最新章节</td>
                    <td>作者</td>
                    <td>更新时间</td>
                </tr>
                <!--总共23本放在首页作为更新栏-->
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="book?book_id=1" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
                <tr>
                    <td><a href="" class="book_update_content_style">[同人]</a></td>
                    <td><a href="" class="book_update_content_bname">火影忍者之旅</a></td>
                    <td><a href="" class="book_update_content_charter">第一章:穿越</a></td>
                    <td><a href="" class="book_update_content_author">未来人类</a></td>
                    <td>2015-1-1 12:03:02</td>
                </tr>
            </table>

        </div>
        <div id="book_update_foot">
            <a href=""><span>更多...</span></a>
        </div>
    </div>

    <!--------------------------书籍更新状态栏--------------------->
    <!--------------------------数据列(点击,推荐)周,月,总-------------->
    <div id="book_data">
        <div id="book_data_click">
            <div id="book_data_click_title">
                <span class="high_comment_title_left"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/></span><span>小说点击榜</span>
                <div id="book_data_click_part">
                    <ul>
                        <li id="book_data_click_week">周</li>
                        <li id="book_data_click_month">月</li>
                        <li id="book_data_click_total">总</li>
                    </ul>
                </div>

            </div>
            <div id="book_data_click_content">
                    <table class="table table-striped">
                        <tr>
                            <td>1</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td><a href="" target="_blank">纯纯传</a></td>
                            <td>314321</td>
                        </tr>
                    </table>
            </div>
            <div id="book_data_click_foot">
                <a href="" target="_blank">查看更多...</a>
            </div>
        </div>
        <div class="m_part_click_comment"></div>
        <div id="book_data_comment">
            <div id="book_data_comment_title">
                <span class="high_comment_title_left"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/></span><span>小说推荐榜</span>
                <div id="book_data_comment_part">
                    <ul>
                        <li id="book_data_comment_week">周</li>
                        <li id="book_data_comment_month">月</li>
                        <li id="book_data_comment_total">总</li>
                    </ul>
                </div>

            </div>
            <div id="book_data_comment_content">
                <table class="table table-striped">
                    <tr>
                        <td>1</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td><a href="" target="_blank">纯纯传</a></td>
                        <td>314321</td>
                    </tr>
                </table>
            </div>
            <div id="book_data_comment_foot">
                <a href="" target="_blank">查看更多...</a>
            </div>
        </div>

    </div>
    <!--------------------------数据列(点击,推荐)日,周,月,总结束-------------->

    <!--------------第二层内容结束---------->
    <!---------如果有必要,可以继续添加内容--第三层,第四层...-------------->
</section>
<div class="m_floor_10"></div>
@include('layouts.frendsLink')
<div class="m_floor_10"></div>
@include('layouts.footer')
@stop

