@extends('backEnd.master')

@section('mainTitle', 'Result Entry')
@section('head_section')
    <style>
       .select2-selection.select2-selection--single {
            height:  35px;
        }
    </style>
@endsection
@section('active_ca_subject', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Result Entry</h1>
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

        <div id="success_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-success">
            <p class="text-center success" style=""></p>
        </div>

        <div class="panel-body">
            <form name="add-result-form" action="{{url('ca-result/search/make')}}" method="get" >
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="class">Class <span class="star">*</span></label>
                            <select name="master_class_id" id="class" class="form-control" required="">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group1">Group<span class="star">*</span></label>
                            <select name="group_class_id" id="group1" class="form-control" required="">
                                <option value="">Select Group</option>
                                @foreach($group_classes as $group_class)
                                  <option value="{{$group_class->id}}">{{$group_class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift1">Shift <span class="star">*</span></label>
                            <select name="shift" id="shift1" class="form-control" required="">
                                <option value="">Select Shift</option>
                                <option value="Morning">Morning</option>
                                <option value="Day">Day</option>
                                <option value="Evening">Evening</option>
                                <option value="Night">Night</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section1">Section <span class="star">*</span></label>
                            <select name="section" id="section1" class="form-control" required="">
                                <option value="">Select Section</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                @foreach($units as $unit)
                                <option value="{!!$unit->name!!}">{!!$unit->name!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
      <hr>
        @if(isset($students)&& count($students)>0)
            <form id="result_from" name="result_from" action="{{url('/ca-result/store')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <label class="" for="class">Exam <span class="star">*</span></label>
                            <select name="exam_type_id" id="exam_type_id" class="form-control">
                                <option value="">Select Exam Type</option>
                                @foreach($exam_types as $exam)
                                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('exam_type_id'))
                                <span class="help-block text-danger">
                                    <strong>{{$errors->first('exam_type_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('exam_year') ? 'has-error' : ''}}">
                            <label class="" for="exam_year">Session <span class="star">*</span></label>
                            <div class="">
                                <select name="exam_year" id="exam_year" class="form-control">
                                <option value="">Select Session</option>
                                <option value="{{date('Y')}}">{{date('Y')}}</option>
                                <option value="{{date('Y')-1}}">{{date('Y')-1}}</option>
                            </select>
                            </div>
                            @if ($errors->has('exam_year'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_year')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('subject_id') ? 'has-error' : ''}}">
                            <label class="" for="subject_id">Subject <span class="star">*</span></label>
                            <div class="">
                                <select name="subject_id" id="subject_id" class="form-control" onchange="select_subject_details();" required="">
                                    <option value="">Select Subject</option>
                                    @foreach($subjects as $key=>$subject)
                                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('subject_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="subject_name" id="subject_name">
                    <input type="hidden" name="total_mark" id="total_mark">
                    <input type="hidden"  name="pass_mark" id="pass_mark">

                </div>
                <hr>
                <input type="hidden" value="{{$search['master_class_id'] ?? ''}}" name="master_class_id" id="master_class_id">
                <input type="hidden" value="{{$search['group_class_id']??''}}" name="group_class_id" id="group_class_id">
                <input type="hidden" value="{{$search['shift']??''}}" name="shift">
                <input type="hidden" value="{{$search['section']??''}}" name="section">


            @foreach($students as $key=>$student)
                <div class="row" id="row{{$key}}">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="" for="student_id">Student<span class="star">*</span></label>
                            <div class="">
                                <input type="hidden" name="student_id[]" value="{{$student->student_id}}">
                                <input type="text" placeholder="Student" class="form-control" value="{{$student->user->name}}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="" for="roll">Class Roll<span class="star">*</span></label>
                            <div class="">
                                <input type="text" placeholder="Class Roll" name="roll[]" class="form-control" value="{{$student->roll}}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-12">
                        <div class="form-group">
                            <label class="" for="marks">G.P.A</label>
                            <div class="">
                                <input value="--" class="form-control" type="text" name="marks[]">
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        </div>
    </div>
@endsection
@section('script')
   <script type="text/javascript">
       function select_subject_details(){
        var master_class_id = $('#master_class_id').val();
        var group_class_id = $('#group_class_id').val();
        var subject_id = $('#subject_id').val();
        $.ajax({
            url: "{{url('ca-result/get/subject')}}",
            type: 'get',
            data: {
                'master_class_id': master_class_id,
                'group_class_id': group_class_id,
                'subject_id': subject_id
            },
            success: function (data) {
                $('#total_mark').val(data.total_mark);
                $('#pass_mark').val(data.pass_mark);
                $('#subject_name').val(data.subject_name);
            }
        });
       }
       function clear(){}
   </script>
   @if(isset($search) && $search!=NULL)
       <script>
           document.forms['add-result-form'].elements['master_class_id'].value="{{$search['master_class_id']}}";
           document.forms['add-result-form'].elements['group_class_id'].value="{{$search['group_class_id']}}";
           document.forms['add-result-form'].elements['shift'].value="{{$search['shift']}}";
           document.forms['add-result-form'].elements['section'].value="{{$search['section']}}";
       </script>
   @endif
   <script>
       document.forms['result_from'].elements['exam_year'].value="{{old('exam_year')}}";
       document.forms['result_from'].elements['subject_id'].value="{{old('subject_id')}}";
       document.forms['result_from'].elements['exam_type_id'].value="{{old('exam_type_id')}}";
   </script>
@endsection
