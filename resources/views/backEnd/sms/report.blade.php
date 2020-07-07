@extends('backEnd.master')

@section('mainTitle', 'SMS Report')

@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h2>
                        @if(!Auth::is('root'))
                            @php($school = \App\School::find(Auth::getSchool()))
                            {{$school->user->name}} <small>(SMS Dashboard)</small>
                        @else
                            SMS Dashboard
                        @endif
                    </h2>
                    <h5> {{Auth::user()->school->address}}. </h5>
                </center>    
            </div>
        </div>
        <!-- /. ROW  -->
        <hr/>
        <div class="row">
            @if(isset($report))
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ number_format($report['total_sms_cost'],2) }} Taka</p>
                            <p class="text-muted">Total SMS Cost</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ number_format($report['total_send_sms']) }}</p>
                            <p class="text-muted">Total Sent SMS</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ number_format($report['month_sms_costs'],2) }} Taka</p>
                            <p class="text-muted">Current Month SMS Cost</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ number_format($report['monthly_send_sms']) }}</p>
                            <p class="text-muted">Current Month Sent SMS</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ number_format($report['direct_sms_cost'],2) }} Taka</p>
                            <p class="text-muted">Direct SMS Cost</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ number_format($report['total_balance'],2) }} Taka</p>
                            <p class="text-muted">Total Recharge Amount </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 ">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ number_format($report['current_balance'],2) }} Taka</p>
                            <p class="text-muted">Current Balance</p>
                        </div>
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