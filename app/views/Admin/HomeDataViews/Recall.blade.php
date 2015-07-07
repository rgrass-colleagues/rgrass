@extends('layouts.admin_master')
@section('title')
用户管理
@stop
@section('pagetitle')
用户列表
@stop
@section('ptitle')
<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="/rgrassAdmin/IndexCenter">后台首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li>
        <a href="/rgrassAdmin/HomeData">前台数据</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="/rgrassAdmin/BoutiqueRecall">{{$site_name}}追忆</a></li>

</ul>
@stop
@section('content')
<br><br>
<a href="/rgrassAdmin/AddHideRecall?column={{$nav}}" class="btn blue">添加推荐</a>
<a href="" class="btn green">一键轮换</a>
<br><br>
<span>目前处在显示状态的书籍有</span>
<span style="color:red">{{$count}}</span>
<span>本（超过6本后不能再选择显示）</span>
<br><br>
<table class="table table-hover">
    <tr>
        <td>id</td>
        <td>书号</td>
        <td>可用</td>
        <td>更改时间</td>
        <td>操作</td>
    </tr>
    @foreach($boutique as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{ViewSpalls_AdminViewSpallsModel::changeBookIdIntoBookName($v->book_id)}}</td>
        <td>
            @if($v->state==0)
            <span style="color:gray;">隐藏</span>
            @else
            <span style="color:green;">显示</span>
            @endif
        </td>
        <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
        <td>
            <a href="/rgrassAdmin/ModifyRecall?id={{$v->id}}&&column={{$nav}}" class="btn blue">修改</a>
            @if($v->state==0)
            @if($count>=6)
            <a href="#" onclick="alert('处于显示状态的不能大于10个')" class="btn green">显示</a>
            @else
            <a href="/rgrassAdmin/doChangeState?state=show&&id={{$v->id}}&&redirect={{$nav}}Recall" class="btn green">显示</a>
            @endif
            @else
            <a href="/rgrassAdmin/doChangeState?state=hide&&id={{$v->id}}&&redirect={{$nav}}Recall" class="btn gray">隐藏</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@stop