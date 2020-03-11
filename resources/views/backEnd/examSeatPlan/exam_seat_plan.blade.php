@extends('backEnd.master')

@section('mainTitle', 'Result View')
@section('active_latter', 'active')

@section('content')
<div id="forPdf" class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
  <div class="page-header text-center">
    <h3>পরীক্ষার আসন পরিকল্পনা</h3>
  </div> 

  @if(Session::has('errmgs'))
  @include('backEnd.includes.errors')
  @endif
  @if(Session::has('sccmgs'))
  @include('backEnd.includes.success')
  @endif

  <div class="panel-body">
    <div class="row" id="div-id-name"> 
     <style>
      @media print
      {
        div{
         page-break-inside: avoid;
        }
      }
      * {box-sizing: border-box; } .row1 {margin-right: -5px; margin-left: -5px } .row1::after {content: ""; clear: both; display: table; } [class*="col-"] {float: left; padding: 5px;} .col-1 {width: 8.33%; } .col-2 {width: 16.66%; } .col-3 {width: 25%; } .col-4 {width: 33.33%; } .col-5 {width: 41.66%; } .col-6 {width: 50%; } .col-7 {width: 58.33%; } .col-8 {width: 66.66%; } .col-9 {width: 75%; } .col-10 {width: 83.33%; } .col-11 {width: 91.66%; } .col-12 {width: 100%; } .school-info {text-align: center; } .school-logo {padding: 4px; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; max-width: 100%; height: 64px; } .school-info-header>h3, .school-info>h4, .school-info-header>p {padding: 0; margin: 0; line-height: 2; } .school-info-header{width: 100%;height: 41px; } .school-info-header>h3{font-size: 8px; } .school-info-header>p {font-size: 6px; } .school-info>h4 {margin-top: 1px; padding: 2px; background: gray; color:#ffffff; font-size: 8.5px; } .student-photo {padding: 4px; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; max-width: 100%; height: 64px; float: right } .student-info{float: left; } .student-info p{line-height:1.2; margin: 0; padding: 0; font-size: 12px; } .table-placement{margin-top: 4px; } .table {border-collapse: separate !important; border: 1px solid #ddd; float: right; } .table-bordered th, .table-bordered td {border: 3px solid #ddd !important; text-align: center;}
    </style>

    @foreach($students as $key=>$student)
      <div class="col-6">
        <div class="col-12" style="border:1px double black;">
            <div class="row1">
                <div class="col-3">
                  <img src="{{Storage::url($school->logo)}}" class="school-logo" alt="School Logo">
                </div>
                <div class="col-6 school-info">
                  <div class="school-info-header">
                    <h3>{{$school->user->name}}</h3>
                    <p>{{$school->address}}</p>
                  </div>
                   <h4>{{$exam->name.'র'}} আসন-{{$request->exam_year}}</h4>
                </div>
                <div class="col-3">
                  <img src="{{Storage::url($student->photo)}}" class="student-photo" alt="Student Photo">
                </div>
                <div class="col-12" style="padding-top:0;padding-bottom: 0">
                  <div class="student-info" style="width: 16.5%;">
                    <p>নাম</p>
                  </div>
                  <div class="student-info" style="width: 83.5%;">
                    <p>: {{$student->user->name}}</p>
                  </div>
                </div>
                <div class="col-8">
                  <div class="student-info" style="width: 25%;">
                    <p>আইডি</p>
                    <p>শ্রেণী</p>
                    <p>শিক্ষাবর্ষ</p>
                    <p>পরীক্ষার</p>
                    <p>বিভাগ</p>
                    <p>শাখা</p>
                  </div>
                  <div class="student-info" style="width: 75%;">
                    <p>: {{$student->student_id}}</p>
                    <p>: {{$student->masterClass->name}}</p>
                    <p>: {{$student->session}}</p>
                    <p>: {{$exam->name}}</p>
                    <p>: {{$student->group}}</p>
                    <p>: {{$student->section}}</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="table-placement">
                      <table class="table-bordered" style="border-collapse: separate !important;
            border: 3px solid #ddd;">
                        <tr><td>রোল নং</td></tr>
                        <tr><td>{{$student->roll}}</td></tr>
                      </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
      @if($key==9||$key==19||$key==29||$key==39||$key==49||$key==59||$key==69||$key==79||$key==89||$key==99||$key==109||$key==119||$key==129||$key==139||$key==149||$key==159||$key==169||$key==179||$key==189||$key==199||$key==209||$key==219||$key==229||$key==239||$key==249||$key==259)
      <div class="col-12" style="height: 10.5px;"> </div>
      @endif
    @endforeach
  </div>
</div>
  <div class="row">   
    @if($students)
    <a class="btn btn-default col-sm-2 col-sm-offset-4" style="color:#000" href="{{url('/result')}}">পুনরায় অনুসন্ধান করুন</a>

    <a onclick="javascript:print_genarator('div-id-name')" class="btn btn-default col-sm-2 col-sm-offset-" style="color: #000" href="javascript:void" target="_blank">প্রিন্ট করুন</a>
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
<script src="{{asset('backEnd/js/pdf/jquery-2.1.3.js')}}"></script>
<script charset="UTF-8" type="text/javascript"  src="{{asset('backEnd/js/pdf/jspdf.js')}}"></script>
<script charset="UTF-8" type="text/javascript"  src="{{asset('backEnd/js/pdf/printArea.js')}}"></script>
@endsection

