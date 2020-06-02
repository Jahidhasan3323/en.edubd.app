@extends('backEnd.master')

@section('mainTitle', 'Result View')
@section('active_latter', 'active')

@section('content')
<div id="forPdf" class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
  <div class="page-header text-center">
    <h3>Admit Card</h3>
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
      *{box-sizing: border-box; } .row1 {margin-right: -15px; margin-left: -15px } .row1::after {content: ""; clear: both; display: table; } [class*="col-"] {float: left; padding: 15px; padding-top: 5px; padding-bottom: 3px; } .col-1 {width: 8.33%;} .col-2 {width: 16.66%;} .col-3 {width: 25%;} .col-4 {width: 33.33%;} .col-5 {width: 41.66%;} .col-6 {width: 50%;} .col-7 {width: 58.33%;} .col-8 {width: 66.66%;} .col-9 {width: 75%;} .col-10 {width: 83.33%;} .col-11 {width: 91.66%;} .col-12 {width: 100%;} .school-info{text-align: center; } .school-logo {padding: 4px; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; max-width: 100%; height: 80px; } .school-info>h3,.school-info>h4,.school-info>p{padding: 0; margin: 0;}.school-info>p{font-size:10px;} .school-info>h4{border-bottom: 3px dashed gray; padding: 3px; } .student-info>p{padding:0; margin: 0; font-size: 12px; line-height: 2; } .student-photo{padding: 4px; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; max-width: 100%; height: 140px; } .gap{height:55.5px; }
     </style>
    @foreach($students as $key=>$student)
    <div class="col-12" style="border:1px solid black;border-bottom:1px solid gray;color:gray">
     <div class="row1">
       <div class="col-2">
         <img src="{{Storage::url($school->logo)}}" class="school-logo" alt="School Logo">
       </div>
       <div class="col-8 school-info">
        <h3>{{$school->user->name}}</h3>
        <p>{{$school->address}}</p>
        <h4>{{$exam->name}} </h4>
      </div>
      <div class="col-2"></div>
    </div>
    <div class="row1">
     <div class="col-6">
      <div class="row1">
        <div class="col-4 student-info">
          <p>Student Name</p>
          <p>ID No.</p>
          <p>Fathers's Name</p>
          <p>Mother's Name</p>
          <p>Student Type</p>
          <p>Mobile Number</p>
        </div>
        <div class="col-8 student-info">
          <p>: {{$student->user->name}}</p>
          <p>: {{$student->student_id}}</p>
          <p>: {{$student->father_name}}</p>
          <p>: {{$student->mother_name}}</p>
          <p>: {{$student->regularity}}</p>
          <p>: {{$student->user->mobile}}</p>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="row1">
        <div class="col-4 student-info">
          <p>Session</p>
          <p>Class</p>
          <p>Section</p>
          <p>Group</p>
          <p>Shift</p>
          <p>Roll</p>
        </div>
        <div class="col-8 student-info">
          <p>: {{$student->session}}</p>
          <p>: {{$student->masterClass->name}}</p>
          <p>: {{$student->section}}</p>
          <p>: {{$student->group}}</p>
          <p>: {{$student->shift}}</p>
          <p>: {{$student->roll}}</p>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="row1">
        <div class="col-12" style="text-align: center;">
          <img src="{{Storage::url($student->photo)}}" class="student-photo" alt="Student Photo">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-12" style="border:1px solid black;border-top:0;color:gray">
  <div class="row1">
    <div class="col-12">
      <p>Note: Keep this card safe and must be show ine the exam @Ehsan Software</p>
    </div>
  </div>
  <div class="row1" style="margin-top: 100px">
    <div class="col-3" style="text-align: center;">Principal/Headmaster</div>
    <div class="col-6" style="text-align: center;">Institute Seal</div>
    <div class="col-3" style="text-align: center;">Exam Moderator</div>
  </div>
</div>
<div class="row1"><div class="col-12"><div class="gap"></div></div></div>
@endforeach
</div>
    <div class="row">
    @if($students)
    <div class="col-md-6 col-sm-12">
      <a class="btn btn-default col-md-6" style="color:#000" href="{{url()->previous()}}">Search Again</a>
    </div>
    <div class="col-md-6 col-sm-12">
      <a onclick="javascript:print_genarator('div-id-name')" class="btn btn-default col-md-6" style="color: #000;float: right" href="javascript:void" target="_blank">Print</a>
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
