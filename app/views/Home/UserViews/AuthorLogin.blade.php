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
        <div class="user_section_right_content">
            <form action="/doAuthorLogin" method="post">
                <div class="form-group">
                    <div class="col-sm-10">
                        输入作者专区密码：<input type="password" name="author_password" class="form-control input_m_cls"/>
                        <input type="hidden" name="user_id" value="{{$user_info->user_id}}"/>
                        <input type="submit" value="进入" class="btn btn-primary"/>

                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('layouts.footer')
@stop