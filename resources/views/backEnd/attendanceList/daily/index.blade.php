@extends('backEnd.master')

@section('mainTitle', 'Result View')
@section('active_latter', 'active')

@section('content')
<div id="forPdf" class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
  <div class="page-header text-center">
    <h3>হাজিরা</h3>
  </div> 

  @if(Session::has('errmgs'))
  @include('backEnd.includes.errors')
  @endif
  @if(Session::has('sccmgs'))
  @include('backEnd.includes.success')
  @endif

  <div class="panel-body" style="border:1px solid black;border-bottom:1px solid gray;color:gray">
    <div class="row" id="div-id-name"> 
     <style>
      *{box-sizing: border-box; } .row1 {margin-right: -15px; margin-left: -15px } .row1::after {content: ""; clear: both; display: table; } [class*="col-"] {float: left; padding: 15px; padding-top: 5px; padding-bottom: 3px; } .col-1 {width: 8.33%;} .col-2 {width: 16.66%;} .col-3 {width: 25%;} .col-4 {width: 33.33%;} .col-5 {width: 41.66%;} .col-6 {width: 50%;} .col-7 {width: 58.33%;} .col-8 {width: 66.66%;} .col-9 {width: 75%;} .col-10 {width: 83.33%;} .col-11 {width: 91.66%;} .col-12 {width: 100%;} .school-info{text-align: center; } .school-logo {padding: 4px; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; max-width: 100%; height: 123px; } .school-info>h3,.school-info>p{padding: 0; margin: 0;color:gray;}.school-info>p{font-size:15px;} .school-info>h4{padding: 0; padding-bottom: 2px;margin: 0;color:gray;}
      }
     </style>
     <style type="text/css">
       .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {border: 1px solid #ddd; } .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; } td, th {padding: 0; } td, th {padding: 0; } * {box-sizing: border-box; } * {-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; } td {display: table-cell; vertical-align: inherit; } table {border-spacing: 0; border-collapse: collapse; } td, th {border: 1px solid black; border-bottom: 1px solid gray; color: gray; } body {font-family: 'SolaimanLipi', Arial, sans-serif !important; } body {font-family: 'Open Sans', sans-serif; } body {font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.42857143; color: gray;; background-color: #fff;}
     </style>
    
       <div class="col-12">
           <div class="row1">
             <div class="col-2">
               <img src="{{Storage::url($school->logo)}}" class="school-logo" alt="School Logo">
             </div>
             <div class="col-8 school-info">
               <h3>{{$school->user->name}}</h3>
               <p>{{$school->address}}</p>
               @if(isset($exam->name))
               <p>{{$exam->name.'-'.$exam_year}}</p>
               @endif 
               <p>{{isset($exam->name)?'অংশগ্রহণকারী':''}} শিক্ষার্থীদের হাজিরা</p>

               <p>শ্রেণী : {{$students[0]->masterClass->name}}, শাখা : {{$data['section']}}, বিভাগ : {{$data['group']}} এবং শিফট : {{$data['shift']}}</p>
               @if(!isset($exam->name))
               <p>তারিখ : __/__/____</p>
               @endif
               
             </div>
             <div class="col-2"></div>
           </div>
           <div class="row1">
             <div class="col-12">
              <div class="table-responsive">
                 <table id="student_tbl" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                          <tr>
                              <th style="width: 10%">ক্র: নং</th>
                              <th style="width:50px !important; ">ছবি</th>
                              <th style="width: 42%">শিক্ষার্থী</th>
                              <th style="width: 6%">রোল</th>
                              @if(isset($exam->name))
                              <th style="width: 24%">বিষয়</th>
                              <th>তারিখ</th>
                              @else
                              <th style="width: 12%">উপস্থিত</th>
                              <th style="width: 12%">অনুপস্থিত</th>
                              @endif
                              <th>স্বাক্ষর</th>
                          </tr>
                      </thead>
                      <tbody>
                            @php $i=1; @endphp
                            @foreach($students as $student)
                              <tr>
                                  <td>{{$i++}}</td>
                                  <td style="width:50px !important; padding:0 5px;"><img src="{{Storage::url($student->photo)}}" width="50px" height="50px"></td>
                                  <td>{{$student->user->name}}</td>
                                  <td>{{$student->roll}}</td>
                                  @if(isset($exam->name))
                                  <td></td>
                                  <td></td>
                                  @else
                                  <td><input type="checkbox" class="checkbox text-center"></td>
                                  <td><input type="checkbox" class="checkbox text-center"></td>
                                  @endif
                                  <td></td>
                              </tr>
                            @endforeach
                      </tbody>
                  </table>
              </div>
             </div>
           </div>
       </div>
    </div>
  </div>
    <div class="row">
    @if($students)
    <div class="col-md-6 col-sm-12">
      <a class="btn btn-default col-md-6" style="color:#000" href="{{url()->previous()}}">পুনরায় অনুসন্ধান করুন</a>
    </div>   
    <div class="col-md-6 col-sm-12">
      <a onclick="javascript:print_genarator('div-id-name')" class="btn btn-default col-md-6" style="color: #000;float: right" href="javascript:void" target="_blank">প্রিন্ট করুন</a>
    </div>
    @endif
    </div>
  </div>
  @endsection

@section('script')
<script>
  function print_genarator(lyear){
   var genaretor = window.open();
   var layeartext = document.getElementById(lyear);
   genaretor.document.write(layeartext.innerHTML.replace("Print Me"));
   genaretor.document.close();
   genaretor.print();
   genaretor.close();

 }
</script>
<script charset="UTF-8" type="text/javascript"  src="{{asset('backEnd/js/pdf/jspdf.js')}}"></script>
<script charset="UTF-8" type="text/javascript"  src="{{asset('backEnd/js/pdf/printArea.js')}}"></script>
@endsection

