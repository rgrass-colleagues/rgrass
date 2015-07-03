<div id="recall_recommend">
    <div class="recall_recommend_mb_20"></div>
    <div class="recall_recommend_title">
        {{$site_name}}回忆录
    </div>
    <p class="recall_recommend_introduce">最经典最让人忘怀的精品小说是什么?带你一同领略精品小说的魅力所在!</p>
    <div class="recall_recommend_content">
        <ul>
            @foreach($recall as $v)
            <li class="recall_recommend_content_show">
                <a href="/Book?book_id={{$v->book_id}}">
                    <img src="/uploads/covers/{{$v->cover}}" alt="" width="120px" height="150px;"/>
                </a><br>
                <span class="recall_recommend_content_show_book_name" title="{{$v->book_name}}"><b><a href="/Book?book_id={{$v->book_id}}">{{$v->book_name}}</a></b></span><br>
                <span class="recall_recommend_content_show_author">作者:{{$v->author}}</span>
                <a href="/Book?book_id={{$v->book_id}}" class="recall_recommend_content_click_read">[<span>点击阅读</span>]</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>