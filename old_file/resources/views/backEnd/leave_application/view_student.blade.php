@extends('backEnd.master')

@section('mainTitle', 'Leave Application')
@section('leave_application','active')
@section('information', 'active')
@section('content')

    <div class="panel panel-info col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ছুটির আবেদন</h1>
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
                  বরাবর,<br>
                  {{$leave_application->toward}}  <br>
                  {{str_replace($s,$r, $leave_application->school->user->name)}}  <br>      
                  {{str_replace($s,$r, $leave_application->school->address)}}। <br><br>
               
              মাধ্যমঃ মাধ্যম যথাযথ শ্রেণী শিক্ষক <br><br>
               
              বিষয়ঃ {{str_replace($s,$r, $leave_application->form_date->format('d-m-Y'))}} তারিখ হতে {{str_replace($s,$r, $leave_application->to_date->format('d-m-Y'))}}  তারিখ পর্যন্ত {{str_replace($s,$r,$leave_application->total_day)}} দিনের নৈমিত্তিক ছুটির প্রয়োজন। <br><br>
               
              জনাব,<br><br>
                       যথাবিহীত সম্মান প্রদর্শন পূর্বক বিনীত নিবেদন এই যে, আমি আপনার বিদ্যালয়ের একজন নিয়মিত শিক্ষার্থী। আমার {{$leave_application->purpose}}  জন্য আগামী {{str_replace($s,$r, $leave_application->form_date->format('d-m-Y'))}} তারিখ হতে {{str_replace($s,$r, $leave_application->to_date->format('d-m-Y'))}} তারিখ পর্যন্ত আমার নৈমিত্তিক ছুটির প্রয়োজন। <br><br>
               
                      অতএব জনাবের নিকট আবেদন আমাকে উল্লেখিত {{str_replace($s,$r,$leave_application->total_day)}} দিনের নৈমিত্তিক ছুটি মঞ্জুরসহ কর্মস্থল ত্যাগের অনুমতিদানে সদয় মর্জি হয়। <br><br>
               
                      
               
              নিবেদক, <br>
               
              নামঃ  {{$leave_application->student->user->name}}<br>
              শ্রেণিঃ  {{$leave_application->student->masterClass->name}}<br>
              শাখাঃ  {{$leave_application->student->section}}<br>
              গ্রুপঃ  {{$leave_application->student->group}}<br>
              রোল:  {{str_replace($s,$r,$leave_application->student->roll)}}<br>
              আইডিঃ  {{$leave_application->student->student_id}}<br>
              মোবাইলঃ  {{str_replace($s,$r,$leave_application->student->f_mobile_no)}}<br>
              তারিখঃ  {{str_replace($s,$r,$leave_application->created_at->format('d-m-Y'))}}   
            </p>
        </div>
        <div align="center" style="width: 100%; margin-bottom: 25px;">
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
