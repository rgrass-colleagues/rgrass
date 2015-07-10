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

        <div class="user_info_modify_content">
            <span class="nick_modify_explain">(注意，新密码1和新密码2要一致)</span><br><br>
            <form class="form-horizontal" action="/doUserPasswordModify" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">旧密码：</label>
                    <div class="col-sm-10">
                        <input type="password" name="old_password" class="form-control input_m_cls"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">新密码1：</label>
                    <div class="col-sm-10">
                        <input type="password" name="new1_password" class="form-control input_m_cls"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">新密码2：</label>
                    <div class="col-sm-10">
                        <input type="password" name="new2_password" class="form-control input_m_cls"/>
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