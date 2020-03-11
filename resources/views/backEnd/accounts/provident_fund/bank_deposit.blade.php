@extends('backEnd.master')

@section('mainTitle', 'প্রভিডেন্ট ফান্ড পরিচালনা')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">ব্যাংকে জমা প্রভিডেন্ট ফান্ড</h2>
    </div>
  </div>
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
      <div class="panel-body">
          <div class="table-responsive">
              <table id="provident_fund" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th class="text-center">ক্রমিক</th>
                        <th class="text-center">ব্যাংকের নাম</th>
                        <th class="text-center">একাউন্ট নাম্বার</th>
                        <th class="text-center">ডিপোজিট নাম্বার</th>
                        <th class="text-center">জমাকারী</th>
                        <th class="text-center">পরিমান</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($bank_deposits as $bank_deposit)
                      <tr>
                          <td class="text-center">{{ $i++ }}</td>
                          <td class="text-center">{{ $bank_deposit->bank->name??'' }}</td>
                          <td class="text-center">{{ $bank_deposit->account_number }}</td>
                          <td class="text-center">{{ $bank_deposit->deposit_number }}</td>
                          <td class="text-center">{{ $bank_deposit->deposit_by }}</td>
                          <td class="text-center">{{ $bank_deposit->amount }}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>

@endsection
@section('script')

    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#provident_fund').DataTable();
    } );
    </script>


@endsection
