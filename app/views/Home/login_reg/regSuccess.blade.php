<html>
<head>
    <meta charset="utf-8">
    <style>
        div{
            margin:0 auto;
            padding-top:200px;
            height:400px;
            width:500px;
        }
    </style>
</head>
<body>
<div>
    <p>恭喜,注册成功,我们会发一封邮件到你的邮箱,请前往登陆激活</p>
    <p>3秒后为您自动跳转,如果没有反应,请点击下方回到登陆页</p>
    <p><a href="{{$from_url}}">回到登陆页</a></p>
</div>
</body>
</html>
<script>
    var from_url = "{{$from_url}}";
    console.log(from_url);
    if(!from_url && typeof(from_url)!="undefined" && from_url!=0){
        from_url = "http://rgrass.com/Index";
    }else if("{{$from_url}}"=='http://www.rgrass.com/doLogin'){
        from_url = "http://rgrass.com/Index";
    }
    setTimeout(function(){
        window.location.href=from_url;
    },3000);
</script>