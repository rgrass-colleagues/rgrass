/**
 * Created by bob on 15-5-14.
 */
$('#login_confirm').click(function(){
    if($('#js-mail_ipt').val()==""){
        $('#username_error').html('用户名不可以为空');
        return false;
    }else{
        $('#username_error').html('');
    }
    if($('#js-mail_pwd_ipt').val()==""){
        $('#password_error').html('密码不可以为空');
        return false;
    }else{
        $('#password_error').html('');
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