@extends('layouts.home_master')
@section('title')
某书籍--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')



<div id="book_sign_left">
    <div id="book_sign_left_title">
        <div id="book_sign_left_title_left">
            <img src="../../../Tongrenfang/img/zhujian.jpg" alt="宠物狂想曲"/>
            <a href="">宠物狂想曲</a>
            <span>(书号：1234567)</span>
        </div>
        <div id="book_sign_left_title_right">
            <a href="http://www.rgrass.com/book?book_id=1" class="btn-success">本站首发</a>

        </div>
    </div>
    <div id="book_sign_content">
        <div id="book_sign_content_left">
            <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>
            <ul>
                <li><a href="http://www.rgrass.com/catalog?book_id=1" class="btn btn-default">>>点击阅读</a></li>
                <li><a href="" class="btn btn-default">加入书架</a></li>
                <li><a href="" class="btn btn-default">我要推荐</a></li>
                <li><a href="" class="btn btn-default">下载本书</a></li>
                <li><a href="" class="btn btn-default">我要打赏</a></li>
            </ul>
        </div>
        <div id="book_sign_content_right">
            <div id="book_sign_content_right_nav">
                <span><a href="">首页</a></span>>
                <span><a href="">动漫同人</a></span>>
                <span><a href="" style="color:black;font-size:16px;">宠物狂想曲</a></span>
            </div>
            <div id="book_sign_content_right_data">
                <ul>
                    <li>总点击：</li>
                    <li>1232131</li>
                    <li>总推荐：</li>
                    <li>3213</li>
                    <li>月点击</li>
                    <li>211321</li>
                    <li>周点击</li>
                    <li>21321</li>
                    <li style="color:red;margin-right:10px; ">燃草中文社区首发</li>
                </ul>
            </div>
            <div id="book_sign_content_right_detail">
                <br/>
                <textarea id="book_sign_content_right_content" disabled="disabled">
                    一个少年被创世神阿尔宙斯、时间之神帝牙鲁卡和空间之神帕路奇犽合力带到宠物小精灵世界后，与创世神达成协议，帮其寻找这个世界所谓的本源！那么，就意味着他将会和小智一般，踏遍每一个地区！但是……

                    他有着丰富的口袋知识……

                    他对剧情无比熟悉……

                    他还有着无比坚挺……好吧，超超级巨挺的后台……
                </textarea>
                <div id="book_sign_url">
                    <span>本书首发自</span>
                    <a href="http://www.rgrass.com/book?book_id=1">http://www.rgrass.com/book?book_id=1</a>
                    <br>
                    <span class="last_book_sign_content">
                        特此声明：本站所有书籍皆由网友上传，如有版权问题，请联系管理员。
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
        <span id="author_sign_name"><a href="">陈程程</a></span>
        <br>
        <br>
        <span id="author_sign_random_write">作者很懒，什么都木有写～</span>
    </div>
    <div id="book_sign_right_dynamic">
        <div id="book_dynamic_title"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/><span>本书最新动态</span></div>
        <ul>
            <li><span>程程陈</span><span>打赏了</span><span>100</span><span>燃草币</span></li>
            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>
            <li><span>程dddsssffdg程陈</span><span>打赏了</span><span>100</span><span>燃草币</span></li>
            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>
            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>
            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>
            <li><span>彭老板</span><span>投了</span><span>1</span><span>推荐票</span></li>
        </ul>
    </div>
</div>
<!--------------------------评论，数据列(点击,推荐)日,周,月,总-------------->
<div class="m_floor_10"></div>
<div id="ad_center"><img src="../../../Tongrenfang/img/ad1.jpg" alt=""/></div>
<div class="m_floor_10"></div>
<!--------------------------评论-------------->
<div id="book_discuss">
    <div id="book_discuss_title"><img src="../../../Home/img/black_ico.gif" alt="评论" /><span id="book_discuss_title_bname">宠物狂想曲</span><span>书评讨论区</span></div>
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
                <span>宠物狂想曲</span>
                <span>已有</span>
                <span>34</span>
                <span>条评论</span>
            </div>
            <div id="book_discuss_content_detail">
                <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>
                <div id="book_discuss_content_detail_title">
                    <a href="">狂想曲的测试</a>
                </div>
                <div id="book_discuss_content_detail_title_author"><a href="">程程陈</a>说：</div>
                <div id="book_discuss_content_detail_content"><a href="">范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范飞范德萨范德萨范德萨范德萨飞</a>
                </div>
                <div id="book_discuss_content_detail_content_data">
                    评论时间:<span>2015-1-1 12:21:11</span>　　
                    <span>回复（<span style="color:red">4</span>）</span>
                </div>
            </div>
            <div id="book_discuss_content_detail">
                <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>
                <div id="book_discuss_content_detail_title">
                    <a href="">狂想曲的测试</a>
                </div>
                <div id="book_discuss_content_detail_title_author"><a href="">程程陈</a>说：</div>
                <div id="book_discuss_content_detail_content"><a href="">范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞</a>
                </div>
                <div id="book_discuss_content_detail_content_data">
                    评论时间:<span>2015-1-1 12:21:11</span>　　
                    <span>回复（<span style="color:red">4</span>）</span>
                </div>
            </div>
            <div id="book_discuss_content_detail">
                <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>
                <div id="book_discuss_content_detail_title">
                    <a href="">狂想曲的测试</a>
                </div>
                <div id="book_discuss_content_detail_title_author"><a href="">程程陈</a>说：</div>
                <div id="book_discuss_content_detail_content"><a href="">范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德</a>
                </div>
                <div id="book_discuss_content_detail_content_data">
                    评论时间:<span>2015-1-1 12:21:11</span>　　
                    <span>回复（<span style="color:red">4</span>）</span>
                </div>
            </div>
            <div id="book_discuss_content_detail">
                <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>
                <div id="book_discuss_content_detail_title">
                    <a href="">狂想曲的测试</a>
                </div>
                <div id="book_discuss_content_detail_title_author"><a href="">程程陈</a>说：</div>
                <div id="book_discuss_content_detail_content"><a href="">范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞</a>
                </div>
                <div id="book_discuss_content_detail_content_data">
                    评论时间:<span>2015-1-1 12:21:11</span>　　
                    <span>回复（<span style="color:red">4</span>）</span>
                </div>
            </div>
            <div id="book_discuss_content_detail">
                <img src="../../../Tongrenfang/img/1.jpeg" alt=""/>
                <div id="book_discuss_content_detail_title">
                    <a href="">狂想曲的测试</a>
                </div>
                <div id="book_discuss_content_detail_title_author"><a href="">程程陈</a>说：</div>
                <div id="book_discuss_content_detail_content"><a href="">范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞范德萨范德萨范德萨范德萨飞</a>
                </div>
                <div id="book_discuss_content_detail_content_data">
                    评论时间:<span>2015-1-1 12:21:11</span>　　
                    <span>回复（<span style="color:red">4</span>）</span>
                </div>
            </div>
        </div>

    </div>
    <div id="book_update_foot">
        <a href=""><span>更多...</span></a>
    </div>
</div>

<!--------------------------评论结束--------------------->
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
<!--QQ表情插件-->

<script type="text/javascript" src="../../Expression/jquery.qqFace.js"></script>
<script src="../../Home/js/qqFace.js"></script>
<!--QQ表情插件结束-->
@include('layouts.footer')
@stop