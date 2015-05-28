<?php
class Email_SendEmail{
    public function sendEmail($to_email,$token){
        echo "<meta CharSet='utf-8'>";
        $mail = new Email_PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host = "smtp.163.com"; //SMTP服务器 以163邮箱为例子
        $mail->Port = 25;  //邮件发送端口
        $mail->SMTPAuth   = true;  //启用SMTP认证

        $mail->CharSet  = "UTF-8"; //字符集
        $mail->Encoding = "base64"; //编码方式

        $mail->Username = "81118bobo@163.com";  //你的邮箱
        $mail->Password = "hr1ycfLqswslhK";  //你的密码
        $mail->Subject = "hello"; //邮件标题

        $mail->From = "81118bobo@163.com";  //发件人地址（也就是你的邮箱）
        $mail->FromName = "rgrass";  //发件人姓名

        $address = $to_email;//收件人email
        $mail->AddAddress($address, "亲");//添加收件人（地址，昵称）

        //$mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
        $mail->IsHTML(true); //支持html格式内容
        //$mail->AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg"); //设置邮件中的图片
        $mail->Body = '你好, <b>朋友</b><br/>这是一封来自<a href="http://www.rgrass.com" target="_blank">rgrass.com</a>的邮件！<br/>首先,,恭喜你注册成功!但是,你还需要进行下面的操作!<br/><a href="http://www.rgrass.com/activate?token='.$token.'&&username='.$to_email.'">请点击这里,进行激活</a>'; //邮件主体内容

//发送
        if($mail->Send()){
            echo $mail->ErrorInfo;
            return true;
        }else{
            return false;
        }
    }
}
