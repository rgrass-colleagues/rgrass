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

            <div class="user_info_modify_content">
                <span class="nick_modify_explain">(注意，新注册用户只有一次修改昵称的机会，再次修改需要<a>消耗</a>200积分)</span><br><br>
                <form class="form-horizontal" action="/doUserInfoModify" method="post">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">昵称：</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   @if($user_info->is_uname_modify=='1')
                                   name="username"
                                   @endif

                            class="form-control input_m_cls" id="inputEmail3" placeholder="{{$user_info->username}}" value="@if($user_info->is_uname_modify=='1'){{$user_info->username}}@endif"

                            @if($user_info->is_uname_modify=='0')
                            disabled
                            @endif
                            >
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">手机号：</label>
                        <div class="col-sm-10">
                            <input type="text" name="telephone" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$user_info->telephone}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">QQ：</label>
                        <div class="col-sm-10">
                            <input type="text" name="qq" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$user_info->qq}}">
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="{{$user_info->user_id}}"/>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="确认修改" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
            </div>

        </div>

</div>
@include('layouts.footer')
@stop