@extends('backEnd.master')

@section('mainTitle', 'Login Info')

@section('active_login_info', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Student Login Information</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="col-md-8 col-md-offset-2">
            <h4 style="margin-bottom: 20px;" class="text-center">Select All</h4>
            <div class="row">
                <form action="{{route('student_login_info_print')}}" method="post" target="_blank">
                    {{csrf_field()}}
                    <div class="col-md-6 {{$errors->has('school_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="school_id" id="school_id">
                                <option value="">Select Institute</option>
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}" >{{$school->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('school_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('school_id')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="master_class_id" id="master_class_id">
                                <option value="">Select Class</option>
                            </select>
                        </div>
                        @if($errors->has('master_class_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('master_class_id')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{$errors->has('session') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="session" id="session">
                                <option value="">Select Session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session }}" >{{ $session }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('session'))
                        <span class="help-block">
                            <strong>{{$errors->first('session')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{$errors->has('group') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="group" id="group">
                                <option value="">Select Group</option>
                                @foreach($class_groups as $class_group)
                                    <option value="{{$class_group->name}}" >{{$class_group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('group'))
                        <span class="help-block">
                            <strong>{{$errors->first('group')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{$errors->has('shift') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="shift" id="shift">
                                <option value="">Select Shift</option>
                                <option value="Morning">Morning</option>
                                <option selected value="Day">Day</option>
                                <option value="Evening">Evening</option>
                                <option value="Night">Night</option>
                            </select>
                        </div>
                        @if($errors->has('shift'))
                        <span class="help-block">
                            <strong>{{$errors->first('shift')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{$errors->has('section') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select name="section" id="section" class="form-control" required="">
                                <option value="">...Select Section...</option>
                                <option selected value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                @foreach($units as $unit)
                                <option value="{{$unit->name}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('section'))
                        <span class="help-block">
                            <strong>{{$errors->first('section')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <br>
                            <center>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        function checkNumber(){
            // Check #x
            if($("#all_check").prop('checked') == true){
                $(".number").prop( "checked", true );
            }else{
                $(".number").prop( "checked", false );
            }
        }
    </script>
    <script>
        $( function() {
            $( ".date" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
        } );
    </script>
    @if(isset($students))
    <script type="text/javascript">
        document.getElementById("master_class_id").value="{{$request->master_class_id}}"
        document.getElementById("group").value="{{$request->group}}"
        document.getElementById("shift").value="{{$request->shift}}"
        document.getElementById("section").value="{{$request->section}}"
    </script>
    @endif
    @if($errors->has('*'))
    <script type="text/javascript">
        document.getElementById("master_class_id").value="{{old('master_class_id')}}"
        document.getElementById("group").value="{{old('group')}}"
        document.getElementById("shift").value="{{old('shift')}}"
        document.getElementById("section").value="{{old('section')}}"
    </script>
    @endif
	<script type="text/javascript">
		$(document).ready(function() {
		  $('#school_id').on('change', function () {
				  var school_id = $(this).find(":selected").val();
				  var option = '<option>শ্রেণী নির্বাচন করুন</option>';
				  $.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});
				  $.ajax({
					  url : "{{route('loginInfo.get_classes')}}",
					  type: 'post',
					  data: {'school_id' : school_id},
					  success: function (data) {
						  // alert(data);
						  if (data.length){
							  for (var i = 0; i < data.length; i++){
								  option = option + '<option value="'+ data[i].id +'">' + data[i].name + '</option>';
							  }
							  $('#master_class_id').html(option);
						  }else {
							  var option1 = '<option>শ্রেণী খুজে পাওয়া যায়নি !</option>';
							  $('#master_class_id').html(option1);
						  }
					  }
				  });
			  });

		});
	</script>
@endsection
