<header>
    <a href="http://www.rgrass.com/Index"><img src="../../Home/img/logo.jpg" alt="燃草中文同人坊" id="show_logo"/></a>
    <div id="login_module">
        @if(!isset($is_user_login))
        <span id="login">
            <a href="/Login">登录</a>
        </span>
        <span>/</span>
        <span id="register" >
            <a href="/Reg">注册</a>
        </span>
        @else
        <div id="user_sign">
            <ul>
                <li><a href="/error">消息(x)</a></li>
                <li><a href="/error">{{$is_user_login->username}}</a></li>
                <li><a href="/User">个人中心</a></li>
                <li><a href="/Out" onclick="return confirm('确定退出吗?')">退出</a></li>
            </ul>
        </div>
        @endif
    </div>
</header>