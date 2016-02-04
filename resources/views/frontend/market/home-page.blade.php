<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>无标题文档</title>
<link href="{{asset('css/frontend/reset.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/frontend/home.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="logobox">
        <img src="" class="homelogo">
    </div>
    
    <h1>web版进销存系统</h1>

    {!! Form::open(['url' => 'login', 'class' => 'form-horizontal']) !!}
        <p class="username-box">
            <label for="email">用户名：</label><input type="text" class="" id="username" name="email"/>
        </p>
        <p class="password-box">
            <label for="password">密码</label>:&nbsp;<input type="password" class="" id="password" name="password"/>
        </p>
        <p class="check-box">
            <label class="forget-box" for="forget"><input type="radio"  name="password"  id="forget" value="2"/>忘记密码</label>
            <label for="remember"><input type="radio" name="password"  id="remember" value="1"/>记住密码</label>      
        </p>
        <input type="submit" class="login" value="登录" id="login" name="login-btn">
    {!! Form::close() !!}
    
</body>
</html>
