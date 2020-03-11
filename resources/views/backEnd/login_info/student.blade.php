@extends('backEnd.master')

@section('mainTitle', 'Login Info')

@section('active_sms_login_info', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">লগিনের তথ্য সেবা</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="col-sm-12">
            <h4 style="margin-bottom: 20px;" class="text-center">নিচের সব নির্বাচন করুন</h4>
            <div class="row">
                <form action="{{route('loginInfo.st_search')}}" method="post">
                    {{csrf_field()}}
                    <div class="col-md-4 {{$errors->has('school_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="school_id" id="school_id">
                                <option value="">...প্রতিষ্ঠান নির্বাচন করুন...</option>
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
                    <div class="col-md-4 {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="master_class_id" id="master_class_id">
                                <option value="">...শ্রেণী নির্বাচন করুন...</option>
                            </select>
                        </div>
                        @if($errors->has('master_class_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('master_class_id')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{$errors->has('group') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="group" id="group">
                                <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
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
                    <div class="col-md-4 {{$errors->has('shift') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="shift" id="shift">
                                <option value="">শিফট নির্বাচন করুন</option>
                                <option value="সকাল">সকাল</option>
                                <option value="দিন">দিন</option>
                                <option value="সন্ধ্যা">সন্ধ্যা</option>
                                <option value="রাত">রাত</option>
                            </select>
                        </div>
                        @if($errors->has('shift'))
                        <span class="help-block">
                            <strong>{{$errors->first('shift')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{$errors->has('section') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select name="section" id="section" class="form-control" required="">
                                <option value="">...শাখা নির্বাচন করুন...</option>
                                <option value="ক">ক</option>
                                <option value="খ">খ</option>
                                <option value="গ">গ</option>
                                <option value="ঘ">ঘ</option>
                                @foreach($units as $unit)
                                <option value="{!!$unit->name!!}">{!!$unit->name!!}</option>
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
                            <button type="submit" class="btn btn-primary">অনুসন্ধান</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(isset($students))
        <div class="col-sm-12">
        <h4 style="margin-bottom: 10px;" class="text-center"> শিক্ষার্থী চিহ্নিত করুন </h4>
        <h5 style="margin-bottom: 10px;" class="text-center">মোট শিক্ষার্থী : {{count($students)}}</h5>
        <div class="row">
            <div class="panel-body" style="margin-top: 10px;">
                <form action="{{route('loginInfo.st_sms')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @php($i=1)
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-body table-responsive">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>শিক্ষার্থীর নাম </th>
                                <th>শিক্ষার্থীর আইডি</th>
                                <th>শ্রেণী রোল</th>
                                <th>মোবাইল নাম্বার</th>
                            </tr>
                           @foreach($students as $student)
                            <tr>
                               <td>
                                    <input class="form-check-input number" name="id[]" type="checkbox" value="{{$student->id}}" id="defaultCheck{{$i}}">
									<input type="hidden" name="school_id" value="{{ $student->school_id }}">
                                    <label class="form-check-label" for="defaultCheck{{$i++}}">
                                      {{$student->user->name}}
                                    </label>
                                </td>
                                <td>
                                    {{$student->student_id}}
                                </td>
                                <td>
                                    {{$student->roll}}
                                </td>
                                <td>
                                    {{$student->user->mobile}}
                                </td>
                            </tr>
                            @endforeach
                            @if(count($students)>0)
                            <tr>
                                <td colspan="3">
                                    <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">সব চেক / আনচেক</label>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    </div>
                    @if(count($students)>0)
                    <hr>

                    <div class="">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-5">
                                <div class="form-group">
                                    <button id="save_btn" type="submit" class="btn btn-block btn-info">Send SMS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endif
                </form>
            </div>
        </div>
        </div>
        @endif
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
