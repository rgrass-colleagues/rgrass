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
            <form class="form-horizontal" action="/doUserDetailModify" method="post">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">性别：</label>
                    <div class="col-sm-10">
                        <select name="sex" id="sex_control" class="form-control input_m_cls">
                            <option value="1">男</option>
                            <option value="0">女</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">描述：</label>
                    <div class="col-sm-10">
                        <textarea name="user_estimate" class="form-control input_m_cls">{{$user_detail->user_estimate}}</textarea>
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
<script>
    $('#sex_control option[value={{$user_detail->sex}}]').attr('selected','true');
</script>
@include('layouts.footer')
@stop