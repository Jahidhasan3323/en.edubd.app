@extends('backEnd.master')

@section('mainTitle', 'Provident Fund Management')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center text-temp">Provident Fund Management</h2>
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
    </div>
  </div>
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
      <div class="panel-body">
          <form action="{{ route('provident_fund_store') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="">Select Month</label>
                          <div class="">
                            <select class="form-control" name="month">
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="">Select Year</label>
                          <div class="">
                            <select class="form-control" name="year">
                              <option value="2019">2019</option>
                              <option selected value="2020">2020</option>
                              <option value="2021">2021</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <button id="save" type="submit" class="btn btn-block btn-info" style="margin-top: 20px;">Save</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>

  @isset($provident_funds)
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="panel-body">
          <h3 class="text-center"> {{ date('F', strtotime('1-'.$month.'-'.$year)) }} {{ $year }} </h3>
            <div class="table-responsive">
                <table id="provident_fund" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Serial</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach($provident_funds as $provident_fund)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $provident_fund->employee->user->name }}</td>
                            <td class="text-center">{{ $provident_fund->amount }}</td>
                            <td class="text-center">
                              <form class="" action="{{ route('provident_fund_delete') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $provident_fund->id }}">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash-o"></i></button>
                              </form>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  @endisset

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
