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
    <p>登陆成功</p>
    <p>3秒后为您自动跳转,如果没有反应,请点击下方回到登陆页</p>
    <p><a href="{{$from_url}}">回到登陆页</a></p>
</div>
</body>
</html>
<script>
    setTimeout(function(){
        window.location.href="{{$from_url}}";
    },3000);
</script>