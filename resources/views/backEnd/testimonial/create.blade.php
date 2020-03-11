@extends('backEnd.master')

@section('mainTitle', 'প্রশংসাপত্র তৈরি করুন')
@section('active_testimonial', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রশংসাপত্র তৈরি করুন</h1>
            <h3 class="text-center text-temp">নিম্নে শিক্ষার্থীর তথ্য দিন</h3>
            <hr>
            <form class="form-inline" style="text-align: center" method="get" action="{{url('testimonial/search_student')}}">
                @csrf
                <div class="form-group {{$errors->has('student_id') ? 'has-error' : ''}}">
                  <label for="photo">শিক্ষার্থীর আইডি নং <span class="star">*</span></label>
                  <input type="text" name="student_id" class="form-control" placeholder="শিক্ষার্থীর আইডি নং" data-validation="required length " data-validation-length="max100" value="{{old('student_id')}}">
                  @if ($errors->has('student_id'))
                      <span class="help-block">
                          <strong>{{$errors->first('student_id')}}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> </button>
              </div>
            </form>
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
            @if (isset($student))
            <form action="{{url('testimonial/store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('student_id') ? 'has-error' : ''}}">
                            <label class="" for="student_id">শিক্ষার্থীর আইডি নং <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('student_id',$student->student_id)}}" class="form-control" type="text" name="student_id" id="student_id" placeholder="শিক্ষার্থীর আইডি নং" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('student_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('student_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">শিক্ষার্থীর নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name',$student->user->name)}}" class="form-control" type="text" name="name" id="name" placeholder="শিক্ষার্থীর নাম" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('father_name') ? 'has-error' : ''}}">
                            <label class="" for="father_name">পিতার নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('father_name',$student->father_name)}}" class="form-control" type="text" name="father_name" id="father_name" placeholder="পিতার নাম" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('father_name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('mother_name') ? 'has-error' : ''}}">
                            <label class="" for="mother_name">মাতার নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('mother_name',$student->mother_name)}}" class="form-control" type="text" name="mother_name" id="mother_name" placeholder="মাতার নাম" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('mother_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('mother_name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('village') ? 'has-error' : ''}}">
                            <label class="" for="village">গ্রাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('village',$student->per_vpm)}}" class="form-control" type="text" name="village" id="village" placeholder="গ্রাম" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('village'))
                                <span class="help-block">
                                    <strong>{{$errors->first('village')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('post_office') ? 'has-error' : ''}}">
                            <label class="" for="post_office">ডাকঘর <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('post_office',$student->per_unim)}}" class="form-control" type="text" name="post_office" id="post_office" placeholder="ডাকঘর" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('post_office'))
                                <span class="help-block">
                                    <strong>{{$errors->first('post_office')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('upazila') ? 'has-error' : ''}}">
                            <label class="" for="upazila">থানা <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('upazila',$student->per_subd)}}" class="form-control" type="text" name="upazila" id="upazila" placeholder="থানা" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('upazila'))
                                <span class="help-block">
                                    <strong>{{$errors->first('upazila')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('district') ? 'has-error' : ''}}">
                            <label class="" for="mother_name">জেলা <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('district',$student->per_district)}}" class="form-control" type="text" name="district" id="district" placeholder="জেলা" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('district'))
                                <span class="help-block">
                                    <strong>{{$errors->first('district')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('exam_session') ? 'has-error' : ''}}">
                            <label class="" for="exam_session">পরীক্ষার সাল <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('exam_session')}}" class="form-control" type="text" name="exam_session" id="exam_session" placeholder="পরীক্ষার সাল" data-validation="required length" data-validation-length="max100" >
                            </div>
                            @if ($errors->has('exam_session'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_session')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('gpa') ? 'has-error' : ''}}">
                            <label class="" for="gpa">প্রাপ্ত জিপিএ <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('gpa')}}" class="form-control" type="text" name="gpa" id="gpa" placeholder="প্রাপ্ত জিপিএ " data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('gpa'))
                                <span class="help-block">
                                    <strong>{{$errors->first('gpa')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('roll') ? 'has-error' : ''}}">
                            <label class="" for="roll">পরীক্ষার রোল নম্বর <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('roll')}}" class="form-control" type="text" name="roll" id="roll" placeholder="পরীক্ষার রোল নম্বর" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('roll'))
                                <span class="help-block">
                                    <strong>{{$errors->first('roll')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('reg_no') ? 'has-error' : ''}}">
                            <label class="" for="reg_no">রেজিস্ট্রেশন নম্বর <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('reg_no')}}" class="form-control" type="text" name="reg_no" id="reg_no" placeholder="রেজিস্ট্রেশন নম্বর" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('reg_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('reg_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('board') ? 'has-error' : ''}}">
                            <label class="" for="board">শিক্ষা বোর্ড <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('board')}}" class="form-control" type="text" name="board" id="board" placeholder="শিক্ষা বোর্ড" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('board'))
                                <span class="help-block">
                                    <strong>{{$errors->first('board')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('session') ? 'has-error' : ''}}">
                            <label class="" for="session">শিক্ষাবর্ষ <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('session')}}" class="form-control" type="text" name="session" id="session" placeholder="শিক্ষাবর্ষ" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('session'))
                                <span class="help-block">
                                    <strong>{{$errors->first('session')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('exam') ? 'has-error' : ''}}">
                            <label class="" for="exam">পরীক্ষার ধরণ <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('exam')}}" class="form-control" type="text" name="exam" id="exam" placeholder="পরীক্ষার ধরণ" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('exam'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                          <div class="form-group {{$errors->has('birth_day') ? 'has-error' : ''}}">
                              <label class="" for="birth_day">জন্ম তারিখ <span class="star">*</span></label>
                              <div class="">
                                  <input value="{{old('birth_day',$student->birthday)}}" class="form-control date" type="text" name="birth_day" id="birth_day" placeholder="জন্ম তারিখ" data-validation="required length" data-validation-length="max100">
                              </div>
                              @if ($errors->has('birth_day'))
                                  <span class="help-block">
                                      <strong>{{$errors->first('birth_day')}}</strong>
                                  </span>
                              @endif
                          </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">শ্রেণী <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="master_class_id" id="master_class_id" data-validation="required" >
                                    <option value="">শ্রেণী নির্বাচন করুন</option>
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
                    <div class="col-md-6">
                          <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                              <label class="" for="shift">শিফট <span class="star">*</span></label>
                              <div class="">
                                  <input value="{{old('shift',$student->shift)}}" class="form-control" type="text" name="shift" id="shift" placeholder="শিফট" data-validation="required length" data-validation-length="max100">
                              </div>
                              @if ($errors->has('shift'))
                                  <span class="help-block">
                                      <strong>{{$errors->first('shift')}}</strong>
                                  </span>
                              @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                          <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                              <label class="" for="section">শাখা <span class="star">*</span></label>
                              <div class="">
                                  <input value="{{old('section',$student->section)}}" class="form-control" type="text" name="section" id="section" placeholder="শাখা" data-validation="required length" data-validation-length="max100">
                              </div>
                              @if ($errors->has('section'))
                                  <span class="help-block">
                                      <strong>{{$errors->first('section')}}</strong>
                                  </span>
                              @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                          <div class="form-group {{$errors->has('group') ? 'has-error' : ''}}">
                              <label class="" for="group">গ্রুপ / বিভাগ <span class="star">*</span></label>
                              <div class="">
                                  <input value="{{old('group',$student->group)}}" class="form-control" type="text" name="group" id="group" placeholder="গ্রুপ / বিভাগ" data-validation="required length" data-validation-length="max100">
                              </div>
                              @if ($errors->has('group'))
                                  <span class="help-block">
                                      <strong>{{$errors->first('group')}}</strong>
                                  </span>
                              @endif
                          </div>
                    </div>
                    
                  </div>
                 
                <hr>

                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <div class="form-group">
                            <button id="save_btn" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                        </div>
                    </div>
                </div>
                <hr>
            </form>
            <script>
                document.getElementById('master_class_id').value={{old('master_class_id',$student->master_class_id)}};
            </script>
            @endif
        </div>
    </div>

   
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