@extends('backEnd.master')

@section('mainTitle', 'বেতন শীট পরিচালনা')
@section('head_section')
  <style>
    .vouchar1, .vouchar2{position: relative; min-height: 500px;}
    .vouchar2{display: none;}
  </style>
@endsection
@section('active_accounts', 'active')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">বেতন শীট</h2>
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
          <form action="{{ route('salary_sheet_store') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="">মাসের নাম নির্বাচন করুন</label>
                          <div class="">
                            <select class="form-control" name="month">
                              <option @if (date('m')=='02') selected @endif value="01">জানুয়ারি</option>
                              <option @if (date('m')=='03') selected @endif value="02">ফেব্রুয়ারি</option>
                              <option @if (date('m')=='04') selected @endif value="03">মার্চ</option>
                              <option @if (date('m')=='05') selected @endif value="04">এপ্রিল</option>
                              <option @if (date('m')=='06') selected @endif value="05">মে</option>
                              <option @if (date('m')=='07') selected @endif value="06">জুন</option>
                              <option @if (date('m')=='08') selected @endif value="07">জুলাই</option>
                              <option @if (date('m')=='09') selected @endif value="08">আগস্ট</option>
                              <option @if (date('m')=='10') selected @endif value="09">সেপ্টেম্বর</option>
                              <option @if (date('m')=='11') selected @endif value="10">অক্টোবর</option>
                              <option @if (date('m')=='12') selected @endif value="11">নভেম্বর</option>
                              <option @if (date('m')=='01') selected @endif value="12">ডিসেম্বর</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="">মাসের নাম নির্বাচন করুন</label>
                          <div class="">
                            <select class="form-control" name="year">
                              <option @if (date('Y')=='2019') selected @endif value="2019">২০১৯</option>
                              <option @if (date('Y')=='2020') selected @endif value="2020">২০২০</option>
                              <option @if (date('Y')=='2021') selected @endif value="2021">২০২১</option>
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <button id="save" type="submit" class="btn btn-block btn-info" style="margin-top: 20px;">বেতন শীট জমা ও ভিঊ</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>

  @isset($salary_sheets)
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;" style="border: 1px solid #ddd;">
      <div id="vouchercontents" class="col-sm-12 row vouchar1" style="width: 100%; position: relative; height: 100%;">
        <div class="panel-body">
          <center>
            <h3>{{ $school->user->name }}</h3>
            <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
            <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
            <h4 class="text-center">বেতন শীট - {{ str_replace($s, $r, date('F', strtotime('1-'.$month.'-'.$year))) }} {{ str_replace($s, $r, $year) }} </h4>
          </center>
          <div class="" style="margin-top: 25px;"></div>
          <div class="">
                <table id="" class="table table-bordered table-hover table-striped">
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
                            <th class="text-center">স্বাক্ষর</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if (count($salary_sheets) < 1)
                        <tr>
                          <td class="text-center" colspan="11">
                            <span style="color:red;">বেতন শীট তৈরির পূর্বে কর্মকর্তা বা কর্মাচারীদের বেতন নির্ধারণ করুন ।</span>
                          </td>
                        </tr>
                      @endif
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
                            <td class="text-center" width="80"></td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <div class="col-md-6 text-left" style="float:left;margin-top:100px;">
                  Powered by: Ehsan Software Email: infoehsansoftware@gmail.com
                </div>
                <div class="col-md-6 text-right" style="float:right;margin-top:100px;">
                   স্বাক্ষর ও সীল
                </div>
            </div>
        </div>
      </div>
      <div align="center" style="width: 100%; margin-bottom: 25px;">
        <button class="btn btn-success" id="PrintVoucher">প্রিন্ট করুন</button>
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

    <script type="text/javascript">
    $(function () {
      $("#PrintVoucher").click(function () {
          var contents = $("#vouchercontents").html();
          var frame1 = $('<iframe />');
          frame1[0].name = "frame1";
          frame1.css({ "position": "absolute", "top": "-1000000px" });
          $("body").append(frame1);
          var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
          frameDoc.document.open();
          //Create a new HTML document.
          frameDoc.document.write('<html><head><title>ভাউচার প্রিন্ট</title>');
          frameDoc.document.write('</head><body>');
          //Append the external CSS file.
          frameDoc.document.write('<link rel="stylesheet" href="{{mix('css/all.css')}}">');
          //Append the DIV contents.
          frameDoc.document.write(contents);
          frameDoc.document.write('</body></html>');
          frameDoc.document.close();
          setTimeout(function () {
              window.frames["frame1"].focus();
              window.frames["frame1"].print();
              frame1.remove();
          }, 500);
      });
    });
    </script>


@endsection
