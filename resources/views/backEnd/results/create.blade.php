@extends('backEnd.master')

@section('mainTitle', 'Result Entry')
@section('head_section')
    <style>
       
        .select2-selection.select2-selection--single {
            height:  35px;
        }
    </style>
@endsection
@section('active_result', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ফলাফল এন্ট্রি করুন</h1>
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
            <form name="add-result-form" action="{{url('result/search/make')}}" method="get" >
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="class">শ্রেণী <span class="star">*</span></label>
                            <select name="master_class_id" id="class" class="form-control" required="">
                                <option value="">...শ্রেণী নির্বাচন করুন...</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group1">গ্রুপ / বিভাগ <span class="star">*</span></label>
                            <select name="group_class_id" id="group1" class="form-control" required="">
                                <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
                                @foreach($group_classes as $group_class)
                                  <option value="{{$group_class->id}}">{{$group_class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift1">শিফট <span class="star">*</span></label>
                            <select name="shift" id="shift1" class="form-control" required="">
                                <option value="">...শিফট নির্বাচন করুন...</option>
                                <option value="সকাল">সকাল</option>
                                <option value="দিন">দিন</option>
                                <option value="সন্ধ্যা">সন্ধ্যা</option>
                                <option value="রাত">রাত</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section1">শাখা <span class="star">*</span></label>
                            <select name="section" id="section1" class="form-control" required="">
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
                    </div>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">অনুসন্ধান করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
      <hr>
        @if(isset($students)&& count($students)>0)
            <form id="result_from" name="result_from" action="{{url('/result/store')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <label class="" for="class">পরীক্ষা <span class="star">*</span></label>
                            <select name="exam_type_id" id="exam_type_id" class="form-control" required="">
                                <option value="">...পরীক্ষা নির্বাচন করুন...</option>
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
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('exam_year') ? 'has-error' : ''}}">
                            <label class="" for="exam_year">শিক্ষাবর্ষ <span class="star">*</span></label>
                            <div class="">
                                <select name="exam_year" id="exam_year" class="form-control" required="">
                                <option value="">...শিক্ষাবর্ষ নির্বাচন করুন...</option>
                                <option value="{{date('Y')}}">{{date('Y')}}</option>
                                <option value="{{date('Y')-1}}">{{date('Y')-1}}</option>
                            </select>
                            </div>
                            @if ($errors->has('exam_year'))
                                <span class="help-block" style="color: red;">
                                    {{$errors->first('exam_year')}}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('student_id') ? 'has-error' : ''}}">
                            <label class="" for="student_id">শিক্ষার্থী <span class="star">*</span></label>
                            <div class="">
                                <select name="student_id" id="student_id" class="form-control" onchange="select_student_roll();" required="">
                                <option value="">...শিক্ষার্থী নির্বাচন করুন...</option>
                                @foreach($students as $student)
                                    <option value="{{$student->student_id}}">{{$student->user->name}} ({{$student->student_id}})</option>
                                @endforeach
                            </select>
                            </div>
                            @if ($errors->has('student_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('student_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group {{$errors->has('roll') ? 'has-error' : ''}}">
                            <label class="" for="roll">শ্রেণী রোল<span class="star">*</span></label>
                            <div class="">
                                <input type="text" placeholder="শ্রেণী রোল" name="roll" id="roll" class="form-control" value="{{old('roll')}}" readonly="readonly">
                            </div>
                            @if ($errors->has('roll'))
                                <span class="help-block">
                                    <strong>{{$errors->first('roll')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <input type="hidden" value="{{$search['master_class_id'] ?? ''}}" name="master_class_id">
                <input type="hidden" value="{{$search['group_class_id']??''}}" name="group_class_id">
                <input type="hidden" value="{{$search['shift']??''}}" name="shift">
                <input type="hidden" value="{{$search['section']??''}}" name="section">
                @foreach($subjects as $key=>$subject)
                <div class="row" id="row{{$key}}">
                    <div class="{{in_array($search['master_class_id'],['8','9','10','11','12'])?'col-sm-2':'col-sm-3'}}">
                        <div class="form-group {{$errors->has('subject_name') ? 'has-error' : ''}}">
                            <label class="" for="subject_name">{{$subject->subject_name}}<span class="star">*</span></label>
                            <div class="">
                                <input type="hidden" value="{{$subject->id}}" name="subject_id[]" class="form-control" readonly="readonly">

                                <input type="text" value="{{$subject->subject_name}}" name="subject_name[]" class="form-control" readonly="readonly">
                            </div>
                            @if ($errors->has('subject_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject_name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2" style="display: {{in_array($search['master_class_id'],['8','9','10','11','12'])?'block':'none'}};">
                        <div class="form-group {{$errors->has('ca_mark') ? 'has-error' : ''}}">
                            <label class="" for="ca_mark">সিএ নম্বর</label>
                            <div class="">
                                <input value="--" class="form-control" type="text" name="ca_mark[]">
                            </div>
                            @if ($errors->has('ca_mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('ca_mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group {{$errors->has('cr_mark') ? 'has-error' : ''}}">
                            <label class="" for="cr_mark">সিআর/তত্ত্বীয় নম্বর</label>
                            <div class="">
                                <input value="--" class="form-control" type="text" name="cr_mark[]">
                            </div>
                            @if ($errors->has('cr_mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('cr_mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group {{$errors->has('mcq_mark') ? 'has-error' : ''}}">
                            <label class="" for="mcq_mark">এমসিকিউ নম্বর</label>
                            <div class="">
                                <input value="--" class="form-control" type="text" name="mcq_mark[]">
                            </div>
                            @if ($errors->has('mcq_mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('mcq_mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group {{$errors->has('pr_mark') ? 'has-error' : ''}}">
                            <label class="" for="pr_mark">পিআর নম্বর</label>
                            <div class="">
                                <input value="--" class="form-control" type="text" name="pr_mark[]">
                            </div>
                            @if ($errors->has('pr_mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pr_mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

<input type="hidden" name="total_mark[]" value="{{$subject->total_mark}}">
<input type="hidden" name="ca_pass_mark[]" value="{{($subject->ca_pass_mark)?$subject->ca_pass_mark:0}}">
<input type="hidden" name="cr_pass_mark[]" value="{{($subject->cr_pass_mark)?$subject->cr_pass_mark:0}}">
<input type="hidden" name="mcq_pass_mark[]" value="{{($subject->mcq_pass_mark)?$subject->mcq_pass_mark:0}}">
<input type="hidden" name="pr_pass_mark[]" value="{{($subject->pr_pass_mark)?$subject->pr_pass_mark:0}}">
<input type="hidden"  name="total_pass_mark[]" value="{{$subject->total_pass_mark}}">

<input type="hidden" name="subject_type[]" value="{{$subject->subject_type}}">

                    <div class="{{in_array($search['master_class_id'],['8','9','10','11','12'])?'col-sm-2':'col-sm-3'}}">
                        <div class="form-group {{$errors->has('subject_status') ? 'has-error' : ''}}">
                            <label class="" for="subject_status">সাবজেক্ট স্টেটাস<span class="star">*</span></label>
                            <div class="">
                                @if($subject->status=='কমন'||$subject->status=='ঐচ্ছিক'||$subject->subject_type=='ধর্ম শিক্ষা')
                                <select name="subject_status[]" id="subject_status" class="form-control">
                                    <option value="">স্টেটাস নির্বাচন করুন</option>
                                    @if($subject->subject_type=='ধর্ম শিক্ষা')
                                    <option value="আবশ্যিক">আবশ্যিক</option>
                                    @endif
                                    @if($subject->status=='কমন')
                                    <option value="আবশ্যিক">আবশ্যিক</option>
                                    <option value="ঐচ্ছিক">ঐচ্ছিক</option>
                                    @endif
                                    @if($subject->status=='ঐচ্ছিক')
                                    <option value="ঐচ্ছিক">ঐচ্ছিক</option>
                                    @endif
                                </select>
                                @else
                                 <input type="text" class="form-control" name="subject_status[]" id="subject_status" value="{{$subject->status}}" readonly="readonly">
                                @endif
                            </div>
                            @if ($errors->has('subject_status'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject_status')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">সংরক্ষণ করুন</button>
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
       function select_student_roll(){
        var student_id = $('#student_id').val();
        $.ajax({
            url: "{{url('result/get/student_roll')}}",
            type: 'get',
            data: {'student_id': student_id},
            success: function (data) {
                $('#roll').val(data.roll);
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
       document.forms['result_from'].elements['exam_type_id'].value="{{old('exam_type_id')}}";
       document.forms['result_from'].elements['student_id'].value="{{old('student_id')}}";
   </script>
@endsection
