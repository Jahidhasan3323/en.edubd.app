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

        
        <div class="panel-body">

              
            <p>
                  To,<br>
                  {{$leave_application->toward}}  <br>
                  {{$leave_application->school->user->name)}}  <br>      
                  {{$leave_application->school->address)}}। <br><br>
               
              Medium : The medium is the proper authority. <br><br>
               
              Subject : Form {{$leave_application->form_date->format('d-m-Y')}} to {{ $leave_application->to_date->format('d-m-Y')}}, Need casual holidays of the {{$leave_application->total_day}} days. <br><br>
               
              Sir,<br><br>
                       Sincerely regards, I am a regular employee ( {{$leave_application->staff->designation->name}} ) at your school. From {{ $leave_application->form_date->format('d-m-Y')}} to {{ $leave_application->to_date->format('d-m-Y')}} for my {{$leave_application->purpose}}. So, I need a casual vacation. <br><br>
               
                      Therefore, I request you to please understand my situation and grant my leave for {{$leave_application->total_day}} <br><br>
               
                       Note, In the current calendar year, I have {{$ leave_application->due_leave}} days of casual leave. <br><br>
               
              Thank You, <br>
              Yours sincerely, <br>
               
              Name : {{$leave_application->staff->user->name}} <br>
              Designation : {{$leave_application->staff->designation->name}} <br>
              Mobile : {{$leave_application->staff->user->mobile}}<br>
              Date : {{$leave_application->created_at->format('d-m-Y')}}   
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