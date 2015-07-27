@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
<div id="user_section">
    @include('layouts.authorLeft')
    <div class="user_section_right">
        @include('layouts.authorRightTitle')
        <div class="user_section_right_content">

            <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;"><h3>修改作家密码</h3></b></span><br><br><br>
            <form class="form-horizontal" action="/doAuthorPasswordModify" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">旧密码：</label>
                    <div class="col-sm-10">
                        <input type="password" name="old_pass" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">新密码：</label>
                    <div class="col-sm-10">
                        <input type="password" name="new_pass1" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">新密码：</label>
                    <div class="col-sm-10">
                        <input type="password" name="new_pass2" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="">
                        <span class="author_reg_tips">两次新密码的输入必须一致</span>
                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{$author_info->user_id}}"/>
                <input type="hidden" name="id" value="{{$author_info->id}}"/>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-primary" value="确认修改"/>
                    </div>
                </div>
            </form>


        </div>
    </div>

</div>
@include('layouts.footer')
@stop