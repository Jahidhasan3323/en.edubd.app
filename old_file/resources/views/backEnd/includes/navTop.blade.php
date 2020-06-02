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
</nav>