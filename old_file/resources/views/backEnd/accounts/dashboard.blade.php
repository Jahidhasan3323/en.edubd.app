@extends('backEnd.master')

@section('mainTitle', 'Account Dathboard')
@section('active_accounts', 'active')
@section('content')
    <div id="page-inner">
        <div class="row">
            @if(isset($total_fee_collection))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{$total_fee_collection}} Taka</p>
                            <p class="text-muted">Total Fee Collection</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_income))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ $total_income }} Taka</p>
                            <p class="text-muted">Total Income Collection</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_expense))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ $total_expense }} Taka</p>
                            <p class="text-muted">Total Expense</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($current_due))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ $current_due }} Taka</p>
                            <p class="text-muted">Total Due</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_deposit))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ $total_deposit-$total_withdraw }} Taka</p>
                            <p class="text-muted"> Current Bank Deposit</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_asset))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ $total_asset }} Taka</p>
                            <p class="text-muted"> Total Asset Amount</p>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($total_fine))
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">{{ $total_fine }} Taka</p>
                            <p class="text-muted"> Total Fine Collection</p>
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
