<header>
    <a href="http://www.rgrass.com/Index"><img src="../../Home/img/logo.jpg" alt="燃草中文同人坊" id="show_logo"/></a>
    <div id="login_module">
        @if(!isset($user_info))
        <span id="login">
            <a href="/Login">登录</a>
        </span>
        <span>/</span>
        <span id="register" >
            <a href="/Reg">注册</a>
        </span>
        @else
        <div class="dropdown user_sign">
            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-danger">
                {{$user_info->username}}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a href="/User">个人中心</a></li>
                <li><a href="/Out" onclick="return confirm('确定退出吗?')">退出</a></li>
            </ul>
        </div>
        @endif
    </div>
</header>