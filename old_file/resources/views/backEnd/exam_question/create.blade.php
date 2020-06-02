@extends('backEnd.master')

@section('mainTitle', 'Create Exam')
@section('question', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Create Exam</h1>
            <hr>

        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-md-8 col-md-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>
        <style type="text/css">
            hr{
                margin:0;
                margin-bottom: 10px;
            }
        </style>
        <div class="panel-body">
            <form action="{{url('exam/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">Exam Name <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" class="form-control" type="text" name="name" id="name" placeholder="Exam Name" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                          <div class="form-group {{$errors->has('time') ? 'has-error' : ''}}">
                              <label class="" for="time">Time <span class="star">* ( Total Minute)</span></label>
                              <div class="">
                                  <input value="{{old('time')}}" class="form-control" type="text" name="time" id="time" placeholder="Time" data-validation="required length number" data-validation-length="max10">
                              </div>
                              @if ($errors->has('time'))
                                  <span class="help-block">
                                      <strong>{{$errors->first('time')}}</strong>
                                  </span>
                              @endif
                          </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('exam_type') ? 'has-error' : ''}}">
                            <label class="" for="exam_type">Exam Type <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="exam_type" id="exam_type" data-validation="required" >
                                    <option value="">Select Exam Type</option>
                                    <option value="1">Online</option>
                                    <option value="2">Offline</option>
                                </select>
                            </div>
                            @if ($errors->has('exam_type'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_type')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('full_mark') ? 'has-error' : ''}}">
                            <label class="" for="full_mark">Full marks <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('full_mark')}}" class="form-control" type="text" name="full_mark" id="full_mark" placeholder="Full marks" data-validation="required length number" data-validation-length="max100" data-validation-allowing="float">
                            </div>
                            @if ($errors->has('full_mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('full_mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('result_type') ? 'has-error' : ''}}">
                            <label class="" for="result_type"> Result type <span class="star">(If exam type online)</span></label>
                            <div class="">
                                <select class="form-control" name="result_type" id="result_type" data-validation="required" >
                                    <option value="">Select result type</option>
                                    <option value="1">Grade</option>
                                    <option value="2">General</option>
                                </select>
                            </div>
                            @if ($errors->has('result_type'))
                                <span class="help-block">
                                    <strong>{{$errors->first('result_type')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('exam_option') ? 'has-error' : ''}}">
                            <label class="" for="exam_option"> How many attend the exam ?  <span class="star">(If exam online)</span></label>
                            <div class="">
                                <select class="form-control" name="exam_option" id="exam_option" data-validation="required" >
                                    <option value="">Select any one</option>
                                    <option value="1">One time</option>
                                    <option value="2">More than one</option>
                                </select>
                            </div>
                            @if ($errors->has('exam_option'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_option')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('pass_mark') ? 'has-error' : ''}}">
                            <label class="" for="pass_mark">Pass Marks <span class="star">(If exam type online)</span></label>
                            <div class="">
                                <input value="{{old('pass_mark')}}" class="form-control" type="text" name="pass_mark" id="pass_mark" placeholder="Pass Marks" data-validation="required length number" data-validation-length="max100" data-validation-allowing="float">
                            </div>
                            @if ($errors->has('pass_mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pass_mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">Shift <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('shift')}}" class="form-control" type="text" name="shift" id="shift" placeholder="Shift" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('shift'))
                                <span class="help-block">
                                    <strong>{{$errors->first('shift')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('type') ? 'has-error' : ''}}">
                            <label class="" for="type"> Type <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type" id="type" data-validation="required" >
                                    <option value="">Select Type</option>
                                    <option value="1">MCQ</option>
                                    <option value="2">Written</option>
                                </select>
                            </div>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{$errors->first('type')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">Class <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="master_class_id" id="master_class_id" data-validation="required" >
                                    <option value="">Select Class</option>
                                    @if($classes)
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    @endif
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
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group_class_id">Group <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="group_class_id" id="group_class_id" data-validation="required" >
                                    <option value="">Select Group</option>
                                    @if($group_classes)
                                        @foreach($group_classes as $group_class)
                                            <option value="{{$group_class->id}}">{{$group_class->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($errors->has('group_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('group_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section">Section <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('section')}}" class="form-control" type="text" name="section" id="section" placeholder="Section" data-validation="required length" data-validation-length="max100" name="section">
                            </div>
                            @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{$errors->first('section')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('subject_id') ? 'has-error' : ''}}">
                            <label class="" for="subject_id">Subject <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="subject_id" id="subject_id" data-validation="required" >
                                    <option value="">Select Subject</option>
                                    @if($subjects)
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($errors->has('subject_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                  </div>

                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <div class="form-group">
                            <button id="save_btn" type="submit" class="btn btn-block btn-info">Save</button>
                        </div>
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>

@if($errors->any())
    <script>
        document.getElementById('master_class_id').value={{old('master_class_id')}};
    </script>
    <script>
        document.getElementById('result_type').value={{old('result_type')}};
    </script>
    <script>
        document.getElementById('type').value={{old('type')}};
    </script>
    <script>
        document.getElementById('exam_option').value={{old('exam_option')}};
    </script>
    <script>
        document.getElementById('exam_type').value={{old('exam_type')}};
    </script>
    <script>
        document.getElementById('group_class_id').value={{old('group_class_id')}};
    </script>
    <script>
        document.getElementById('subject_id').value={{old('subject_id')}};
    </script>
@endif



@endsection

@section('script')
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( ".date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true
            }).val();
        } );
    </script>
@endsection
