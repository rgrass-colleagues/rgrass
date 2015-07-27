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

            <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;"><h3>修改作家信息</h3></b></span><br><br><br>
            <form class="form-horizontal" action="/doAuthorInfoModify" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">笔名：</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$author_info->pen_name}}" disabled><span class="author_reg_tips">*笔名修改请联系管理员</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">邮箱：</label>
                    <div class="col-sm-10">
                        <input type="text" name="author_email" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$author_info->author_email}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">QQ：</label>
                    <div class="col-sm-10">
                        <input type="text" name="author_qq" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$author_info->author_qq}}">
                    </div>
                </div>

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