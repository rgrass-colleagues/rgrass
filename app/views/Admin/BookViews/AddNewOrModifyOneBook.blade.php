@extends('layouts.admin_master')
@section('title')
文章管理
@stop
@section('pagetitle')
添加新书籍
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="/rgrassAdmin/BookLists">书籍管理</a></li>

    <li class="pull-right no-text-shadow">

        <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">

            <i class="icon-calendar"></i>

            <span></span>

            <i class="icon-angle-down"></i>

        </div>

    </li>

</ul>
@stop
@section('content')
<form action="doAddNewOrModifyOneBook" method="post" enctype = 'multipart/form-data'>
    ----------------书籍基本信息--------------<br><br>
<!--    请选择封面:<input type="file" name="default_cover"><br>-->
    @if(!empty($book_info->cover))
    <img src="../../../uploads/covers/{{$book_info->cover}}" alt="" width="100px"/><br/>
    @endif
    <input type="hidden" name="default_last_book_picture" value="@if(!empty($book_info)){{$book_info->cover}}@endif"/>
    <input type='hidden' name='MAX_FILE_SIZE' value='2621114' />
    小说封面图:<input type="file" name="cover"><br><br/>
    请输入书名:<input type="text" name="default_book_name" value="@if(!empty($book_info)){{$book_info->book_name}}@endif"/><br>
    请输入作者:<input type="text" name="default_author" value="@if(!empty($book_info)){{$book_info->author}}@endif"><br>
    请输入简介:<input type="text" name="default_detail" value="@if(!empty($book_info)){{$book_info->detail}}@endif"><br>
    请选择类型:
        <select name="default_book_type" id="book_type">
            <option value="0">初始化</option>
            @foreach($book_type as $v)
            <option value="{{$v->type_id}}">{{ViewSpalls_AdminViewSpallsModel::showBookType($v->type_id)}}</option>
            @endforeach
        </select>
    <br>
    是否精品书籍:
    <select name="default_is_boutiques" id="boutiques">
        <option value="0">否</option>
        <option value="1">是</option>
    </select><br>
    小说首发站:
    <select name="default_book_from_status" id="book_from">
        <option value="0">本站首发</option>
        <option value="1">它站首发</option>
        <option value="2">起点首发</option>
        <option value="3">纵横首发</option>
        <option value="4">创世首发</option>
        <option value="5">逐浪首发</option>
        <option value="6">飞卢首发</option>
    </select><br>
    小说首发连接:
    <input type="text" name="default_book_from_url" value="@if(!empty($book_info)){{$book_info->book_from_url}}@else{{'http://www.rgrass.com'}}@endif"/><br>
    <br>
    ----------------书籍详细信息--------------<br><br>
<!--    书本章节数:<input type="text" name="book_length" value="@if(!empty($book_detail)){{$book_detail->book_length}}@endif"><br>-->
<!--    书本总字数:<input type="text" name="word_number" value="@if(!empty($book_detail)){{$book_detail->word_number}}@endif"><br>-->
<!--    最后的更新:<input type="text" name="last_update_time" value="@if(!empty($book_detail)){{$book_detail->last_update_time}}@endif"><br>-->
    书本的状态:
    <select name="state" id="book_state">
        <option value="1">新书首发</option>
        <option value="2">渐入佳境</option>
        <option value="3">步入高潮</option>
        <option value="4">曲终人散</option>
    </select><br>
    小编读后感:
    <textarea name="editor_estimate">@if(!empty($book_detail)){{$book_detail->editor_estimate}}@endif</textarea><br>
    @if($page_type=='modify')
    <input type="hidden" value="@if(!empty($book_info)){{$book_info->book_id}}@endif" name="default_book_id"/>
    @endif
    <input type="hidden" value="{{$page_type}}" name="page_type"/>
    <input type="submit" value="确定创建" class="btn blue"/>

</form>
{{HTML::script('Admin/js/jquery-1.10.1.min.js')}}
@if((!empty($book_detail))&&(!empty($book_info)))
<script>
    $('#book_type option[value={{$book_info->book_type}}]').attr('selected','true');
    $('#boutiques option[value={{$book_info->is_boutiques}}]').attr('selected','true');
    $('#book_state option[value={{$book_detail->state}}]').attr('selected','true');
    $('#book_from option[value={{$book_info->book_from_status}}]').attr('selected','true');
</script>
@endif
@stop