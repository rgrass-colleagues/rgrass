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
            <a href="/AddNewBook?author_id={{$author_info->id}}" class='btn btn-success'>添加新书</a><br><br>
            <table class="table table-hover">
                <tr>
                    <td>封面</td>
                    <td>书号</td>
                    <td>书名</td>
                    <td>类型</td>
                    <td>入库时间</td>
                    <td>权限</td>
                    <td>操作</td>
                </tr>

            </table>
        </div>
    </div>

</div>
@include('layouts.footer')
@stop