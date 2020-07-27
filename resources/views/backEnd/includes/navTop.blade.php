<style>
     .oc-dextop{
            display: block;
            width: 40%;
        }

        .fa-spinner{
            color: #fff;
            font-size: 20px;
            background: #d9534f;
            padding: 5px 0 0 6px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }
    
</style>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('/home')}}">{{(Auth::user()->name) ? Auth::user()->name : ''}}</a>
    </div>
    <div class="navTopUser" style="color: white;
padding: 10px 50px 5px 50px;
float: right;
font-size: 16px;">
        @yield('changePassword')
        @yield('profile')
        @if(!Auth::is('root'))
            <a href="
                @if(Auth::is('admin'))
                    {{url('/schoolProfile')}}
                @endif

                @if(Auth::is('teacher'))
                {{url('/teacherProfile')}}
                @endif

                @if(Auth::is('staff'))
                {{url('/teacherProfile')}}
                @endif

                @if(Auth::is('student'))
                {{url('/studentProfile')}}
                @endif
                @if(Auth::is('commitee'))
                {{url('/commiteeProfile')}}
                @endif
            " class="btn btn-danger square-btn-adjust">Profile</a>
        @endif
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-danger square-btn-adjust">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <div class="navTopUser oc-dextop" style="color: white; padding: 10px 50px 5px 50px; float: right; font-size: 16px;">
        @if(Auth::is('student'))
        <a href="#" class="pull-left" style="margin-right:5px"><i class="fa fa-spinner fa-spin"></i></a>  
        <a href="{{url('online_class_us/student')}}" class="btn btn-danger square-btn-adjust pull-left">Ehsan Online Conferance</a> 
        @endif
        @if(Auth::is('teacher')  || Auth::is('commitee') || Auth::is('staff') )
        <a href="#" class="pull-left" style="margin-right:5px"><i class="fa fa-spinner fa-spin"></i></a>  
            <a href="{{url('online_class_us/staff')}}" class="btn btn-danger square-btn-adjust pull-left">Ehsan Online Conferance</a> 
        @endif
        @if ( Auth::is('admin'))
        <a href="#" class="pull-left" style="margin-right:5px"><i class="fa fa-spinner fa-spin"></i></a>  
        <a href="{{url('online_class_us/school_class')}}" class="btn btn-danger square-btn-adjust pull-left">Ehsan Online Conferance</a> 
        @endif
    </div>
    
</nav>