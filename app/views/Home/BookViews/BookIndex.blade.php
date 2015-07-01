@extends('layouts.home_master')
@section('title')
{{$book_info->book_name}}--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')



<div id="book_sign_left">
    <div id="book_sign_left_title">
        <div id="book_sign_left_title_left">
            <img src="../../../Tongrenfang/img/zhujian.jpg" alt="{{$book_info->book_name}}"/>
            <a href="">{{$book_info->book_name}}</a>
            <span>(书号：{{$book_info->book_id}})</span>
        </div>
        <div id="book_sign_left_title_right">
            @if($book_info->book_from_status=='0')
            <a href="{{$book_info->book_from_url}}" class="btn-success">本站首发</a>
            @else
            <a href="{{$book_info->book_from_url}}" class="btn-info">它站首发</a>
            @endif
        </div>
    </div>
    <div id="book_sign_content">
        <div id="book_sign_content_left">
            <img src="./uploads/covers/{{$book_info->cover}}" alt=""/>
            <ul>
                <li><a href="http://www.rgrass.com/Catalog?book_id={{$book_info->book_id}}" class="btn btn-default">>>点击阅读</a></li>
                <li><a href="" class="btn btn-default">加入书架</a></li>
                <li><a href="" class="btn btn-default">我要推荐</a></li>
                <li><a href="" class="btn btn-default">下载本书</a></li>
                <li><a href="" class="btn btn-default">我要打赏</a></li>
            </ul>
        </div>
        <div id="book_sign_content_right">
            <div id="book_sign_content_right_nav">
                <span><a href="/">首页</a></span>>
                <span><a href="/Index">同人坊</a></span>>
                <span><a href="" style="color:black;font-size:16px;">{{$book_info->book_name}}</a></span>
            </div>
            <div id="book_sign_content_right_data">
                <ul>
                    <li>总点击：</li>
                    <li>{{$book_detail->click_number_all}}</li>
                    <li>总推荐：</li>
                    <li>{{$book_detail->recommend_all}}</li>
                    <li>月推荐</li>
                    <li>{{$book_detail->recommend_month}}</li>
                    <li>周推荐</li>
                    <li>{{$book_detail->recommend_week}}</li>
                    @if($book_info->book_from_status=='0')
                        <li style="color:red;margin-right:10px; ">燃草中文社区首发</li>
                        @else
                        <li style="color:#060;margin-right:10px; ">它站首发</li>
                    @endif
                </ul>
            </div>
            <div id="book_sign_content_right_detail">
                <br/>
                <textarea id="book_sign_content_right_content" disabled="disabled">
                    {{$book_info->detail}}
                </textarea>
                <div id="book_sign_url">
                    <span>本书首发自</span>
                    @if($book_info->book_from_status=='0')
                        <a href="{{$book_info->book_from_url}}">{{$book_info->book_from_url}}</a>
                    @else
                        <a href="{{$book_info->book_from_url}}">{{$book_info->book_from_url}}</a>
                    @endif
                        <br>
                    <span class="last_book_sign_content">
                        特此声明：本站所有书籍皆由网友上传，如有版权问题，请<a href="">>联系<</a>管理员。
                        <br/>本故事纯属虚构，请不要随意模仿。
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------------------------书籍更新状态栏--------------------->
<!--------------------------数据列(点击,推荐)周,月,总-------------->
<div id="book_sign_right">
    <div id="book_sign_right_author">
        <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>
        <br/>
        <span>作者：</span>
        <span id="author_sign_name"><a href="">{{$book_info->author}}</a></span>
        <br>
        <br>
        <span id="author_sign_random_write">{{$book_info->author_in_mind}}</span>
    </div>
    <div id="book_sign_right_dynamic">
        <div id="book_dynamic_title"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/><span>本书最新动态</span></div>
        <ul>
                        <li>本书暂时没有动态</li>
<!--            <li><span>程程陈</span><span>打赏了</span><span>100</span><span>燃草币</span></li>-->
<!--            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>-->
<!--            <li><span>程dddsssffdfdsfdsg程陈</span><span>打赏了</span><span>100</span><span>燃草币</span></li>-->
<!--            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>-->
<!--            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>-->
<!--            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>-->
<!--            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>-->
        </ul>
    </div>
</div>
<!--------------------------评论，数据列(点击,推荐)日,周,月,总-------------->
<div class="m_floor_10"></div>
<div id="ad_center"><img src="../../../Tongrenfang/img/ad1.jpg" alt=""/></div>
<div class="m_floor_10"></div>
<!--------------------------评论-------------->
<div id="book_discuss">
    <div id="book_discuss_title"><img src="../../../Home/img/black_ico.gif" alt="评论" /><span id="book_discuss_title_bname">{{$book_info->book_name}}</span><span>书评讨论区</span></div>
    <!--书籍更新内容-->
    <div id="book_update_content" class="table-responsive">
        <div id="book_discuss_input">
            <!--输入评论-->
            <div id="book_discuss_input_title">
                <span>看小说,写评论,投推荐票,打小怪兽....</span><br/>
                <span>你一点点的支持,都会转化成作者无限的动力!</span>
            </div>
            <div id="book_discuss_input_content">
                <img src="../../../Tongrenfang/img/1.jpeg" alt="" id="book_discuss_input_content_userpic"/>
                <!--QQ插件-->
                <div id="main">
                    <input type="text" value="请输入标题" onfocus='clearText(this)'/>
                    <div class="comment">
                        <div class="com_form">
                            <textarea class="input" id="saytext" name="saytext"></textarea>
                            <p><input type="button" class="sub_btn" value="提交"><span class="emotion">表情</span></p>
                        </div>
                    </div>
                </div>
                <!--QQ插件-->
            </div>
        </div>
        <div id="book_discuss_content">
            <!--评论内容-->
            <div id="book_discuss_content_title">
                <span>{{$book_info->book_name}}</span>
                <span>已有</span>
                <span>0</span>
                <span>条评论</span>
            </div>
<!--            <div id="book_discuss_content_detail">-->
<!--                <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>-->
<!--                <div id="book_discuss_content_detail_title">-->
<!--                    <a href="">狂想曲的测试</a>-->
<!--                </div>-->
<!--                <div id="book_discuss_content_detail_title_author"><a href="">程程陈</a>说：</div>-->
<!--                <div id="book_discuss_content_detail_content"><a href="">评论内容</a>-->
<!--                </div>-->
<!--                <div id="book_discuss_content_detail_content_data">-->
<!--                    评论时间:<span>2015-1-1 12:21:11</span>　　-->
<!--                    <span>回复（<span style="color:red">4</span>）</span>-->
<!--                </div>-->
<!--            </div>-->
        </div>

    </div>
    <div id="book_update_foot">
        <a href=""><span>更多...</span></a>
    </div>
</div>

<!--------------------------评论结束--------------------->
<!--------------------------数据列(点击,推荐)周,月,总-------------->
<!--30%宽度-->
@include('layouts.book_data')
<!--------------------------数据列(点击,推荐)日,周,月,总结束-------------->
<!--QQ表情插件-->

<script type="text/javascript" src="../../Expression/jquery.qqFace.js"></script>
<script src="../../Home/js/qqFace.js"></script>
<!--QQ表情插件结束-->
@include('layouts.footer')
@stop