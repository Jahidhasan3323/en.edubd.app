@extends('backEnd.master')

@section('mainTitle', 'Online Admission')
@section('online_admission', 'active')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_notice', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Online Admission</h1>
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
            <form action="{{url('/online_admission/edit',$online_admission->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                            <label class="" for="title">Title <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$online_admission->title}}" type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{$errors->first('title')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('session') ? 'has-error' : ''}}">
                            <label for="session">Session  </label>
                            <input value="{{$online_admission->session}}" type="text" name="session" class="form-control" placeholder="Session">
                            @if ($errors->has('session'))
                                <span class="help-block">
                                    <strong>{{$errors->first('session')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('start_date') ? 'has-error' : ''}}">
                            <label for="start_date">Start date  </label>
                            
                            <input value="{{$online_admission->start_date}}" class="form-control date" type="text" name="start_date" id="start_date" placeholder="Start date " autocomplete="off">
                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('start_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('end_date') ? 'has-error' : ''}}">
                            <label for="end_date">End Date  </label>
                            
                            <input value="{{$online_admission->end_date}}" class="form-control date1" type="text" name="end_date" id="end_date" placeholder="End Date "  autocomplete="off">
                            @if ($errors->has('end_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('end_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 {{$errors->has('status') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="status">Status </label>
                            <div class="">
                                <select class="form-control" name="status" id="status" >
                                    <option value=""> Select</option>
                                    <option value="1">School</option>
                                    <option value="0">College</option>
                                    
                                </select>
                            </div>
                        </div>
                        @if($errors->has('status'))
                            <span class="help-block">
                                <strong>{{$errors->first('status')}}</strong>
                            </span>
                        @endif
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
    <script type="text/javascript">
        document.getElementById('status').value="{{$online_admission->status}}";
    </script>
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
