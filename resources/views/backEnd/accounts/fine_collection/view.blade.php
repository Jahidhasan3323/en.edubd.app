@extends('backEnd.master')

@section('mainTitle', 'জরিমানা কালেকশন প্রিন্ট')
@section('head_section')
    <style>
      .vouchar1, .vouchar2{position: relative; min-height: 1000px;}
      .vouchar2{display: none;}
      }
    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">জরিমানা কালেকশন ভাউচার প্রিন্ট করুন</h2>
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
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
    <div id="vouchercontents" class="panel col-sm-12" style="width: 100%; position: relative; height: 100%;">
      <div id="voucher" class="row vouchar1" style="width: 100%; position: relative; height: 100%; overflow: hidden;">
        <center>
          <h3>{{ $school->user->name }}</h3>
          <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
          <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
          <h3>{{ $account_setting->voucher_title }}</h3>
          <span>শিক্ষার্থী কপি</span>
        </center>
        <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
          সিরিয়ালঃ {{ $fine_collection->serial }}
        </div>
        <div class="col-md-6 text-right" style="padding-bottom: 15px;">
          তারিখঃ {{ $fine_collection->payment_date }}
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>নাম</th>
                    <td>{{ $student->user->name??'' }}</td>
                  </tr>
                  <tr>
                    <th>আইডি</th>
                    <td>{{ $student->student_id??'' }}</td>
                  </tr>
                  <tr>
                    <th>শ্রেণী</th>
                    <td>{{$student->masterClass->name}}</td>
                  </tr>
                  <tr>
                    <th>বিভাগ</th>
                    <td>{{$student->group}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6" style="width: 50%; display:inline-block;">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>শাখা</th>
                    <td>{{$student->section}}</td>
                  </tr>
                  <tr>
                    <th>শিফট</th>
                    <td>{{ $student->shift??'' }}</td>
                  </tr>
                  <tr>
                    <th>রোল</th>
                    <td>{{$student->roll}}</td>
                  </tr>
                  <tr>
                    <th>মোবাইল</th>
                    <td> {{$student->user->mobile}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <table class="table table-bordered" style="margin-top: 50px;">
            <thead>
                <tr>
                    <th class="text-center">ক্রমিক</th>
                    <th class="text-center">বিবরণ</th>
                    <th class="text-center">পরিমান</th>
                </tr>
            </thead>
            <tbody>
              @php
              $total = 0;
                $i = 1;
              @endphp
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>মোট জরিমানা- <br> {{ $fine_collection->description }}</td>
                  <td class="text-right"> <b>{{ number_format($fine_collection->amount, 2) }}</b> </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">জরিমানা পেইড </td>
                  <td class="text-right"> - {{ number_format($fine_collection->paid, 2) }} </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">জরিমানা মওকুফ</td>
                  <td class="text-right">- {{ number_format($fine_collection->waiver, 2) }}</td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">বর্তমান মোট বাকি</td>
                  <td class="text-right"> <b>{{ number_format($fine_collection->amount-($fine_collection->paid+$fine_collection->waiver), 2) }}</b> </td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="col-md-12 text-left" style="position: absolute;left: 2%;bottom: 0%;">
          Powered by: Ehsan Software Email: infoehsansoftware@gmail.com
        </div>
        <div class="col-md-12 text-right" style="position: absolute;right: 2%;bottom: 0%;">
          আদায়কারীর স্বাক্ষর ও সীল
        </div>
      </div>
      <div class="" style="height: 0.1px;">

      </div>
      <div id="" class="row vouchar2" style="width: 100%; position: relative; height: 100%; overflow: hidden;">
        <center>
          <h3>{{ $school->user->name }}</h3>
          <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
          <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
          <h3>{{ $account_setting->voucher_title }}</h3>
          <span>অফিস কপি</span>
        </center>
        <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
          সিরিয়ালঃ {{ $fine_collection->serial }}
        </div>
        <div class="col-md-6 text-right" style="padding-bottom: 15px;">
          তারিখঃ {{ $fine_collection->payment_date }}
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>নাম</th>
                    <td>{{ $student->user->name??'' }}</td>
                  </tr>
                  <tr>
                    <th>আইডি</th>
                    <td>{{ $student->student_id??'' }}</td>
                  </tr>
                  <tr>
                    <th>শ্রেণী</th>
                    <td>{{$student->masterClass->name}}</td>
                  </tr>
                  <tr>
                    <th>বিভাগ</th>
                    <td>{{$student->group}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6" style="width: 50%; display:inline-block;">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>শাখা</th>
                    <td>{{$student->section}}</td>
                  </tr>
                  <tr>
                    <th>শিফট</th>
                    <td>{{ $student->shift??'' }}</td>
                  </tr>
                  <tr>
                    <th>রোল</th>
                    <td>{{$student->roll}}</td>
                  </tr>
                  <tr>
                    <th>মোবাইল</th>
                    <td> {{$student->user->mobile}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <table class="table table-bordered" style="margin-top: 50px;">
            <thead>
                <tr>
                    <th class="text-center">ক্রমিক</th>
                    <th class="text-center">বিবরণ</th>
                    <th class="text-center">পরিমান</th>
                </tr>
            </thead>
            <tbody>
              @php
              $total = 0;
                $i = 1;
              @endphp
                <tr>
                  <td class="text-center">{{ $i++ }}</td>
                  <td>মোট জরিমানা- <br> {{ $fine_collection->description }}</td>
                  <td class="text-right"> <b>{{ number_format($fine_collection->amount, 2) }}</b> </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">জরিমানা পেইড </td>
                  <td class="text-right"> - {{ number_format($fine_collection->paid, 2) }} </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">জরিমানা মওকুফ</td>
                  <td class="text-right">- {{ number_format($fine_collection->waiver, 2) }}</td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">বর্তমান মোট বাকি</td>
                  <td class="text-right"> <b>{{ number_format($fine_collection->amount-($fine_collection->paid+$fine_collection->waiver), 2) }}</b> </td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="col-md-12 text-left" style="position: absolute;left: 2%;bottom: 0%;">
          Powered by: Ehsan Software Email: infoehsansoftware@gmail.com
        </div>
        <div class="col-md-12 text-right" style="position: absolute;right: 2%;bottom: 0%;">
          আদায়কারীর স্বাক্ষর ও সীল
        </div>
      </div>
    </div>
    <div align="center" style="width: 100%; margin-bottom: 10px">
      <button class="btn btn-success" id="PrintVoucher">প্রিন্ট করুন</button>
    </div>
  </div>
@endsection
@section('script')
  <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
  <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
      $('#commitee_tbl').DataTable();
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
