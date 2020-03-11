@extends('backEnd.master')

@section('mainTitle', 'খরচ বা ব্যয় যোগ করুন')
@section('head_section')
    <style>
      .vouchar1, .vouchar2{position: relative; min-height: 500px;}
      .vouchar2{display: none;}
    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
  <div class="row">
    <div class="col-md-6" style="padding: 15px;">
      <h2 class="text-center text-temp">খরচ বা ব্যয় যোগ করুন</h2>
    </div>
    <div class="col-md-6" style="padding: 15px;">
      <h2 class="text-center text-temp">ভাউচার প্রিন্ট করুন</h2>
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
  </div>
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
        <div class="panel-body">
            <form action="{{ route('expense_store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="payment_date">প্রদানের তারিখ <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="payment_date" id="payment_date">
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="received_by">গ্রহণকারীর নাম <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('received_by')}}" type="text" name="received_by" class="form-control" placeholder="গ্রহণকারীর নাম লিখুন">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="mobile">গ্রহণকারীর মোবাইল </label>
                          <div class="">
                              <input value="{{old('mobile')}}" type="text" name="mobile" class="form-control" placeholder=" মোবাইল - 01xxxxxxxxx">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="amount">পরিমান <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('amount')}}" type="number" name="amount" class="form-control" placeholder="পরিমান দিন (ইংরেজিতে)">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="reference">রেফারেন্স </label>
                          <div class="">
                              <input value="{{old('reference')}}" type="text" name="reference" class="form-control" placeholder="রেফারেন্স">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="payment_method">পেমেন্ট মেথড <span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" name="payment_method" id="payment_method">
                                  <option value="ক্যাশ">ক্যাশ</option>
                                  <option value="বিকাশ">বিকাশ</option>
                                  <option value="রকেট">রকেট</option>
                                  <option value="ক্রেডিট কার্ড">ক্রেডিট কার্ড</option>
                                  <option value="ডেবিট কার্ড">ডেবিট কার্ড</option>
                                  <option value="ব্যাংক">ব্যাংক</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="fund_id">ফান্ড নির্বাচন করুন <span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" name="fund_id" id="fund_id">
                                @foreach ($funds as $fund)
                                  <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="fund_id">বিবরণ</label>
                          <div class="">
                              <textarea name="description" rows="3" class="form-control"></textarea>
                          </div>
                      </div>
                  </div>
                </div>

                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

  @isset($expense_view)
    <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
      <div id="vouchercontents" class="panel col-sm-12" style="width: 100%; position: relative; height: 100%;">
        <div id="voucher" class="row vouchar1" style=" height: 50%;">
          <center>
            <h3>{{ $school->user->name }}</h3>
            <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
            <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
            <h3>{{ $account_setting->voucher_title }}</h3>
            <span>অফিস কপি</span>
          </center>
          <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
            সিরিয়ালঃ {{ $expense_view->serial }}
          </div>
          <div class="col-md-6 text-right" style="padding-bottom: 15px;">
            তারিখঃ {{ $expense_view->payment_date }}
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th width="40%">নাম</th>
                      <td>{{ $expense_view->received_by??'' }}</td>
                    </tr>
                    <tr>
                      <th width="40%">মোবাইল</th>
                      <td> {{$expense_view->mobile}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6" style="width: 50%; display:inline-block;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th width="40%">পেমেন্ট মেথোড</th>
                      <td>{{$expense_view->payment_method}}</td>
                    </tr>
                    <tr>
                      <th width="40%">রেফারেন্স</th>
                      <td>{{ $expense_view->reference??'' }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">ক্রমিক</th>
                      <th class="text-center">বিবরণ</th>
                      <th class="text-center">ফান্ড</th>
                      <th class="text-center">পরিমান</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td class="text-center">1</td>
                    <td class="text-left">{{ $expense_view->description??'' }}</td>
                    <td class="text-left">{{ $expense_view->fund->name??'' }}</td>
                    <td class="text-right">{{ number_format($expense_view->amount, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right">সর্বমোট</td>
                    <td class="text-right"> <b>{{ number_format($expense_view->amount, 2) }}</b> </td>
                  </tr>
              </tbody>
          </table>
          <div class="col-md-12 text-right" style="margin-top: 50px;">
            আদায়কারীর স্বাক্ষর ও সীল
          </div>
          </div>
        </div>
        <div id="voucher" class="row vouchar2" style=" height: 50%;">
          <center>
            <h3>{{ $school->user->name }}</h3>
            <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
            <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
            <h3>{{ $account_setting->voucher_title }}</h3>
            <span>গ্রহণকারীর কপি</span>
          </center>
          <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
            সিরিয়ালঃ {{ $expense_view->serial }}
          </div>
          <div class="col-md-6 text-right" style="padding-bottom: 15px;">
            তারিখঃ {{ $expense_view->payment_date }}
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th width="40%">নাম</th>
                      <td>{{ $expense_view->received_by??'' }}</td>
                    </tr>
                    <tr>
                      <th width="40%">মোবাইল</th>
                      <td> {{$expense_view->mobile}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6" style="width: 50%; display:inline-block;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th width="40%">পেমেন্ট মেথোড</th>
                      <td>{{$expense_view->payment_method}}</td>
                    </tr>
                    <tr>
                      <th width="40%">রেফারেন্স</th>
                      <td>{{ $expense_view->reference??'' }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">ক্রমিক</th>
                      <th class="text-center">বিবরণ</th>
                      <th class="text-center">ফান্ড</th>
                      <th class="text-center">পরিমান</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td class="text-center">1</td>
                    <td class="text-left">{{ $expense_view->description??'' }}</td>
                    <td class="text-left">{{ $expense_view->fund->name??'' }}</td>
                    <td class="text-right">{{ number_format($expense_view->amount, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right">সর্বমোট</td>
                    <td class="text-right"> <b>{{ number_format($expense_view->amount, 2) }}</b> </td>
                  </tr>
              </tbody>
          </table>
          <div class="col-md-12 text-left" style="position: absolute;left: 2%;bottom: 0%;">
            Powered by: Ehsan Software Email: infoehsansoftware@gmail.com
          </div>
          <div class="col-md-12 text-right" style="margin-top: 50px;">
            আদায়কারীর স্বাক্ষর ও সীল
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
