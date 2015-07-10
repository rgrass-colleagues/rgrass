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
        @include('layouts.userRightTitle')
        <div class="user_section_right_content">

            <p>用户昵称：<span>{{$user_info->username}}</span><a href="/UserInfoModify" class="user_info_modify">修改</a></p>


            <p>性别：<span>@if($user_detail->sex=='0')<img src="./Home/img/girl.png" alt=""/>女@else<img src="./Home/img/boy.png">男@endif</span><a href="/UserDetailModify" class="user_info_modify">修改</a></p>


            <p>Email：<span>{{$user_info->email}} @if($user_info->is_activate==0)(<a href="" class="user_info_activate">未激活</a>)@endif</span></p>


            <p>手机：<span>@if($user_info->telephone != 0){{$user_info->telephone}}@else<span class="not_set">未设置手机号</span>@endif</span><a href="/UserInfoModify" class="user_info_modify">修改</a></p>


            <p>QQ：<span>@if($user_info->qq != 0){{$user_info->qq}}@else<span class="not_set">未设置qq</span>@endif</span><a href="/UserInfoModify" class="user_info_modify">修改</a></p>


            <p>等级：<span>魔法学徒</span><a href="" class="user_change_grade">切换称号</a></p>


            <p>上一次登录时间：<span>{{date('Y-m-d H:i:s',$user_info->last_login_time)}}</span></p>


            <p>积分：<span>{{$user_property->points}}</span><a href="" class="user_change_grade">如何增加积分？</a></p>


            <p>燃草币：<span>{{$user_property->rgrass_coin}}</span><a href="" class="rc_recharge">充值</a></p>


            <p>推荐票：<span>{{$user_property->recommend_ticket}}</span><a href="" class="user_change_grade">如何增加推荐票？</a></p>


            <p>书架：<span>共<b>100</b>本，已用<b>0</b>本，剩余<b>100</b>本</span><a href="" class="user_change_grade">如何扩容书架？</a></p>


            <p></p>
        </div>
    </div>
</div>
@include('layouts.footer')
@stop