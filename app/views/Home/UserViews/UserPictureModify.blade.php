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
            <span class="nick_modify_explain">(注意，请尽可能选择100×100(px)的方形图片)</span><br><br>
            <form class="form-horizontal" action="/doUserPictureModify" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">上传图片：</label>
                    <div class="col-sm-10">
                        <input type="file" name="user_picture"/>
                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{$user_info->user_id}}"/>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="确认上传" class="btn btn-primary"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@include('layouts.footer')
@stop