@extends('backEnd.master')
@section('mainTitle', 'Account Report')
@section('head_section')
    <style>
      .vouchar{position: relative;}
      #school_logo{position: absolute;left: 1%;top: 5%;}
      .report_result{position: absolute; top: 45%; left: 45%; width: 300px; border-radius: 5px; z-index: 9;}
    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
  <div class="row">
    <div class="col-md-12">
      @if(session('success_msg'))
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{session('success_msg')}}
        </div>
      @endif
      @if($errors->any())
          @foreach($errors->all() as $error)
          <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{$error}}
          </div>
        @endforeach
      @endif
    </div>
  </div>
  {{-- Date Wise Fund Balance Report --}}
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd; min-height: 286px;">
        <h2 class="text-center text-temp">Fund Report</h2>
        <div class="panel-body">
            <form action="{{ route('date_wise_fund_report') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="fund_id">Select Fund<span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" name="fund_id" id="fund_id">
                                @isset($fund)
                                  <option selected value="{{ $fund->id }}">{{ $fund->name }}</option>
                                @endisset
                                @foreach ($funds as $fund)
                                  <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="start_date">Start Date<span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y', strtotime('-1 years')) }}" class="form-control date" type="text" name="start_date" id="start_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="end_date">End Date <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="end_date" id="end_date">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <center>
                              <button id="save" type="submit" class="btn btn-info"> Balance</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @isset($fund_balance)
      <div class="report_result btn btn-success">
        <div class="close" style="color:red; font-size: 24px;">
          <i class="fa fa-times-circle"></i>
        </div>
        <div class="">
          <h3>{{ $return_fund->name }} Report</h>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Total Fund Amount </td>
              <td class="text-right"> {{ number_format($fee_fund+$fee_fund_due_paid+$income_fund, 2) }} </td>
            </tr>
            <tr>
              <td>Total Expense</td>
              <td class="text-right">- {{ number_format($fee_fund_due+$expense_fund, 2) }}</td>
            </tr>
            <tr>
              <td>Current Balance </td>
              <td class="text-right"> <b>{{ number_format($fund_balance, 2) }}</b> </td>
            </tr>
          </tbody>
        </table>
      </div>
    @endisset
    {{-- Date Wise Fee Collection Report --}}
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd; min-height: 286px;">
        <h2 class="text-center text-temp">Date Wise Fee Collection Report</h2>
        <div class="panel-body">
            <form action="{{ route('date_wise_fee_collection_report') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="start_date">Start Date <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y', strtotime('-1 years')) }}" class="form-control date" type="text" name="start_date" id="start_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="end_date">End Date  <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="end_date" id="end_date">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <center>
                              <button id="save" type="submit" class="btn btn-info"> Fee Collection Report</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @isset($date_fee_collection)
      <div class="report_result btn btn-success">
        <div class="close" style="color:red; font-size: 24px;">
          <i class="fa fa-times-circle"></i>
        </div>
        <div class="">
          <h3> Collection </h>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Fee Collection </td>
              <td class="text-right"> {{ number_format($date_fee_collection, 2) }} </td>
            </tr>
            <tr>
              <td>Due Collection</td>
              <td class="text-right">+ {{ number_format($date_fee_collection_due_paid, 2) }}</td>
            </tr>
            <tr>
              <td>Total Fee Collection</td>
              <td class="text-right"> <b>{{ number_format($date_fee_collection+$date_fee_collection_due_paid, 2) }}</b> </td>
            </tr>
            <tr>
              <td>Current Due </td>
              <td class="text-right"> <b style="color:red;">{{ number_format($date_fee_collection_due-$date_fee_collection_due_paid, 2) }}</b> </td>
            </tr>
          </tbody>
        </table>
      </div>
    @endisset
  {{-- Date Wise Total Income Report  --}}
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd;min-height: 286px;">
        <h2 class="text-center text-temp">Date Wise Income Report</h2>
        <div class="panel-body">
            <form action="{{ route('date_wise_income_report') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="start_date">Start Date <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y', strtotime('-1 years')) }}" class="form-control date" type="text" name="start_date" id="start_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="end_date">End Date <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="end_date" id="end_date">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <center><button id="save" type="submit" class="btn btn-info">Income Report</button></center>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  @isset($total_income)
    <div class="report_result btn btn-success">
      <div class="close" style="color:red; font-size: 24px;">
        <i class="fa fa-times-circle"></i>
      </div>
      <div class="">
        <h3>Total Income = {{ $total_income }}</h3>
      </div>
    </div>
  @endisset
  {{-- Date Wise Total Income Report  --}}
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd; min-height: 286px;">
        <h2 class="text-center text-temp">Date Wise Expense Report</h2>
        <div class="panel-body">
            <form action="{{ route('date_wise_expense_report') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="start_date">Start Date <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y', strtotime('-1 years')) }}" class="form-control date" type="text" name="start_date" id="start_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="end_date">End Date<span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="end_date" id="end_date">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <center><button id="save" type="submit" class="btn btn-info"> Expense Report </button></center>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  @isset($total_expense)
    <div class="report_result btn btn-success">
      <div class="close" style="color:red; font-size: 24px;">
        <i class="fa fa-times-circle"></i>
      </div>
      <div class="">
        <h3>Total Expense = {{ $total_expense }}</h3>
      </div>
    </div>
  @endisset

  {{-- Class Wise Fee Collection --}}
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd; min-height: 286px;">
        <h2 class="text-center text-temp">Class Wise Fee Collection</h2>
        <div class="panel-body">
            <form action="{{ route('class_wise_fee_collection_report') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="class">Class <span class="star">*</span></label>
                          <select name="master_class_id" id="master_class_id" class="form-control" required="">
                              <option value="">Select Class</option>
                              @foreach($classes as $class)
                                  <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="group1">Group <span class="star">*</span></label>
                          <select name="group_class_id" id="group_class_id" class="form-control" required="">
                              <option value="">Select Group</option>
                              @foreach($groups as $group_class)
                                <option value="{{$group_class->name}}">{{$group_class->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                          <label class="" for="shift">Shift <span class="star">*</span></label>
                          <select name="shift" id="shift" class="form-control" required="">
                              <option value="">Select Shift</option>
                              <option value="Morning">Morning</option>
                              <option value="Day">Day</option>
                              <option value="Evening">Evening</option>
                              <option value="Night">Night</option>
                          </select>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <center>
                              <button id="save" type="submit" class="btn btn-info"> Balance Check</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @isset($total_fee_collection)
      <div class="report_result btn btn-success">
        <div class="close" style="color:red; font-size: 24px;">
          <i class="fa fa-times-circle"></i>
        </div>
        <div class="">
          <h3>Fee Collection Report</h>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Fee Collection </td>
              <td class="text-right"> {{ number_format($total_fee_collection, 2) }} </td>
            </tr>
            <tr>
              <td>Due Collection</td>
              <td class="text-right">+ {{ number_format($fee_collection_due_paid, 2) }}</td>
            </tr>
            <tr>
              <td>Total Fee Collection</td>
              <td class="text-right"> <b>{{ number_format($total_fee_collection+$fee_collection_due_paid, 2) }}</b> </td>
            </tr>
            <tr>
              <td>Current Due</td>
              <td class="text-right"> <b style="color:red;">{{ number_format($fee_collection_due-$fee_collection_due_paid, 2) }}</b> </td>
            </tr>
          </tbody>
        </table>
      </div>
    @endisset

    {{-- Date Wise Total Bank Report  --}}
    <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd; min-height: 286px;">
          <h2 class="text-center text-temp">Date Wise Bank Report</h2>
          <div class="panel-body">
              <form action="{{ route('date_wise_bank_report') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="start_date">Start Date <span class="star">*</span></label>
                            <div class="">
                                <input value="{{ date('d-m-Y', strtotime('-1 years')) }}" class="form-control date" type="text" name="start_date" id="start_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="end_date">End Date <span class="star">*</span></label>
                            <div class="">
                                <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="end_date" id="end_date">
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                              <center><button id="save" type="submit" class="btn btn-info"> Bank Report</button></center>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>

    @isset($total_deposit)
      <div class="report_result btn btn-success">
        <div class="close" style="color:red; font-size: 24px;">
          <i class="fa fa-times-circle"></i>
        </div>
        <div class="">
          <h3>Bank Report</h>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Total Deposit </td>
              <td class="text-right"> {{ number_format($total_deposit, 2) }} </td>
            </tr>
            <tr>
              <td> Total Withdraw</td>
              <td class="text-right">- {{ number_format($total_withdraw, 2) }}</td>
            </tr>
            <tr>
              <td> Current Deposit</td>
              <td class="text-right"> <b>{{ number_format($total_deposit-$total_withdraw, 2) }}</b> </td>
            </tr>
          </tbody>
        </table>
      </div>
    @endisset


@endsection
@section('script')
<link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
<script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
<script>
    $( function() {
        $( ".date" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        }).val();
    } );
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".report_result .close").on("click", function(){
      $(".report_result").hide();
    });
  });
</script>

@endsection
