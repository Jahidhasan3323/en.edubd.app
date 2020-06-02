@extends('backEnd.master')

@section('mainTitle', 'Advanced Salary Management')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center text-temp">Advanced Salary Management</h2>
    </div>
    <div class="col-md-6">
      <h2 class="text-center text-temp">Add Advanced Salary</h2>
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
  @isset($advanced_paids)
    <div class="panel col-md-7" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
        <div class="panel-body">
            <div class="table-responsive">
                <table id="advanced_paid" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach($advanced_paids as $advanced_paid)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $advanced_paid->employee->user->name??'' }}</td>
                            <td class="text-center">{{ $advanced_paid->amount }}</td>
                            <td class="text-center">{{ $advanced_paid->description }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($advanced_paid->payment_date)) }}</td>
                            <td class="text-center">
                              <form class="" action="{{ route('advanced_paid_delete') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $advanced_paid->id }}">
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
  @endisset
  <div class="panel col-md-5" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
      <div class="panel-body">
          <form action="{{ route('advanced_paid_store') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="">Select Month <span style="color:red;">*</span> </label>
                        <div class="">
                          <select class="form-control" name="month">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">Marh</option>
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="">Select Month <span style="color:red;">*</span> </label>
                        <div class="">
                          <select class="form-control" name="year">
                            <option value="2019">2019</option>
                            <option selected value="2020">2020</option>
                            <option value="2021">2021</option>
                          </select>
                        </div>
                    </div>
                </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="">Select Employee <span style="color:red;">*</span> </label>
                          <div class="">
                            <select class="form-control" name="employee_id">
                              @foreach ($employees as $key => $employee)
                                <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="">Amount <span style="color:red;">*</span> </label>
                          <div class="">
                            <input type="number" name="amount" class="form-control">
                          </div>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="">Description</label>
                          <div class="">
                            <textarea name="description" rows="3" class="form-control"></textarea>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="">Payment Date <span style="color:red;">*</span> </label>
                          <div class="">
                            <input type="text" name="payment_date" value="{{ date('d-m-Y') }}" class="form-control date">
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-12">
                      <div class="form-group">
                          <button id="save" type="submit" class="btn btn-block btn-info" style="margin-top: 20px;">Save</button>
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
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#advanced_paid').DataTable();
    } );
    </script>
    <script type="text/javascript">
      $( function() {
          $( ".date" ).datepicker({
              dateFormat: 'dd-mm-yy',
              changeMonth: true,
              changeYear: true
          }).val();
      } );
    </script>


@endsection
