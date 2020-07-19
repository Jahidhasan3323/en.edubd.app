@extends('backEnd.master')

@section('mainTitle', 'Online Class')
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
            <h1 class="text-center text-temp">Online Class</h1>
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
            <form action="{{url('/online_class_us/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                   
                    
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">Institute <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="school_id" id="school_id">
                                    <option value="">Institute</option>
                                    @foreach($schools as $school)
                                    <option value="{{$school->id}}">{{$school->user->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @if ($errors->has('master_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('master_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('type') ? 'has-error' : ''}}">
                            <label class="" for="type">User <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type" id="type">
                                    <option value="">User</option>
                                    <option value="1">Student</option>
                                    <option value="2">Staff</option>
                                </select>
                            </div>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{$errors->first('type')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                   
               </div>
               <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label for="master_class_id">Select Class<span class="star">*</span></label>
                            <select name="master_class_id[]" id="master_class_id" class="form-control" multiple="true">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                            </select>

                            @if ($errors->has('master_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('master_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">Shift <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="shift" id="shift">
                                    <option value="">Select Shift </option>
                                    <option value="Morning">Morning</option>
                                    <option value="Day">Day</option>
                                    <option value="Evining">Evining</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                            @if ($errors->has('shift'))
                                <span class="help-block">
                                    <strong>{{$errors->first('shift')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
               </div>
               <div class="row  student">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section">Section <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="section" id="section">
                                    <option value="">...Select Section ...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    @foreach($units as $unit)
                                    <option value="{{$unit->name}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{$errors->first('section')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('group') ? 'has-error' : ''}}">
                            <label class="" for="group">Group <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="group" id="group">
                                    <option value="">Select Group </option>
                                    @foreach($group_classes as $group_class)
                                    <option value="{{$group_class->name}}">{{$group_class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('group'))
                                <span class="help-block">
                                    <strong>{{$errors->first('group')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('subject') ? 'has-error' : ''}}">
                            <label class="" for="subject">Subject <span class="star">*</span></label>
                            <div class="">
                                <input  type="text" name="subject" class="form-control" placeholder="Each subject seperate by comma(,)">
                            </div>
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject')}}</strong>
                                </span>
                            @endif
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
    @if($errors->any())
        <script type="text/javascript">
            document.getElementById('master_class_id').value="{{old('master_class_id')}}";
            document.getElementById('shift').value="{{old('shift')}}";
            document.getElementById('section').value="{{old('section')}}";
            document.getElementById('group').value="{{old('group')}}";
            document.getElementById('type').value="{{old('type')}}";
            document.getElementById('school_id').value="{{old('school_id')}}";
        </script>
    @endif
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
    <script >
         $(document).ready(function() {
                $("#type").change(function() {
                    var id = $(this).val();
                    console.log(id);
                    if(id==2){
                        $(".student").attr("style", "display:none")
                    }if(id==1){
                        $(".student").attr("style", "display:block")

                   }else{

                   }
                });
            });
    </script>
@endsection
