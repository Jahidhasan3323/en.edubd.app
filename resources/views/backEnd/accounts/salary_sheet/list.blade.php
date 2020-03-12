@extends('backEnd.master')

@section('mainTitle', 'Salary Sheet Management')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">Salary Sheet</h2>
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
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;" style="border: 1px solid #ddd;">
      <div class="panel-body">
          <form action="{{ route('salary_sheet_list') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="">Select Month</label>
                          <div class="">
                            <select class="form-control" name="month">
                                <option @if (date('m')=='02') selected @endif value="01">January</option>
                                <option @if (date('m')=='03') selected @endif value="02">February</option>
                                <option @if (date('m')=='04') selected @endif value="03">March</option>
                                <option @if (date('m')=='05') selected @endif value="04">April</option>
                                <option @if (date('m')=='06') selected @endif value="05">May</option>
                                <option @if (date('m')=='07') selected @endif value="06">June</option>
                                <option @if (date('m')=='08') selected @endif value="07">July</option>
                                <option @if (date('m')=='09') selected @endif value="08">August</option>
                                <option @if (date('m')=='10') selected @endif value="09">September</option>
                                <option @if (date('m')=='11') selected @endif value="10">October</option>
                                <option @if (date('m')=='12') selected @endif value="11">November</option>
                                <option @if (date('m')=='01') selected @endif value="12">December</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="">Select Year</label>
                          <div class="">
                            <select class="form-control" name="year">
                                <option @if (date('Y')=='2019') selected @endif value="2019">2019</option>
                                <option @if (date('Y')=='2020') selected @endif value="2020">2020</option>
                                <option @if (date('Y')=='2021') selected @endif value="2021">2021</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <button id="save" type="submit" class="btn btn-block btn-info" style="margin-top: 20px;">Salary Sheet</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>

  @isset($salary_sheets)
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;" style="border: 1px solid #ddd;">
        <div class="panel-body">
          <h3 class="text-center"> {{ str_replace($s, $r, date('F', strtotime('1-'.$month.'-'.$year))) }} {{ str_replace($s, $r, $year) }} </h3>
            <div class="table-responsive">
                <table id="provident_fund" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">আইডি</th>
                            <th class="text-center">নাম</th>
                            <th class="text-center">পদবী</th>
                            <th class="text-center">বেসিক</th>
                            <th class="text-center">অন্যান্য (+)</th>
                            <th class="text-center">অন্যান্য (-) </th>
                            <th class="text-center">প্রভিডেন্ট</th>
                            <th class="text-center">অনুপস্থিত</th>
                            <th class="text-center">অগ্রিম</th>
                            <th class="text-center">নেট বেতন</th>
                            <th class="text-center">একশন</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($salary_sheets as $salary_sheet)
                        <tr>
                            <td class="text-center">{{ $salary_sheet->employee->staff_id }}</td>
                            <td class="text-center">{{ $salary_sheet->employee->user->name??'' }}</td>
                            <td class="text-center">{{ $salary_sheet->employee->designation->name??"" }}</td>
                            <td class="text-center">{{ $salary_sheet->basic }}</td>
                            <td class="text-center">{{ number_format($salary_sheet->basic_increase, 2) }}</td>
                            <td class="text-center">{{ number_format($salary_sheet->basic_decrease, 2) }}</td>
                            <td class="text-center">{{ number_format($salary_sheet->provident_fund, 2) }}</td>
                            <td class="text-center">{{ number_format($salary_sheet->absent_fine, 2) }}</td>
                            <td class="text-center">{{ number_format($salary_sheet->advanced_paid, 2) }}</td>
                            <td class="text-center">{{ number_format($salary_sheet->net_salary, 2) }}</td>
                            <td class="text-center">
                              <form class="action_btn" action="{{ route('salary_sheet_delete') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $salary_sheet->id }}">
                                <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i> </button>
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
