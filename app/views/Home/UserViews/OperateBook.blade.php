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
            <span class="nick_modify_explain btn_activate_author"><b style="color:darkred;"><h3>书籍管理</h3></b></span>
        <a href="/AddNewChapter?book_id={{$book_id}}" class="btn btn-primary">添加新章节</a>
        <a href="/AddNewOrganization?book_id={{$book_id}}" class="btn btn-info">添加新分卷</a>
            <br>
            <br>
        <table class="table table-hover">
            {{ViewSpalls_BookViewSpallsModel::OperateBookCatalog($catalog,$book_id,3)}}
        </table>
        </div>
    </div>

</div>
@include('layouts.footer')
@stop