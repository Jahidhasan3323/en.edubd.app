<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('backEnd/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backEnd/css/font-awesome.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backEnd/img/icon.png')}}" />
    <title>Account Date expired</title>
    <style>
        .content {
            width: 50%;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            margin: 10% auto;
        }
        .message{ text-align: center; padding: 15% 3% 15%; color: red}
        .top_manue{margin-top: 15px}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-sm-offset-10 top_manue">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn btn-danger square-btn-adjust">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="row">
            <div class="content">
                <h2 class="message">
                    @if(Auth::is('admin'))
                        Opps. account expired ! Please contact to your provider.
                    @endif
                    @if(Auth::is('teacher') || Auth::is('student'))
                        Opps. System problem ! Please contact to school's management.
                    @endif
                </h2>
            </div>
        </div>
    </div>
</body>
</html>