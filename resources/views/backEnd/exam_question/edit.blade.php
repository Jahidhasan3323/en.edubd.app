@extends('backEnd.master')

@section('mainTitle', 'পরীক্ষা তৈরি করুন')
@section('question', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">পরীক্ষা তৈরি করুন</h1>
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
            <form action="{{url('exam/edit',$exam->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">পরীক্ষার নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name',$exam->name)}}" class="form-control" type="text" name="name" id="name" placeholder="পরীক্ষা্র নাম" data-validation="required length" data-validation-length="max100">
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
                              <label class="" for="time">সময় <span class="star">* ( মোট মিনিট )</span></label>
                              <div class="">
                                  <input value="{{old('time',$exam->time)}}" class="form-control" type="text" name="time" id="time" placeholder="সময়" data-validation="required length number" data-validation-length="max10">
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
                            <label class="" for="exam_type">পরীক্ষার ধরন <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="exam_type" id="exam_type" data-validation="required" >
                                    <option value="">পরীক্ষার ধরন নির্বাচন করুন</option>
                                    <option value="1">অনলাইন</option>
                                    <option value="2">অফলাইন</option>
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
                            <label class="" for="full_mark">পূর্ণমান <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('full_mark',$exam->full_mark)}}" class="form-control" type="text" name="full_mark" id="full_mark" placeholder="পূর্ণমান" data-validation="required length number" data-validation-length="max100" data-validation-allowing="float">
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
                            <label class="" for="result_type"> ফলাফলের ধরন  <span class="star">(যদি পরীক্ষা টাইপ অনলিন হয়)</span></label>
                            <div class="">
                                <select class="form-control" name="result_type" id="result_type" data-validation="required" >
                                    <option value="">ফলাফলের ধরন নির্বাচন করুন</option>
                                    <option value="1">গ্রেড</option>
                                    <option value="2">সাধারন</option>
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
                            <label class="" for="exam_option"> পরীক্ষা কতবার দিতে পারবে ?  <span class="star">(যদি পরীক্ষা টাইপ অনলিন হয়)</span></label>
                            <div class="">
                                <select class="form-control" name="exam_option" id="exam_option" data-validation="required" >
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="1">একবার</option>
                                    <option value="2">একাধিকবার</option>
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
                            <label class="" for="pass_mark">পাস মার্ক <span class="star">(যদি পরীক্ষা টাইপ অনলিন হয়)</span></label>
                            <div class="">
                                <input value="{{old('pass_mark',$exam->pass_mark)}}" class="form-control" type="text" name="pass_mark" id="pass_mark" placeholder="পাস মার্ক" data-validation="required length number" data-validation-length="max100" data-validation-allowing="float">
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
                            <label class="" for="shift">শিফট <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('shift',$exam->shift)}}" class="form-control" type="text" name="shift" id="shift" placeholder="শিফট" data-validation="required length" data-validation-length="max100">
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
                            <label class="" for="type"> ধরন <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type" id="type" data-validation="required" >
                                    <option value=""> ধরন নির্বাচন করুন</option>
                                    <option value="1">নৈর্ব্যক্তিক</option>
                                    <option value="2">লিখিত</option>
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
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group_class_id">গ্রুপ <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="group_class_id" id="group_class_id" data-validation="required" >
                                    <option value="">গ্রুপ নির্বাচন করুন</option>
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
                            <label class="" for="section">শাখা <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('section',$exam->section)}}" class="form-control" type="text" name="section" id="section" placeholder="শাখা" data-validation="required length" data-validation-length="max100" name="section">
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
                            <label class="" for="subject_id">বিষয় <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="subject_id" id="subject_id" data-validation="required" >
                                    <option value="">বিষয় নির্বাচন করুন</option>
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
                            <button id="save_btn" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
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
@else
    <script>
        document.getElementById('master_class_id').value={{old('master_class_id',$exam->master_class_id)}};
    </script> 
    <script>
        document.getElementById('result_type').value={{old('result_type',$exam->result_type)}};
    </script>
    <script>
        document.getElementById('type').value={{old('type',$exam->type)}};
    </script>
    <script>
        document.getElementById('exam_option').value={{old('exam_option',$exam->exam_option)}};
    </script>
    <script>
        document.getElementById('exam_type').value={{old('exam_type',$exam->exam_type)}};
    </script>
    <script>
        document.getElementById('group_class_id').value={{old('group_class_id',$exam->group_class_id)}};
    </script>
    <script>
        document.getElementById('subject_id').value={{old('subject_id',$exam->subject_id)}};
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