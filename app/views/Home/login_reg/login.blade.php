<!DOCTYPE html>
<html>
<head>
<title>燃草中文社区用户注册中心</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="utf-8">
    {{HTML::style('vendor_login_reg/css/home.css?v=2')}}
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
  <script type="text/javascript">
                ;(function(){
                    
                    var defaultInd = 0;
                    var list = $('#js_ban_content').children();
                    var count = 0;
                    var change = function(newInd, callback){
                        if(count) return;
                        count = 2;
                        $(list[defaultInd]).fadeOut(400, function(){
                            count--;
                            if(count <= 0){
                                if(start.timer) window.clearTimeout(start.timer);
                                callback && callback();
                            }
                        });
                        $(list[newInd]).fadeIn(400, function(){
                            defaultInd = newInd;
                            count--;
                            if(count <= 0){
                                if(start.timer) window.clearTimeout(start.timer);
                                callback && callback();
                            }
                        });
                    }
                    
                    var next = function(callback){
                        var newInd = defaultInd + 1;
                        if(newInd >= list.length){
                            newInd = 0;
                        }
                        change(newInd, callback);
                    }
                    
                    var start = function(){
                        if(start.timer) window.clearTimeout(start.timer);
                        start.timer = window.setTimeout(function(){
                            next(function(){
                                start();
                            });
                        }, 8000);
                    }
                    
                    start();
                    
                    $('#js_ban_button_box').on('click', 'a', function(){
                        var btn = $(this);
                        if(btn.hasClass('right')){
                            //next
                            next(function(){
                                start();
                            });
                        }
                        else{
                            //prev
                            var newInd = defaultInd - 1;
                            if(newInd < 0){
                                newInd = list.length - 1;
                            }
                            change(newInd, function(){
                                start();
                            });
                        }
                        return false;
                    });
                    
                })();
                $(function(){
                    $(".getcode_math").click(function(){
                        $(this).attr("src",'../../../Common/code_math.php?' + Math.random());
                    });
                    $("#code_math").keyup(function(){
                        var code_math = $(this).val();
                        $.post("../../../Common/chk_code.php?act=math",{code:code_math},function(msg){
                            if(msg!=1){
                                $('#chk_math').html("<span style='color:red;'>验证码错误！<span>");
                            }else{
                                $('#chk_math').html("<span style='color:green;'>验证码正确！<span>");

                            }
                        });
                    });
                });
            </script>
  <div class="container">
    <div class="register-box">
      <div class="reg-slogan"> 新用户注册</div>
      <div class="reg-form" id="js-form-mobile"> <br>
        <br>
          <form action="">
      <div class="reg-form" id="js-form-mail">
        <div class="cell">
          <input type="text" name="email" id="js-mail_ipt" class="text" placeholder="请输入邮箱"/>
        </div>
        <div class="cell">
          <input type="password" name="passwd" id="js-mail_pwd_ipt" class="text" placeholder="请输入密码"/>
          <b class="icon-form ifm-view js-view-pwd" title="查看密码" style="display: none"> 查看密码</b> </div>
        <!-- !短信验证码 -->
        <div class="cell vcode">
          <input type="text" name="code" id="code_math" class="text" maxlength="4" placeholder="请输入验证码"/>
          <img src="../../../../Common/code_math.php" class="getcode_math" title="看不清，点击换一张" align="absmiddle"> <span> <a href="" >刷新</a></span> </div>
          <span id="chk_math"></span>
        <div class="user-agreement">
          <input type="checkbox" id="js-mail_chk" checked="true" />
          <label for="js-mail_chk">同意<a href="#" target="_blank">《燃草中文社区用户服务协议》</a></label>
        </div>
        <div class="bottom"> <input type="submit" class="button btn-green" value="我要注册"></div>
      </div>
          </form>
    </div>
  </div>
</div>
</body>
</html>
