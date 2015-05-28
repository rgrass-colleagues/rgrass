<!DOCTYPE html>
<html>
<head>
<title>燃草中文社区用户登陆中心</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="utf-8">
    {{HTML::style('vendor_login_reg/css/loginCss.css?v=2')}}
    {{HTML::script('Home/js/jquery.min.js')}}

</head>
<body>
<div class="wrap">
  <div class="banner-show" id="js_ban_content">
    <div class="cell bns-01">
      <div class="con"> </div>
    </div>
    <div class="cell bns-02" style="display:none;">
      <div class="con"> <a target="_blank" class="banner-link"> <i>同人</i></a> </div>
    </div>
    <div class="cell bns-03" style="display:none;">
      <div class="con"> <a target="_blank" class="banner-link"> <i>燃草</i></a> </div>
    </div>
  </div>
  <div class="banner-control" id="js_ban_button_box"> <a href="javascript:;" class="left">左</a> <a href="javascript:;" class="right">右</a> </div>
    <script src="../../../Home/js/login1.js"></script>
  <div class="container">
    <div class="register-box">
      <div class="reg-slogan"> 用户登陆</div>
      <div class="reg-form" id="js-form-mobile"> <br>
        <br>
          <form action="/doLogin" method="post">
      <div class="reg-form" id="js-form-mail">
        <div class="cell">
          <input type="text" name="email" id="js-mail_ipt" class="text" placeholder="请输入用户名或邮箱"/>
        </div><span id="username_error" style="color:red;"></span>
        <div class="cell">
          <input type="password" name="password" id="js-mail_pwd_ipt" class="text" placeholder="请输入密码"/>
          <b class="icon-form ifm-view js-view-pwd" title="查看密码" style="display: none"> 查看密码</b> </div><span id="password_error" style="color:red;"></span>
        <!-- start短信验证码 -->
        <div class="cell vcode">
          <input type="text" id="code_math" class="text" maxlength="4" placeholder="请输入验证码"/>
          <img src="../../../../Common/code_math.php" class="getcode_math" title="看不清，点击换一张" align="absmiddle" style="cursor: pointer"> </div>
          <span id="chk_math"></span>
          <!--end短信验证码-->
        <div class="user-agreement">

        </div>
        <div class="bottom">
            <input type="hidden" id="login_flag" value=""/>
            <input type="hidden" name="from_url" value="{{$from_url}}"/>
            <input type="submit" class="button btn-green" value="登陆" id="login_confirm">
        </div>
      </div>
          </form><a href="/reg" id="to_reg">还没有账号?->>快速注册</a>
    </div>
  </div>
</div>
</body>
</html>
<script src="../../../Home/js/login2.js"></script>