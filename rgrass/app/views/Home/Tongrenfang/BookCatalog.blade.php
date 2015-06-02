@extends('layouts.home_master')
@section('title')
某目录--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')

<div id="book_sign_left">
    <div id="book_sign_left_title">
        <div id="book_sign_left_title_left">
            <img src="../../../Tongrenfang/img/zhujian.jpg" alt="宠物狂想曲"/>
            <a href="http://www.rgrass.com/book?book_id=1">宠物狂想曲</a>
            <span>(书号：1234567)</span>
        </div>
        <div id="book_sign_left_title_right">
            <a href="http://www.rgrass.com/catalog" class="btn-primary">书籍目录列表</a>

        </div>
    </div>
    <div id="book_sign_content">

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

@stop