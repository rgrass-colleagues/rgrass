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
            <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;"><h3>修改章节</h3></b></span>
            <form class="form-horizontal" action="/doChapterModify" method="post">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">章节名：</label>
                    <div class="col-sm-10">
                        <input type="text" name="chapter_name" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$chapter->chapter_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">请选择卷名：</label>
                    <div class="col-sm-10">
                        <select name="chapter_organization" id="organization_sel" class="form-control input_m_cls">
                            <option value="0">作品相关</option>
                            @foreach($chapter_organization as $v)
                            <option value="{{$v->id}}">{{$v->organization_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">章节内容：</label>
                    <div class="col-sm-10">
                        <textarea name="chapter_content" class="form-control" style="width:600px;height:700px;">{{$chapter->chapter_content}}</textarea>
                    </div>
                </div>
                <input type="hidden" name="update_users" value="{{$author_info->pen_name}}"/>
                <input type="hidden" name="id" value="{{$chapter->id}}"/>
                <input type="hidden" name="book_id" value="{{$book_id}}"/>
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
<script>
    $('#organization_sel option[value={{$chapter->chapter_organization}}]').attr('selected','true');
</script>
@include('layouts.footer')
@stop