@extends('backEnd.master')

@section('mainTitle', 'Fee Collection')
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
        <div class="col-md-6">
          <div class="page-header">
              <h2 class="text-center text-temp"> Fee Collection </h2>
          </div>
        </div>
        @isset($fee_collection_form)
          <div class="col-md-6" style="padding: 15px;">
            <h2 class="text-center text-temp">{{ $student->user->name }}</h2>
            @isset($fee_status)
            <p class="text-center" style="color: red; font-size: 20px;">
              @if ($fee_status)
                <span style="color:black;"> Total Due = </span>{{ number_format($current_due, 2) }}, <span style="color:black;">সর্বশেষ পেইডঃ</span> {{ str_replace($s, $r, date('F Y', strtotime($fee_status->payment_date))) }}
              @else
               No payment till now.
              @endif
            </p>
          @endisset
          </div>
        @endisset

        @isset($view_collection)
          <div class="col-md-6" style="padding: 15px;">
            <h2 class="text-center text-temp">Print Vouchar</h2>
          </div>
        @endisset
        <div class="col-md-12">
          @if(session('success_msg'))
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{session('success_msg')}}
            </div>
          @endif
          @if(session('error_msg'))
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{session('error_msg')}}
            </div>
          @endif
          @if($errors->any())
              @foreach($errors->all() as $error)
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{$error}}
              </div>
            @endforeach
          @endif
        </div>
  </div>
  <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
      <div class="panel-body">
          <form name="add-result-form" action="{{route('fee_student_search')}}" method="post" >
                  {{csrf_field()}}
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="class">Class <span class="star">*</span></label>
                          <select name="master_class_id" id="master_class_id" class="form-control" required="">
                              <option value="">Select Class</option>
                              @foreach($classes as $class)
                                  <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="group1">Group <span class="star">*</span></label>
                          <select name="group_class_id" id="group_class_id" class="form-control" required="">
                              <option value="">Select Group</option>
                              @foreach($groups as $group_class)
                                <option value="{{$group_class->name}}">{{$group_class->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                          <label class="" for="shift">Shift <span class="star">*</span></label>
                          <select name="shift" id="shift" class="form-control" required="">
                              <option value="">Select Shift</option>
                              <option value="Morning">Morning</option>
                              <option value="Day">Day</option>
                              <option value="Evening">Evening</option>
                              <option value="Night">Night</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="section1">Section <span class="star">*</span></label>
                          <select name="section" id="section" class="form-control" required="">
                              <option value=""> Select Section </option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                              @foreach($units as $unit)
                              <option value="{!!$unit->name!!}">{!!$unit->name!!}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="roll">Class roll <span class="star">*</span></label>
                          <select name="roll" id="roll" class="form-control" required="">
                              <option value="">Select Class Roll</option>
                          </select>
                      </div>
                  </div>

              </div>
              <div class="">
                  <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                          <div class="form-group">
                              <button id="save" type="submit" class="btn btn-block btn-success">Search</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
  @isset($fee_collection_form)
    <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
          <div class="panel-body">
              <form action="{{ route('fee_collection_store') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input type="hidden" name="student_id" value="{{ $student->id }}">
                  <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="payment_date">Payment Date <span class="star">*</span></label>
                            <div class="">
                                <input value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="payment_date" id="payment_date">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="" for="payment_by">Payment By<span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('payment_by')}}" type="text" name="payment_by" class="form-control" placeholder="Payment By">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="" for="mobile">Mobile Number</label>
                            <div class="">
                                <input value="{{old('mobile')}}" type="text" name="mobile" class="form-control" placeholder="Mobile - 01xxxxxxxxx">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="" style="float: right; margin-bottom: 10px;">
                        <a id="add_row" class="btn btn-primary btn-sm pull-right add-record" data-added="0" title="Add New Row"><i class="glyphicon glyphicon-plus"></i></a>
                      </div>
                      <table class="table table-bordered" id="tbl_posts">
                        <thead>
                          <tr>
                            <th class="text-center" width="50%">Fee Category</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Waiver</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="rec-1">
                            <td>
                              <div class="form-group">
                                <select id="fee_cat-1" class="form-control fee_cat" name="fee_cats[]">
                                  <option value="">Select Fee Category</option>
                                  @foreach ($fee_categories as $key => $fee_category)
                                    <option value="{{ $fee_category->id }}">{{ $fee_category->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </td>
                            <td id="amount-1" class="text-right fees_amount">
                              0.00
                            </td>
                            <td>
                              <input type="text" class="form-control text-right waiver" id="waiver-1" name="waivers[]" value="0">
                            </td>
                            <td>
                              <a id="remove_row-1" class="btn btn-primary btn-sm delete-record"><i class="glyphicon glyphicon-trash" title="মুছে ফেলুন"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row bg-primary" style="margin: 15px 0px;">
                        <div class="col-md-4">
                          <p class="text-center">Total Fee <br> <span id="total_fees">0.00 </span></p>
                        </div>
                        <div class="col-md-4">
                          <p class="text-center">Total Waiver <br> <span id="total_waiver">0.00 </span></p>
                        </div>
                        <div class="col-md-4">
                          <p class="text-center">Payable <br> <span id="payable">0.00 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="" for="paid">Paid <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('paid')}}" type="number" name="paid" class="form-control" placeholder="Paid">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="" for="due_paid">Due paid </label>
                            <div class="">
                                <input value="{{old('due_paid')}}" type="number" name="due_paid" class="form-control" placeholder="Due paid">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="" for="reference">Reference </label>
                            <div class="">
                                <input value="{{old('reference')}}" type="text" name="reference" class="form-control" placeholder="Reference">
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
  @endisset

  @isset($view_collection)
    <div class="panel col-sm-6" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
      <div id="vouchercontents" class="panel col-sm-12" style="width: 100%; position: relative; height: 100%;">
        <div id="voucher" class="row vouchar1" style="width: 100%; position: relative; height: 100%; overflow: hidden;">
          <center>
            <h3>{{ $school->user->name }}</h3>
            <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
            <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
            <h3>{{ $account_setting->voucher_title??'' }}</h3>
            <span>Student Copy</span>
          </center>
          <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
            Serial: {{ $view_collection->serial }}
          </div>
          <div class="col-md-6 text-right" style="padding-bottom: 15px;">
            Date {{ $view_collection->payment_date }}
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Name</th>
                      <td>{{ $student->user->name??'' }}</td>
                    </tr>
                    <tr>
                      <th>ID No</th>
                      <td>{{ $student->student_id??'' }}</td>
                    </tr>
                    <tr>
                      <th>Class</th>
                      <td>{{$student->masterClass->name}}</td>
                    </tr>
                    <tr>
                      <th>Group</th>
                      <td>{{$student->group}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6" style="width: 50%; display:inline-block;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Section</th>
                      <td>{{$student->section}}</td>
                    </tr>
                    <tr>
                      <th>Shift</th>
                      <td>{{ $student->shift??'' }}</td>
                    </tr>
                    <tr>
                      <th>Roll</th>
                      <td>{{$student->roll}}</td>
                    </tr>
                    <tr>
                      <th>Mobile</th>
                      <td> {{$student->user->mobile}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">SL</th>
                      <th class="text-center">Description</th>
                      <th class="text-center">Amount</th>
                  </tr>
              </thead>
              <tbody>
                @php
                $total = 0;
                  $i = 1;
                @endphp
                @foreach ($fee_categories as $key => $category)
                  <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td class="text-left">
                      {{ $category->fee_category->name??'' }} -
                      @if ($account_setting->subcategory_view=='1') <br>
                        @foreach ($category->fee_category->sub_categories($category->fee_category->id, $student->master_class_id, $group->id) as $key => $sub_category)
                          <li>{{ $sub_category->name }}-{{ $sub_category->amount }}</li>
                        @endforeach
                      @else
                        @foreach ($category->fee_category->sub_categories($category->fee_category->id, $student->master_class_id, $group->id) as $key => $sub_category)
                          {{ $sub_category->name }}-{{ $sub_category->amount }},
                        @endforeach
                      @endif

                    </td>
                    <td class="text-right">{{ number_format($category->amount, 2) }}</td>
                  </tr>
                  @php
                    $total += $category->amount;
                  @endphp
                @endforeach
                  <tr>
                    <td colspan="2" class="text-right">Total Fee</td>
                    <td class="text-right"> <b>{{ number_format($total, 2) }}</b> </td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Total Waiver</td>
                    <td class="text-right">- {{ number_format($view_collection->waiver, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Paid</td>
                    <td class="text-right">- {{ number_format($view_collection->paid, 0) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Due</td>
                    <td class="text-right" style="color:red;">{{ number_format($view_collection->due, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">DuePaid</td>
                    <td class="text-right">-{{ number_format($view_collection->due_paid, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Current Total Due</td>
                    <td class="text-right"> <b>{{ number_format($current_due, 2) }}</b> </td>
                  </tr>
              </tbody>
          </table>
          </div>
          <div class="col-md-12 text-left" style="position: absolute;left: 2%;bottom: 0%;">
            Powered by: Ehsan Software Email: infoehsansoftware@gmail.com
          </div>
          <div class="col-md-12 text-right" style="position: absolute;right: 2%;bottom: 0%;">
            Receiver Signature
          </div>
        </div>
        <div class="" style="height: 0.1px;">

        </div>
        <div id="" class="row vouchar2" style="width: 100%; position: relative; height: 100%; overflow: hidden;">
          <center>
            <h3>{{ $school->user->name }}</h3>
            <h5 style="margin: 0px; padding: 0px;">{{ $school->address }}</h5>
            <img id="school_logo" src="{{ Storage::url($school->logo) }}" alt="Logo" width="60" height="60" style="border: 1px solid #ddd; position: absolute;left: 2%;top: 5%;">
            <h3>{{ $account_setting->voucher_title??'মেমো' }}</h3>
            <span>Office Copy</span>
          </center>
          <div class="col-md-6 text-left" style="padding-bottom: 15px; display:inline-block; float:left;">
            Serial: {{ $view_collection->serial }}
          </div>
          <div class="col-md-6 text-right" style="padding-bottom: 15px;">
            Date {{ $view_collection->payment_date }}
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6" style="width: 50%; display:inline-block; float:left;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Name</th>
                      <td>{{ $student->user->name??'' }}</td>
                    </tr>
                    <tr>
                      <th>ID No</th>
                      <td>{{ $student->student_id??'' }}</td>
                    </tr>
                    <tr>
                      <th>Class</th>
                      <td>{{$student->masterClass->name}}</td>
                    </tr>
                    <tr>
                      <th>Group</th>
                      <td>{{$student->group}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6" style="width: 50%; display:inline-block;">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Section</th>
                      <td>{{$student->section}}</td>
                    </tr>
                    <tr>
                      <th>Shift</th>
                      <td>{{ $student->shift??'' }}</td>
                    </tr>
                    <tr>
                      <th>Roll</th>
                      <td>{{$student->roll}}</td>
                    </tr>
                    <tr>
                      <th>Mobile</th>
                      <td> {{$student->user->mobile}}</td>
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
                      <th class="text-center">Amount</th>
                  </tr>
              </thead>
              <tbody>
                @php
                $total = 0;
                  $i = 1;
                @endphp
                @foreach ($fee_categories as $key => $category)
                  <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td class="text-left">
                      {{ $category->fee_category->name??'' }} -
                      @if ($account_setting->subcategory_view=='1') <br>
                        @foreach ($category->fee_category->sub_categories($category->fee_category->id, $student->master_class_id, $group->id) as $key => $sub_category)
                          <li>{{ $sub_category->name }}-{{ $sub_category->amount }}</li>
                        @endforeach
                      @else
                        @foreach ($category->fee_category->sub_categories($category->fee_category->id, $student->master_class_id, $group->id) as $key => $sub_category)
                          {{ $sub_category->name }}-{{ $sub_category->amount }},
                        @endforeach
                      @endif

                    </td>
                    <td class="text-right">{{ number_format($category->amount, 2) }}</td>
                  </tr>
                  @php
                    $total += $category->amount;
                  @endphp
                @endforeach
                  <tr>
                    <td colspan="2" class="text-right">Total Fee</td>
                    <td class="text-right"> <b>{{ number_format($total, 2) }}</b> </td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Total Waiver</td>
                    <td class="text-right">- {{ number_format($view_collection->waiver, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Paid</td>
                    <td class="text-right">- {{ number_format($view_collection->paid, 0) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Due</td>
                    <td class="text-right" style="color:red;">{{ number_format($view_collection->due, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Due paid</td>
                    <td class="text-right">-{{ number_format($view_collection->due_paid, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-right">Current Total Due</td>
                    <td class="text-right"> <b>{{ number_format($current_due, 2) }}</b> </td>
                  </tr>
              </tbody>
          </table>
          </div>
          <div class="col-md-12 text-left" style="position: absolute;left: 2%;bottom: 0%;">
            Powered by: Ehsan Software Email: infoehsansoftware@gmail.com
          </div>
          <div class="col-md-12 text-right" style="position: absolute;right: 2%;bottom: 0%;">
            Receiver Signature
          </div>
        </div>
      </div>
      <div align="center" style="width: 100%; margin-bottom: 10px">
        <button class="btn btn-success" id="PrintVoucher">Print</button>
      </div>
    </div>
  @endisset
@endsection
@section('script')
  <script>
    $(document).ready(function() {
      $('#section').on('change', function () {
              var _token = $("input[name=_token]").val();
              var master_class_id = $('#master_class_id').find(":selected").val();
              var group_class_id = $('#group_class_id').find(":selected").val();
              var shift = $('#shift').find(":selected").val();
              var section = $(this).val();
              // alert(master_class_id);
              var option = '<option>Select ID or Roll</option>';
              $.ajax({
                  url : "{{route('get_st_id')}}",
                  type: 'POST',
                  data: {_token:_token, master_class_id:master_class_id, group_class_id:group_class_id, shift:shift, section:section},
                  success: function (data) {
                      // alert(data);
                      if (data.length){
                          for (var i = 0; i < data.length; i++){
                              option = option + '<option value="'+ data[i].roll +'">' + data[i].student_id + '(' + data[i].roll + ')' +'</option>';
                          }
                          $('#roll').html(option);
                      }else {
                          var option1 = '<option>Student Not Found !</option>';
                          $('#roll').html(option1);
                      }
                  }
              });
          });

    });
    </script>

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
  function sumation(){
    // Sum Total Amount
    var total_fees = 0;
    $('.fees_amount').each(function(){
       total_fees += parseFloat($(this).text());
       $("#total_fees").html(total_fees);
    });
    // Sum Total Waiver
    var waiver_total = 0;
    $('.waiver').each(function(){
        waiver_total += parseFloat($(this).val());
       $("#total_waiver").html(waiver_total);
    });
    // Total payable Fee
    var payable = (total_fees-waiver_total);
    $("#payable").html(payable);
  }
</script>
<script type="text/javascript">
  var i = 1;
  $("#add_row").click(function(){
    i++;
    $("tbody").append('<tr id="rec-'+i+'"><td><div class="form-group"><select class="form-control fee_cat" id="fee_cat-'+i+'" name="fee_cats[]"><option value="">ফি এর ধরণ নির্বাচন করুন</option>@foreach ($fee_categories as $key => $fee_category)<option value="{{ $fee_category->id }}">{{ $fee_category->name }}</option>@endforeach</select></div></td><td id="amount-'+i+'" class="text-right fees_amount">0.00</td><td><input type="text" class="form-control text-right waiver" id="waiver-'+i+'" name="waivers[]" value="0"></td><td><a id="remove_row-'+i+'" class="btn btn-primary btn-sm delete-record"><i class="glyphicon glyphicon-trash" title="মুছে ফেলুন"></i></a></td></tr>');
  })
  $(".table tbody").on('click', '.delete-record', function(){
    $(this).closest("tr").remove();
    sumation();
  });

  $(".table tbody").on('keyup', '.waiver', function(){
    sumation();
  });

  $(document).ready(function() {
    $('.table tbody').on('change', '.fee_cat', function () {
            var _token = $("input[name=_token]").val();
            var student_id = $("input[name=student_id]").val();
            var fee_cat_id = $(this).find(":selected").val();
            var fee_view_id = $(this).attr("id");
            // alert(fee_view_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : "{{route('get_fee_cat_amount')}}",
                type: 'POST',
                data: {_token:_token, student_id:student_id, fee_cat_id:fee_cat_id, fee_view_id:fee_view_id},
                success: function (data) {
                    obj = JSON.parse(data);
                    if (data.length){
                        var amount = obj['fee_amount'];
                        $('#amount-'+obj['view_id']).html(amount);
                    }
                    // Sum Total Amount
                    sumation();
                }
            });
        });

  });


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
