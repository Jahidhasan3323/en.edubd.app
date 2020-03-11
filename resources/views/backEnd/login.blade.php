
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | School Management System</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backEnd/img/icon.png')}}" />
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <!--  for bootstrap  -->
    <link rel="stylesheet" href="{{mix('css/login.css')}}">
    <!-- <style type="text/css">
        body{background-image: url({{asset('public/images/bg.jpg')}});}
    </style> -->
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class="text-center login-title login_welcome">Education Management System</h1>
            @if(file_exists('teacherPermission.txt'))
                @php
                    $openFile = fopen('teacherPermission.txt', 'r');
                    $showMessage = fread($openFile, filesize('teacherPermission.txt'));
                    fclose($openFile);
                @endphp
                <h3 class="text-center" style="margin-top: 25px; color: red">{{$showMessage}}</h3>
                @php(unlink('teacherPermission.txt'))
            @endif
            <div class="col-sm-6 col-md-4 col-md-offset-4">


                <div class="account-wall">
                    {{--<img class="profile-img" src="{{asset('backEnd/img/logo.gif')}}"--}}
                         {{--alt="LOGO">--}}
                    <form action="{{ route('login') }}" method="post" class="form-signin">
                        {{csrf_field()}}
                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input name="email" type="text" class="form-control" placeholder="Email or Phone"  autofocus autocomplete="none">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                         <br>
                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input name="password" type="password" class="form-control" placeholder="Password"  autocomplete="none">

                            @if($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        <hr>
                        <label class="checkbox pull-left">
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="remember-me">
                          Remember me
                      </label>
                        <label>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </label>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
<footer style="margin-top: 30px">
    <div id="footer">
        <div id="container">
            <p align="center">
                CopyRight &copy; <color  style="color:red;"><a href="">Ehsan Software</a></color> 2014 - <?=date('Y');?><br/>
        </div>
    </div>
</footer>
</html>
