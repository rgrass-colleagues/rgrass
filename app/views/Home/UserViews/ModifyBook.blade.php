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

            <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;"><h3>修改作品信息</h3></b></span><br><br><br>
            <form class="form-horizontal" action="/doModifyBook" method="post" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">书名：</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control input_m_cls" id="inputPassword3" placeholder="" value="{{$author_book_info->book_name}}" disabled>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">作品类型：</label>
                    <div class="col-sm-10">
                        <input disabled type="text" value="{{ViewSpalls_AdminViewSpallsModel::showBookType($author_book_info->book_type)}}" class="form-control input_m_cls"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">作品封面：</label>
                    <div class="col-sm-10">
                        <input type="file" name="cover"/><br>
                        <span class="author_reg_tips">*图片尽可能上传<b>250*300</b>px格式</span><br>
                        <span class="author_reg_tips">*严格禁止上传违规图片（色情，暴力，反社会，反人类）</span><br>
                        <span class="author_reg_tips">*一经发现，立刻删除，屡教不改，封号处理！</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">作品状态：</label>
                    <div class="col-sm-10">
                        <select name="state" id="state_sel" class="form-control input_m_cls">
                            <option value="1">新书上传</option>
                            <option value="2">渐入佳境</option>
                            <option value="3">步入高潮</option>
                            <option value="4">曲终人散</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">作品简介：</label>
                    <div class="col-sm-10">
                        <textarea name="detail" class="form-control text_detail">{{$author_book_info->detail}}</textarea>
                        <span class="author_reg_tips">*限400字作品介绍，请勿上传章节内容</span><br>
                        <span class="author_reg_tips">*若要修改小说其它信息，请联系管理员</span>
                    </div>
                </div>
                <input type="hidden" name="book_id" value="{{$author_book_info->book_id}}"/>
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
    $('#state_sel option[value={{$author_book_info->state}}]').attr('selected','true');
</script>
@include('layouts.footer')
@stop