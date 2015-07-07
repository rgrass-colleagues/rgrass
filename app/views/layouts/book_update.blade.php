<div id="book_update">
    <div id="book_update_title"><img src="../../../Tongrenfang/img/brown_book_icon.jpg" alt="小说列表"/><span><span style="color:darkred;">{{$site_name}}</span> 小说更新列表栏</span></div>
    <!--书籍更新内容-->
    <div id="book_update_content" class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <td>类别</td>
                <td>书名</td>
                <td>作者</td>
                <td>更新时间</td>

            </tr>
            <!--总共23本放在首页作为更新栏-->
            @foreach($bookUpdateData as $k=>$v)
            <tr>
                <td><a href="" class="book_update_content_style">[{{$v->type_name}}]</a></td>
                <td><a href="Book?book_id={{$v->book_id}}" class="book_update_content_bname">{{$v->book_name}}</a></td>
                <td><a href="" class="book_update_content_author">{{$v->author}}</a></td>
                <td>{{date('Y-m-d H:i:s',$v->last_update_time)}}</td>
            </tr>
            @endforeach
        </table>

    </div>
    <div id="book_update_foot">
        <a href=""><span>更多...</span></a>
    </div>
</div>