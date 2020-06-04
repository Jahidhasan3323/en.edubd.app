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

        
        <div class="panel-body">

              
            <p>
                  বরাবর,<br>
                  {{$leave_application->toward}}  <br>
                  {{str_replace($s,$r, $leave_application->school->user->name)}}  <br>      
                  {{str_replace($s,$r, $leave_application->school->address)}}। <br><br>
               
              মাধ্যমঃ মাধ্যম যথাযথ কর্তৃপক্ষ। <br><br>
               
              বিষয়ঃ {{str_replace($s,$r, $leave_application->form_date->format('d-m-Y'))}} তারিখ হতে {{str_replace($s,$r, $leave_application->to_date->format('d-m-Y'))}}  তারিখ পর্যন্ত {{str_replace($s,$r,$leave_application->total_day)}} দিনের নৈমিত্তিক ছুটির প্রয়োজন। <br><br>
               
              জনাব,<br><br>
                       যথাবিহীত সম্মান প্রদর্শন পূর্বক বিনীত নিবেদন এই যে, আমি আপনার বিদ্যালয়ের একজন নিয়মিত {{$leave_application->staff->designation->name}}। আমার {{$leave_application->purpose}}  জন্য আগামী {{str_replace($s,$r, $leave_application->form_date->format('d-m-Y'))}} তারিখ হতে {{str_replace($s,$r, $leave_application->to_date->format('d-m-Y'))}} তারিখ পর্যন্ত আমার নৈমিত্তিক ছুটির প্রয়োজন। <br><br>
               
                      অতএব জনাবের নিকট আবেদন আমাকে উল্লেখিত {{str_replace($s,$r,$leave_application->total_day)}} দিনের নৈমিত্তিক ছুটি মঞ্জুরসহ কর্মস্থল ত্যাগের অনুমতিদানে সদয় মর্জি হয়। <br><br>
               
                       উল্লেখ্য, চলতি পঞ্জিকা বৎসরে আমার {{str_replace($s,$r,$leave_application->due_leave)}} দিনের নৈমিত্তিক ছুটি পাওনা আছে। <br><br>
               
              নিবেদক, <br>
               
              নামঃ {{$leave_application->staff->user->name}} <br>
              পদবীঃ     {{$leave_application->staff->designation->name}} <br>
              মোবাইলঃ    {{str_replace($s,$r,$leave_application->staff->user->mobile)}}<br>
              তারিখঃ  {{str_replace($s,$r,$leave_application->created_at->format('d-m-Y'))}}   
            </p>
        </div>
    </div>
    
   
 
 
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'speech' );
  </script>
@endsection