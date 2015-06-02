@extends('layouts.admin_master')
@section('title')
文章管理
@stop
@section('pagetitle')
文章列表
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="ArticleLists">文章管理</a></li>

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
<a href="AddNewOrModifyOneBook?page_type=create" class="btn blue">添加</a>
<br/><br/>
<table class="table table-hover">
    <tr>
        <th>封面</th>
        <th>书号</th>
        <th>书名</th>
        <th>作者</th>
        <th>书权限</th>
        <th>入库时间</th>
        <th>操作</th>
    </tr>
    @foreach($bookBaseInfo as $bookList)
    <tr>
        <td><img src="../../Cover/{{$bookList->cover}}" alt="" width="70px"/></td>
        <td>{{$bookList->book_id}}</td>
        <td>{{$bookList->book_name}}</td>
        <td>{{$bookList->author}}</td>
        <td>{{$bookList->book_authority}}</td>
        <td>{{$bookList->book_add_time}}</td>
        <td>
            <a href="AddNewOrModifyOneBook?page_type=modify&&book_id={{$bookList->book_id}}" class="btn blue">修改</a>
            <a href="/rgrassAdmin/chapter_manager?book_id={{$bookList->book_id}}" class="btn green">章节管理</a>
            <button class="btn blue blue_book_detail" id="book_detail" value="{{$bookList->book_id}}">简介</button>
            <button class="btn black black_book_all_detail" id="book_all_detail" value="{{$bookList->book_id}}">详情<i class="m-icon-swapright m-icon-white"></i></button>
            <a href="delBook?id={{$bookList->book_id}}" class="btn red">删除</a>
        </td>
    </tr>
    @endforeach
</table>
<script>
    //点击，出现简介
    $('.blue_book_detail').click(function(){
        var book_id=$(this).val();
        $.get('BookDetail',{id:book_id},function(data){
            alert(data);
        });
    });
    //点击，出现书籍详细状态
    $('.black_book_all_detail').click(function(){

        var book_id=$(this).val();
        if($('.show_book_all_detail').length>0){
            //判断book_detail的框框是否存在
            return false;
        }
        //编写主体内容
        var show_book_all_detail="<div class='show_book_all_detail' id='detail_flag_"+book_id+"'></div>";
        $(this).after(show_book_all_detail);//插入html
        $.get('BookAllDetail',{id:book_id},function(data){
            var arr=eval('('+data+')');
            var detail_content =
                "<div class='close_window'>"
                +"<span id='close_event'>X</span>"
                +"<table class=\"table table-hover\">"
                +"<tr>"
                +"<td>书名</td>"
                +"<td>总章节</td>"
                +"<td>总字数</td>"
                +"<td>最后更新</td>"
                +"<td>状态</td>"
                +"<td>点击数</td>"
                +"<td>藏经阁</td>"
                +"<td>编辑评价</td>"
                +"<td>书本类型</td>"
                +"</tr>"
                +"<tr>"
                +"<td>"+arr.book_name+"</td>"
                +"<td>"+arr.book_length+"</td>"
                +"<td>"+arr.word_number+"</td>"
                +"<td>"+arr.last_update_time+"</td>"
                +"<td>"+arr.state+"</td>"
                +"<td>"+arr.click_number+"</td>"
                +"<td>"+arr.is_store+"</td>"
                +"<td>"+arr.editor_estimate+"</td>"
                +"<td>"+arr.book_type+"</td>"
                +"</tr>"
                +"</table>"
                +"</div>";
            $('#detail_flag_'+arr.book_id).html(detail_content);
            $('#close_event').click(function(){
                //点击右上角X的时候整个详情删除
                $('#detail_flag_'+book_id).remove();
            });
        });
    });

</script>
@stop