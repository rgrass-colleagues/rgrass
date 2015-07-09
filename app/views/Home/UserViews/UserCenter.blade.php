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
        <div class="user_section_right_title">
            <ul>
                <li><b><a href="" style="color:#b01f2e;border-bottom:2px solid #666;padding-bottom:12px;">基本信息</a></b></li>
                <li class="cols_css">|</li>
                <li><b><a href="">头像修改</a></b></li>
                <li class="cols_css">|</li>
                <li><b><a href="">用户标签</a></b></li>
            </ul>
        </div>
        <div class="user_section_right_content">
            <p>用户昵称：<span>bob</span><a href="" class="user_info_modify">修改</a></p>
            <p>Email：<span>912510822@qq.com (<a href="" class="user_info_activate">未激活</a>)</span><a href="" class="user_info_modify">修改</a></p>
            <p>手机：<span>13726224130</span><a href="" class="user_info_modify">修改</a></p>
            <p>QQ：<span>912510822</span><a href="" class="user_info_modify">修改</a></p>
            <p>等级：<span>魔法学徒</span><a href="" class="user_change_grade">切换称号</a></p>
            <p>上一次登录时间：<span>2014-07-03 19:52:36</span></p>
            <p>积分：<span>10321</span><a href="" class="user_change_grade">如何增加积分？</a></p>
            <p>燃草币：<span>1000</span><a href="" class="rc_recharge">充值</a></p>
            <p>推荐票：<span>500</span><a href="" class="user_change_grade">如何增加推荐票？</a></p>
            <p>书架：<span>共<b>100</b>本，已用<b>0</b>本，剩余<b>100</b>本</span><a href="" class="user_change_grade">如何扩容书架？</a></p>
            <p></p>
        </div>
    </div>
</div>
@include('layouts.footer')
@stop