@extends('backEnd.master')

@section('mainTitle', 'Bank Deposit Management')
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
        <h2 class="text-center text-temp">Add Bank Deposit</h2>
      </div>
      <div class="panel-body">
          <form action="{{ route('bank_deposit_store') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">Select Bank</label>
                          <div class="">
                            <select class="form-control" name="bank_id">
                              @foreach ($banks as $key => $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="">Select Account Type</label>
                          <div class="">
                            <select class="form-control" name="account_type_id">
                              <option value="0">Provident Fund</option>
                              @foreach ($account_types as $key => $account_type)
                                <option value="{{ $account_type->id }}">{{ $account_type->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="account_number">Account Number <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('account_number')}}" type="text" name="account_number" class="form-control" placeholder="Account Number">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="deposit_number">Deposit Number<span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('deposit_number')}}" type="text" name="deposit_number" class="form-control" placeholder="Deposit Number">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="amount">Deposit Amount <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('amount')}}" type="number" name="amount" class="form-control" placeholder="Enter Deposit Amount">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="deposit_by">Deposit By <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('deposit_by')}}" type="text" name="deposit_by" class="form-control" placeholder="Deposit By">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="purpose">Purpose</label>
                          <div class="">
                              <textarea name="purpose" rows="3" class="form-control"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="purpose">Description </label>
                          <div class="">
                              <textarea name="description" rows="3" class="form-control"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="deposit_date">Deposit Date<span class="star">*</span></label>
                          <div class="">
                              <input  value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="deposit_date">
                          </div>
                      </div>
                  </div>
              </div>

              <hr>

              <div class="">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                              <button id="save" type="submit" class="btn btn-block btn-info">Save</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
    <div class="col-md-12">
      <h2 class="text-center text-temp">Deposit Management</h2>
    </div>
      <div class="panel-body">
          <div class="table-responsive">
              <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">Serial</th>
                          <th class="text-center">Bank</th>
                          <th class="text-center">Account Type</th>
                          <th class="text-center">Account Number</th>
                          <th class="text-center">Deposit Number</th>
                          <th class="text-center">Amount</th>
                          <th class="text-center">Depositor</th>
                          <th class="text-center">Cause</th>
                          <th class="text-center">Description</th>
                          <th class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($bank_deposits as $bank_deposit)
                      <tr>
                          <td class="text-center">{{$i++}}</td>
                          <td class="text-center">{{$bank_deposit->bank->name??''}}</td>
                          <td class="text-center">{{$bank_deposit->account_type->name??'Provident Fund'}}</td>
                          <td class="text-center">{{$bank_deposit->account_number}}</td>
                          <td class="text-center">{{$bank_deposit->deposit_number}}</td>
                          <td class="text-center">{{$bank_deposit->amount}}</td>
                          <td class="text-center">{{$bank_deposit->deposit_by}}</td>
                          <td class="text-center">{{$bank_deposit->purpose}}</td>
                          <td class="text-center">{{$bank_deposit->description}}</td>
                          <td class="text-center">
                            <a href="{{ route('bank_deposit_edit', $bank_deposit->id) }}"> <button type="button" class="btn btn-info btn-sm" style="margin:5px;"><i class="fa fa-pencil-square-o"></i></button> </a>
                            <form class="" action="{{ route('bank_deposit_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $bank_deposit->id }}">
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash-o"></i></button>
                            </form>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
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
