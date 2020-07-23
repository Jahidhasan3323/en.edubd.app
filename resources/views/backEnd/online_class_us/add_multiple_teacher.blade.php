@extends('backEnd.master')

@section('mainTitle', 'Onine Class')
@section('online_class_us', 'active')
@section('head_section')
    <style>
        /* .student{
            display: none;
        } */
    </style>
@endsection
@section('active_notice', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Onine Class</h1>
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
            <form action="{{url('/online_class_us/add_multiple_teacher')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id}}">
                <div class="row  student">
                    
                        
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label class="" for="teacher_id">Teacher <span class="star">*</span></label>
                                <div class="">
                                    <select class="form-control" name="teacher_id[]" id="teacher_id" multiple="true">
                                        <option value="">Teacher</option>
                                        @foreach($teachers as $teacher)
                                        <option value="{{$teacher->user_id}}">{{$teacher->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                </div>
                
                
                <hr>
           

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection
@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description' );
  </script>
  <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( ".date" ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            }).val();
        } );
    </script>
    <script>
        $( function() {
            $( ".date1" ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            }).val();
        } );
    </script>
    
@endsection
