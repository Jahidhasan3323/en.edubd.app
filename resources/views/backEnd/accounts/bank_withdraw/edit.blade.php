@extends('backEnd.master')

@section('mainTitle', 'ব্যাংক থেকে টাকা উত্তোলন পরিবর্তন করুন')
@section('head_section')
    <style>

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
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
      <div class="col-md-12">
        <h2 class="text-center text-temp">ব্যাংক থেকে টাকা উত্তোলন পরিবর্তন করুন</h2>
      </div>
      <div class="panel-body">
          <form action="{{ route('bank_withdraw_update') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{ $bank_withdraw->id }}">
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">ব্যাংক নির্বাচন করুন </label>
                          <div class="">
                            <select class="form-control" name="bank_id">
                              <option selected value="{{ $bank_withdraw->bank_id }}">{{ $bank_withdraw->bank->name??'ব্যাংক নির্বাচন করুন' }}</option>
                              @foreach ($banks as $key => $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">একাউন্টের ধরণ নির্বাচন করুন </label>
                          <div class="">
                            <select class="form-control" name="account_type_id">
                              @if ($bank_withdraw->account_type_id==0)
                                <option selected value="0">{{ 'প্রভিডেন্ট ফান্ড' }}</option>
                              @else
                                <option selected value="{{ $bank_withdraw->account_type_id }}">{{ $bank_withdraw->account_type->name??'একাউন্টের ধরণ নির্বাচন করুন' }}</option>
                              @endif
                              @foreach ($account_types as $key => $account_type)
                                <option value="{{ $account_type->id }}">{{ $account_type->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="account_number">একাউন্ট নাম্বার <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_withdraw->account_number??"" }}" type="text" name="account_number" class="form-control" placeholder="একাউন্ট নাম্বার ">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="check_number">চেক নাম্বার <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_withdraw->check_number??"" }}" type="text" name="check_number" class="form-control" placeholder="ডিপোজিট নাম্বার ">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="amount">উত্তোলনের পরিমান <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_withdraw->amount??"" }}" type="number" name="amount" class="form-control" placeholder="ডিপোজিট পরিমান">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="withdraw_by">উত্তোলনকারীর নাম <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_withdraw->withdraw_by??"" }}" type="text" name="withdraw_by" class="form-control" placeholder="ডিপোজিটকারীর নাম">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="purpose">উত্তোলনের কারণ </label>
                          <div class="">
                              <textarea name="purpose" rows="3" class="form-control">{{ $bank_withdraw->purpose??"" }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="purpose">বিবরণ </label>
                          <div class="">
                              <textarea name="description" rows="3" class="form-control">{{ $bank_withdraw->description??"" }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="withdra_date">উত্তোলনের তারিখ <span class="star">*</span></label>
                          <div class="">
                              <input  value="{{ date('d-m-Y', strtotime($bank_withdraw->withdra_date)) }}" class="form-control date" type="text" name="withdra_date">
                          </div>
                      </div>
                  </div>
              </div>

              <hr>

              <div class="">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                              <button id="save" type="submit" class="btn btn-block btn-info">আপডেট করুন</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
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
