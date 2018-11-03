<!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <!-- Custom Theme files -->
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all"/>

</head>
<body>

<div class="login">

    <div class="login-top">
        @include('layout._notice')
        @include('layout._errors')
        <h1>LOGIN FORM</h1>
        <form method="post" action="{{ route('login') }}">
            {{--onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User name';}"--}}
            {{--onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"--}}
            <input type="text" name="name" placeholder="用户名" value="{{ old('name') }}">
            <input type="password" name="password" placeholder="密 码" value="{{ old('password') }}">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="1" @if(old('remember'))checked="checked" @endif> 记住密码
                </label>
            </div>
            <div class="forgot">
                <a href="http://www.daipx.cn/dd.html">forgot Password</a>
                <input type="submit" value="Login" >
            </div>
            {{ csrf_field() }}
        </form>
    </div>
    <div class="login-bottom">
        <h3>New User &nbsp;<a href="{{ route('users.create') }}">Register</a>&nbsp Here</h3>
    </div>
</div>
<div class="copyright">
    <p>Copyright &copy; 2015.Company name All rights reserved.  </p>
</div>
</body>
</html>