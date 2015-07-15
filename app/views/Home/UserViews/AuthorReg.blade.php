@extends('layouts.home_master')
@section('title')
同人坊--燃草同人社区
@stop
@section('content')
@include('layouts.header')
@include('layouts.nav')
<div id="user_section">
    <div class="Author_reg_border">
        <br><br>
        <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;">请根据提示认真填写以下信息，以完成作者账号申请。</b></span><br><br><br>
        <form class="form-horizontal" action="/doAuthorReg" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">笔名：</label>
                <div class="col-sm-10">
                    <input type="text" name="pen_name" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">笔名申请后不可变更,请认真思考后填写</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">作者后台管理密码：</label>
                <div class="col-sm-10">
                    <input type="password" name="author_password1" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">登录后台密码，大于6位英文、数字或特殊字符组成</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">再一次输入密码：</label>
                <div class="col-sm-10">
                    <input type="password" name="author_password2" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">再一次输入作者后台密码</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">常用电子邮箱：</label>
                <div class="col-sm-10">
                    <input type="text" name="author_email" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">电子邮箱可以让我们快速联系到您，请填写完整</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">QQ：</label>
                <div class="col-sm-10">
                    <input type="text" name="author_qq" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">QQ号码可以帮助我们快速联系到您，请真实填写</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">真实姓名：</label>
                <div class="col-sm-10">
                    <input type="text" name="true_name" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">请填写您的真实姓名</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">身份证号码：</label>
                <div class="col-sm-10">
                    <input type="text" name="true_identify" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">请输入身份证号码(号码为8-15为数字与字母组合)</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">真实手机号：</label>
                <div class="col-sm-10">
                    <input type="text" name="true_telephone" class="form-control input_m_cls"/>
                    <span class="author_reg_tips">手机号码可以帮助我们快速联系到您，请真实填写</span>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="read_confirm"> 我已经阅读并同意<a href="">《 燃草中文作者注册投稿协议书 》</a>
                        </label>
                    </div>
                </div>
            </div>
            <br>

            <input type="hidden" name="user_id" value="{{$user_info->user_id}}"/>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="注册成为作者" class="btn btn-primary btn-lg"/>
                </div>
            </div>
        </form>
    </div>

</div>
@include('layouts.footer')
@stop