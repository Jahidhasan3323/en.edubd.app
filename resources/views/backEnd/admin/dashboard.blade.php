@extends('backEnd.master')

@section('mainTitle', 'System Dathboard')

@section('content')

    @if(Auth::is('admin'))
        <div class="alert-danger" style="display: none;" id="expiry_error">
            @if(Get::expiry() >= 0 && Get::expiry() < 30)
                <button id="dismis" style="float:right"><span class="glyphicon glyphicon-remove"></span></button>
                <p class="text-danger text-center" style="padding: 5px">{{Get::expiryDays()}}</p>
            @endif
        </div>
    @endif
    @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
    @endif
    @if(Session::has('sccmgs'))
        @include('backEnd.includes.success')
    @endif
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                
                <h2>
                    @if(!Auth::is('root'))
                        @php($school = \App\School::find(Auth::getSchool()))
                        {{$school->user->name}} Online System
                    @else
                        Admin Dashboard
                    @endif
                </h2>
                <h5>Welcome {{Auth::user()->name}}. </h5>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr/>
        <div class="row">
            @if(isset($users))
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-users"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{$users}} Users</p>
                            <p class="text-muted">All User</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($schools))
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-bars"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{$schools}} Institutes</p>
                            <p class="text-muted">All Institute</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($students))
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-users"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{$students}} Students</p>
                            <p class="text-muted">All Student</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($teachers))
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                        <i class="fa fa-users"></i>
                    </span>
                        <div class="text-box">
                            <p class="main-text">{{$teachers}} Techears</p>
                            <p class="text-muted">All Teacher</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($staff))
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                        <i class="fa fa-users"></i>
                    </span>
                        <div class="text-box">
                            <p class="main-text">{{$staff}} Employees</p>
                            <p class="text-muted">All Employee</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($commitee))
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                        <i class="fa fa-users"></i>
                    </span>
                        <div class="text-box">
                            <p class="main-text">{{$commitee}} Commitees</p>
                            <p class="text-muted">All Commitee</p>
                        </div>
                    </div>
                </div>
            @endif


            
        </div>
        <!-- /. ROW  -->
        <hr/>
        <div class="row">

            <!-- /. ROW  -->
            <div class="row text-center pad-top">
                @if(Auth::is('root'))
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/schools')}}">
                                <i class="fa fa-bars fa-5x" style="color: #246630"></i>
                                <h4>See List of Institute</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/school_users')}}">
                                <i class="fa fa-users fa-5x" style="color: #246630"></i>
                                <h4>See Users</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/class')}}">
                                <i class="fa fa-sitemap fa-5x" style="color: #3AAECD"></i>
                                <h4>Class Information</h4>
                            </a>
                        </div>
                    </div>
                @endif
                @if(Auth::is('root')||Auth::is('admin')||Auth::is('student'))

                @if(!Auth::is('student'))
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{url('/designations')}}">
                            <i class="fa fa-bullseye fa-5x" style="color: green"></i>
                            <h4>Employee Designation</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{url('/examTypes')}}">
                            <i class="fa fa-bullseye fa-5x" style="color: black"></i>
                            <h4>Examination Types </h4>
                        </a>
                    </div>
                </div>
                @endif
                @if(!Auth::is('root'))
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                    <div class="div-square">
                        <a href="{{url('/subjects')}}">
                            <i class="fa fa-book fa-5x" style="color: red"></i>
                            <h4>See Subject Information</h4>
                        </a>
                    </div>
                </div>
                @endif
                @endif
                @if(Auth::is('admin'))
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/classes')}}">
                                <i class="fa fa-sitemap fa-5x" style="color: #3AAECD"></i>
                                <h4>Class Information</h4>
                            </a>
                        </div>
                    </div>
                @endif

                @if(Auth::is('admin') || Auth::is('teacher')||Auth::is('staff') ||Auth::is('commitee') ||Auth::is('student'))
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/staff')}}">
                                <i class="fa fa-user fa-5x" style="color: green"></i>
                                <h4>See Employee List </h4>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/commitee')}}">
                                <i class="fa fa-user fa-5x" style="color: green"></i>
                                <h4>See Commitee List</h4>
                            </a>
                        </div>
                    </div>

                    @if(!Auth::is('commitee')&&!Auth::is('student'))
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/students_list')}}">
                                <i class="fa fa-user fa-5x" style="color: #3AAECD"></i>
                                <h4>See Student List</h4>
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/classRoutines')}}">
                                <i class="fa fa-clipboard fa-5x" style="color: #2046CF"></i>
                                <h4>Class Routine</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/examRoutines')}}">
                                <i class="fa fa-clipboard fa-5x" style="color: #DE6E04"></i>
                                <h4>Exam Routine</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <div class="div-square">
                            <a href="{{url('/result')}}">
                                <i class="fa fa-indent fa-5x" style="color: #000"></i>
                                <h4>See Result</h4>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            
    </div>
@endsection
@section('script')
    <script src="{{asset('backEnd/js/jquery-3.1.1.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#expiry_error').fadeIn();
            $('#dismis').on('click', function () {
                $('#expiry_error').fadeOut();
            });
        })
    </script>

@endsection