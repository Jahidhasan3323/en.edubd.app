
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('mainTitle') | Education Management System</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backEnd/img/icon.png')}}" />
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{mix('js/app.js')}}">
    <link rel="stylesheet" href="{{mix('css/all.css')}}">
    <link href="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css'/>
     <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('backEnd')}}/colorpicker/bootstrap-colorpicker.min.css">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'SolaimanLipi', Arial, sans-serif !important;
        }
    </style>

    @yield('head_section')

    <style>
        .star{
            color: red;
        }
        .navTopUser a{
            margin-top: 5px;
        }
    </style>
    @yield('style')
</head>
<body>
    <div id="wrapper">
        @include('backEnd.includes.navTop')
        @if(isset($nav))
        @else
         @php $nav=''; @endphp
        @endif
        <!-- /. NAV TOP  -->
        @includeWhen($nav=='active','backEnd.includes.navSideWebmanagement')
        @includeWhen($nav=='','backEnd.includes.navSide')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            @yield('content')
            <!-- /. PAGE WRAPPER  -->
        </div>
    </div>

    @include('backEnd.includes.footer')

    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{mix('js/all.js')}}"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> 
    <!-- bootstrap color picker -->
<script src="{{asset('backEnd')}}/colorpicker/bootstrap-colorpicker.min.js"></script>
    @yield('script')

    <script>
        $("select").select2();
        //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();
    </script>


    <script>
        $.validate({
            lang: 'en',
          modules : 'file'
        });
    </script>
</body>
</html>
