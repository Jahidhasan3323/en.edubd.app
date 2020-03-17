@extends('backEnd.master')

@section('mainTitle', 'Edit Expense')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>
        <div class="col-md-12" style="padding: 15px;">
          <h2 class="text-center text-temp">Edit Expense</h2>
        </div>
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
          @isset($msg)
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ $msg }}
            </div>
          @endisset
        </div>
        <div class="panel-body">
            <form action="{{ route('expense_update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $expense->id }}">
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="payment_date">Payment Date <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y', strtotime($expense->payment_date)) }}" class="form-control date" type="text" name="payment_date" id="payment_date">
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="received_by">Name <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $expense->received_by??'' }}" type="text" name="received_by" class="form-control" placeholder="গ্রহণকারীর নাম লিখুন">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="mobile">Mobile Number </label>
                          <div class="">
                              <input value="{{ $expense->mobile??'' }}" type="text" name="mobile" class="form-control" placeholder="Mobile Number">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="amount">Amount <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $expense->amount??'' }}" type="number" name="amount" class="form-control" placeholder="Enter Amount">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="reference">Reference </label>
                          <div class="">
                              <input value="{{ $expense->reference??'' }}" type="text" name="reference" class="form-control" placeholder="Reference">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="payment_method">Payment Method <span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" name="payment_method" id="payment_method">
                                  <option selected value="{{ $expense->payment_method }}">{{ $expense->payment_method }}</option>
                                  <option value="Cash">Cash</option>
                                  <option value="Bkash">Bkash</option>
                                  <option value="Rocket">Rocket</option>
                                  <option value="Credit-Card">Credit-Card</option>
                                  <option value="Debit-Card">Debit-Card</option>
                                  <option value="Bank">Bank</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="fund_id">Select Fund<span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" name="fund_id" id="fund_id">
                                <option selected value="{{ $expense->fund_id }}">{{ $expense->fund->name??'' }}</option>
                                @foreach ($funds as $fund)
                                  <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="description">Description</label>
                          <div class="">
                              <textarea name="description" rows="3" class="form-control">{{ $expense->description??'' }}</textarea>
                          </div>
                      </div>
                  </div>
                </div>

                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

  @isset($expense_view)
    <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;">
      <div class="col-md-12" style="padding: 15px;">
        <h2 class="text-center text-temp">Print Vouchar</h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h3>{{ $expense_view->serial }}</h3>
        </div>
        <div class="col-md-6">

        </div>
      </div>
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


@endsection
