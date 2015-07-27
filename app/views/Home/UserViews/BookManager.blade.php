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
            <a href="/AddNewBook" class='btn btn-success'>添加新书</a><br><br>
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
                @if(empty($author_book_info))
                <tr>
                    <td>你还没有作品喔～快去创建吧～</td>
                </tr>
                @else

                @foreach($author_book_info as $v)
                <tr>
                    <td><img src="/uploads/covers/{{$v->cover}}" alt="" width="62.5px" height="75px"/></td>
                    <td>{{$v->book_id}}</td>
                    <td><a href="/Book?book_id={{$v->book_id}}">{{$v->book_name}}</a></td>
                    <td>{{ViewSpalls_AdminViewSpallsModel::showBookType($v->book_type)}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->book_add_time)}}</td>
                    @if($v->book_authority=='0')
                    <td style="color:red">未审核</td>
                    @else
                    <td style="color:#060">已通过审核</td>
                    @endif
                    <td>
                        <a href="/ModifyBook?book_id={{$v->book_id}}" class="btn btn-info btn-sm">修改</a>
                        <a href="/OperateBook?book_id={{$v->book_id}}" class="btn btn-warning btn-sm">操作本书</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>

</div>
@include('layouts.footer')
@stop