@extends('backEnd.master')

@section('mainTitle', 'System Dathboard')
@section('active_accounts', 'active')
@section('content')
    <div id="page-inner">
        <div class="row">
            @if(isset($total_fee_collection))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{str_replace($s, $r,$total_fee_collection)}} টাকা</p>
                            <p class="text-muted">সর্বমোট ফি কালেকশন</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_income))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{str_replace($s, $r,$total_income)}} টাকা</p>
                            <p class="text-muted">সর্বমোট আয় কালেকশন</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_expense))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{str_replace($s, $r,$total_expense)}} টাকা</p>
                            <p class="text-muted">সর্বমোট ব্যয় বা খরচ</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($current_due))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{str_replace($s, $r,$current_due)}} টাকা</p>
                            <p class="text-muted">সর্বমোট বাকি</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_deposit))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{str_replace($s, $r,($total_deposit-$total_withdraw))}} টাকা</p>
                            <p class="text-muted"> মোট ব্যাংকে জমা আছে</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_asset))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{str_replace($s, $r,($total_asset))}} টাকা</p>
                            <p class="text-muted"> সর্বমোট সম্পদ</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_fine))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{str_replace($s, $r,($total_fine))}} টাকা</p>
                            <p class="text-muted"> সর্বমোট জরিমানা কালেকশন</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <!-- /. ROW  -->
        <hr/>

    </div>
@endsection
@section('script')
    <script src="{{asset('backEnd/js/jquery-3.1.1.min.js')}}"></script>
@endsection
