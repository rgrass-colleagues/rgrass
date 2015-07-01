<div id="book_data">
    <div id="book_data_click">
        <div id="book_data_click_title">
            <span class="high_comment_title_left"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/></span><span>小说点击榜</span>
            <div id="book_data_click_part">
                <ul>
                    <li id="book_data_click_week">周</li>
                    <li id="book_data_click_month">月</li>
                    <li id="book_data_click_total">总</li>
                </ul>
            </div>

        </div>
        <div id="book_data_click_content">
            <table class="table table-striped">
                @foreach($clickNumAll as $k=>$v)
                <tr>
                    <td>{{$k+1}}</td>
                    <td><a href="/Book?book_id={{$v->book_id}}" target="_blank">{{$v->book_name}}</a></td>
                    <td>{{$v->click_number_all}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div id="book_data_click_foot">
            <a href="" target="_blank">查看更多...</a>
        </div>
    </div>
    <div class="m_part_click_comment"></div>
    <div id="book_data_comment">
        <div id="book_data_comment_title">
            <span class="high_comment_title_left"><img src="../../Home/img/black_ico.gif" alt="强烈推荐"/></span><span>小说推荐榜</span>
            <div id="book_data_comment_part">
                <ul>
                    <li id="book_data_comment_week">周</li>
                    <li id="book_data_comment_month">月</li>
                    <li id="book_data_comment_total">总</li>
                </ul>
            </div>
        </div>
        <div id="book_data_comment_content">
            <table class="table table-striped">
                @foreach($recommendAll as $k=>$v)
                <tr>
                    <td>{{$k+1}}</td>
                    <td><a href="/Book?book_id={{$v->book_id}}" target="_blank">{{$v->book_name}}</a></td>
                    <td>{{$v->recommend_all}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div id="book_data_comment_foot">
            <a href="" target="_blank">查看更多...</a>
        </div>
    </div>

</div>
