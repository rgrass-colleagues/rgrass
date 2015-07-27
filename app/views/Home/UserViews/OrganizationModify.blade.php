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

        <div class="user_info_modify_content">
            <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;"><h3>修改分卷</h3></b></span>
            <form class="form-horizontal" action="/doOrganizationModify" method="post">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">分卷名：</label>
                    <div class="col-sm-10">
                        <input type="text" name="organization_name" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$organization->organization_name}}">
                    </div>
                </div>

                <input type="hidden" name="id" value="{{$organization->id}}"/>
                <input type="hidden" name="book_id" value="{{$organization->book_id}}"/>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-primary" value="确认修改">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('layouts.footer')
@stop