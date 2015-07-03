<div id="high_comment">
    <div class="high_comment_title">
        <span class="high_comment_title_left"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/></span><span class="high_comment_title_right">
            <span style="color:darkred">{{$site_name}}</span>
            强烈推荐
        </span>
    </div>
    <div class="high_comment_content">
        <ul>
            @foreach($stronglyRecommend as $v)
            <li><a href="/error" target="_blank">[{{$v->type_name}}]</a><a href="/Book?book_id={{$v->book_id}}" target="_blank" title="{{$v->book_name}}">{{$v->book_name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="high_comment_footer">
        <a href=""><span>更多...</span></a>
    </div>
</div>