<div class="user_section_left">
    <div class="user_picture">
        <br/>
        <span>{{$user_info->username}}</span><br>
        <a href=""><img src="{{$user_picture_url}}" alt="" width="100px" height="100px"/></a><br>
        <a href="/UserPictureModify" class="modify_picture">修改头像</a><br>
    </div><br>
    <div class="user_operation">
        <p><img src="./Home/img/user.gif" alt=""/><a href="/User">用户中心</a></p>
        <p><img src="./Home/img/property.gif" alt=""/><a href="">财务中心</a></p>
        <p><img src="./Home/img/bookshelf.gif" alt=""/><a href="/Bookshelf">用户书架</a></p>
        <p><img src="./Home/img/author.gif" alt=""/><a href="/AuthorNotice">作家中心</a></p>
        <p class="last_user_operation"><img src="./Home/img/link.png" alt=""/><a href="">联系本站</a></p>
    </div>
    <div class="user_section_left_estimate">
        @if($user_detail->user_estimate=="")
        <span class="user_estimate">他很懒,什么自我描述都没写~</span>
        @else
        {{$user_detail->user_estimate}}
        @endif
        <br>
        <a href="/UserDetailModify" class="user_info_modify fr">修改描述</a>
    </div>
</div>