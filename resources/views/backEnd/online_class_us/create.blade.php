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
            <form action="{{url('/online_class_us/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <input type="hidden" name="school_id" value="{{$school_id}}">
                <div class="row  student">
                    <div class="col-sm-6">
                        <div class="form-group ">
                            <label for="master_class_id">Class<span class="star">*</span></label>
                            <select name="master_class_id[]" id="master_class_id" class="form-control" required>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>

                            
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group ">
                            <label class="" for="shift">Shift <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="shift[]" id="shift">
                                    <option value="">Select Shift </option>
                                    <option value="Morning">Morning</option>
                                    <option value="Day">Day</option>
                                    <option value="Evining">Evining</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="" for="section">Section <span class="star">*</span></label>
                                <div class="">
                                    <select class="form-control" name="section[]" id="section">
                                        <option value="">...Select Section ....</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        @foreach($units as $unit)
                                        <option value="{{$unit->name}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="" for="group"> Group <span class="star">*</span></label>
                                <div class="">
                                    <select class="form-control" name="group[]" id="group">
                                        <option value="">Select Group</option>
                                        @foreach($group_classes as $group_class)
                                        <option value="{{$group_class->name}}">{{$group_class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="" for="subject">Subject <span class="star">*</span></label>
                                <div class="">
                                    <input  type="text" name="subject[]" class="form-control" placeholder="Subject">
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="" for="teacher_id">Teacher <span class="star">*</span></label>
                                <div class="">
                                    <select class="form-control" name="teacher_id[]" id="teacher_id">
                                        <option value="">Teacher</option>
                                        @foreach($teachers as $teacher)
                                        <option value="{{$teacher->user_id}}">{{$teacher->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                </div>
                
                <div class="more_div"></div>
                <hr>
            <button id="more" type="button" class="btn btn-success pull-right ">+</button>

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
                var i = 1;
                $("#more").click(function(){
                    i++;
                    $(".more_div").append('<div class="row student"> <hr><div class="col-sm-6"> <div class="form-group "> <label for="master_class_id">Class<span class="star">*</span></label> <select name="master_class_id[]" id="master_class_id" class="form-control" required> @foreach($classes as $class) <option value="{{$class->id}}">{{$class->name}}</option> @endforeach </select> </div></div><div class="col-sm-6"> <div class="form-group "> <label class="" for="shift">Shift <span class="star">*</span></label> <div class=""> <select class="form-control" name="shift[]" id="shift"> <option value="">Shift </option> <option value="Morning">Morning</option> <option value="Day">Day</option> <option value="Evining">Evining</option> <option value="Night">Night</option> </select> </div></div></div><div class="col-sm-6"> <div class="form-group "> <label class="" for="section">Section <span class="star">*</span></label> <div class=""> <select class="form-control" name="section[]" id="section"> <option value="">...select Section...</option>  <option value="A">A</option> <option value="B">B</option> <option value="C">C</option> <option value="D">D</option> @foreach($units as $unit) <option value="{{$unit->name}}">{{$unit->name}}</option> @endforeach </select> </div></div></div><div class="col-sm-6"> <div class="form-group "> <label class="" for="group">Group/Division<span class="star">*</span></label> <div class=""> <select class="form-control" name="group[]" id="group"> <option value="">Select Group</option> @foreach($group_classes as $group_class) <option value="{{$group_class->name}}">{{$group_class->name}}</option> @endforeach </select> </div></div></div><div class="col-sm-6"> <div class="form-group "> <label class="" for="subject">Subject <span class="star">*</span></label> <div class=""> <input type="text" name="subject[]" class="form-control" placeholder="পSubject"> </div></div></div><div class="col-sm-6"> <div class="form-group "> <label class="" for="teacher_id">Teacher <span class="star">*</span></label> <div class=""> <select class="form-control" name="teacher_id[]" id="teacher_id"> <option value="">Teacher</option> @foreach($teachers as $teacher) <option value="{{$teacher->user_id}}">{{$teacher->user->name}}</option> @endforeach </select> </div></div></div><a id="remove_row-'+i+'" class="btn btn-danger btn-sm delete-record pull-right"><i class="glyphicon glyphicon-trash" title="মুছে ফেলুন"></i></a></div>');
                })
                $(".more_div").on('click', '.delete-record', function(){
                    $(this).closest(".student").remove();
                   
                });
                
            
    </script>
@endsection
