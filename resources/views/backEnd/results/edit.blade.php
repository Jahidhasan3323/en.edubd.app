@extends('backEnd.master')

@section('mainTitle', 'ফলাফল সম্পাদনা করুন')
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
            <h1 class="text-center text-temp">ফলাফল সম্পাদনা করুন</h1>
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
            <form id="result_from" name="result_from" action="{{url('/result/update',[$result->student_id])}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="class">পরীক্ষা <span class="star">*</span></label>
                            <select name="exam_type_id" id="exam_type_id" class="form-control" required="">
                                <option value="">...পরীক্ষা নির্বাচন করুন...</option>
                                @foreach($exam_types as $exam)
                                    <option value="{{$exam->id}}" {{($result->exam_type_id==$exam->id)?'selected':''}}>{{$exam->name}}</option>
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
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="class">পরীক্ষার বছর <span class="star">*</span></label>
                            <input type="text" name="exam_year" placeholder="সাল" class="form-control" id="exam_year" value="{{old('exam_year',$result->exam_year)}}">
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
                                <option  value="">...শিক্ষার্থী নির্বাচন করুন...</option>
                                @foreach($students as $student)
                                    <option value="{{$student->student_id}}" {{($result->student_id==$student->student_id)?'selected':''}}>{{$student->user->name}} ({{$student->student_id}})</option>
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
                                <input type="text" placeholder="Class Roll" name="roll" id="roll" class="form-control" value="{{old('roll',$result->student->roll)}}" readonly="readonly">
                            </div>
                            @if ($errors->has('roll'))
                                <span class="help-block">
                                    <strong>{{$errors->first('roll')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{$result->master_class_id}}" name="master_class_id">
                <input type="hidden" value="{{$result->group_class_id}}" name="group_class_id">
                <input type="hidden" value="{{$result->shift}}" name="shift">
                <input type="hidden" value="{{$result->section}}" name="section">
                <hr>
                @foreach($subjects as $key=>$subject)
                 @php
                  $sub_result=\App\Result::where([
                    'subject_id'=>$subject->id,
                    'master_class_id'=>$result->master_class_id,
                    'group_class_id'=>$result->group_class_id,
                    'shift'=>$result->shift,
                    'section'=>$result->section,
                    'student_id'=>$result->student_id,
                    'exam_year'=>$result->exam_year,
                    'exam_type_id'=>$result->exam_type_id,
                    'school_id'=>Auth::getSchool(),
                  ])->first();
                 @endphp
                        <div class="row" id="row{{$key}}">
                            <div class="{{in_array($result->master_class_id,['8','9','10','11','12'])?'col-sm-2':'col-sm-3'}}">
                                <div class="form-group {{$errors->has('subject_name') ? 'has-error' : ''}}">
                                    <label class="" for="subject_name">{{$subject->subject_name}}<span class="star">*</span></label>
                                    <div class="">
                                        <input type="hidden" value="{{$subject->id}}" name="subject_id[]" class="form-control" readonly="readonly">
                                        <input type="hidden" value="{{isset($sub_result->id)?$sub_result->id:''}}" name="result_id[]" class="form-control" readonly="readonly">

                                        <input type="text" value="{{$subject->subject_name}}" name="subject_name[]" class="form-control" readonly="readonly">
                                    </div>
                                    @if ($errors->has('subject_name'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('subject_name')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2" style="display: {{in_array($result->master_class_id,['8','9','10','11','12'])?'block':'none'}};">
                                <div class="form-group {{$errors->has('ca_mark') ? 'has-error' : ''}}">
                                    <label class="" for="ca_mark">সিএ নম্বর</label>
                                    <div class="">
                                        <input value="{{isset($sub_result->ca_mark)?$sub_result->ca_mark:'--'}}" class="form-control" type="text" name="ca_mark[]">
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
                                        <input value="{{isset($sub_result->cr_mark)?$sub_result->cr_mark:'--'}}" class="form-control" type="text" name="cr_mark[]">
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
                                        <input value="{{isset($sub_result->mcq_mark)?$sub_result->mcq_mark:'--'}}" class="form-control" type="text" name="mcq_mark[]">
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
                                        <input value="{{isset($sub_result->pr_mark)?$sub_result->pr_mark:'--'}}" class="form-control" type="text" name="pr_mark[]">
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

                            <div class="{{in_array($result->master_class_id,['8','9','10','11','12'])?'col-sm-2':'col-sm-3'}}">
                                <div class="form-group {{$errors->has('subject_status') ? 'has-error' : ''}}">
                                    <label class="" for="subject_status">সাবজেক্ট স্টেটাস<span class="star">*</span></label>
                                    <div class="">
                                        @if($subject->status=='কমন'||$subject->status=='ঐচ্ছিক'||$subject->subject_type=='ধর্ম শিক্ষা')
                                        <select name="subject_status[]" id="subject_status" class="form-control">
                                            <option value="">স্টেটাস নির্বাচন করুন</option>
                                            @if($subject->subject_type=='ধর্ম শিক্ষা')
                                            <option value="আবশ্যিক" {{isset($sub_result->subject_status)?($sub_result->subject_status=='আবশ্যিক'?'selected':''):''}}>আবশ্যিক</option>
                                            @endif
                                            @if($subject->status=='Common')
                                            <option value="আবশ্যিক" {{isset($sub_result->subject_status)?($sub_result->subject_status=='আবশ্যিক'?'selected':''):''}}>আবশ্যিক</option>
                                            <option value="ঐচ্ছিক" {{isset($sub_result->subject_status)?($sub_result->subject_status=='ঐচ্ছিক'?'selected':''):''}}>ঐচ্ছিক</option>
                                            @endif
                                            @if($subject->status=='ঐচ্ছিক')
                                            <option value="ঐচ্ছিক" {{isset($sub_result->subject_status)?($sub_result->subject_status=='ঐচ্ছিক'?'selected':''):''}}>ঐচ্ছিক</option>
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
                                <button id="save" type="submit" class="btn btn-block btn-success">হালনাগাদ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
   </script>
  
@endsection
