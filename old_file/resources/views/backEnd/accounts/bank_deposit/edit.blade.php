@extends('backEnd.master')

@section('mainTitle', 'Edit Bank Deposit')
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
        <h2 class="text-center text-temp">Edit Bank Deposit</h2>
      </div>
      <div class="panel-body">
          <form action="{{ route('bank_deposit_update') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{ $bank_deposit->id }}">
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">Select Bank </label>
                          <div class="">
                            <select class="form-control" name="bank_id">
                              <option selected value="{{ $bank_deposit->bank_id }}">{{ $bank_deposit->bank->name??'Select Bank' }}</option>
                              @foreach ($banks as $key => $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">Select Account Type </label>
                          <div class="">
                            <select class="form-control" name="account_type_id">
                              @if ($bank_deposit->account_type_id==0)
                                <option selected value="0">{{ 'Provident Fund' }}</option>
                              @else
                                <option selected value="{{ $bank_deposit->account_type_id }}">{{ $bank_deposit->account_type->name??'' }}</option>
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
                          <label class="" for="account_number">Account No. <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_deposit->account_number??"" }}" type="text" name="account_number" class="form-control" placeholder="Account ">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="deposit_number">Deposit No. <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_deposit->deposit_number??"" }}" type="text" name="deposit_number" class="form-control" placeholder="Deposit Number">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="amount">Deposit Amount <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_deposit->amount??"" }}" type="number" name="amount" class="form-control" placeholder="Deposit Amount">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="deposit_by">Dipisitor Name<span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $bank_deposit->deposit_by??"" }}" type="text" name="deposit_by" class="form-control" placeholder="Dipisitor Name">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="purpose">Purpose </label>
                          <div class="">
                              <textarea name="purpose" rows="3" class="form-control">{{ $bank_deposit->purpose??"" }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="purpose">Description </label>
                          <div class="">
                              <textarea name="description" rows="3" class="form-control">{{ $bank_deposit->description??"" }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="deposit_date">Deposit Date <span class="star">*</span></label>
                          <div class="">
                              <input  value="{{ date('d-m-Y', strtotime($bank_deposit->deposit_date)) }}" class="form-control date" type="text" name="deposit_date">
                          </div>
                      </div>
                  </div>
              </div>

              <hr>

              <div class="">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                              <button id="save" type="submit" class="btn btn-block btn-info">Update</button>
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
  <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
  <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
      $('#commitee_tbl').DataTable();
  } );
  </script>
@endsection
