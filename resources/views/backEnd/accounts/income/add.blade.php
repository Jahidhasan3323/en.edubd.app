@extends('backEnd.master')

@section('mainTitle', 'Add Income')
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
      <h2 class="text-center text-temp">Add income</h2>
    </div>
    <div class="col-md-6" style="padding: 15px;">
      <h2 class="text-center text-temp">Print Vouchar</h2>
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
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd;">
        <div class="panel-body">
            <form action="{{ route('income_store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label for="payment_date">Payment Date<span class="star">*</span></label>
                          <div class="">
                              <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="payment_date" id="payment_date">
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="payment_by">Payment By<span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('payment_by')}}" type="text" name="payment_by" class="form-control" placeholder="Payment By">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="mobile">Mobile Number </label>
                          <div class="">
                              <input value="{{old('mobile')}}" type="number" name="mobile" class="form-control" placeholder="Mobile - 01xxxxxxxxx">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="amount">Amount <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('amount')}}" type="number" name="amount" class="form-control" placeholder="ENter Aoount">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="reference">Reference </label>
                          <div class="">
                              <input value="{{old('reference')}}" type="text" name="reference" class="form-control" placeholder="Reference">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="payment_method">Payment Method <span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" name="payment_method" id="payment_method">
                                  <option value="Cash">Cash</option>
                                  <option value="Bkash">Bkash</option>
                                  <option value="Rocket">Rocket</option>
                                  <option value="Credit-Card">Credit-Card</option>
                                  <option value="Debit-Card">Debit-Card</option>
                                  <option value="Bank">Bank</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="fund_id">Select Fund <span class="star">*</span></label>
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
                          <label class="" for="description">Description</label>
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
                                <button id="save" type="submit" class="btn btn-block btn-info">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

  @isset($income_view)
    <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px;border: 1px solid #ddd;">
      <div id="vouchercontents" class="panel col-sm-12" style="width: 100%; position: relative; height: 100%;">
        <div id="voucher" class="row vouchar1" style=" height: 50%;">
          <center>
            <h3>{{ $school->user->name }}</h3>
            <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
            <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
            <h3>{{ $account_setting->voucher_title }}</h3>
            <span>Office Copy</span>
          </center>
          <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
            Serial: {{ $income_view->serial }}
          </div>
          <div class="col-md-6 text-right" style="padding-bottom: 15px;">
            Date: {{ $income_view->payment_date }}
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th width="40%">Name</th>
                      <td>{{ $income_view->payment_by??'' }}</td>
                    </tr>
                    <tr>
                      <th width="40%">Mobile</th>
                      <td> {{$income_view->mobile}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6" style="width: 50%; display:inline-block;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th width="40%">Payment Method</th>
                      <td>{{$income_view->payment_method}}</td>
                    </tr>
                    <tr>
                      <th width="40%">Reference</th>
                      <td>{{ $income_view->reference??'' }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">Serial</th>
                      <th class="text-center">Description</th>
                      <th class="text-center">Fund</th>
                      <th class="text-center">Amount</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td class="text-center">1</td>
                    <td class="text-left">{{ $income_view->description??'' }}</td>
                    <td class="text-left">{{ $income_view->fund->name??'' }}</td>
                    <td class="text-right">{{ number_format($income_view->amount, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td class="text-right"> <b>{{ number_format($income_view->amount, 2) }}</b> </td>
                  </tr>
              </tbody>
          </table>
          </div>
          <div class="col-md-12 text-right" style="margin-top: 50px;">
            Receiver Signature
          </div>
        </div>
        <div class="" style="position:relative">
            <div id="voucher" class="row vouchar2" style=" height: 50%;">
              <center>
                <h3>{{ $school->user->name }}</h3>
                <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
                <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
                <h3>{{ $account_setting->voucher_title }}</h3>
              </center>
              <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
                Serial: {{ $income_view->serial }}
              </div>
              <div class="col-md-6 text-right" style="padding-bottom: 15px;">
                Date {{ $income_view->payment_date }}
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th width="40%">Name</th>
                          <td>{{ $income_view->payment_by??'' }}</td>
                        </tr>
                        <tr>
                          <th width="40%">Mobile</th>
                          <td> {{$income_view->mobile}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-6" style="width: 50%; display:inline-block;">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th width="40%">Payment Method</th>
                          <td>{{$income_view->payment_method}}</td>
                        </tr>
                        <tr>
                          <th width="40%">Reference</th>
                          <td>{{ $income_view->reference??'' }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th class="text-center">Serial</th>
                          <th class="text-center">Description</th>
                          <th class="text-center">Fund</th>
                          <th class="text-center">Amount</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td class="text-left">{{ $income_view->description??'' }}</td>
                        <td class="text-left">{{ $income_view->fund->name??'' }}</td>
                        <td class="text-right">{{ number_format($income_view->amount, 2) }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right">Total</td>
                        <td class="text-right"> <b>{{ number_format($income_view->amount, 2) }}</b> </td>
                      </tr>
                  </tbody>
              </table>
              </div>
              <div class="col-md-12 text-left" style="position: absolute;left: 2%;bottom: 0%;">
                Powered by: Ehsan Software Email: infoehsansoftware@gmail.com
              </div>
              <div class="col-md-12 text-right" style="margin-top: 50px;">
                Receiver Signature
              </div>
            </div>
        </div>
      </div>
      <div align="center" style="width: 100%; margin-bottom: 25px;">
        <button class="btn btn-success" id="PrintVoucher">Print</button>
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
      frameDoc.document.write('<html><head><title>Print Vouchar</title>');
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
