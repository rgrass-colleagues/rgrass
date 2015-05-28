/**
 * Created by bob on 15-5-14.
 */
$('#login_confirm').click(function(){
    //用户名验证
    //1,不可以为空
    //2,至少6位
    //3,用户名是否存在
    if($('#js-mail_ipt').val()==""){
        $('#username_error').html('用户名不可以为空');
        return false;
    }else{
        var email = $('#js-mail_ipt').val();
        if(email.length<6){
            $('#username_error').html('用户名至少于6位');
        }else{


            $.ajax({
                type: "post",
                url: "/ajax/user_confirm",
                data: {email:email},
                //dataType:'json',//json串传入到php
                async:false,//此处可以修改同异步问题
                success: function(msg){
                    console.log(msg);
                    if(msg==0){
                        $('#username_error').html("<span style='color:red;'>该用户已存在<span>");
                        return false;
                    }else if(msg==1){
                        $('#username_error').html("<span style='color:green;'>用户可用<span>");
                    }else if(msg==2){
                        $('#username_error').html("<span style='color:red;'>请输入邮箱<span>");
                    }
                }
            });


        }
    }
    if($('#js-mail_pwd_ipt').val()==""){
        $('#password_error').html('密码不可以为空');
        return false;
    }else{
        var pwd = $('#js-mail_pwd_ipt').val();
        if(pwd.length<6){
            $('#password_error').html('密码至少6位');
        }else{
            $('#password_error').html('');
        }
    }
    /****验证码start*****/
    var code_math = $("#code_math").val();
    if(code_math==""){
        $('#chk_math').html("<span style='color:red;'>验证码不可以为空<span>");
        return false;
    }else{
        $.ajax({
            type: "post",
            url: "../../../Common/chk_code.php?act=math",
            data: {code:code_math},
            //dataType:'json',//json串传入到php
            async:false,//此处可以修改同异步问题
            success: function(msg){
                if(msg!=1){
                    $('#chk_math').html("<span style='color:red;'>验证码错误！<span>");
                    $('#login_flag').attr('value','0');
                }else if(msg==1){
                    $('#login_flag').attr('value','1');
                }
            }
        });
    }
    var flag = $('#login_flag').val();
    if(flag!=1){
        return false;
    }
    /****验证码end*****/
});