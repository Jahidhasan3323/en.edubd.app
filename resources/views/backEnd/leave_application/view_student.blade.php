@extends('backEnd.master')

@section('mainTitle', 'Leave Application')
@section('leave_application','active')
@section('information', 'active')
@section('content')

    <div class="panel panel-info col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Leave Application</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        
        <div class="panel-body" id="vouchercontents">

              
            <p>
                  To,<br>
                  {{$leave_application->toward}}  <br>
                  {{$leave_application->school->user->name}}  <br>      
                  {{$leave_application->school->address}}। <br><br>
               
              Medium : The medium is the proper authority. <br><br>
               
              Subject : Form {{$leave_application->form_date->format('d-m-Y')}} to {{ $leave_application->to_date->format('d-m-Y')}}, Need casual holidays of the {{$leave_application->total_day}} days. <br><br>
               
              Sir,<br><br>
                       Sincerely regards, I am a regular student of your school. From {{ $leave_application->form_date->format('d-m-Y')}} to {{ $leave_application->to_date->format('d-m-Y')}} for my {{$leave_application->purpose}}. So, I need a casual vacation. <br><br>
               
                      Therefore, I request you to please understand my situation and grant my leave for {{$leave_application->total_day}} <br><br>
               
                      
               
              Thank You, <br>
              Yours sincerely, <br>
               
              Name :  {{$leave_application->student->user->name}}<br>
              Class :  {{$leave_application->student->masterClass->name}}<br>
              Section :  {{$leave_application->student->section}}<br>
              Trade :  {{$leave_application->student->group}}<br>
              Roll :  {{$leave_application->student->roll}}<br>
              ID :  {{$leave_application->student->student_id}}<br>
              Mobile :  {{$leave_application->student->f_mobile_no}}<br>
              Date :  {{$leave_application->created_at->format('d-m-Y')}}   
            </p>
        </div>
        <div align="center" style="width: 100%; margin-bottom: 25px;">
          <button class="btn btn-success" id="PrintVoucher">Print</button>
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
