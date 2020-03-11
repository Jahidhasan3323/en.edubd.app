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
            <h1 class="text-center text-temp">ফলাফল সম্পাদন করুন</h1>
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
        @if(isset($students)&& count($students)>0)
            <form id="result_from" name="result_from" action="{{url('/ca-result/update')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                  <div class="col-md-3 col-sm-12">
                      <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                          <label class="" for="master_class_id">শ্রেণী <span class="star">*</span></label>
                          <select name="master_class_id" id="master_class_id" class="form-control" required="">
                              <option value="">...শ্রেণী নির্বাচন করুন...</option>
                              @foreach($classes as $class)
                                  <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  
                  <div class="col-md-3 col-sm-12">
                      <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                          <label class="" for="group_class_id">গ্রুপ / বিভাগ <span class="star">*</span></label>
                          <select name="group_class_id" id="group_class_id" class="form-control" required="">
                              <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
                              @foreach($group_classes as $group_class)
                                <option value="{{$group_class->id}}">{{$group_class->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-md-3 col-sm-12">
                      <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                          <label class="" for="shift">শিফট <span class="star">*</span></label>
                          <select name="shift" id="shift" class="form-control" required="">
                              <option value="">...শিফট নির্বাচন করুন...</option>
                              <option value="সকাল">সকাল</option>
                              <option value="দিন">দিন</option>
                              <option value="সন্ধ্যা">সন্ধ্যা</option>
                              <option value="রাত">রাত</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-md-3 col-sm-12">
                      <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                          <label class="" for="section">শাখা <span class="star">*</span></label>
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
                  </div>
              </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <label class="" for="class">পরীক্ষা <span class="star">*</span></label>
                            <select name="exam_type_id" id="exam_type_id" class="form-control">
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
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group {{$errors->has('exam_year') ? 'has-error' : ''}}">
                            <label class="" for="exam_year">শিক্ষাবর্ষ <span class="star">*</span></label>
                            <div class="">
                                <select name="exam_year" id="exam_year" class="form-control">
                                <option value="">...শিক্ষাবর্ষ নির্বাচন করুন...</option>
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
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group {{$errors->has('subject_id') ? 'has-error' : ''}}">
                            <label class="" for="subject_id">বিষয় <span class="star">*</span></label>
                            <div class="">
                                <select name="subject_id" id="subject_id" class="form-control" onchange="select_subject_details();" required="">
                                    <option value="">...বিষয় নির্বাচন করুন...</option>
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
                    @php
                    $subject=App\CaSubject::where([
                    'school_id'=>Auth::getSchool(),
                    'master_class_id'=>$search['master_class_id'],
                    'group_class_id'=>$search['group_class_id'],
                    'id'=>$search['subject_id']
                    ])->first();
                    @endphp
                    <input type="hidden" name="subject_name" value="{{$subject->subject_name}}" id="subject_name">
                    <input type="hidden" name="total_mark" value="{{$subject->total_mark}}" id="total_mark">
                    <input type="hidden"  name="pass_mark" value="{{$subject->pass_mark}}" id="pass_mark">
                </div>
                <hr>


            @foreach($students as $key=>$student)

            @php
            $result=App\CaResult::where([
              'school_id'=>Auth::getSchool(),
              'student_id'=>$student->student_id,
              'master_class_id'=>$search['master_class_id'],
              'group_class_id'=>$search['group_class_id'],
              'shift'=>$search['shift'],
              'section'=>$search['section'],
              'exam_year'=>$search['exam_year'],
              'exam_type_id'=>$search['exam_type_id'],
              'subject_id'=>$search['subject_id'],
              'author_by'=>Auth::user()->id,
            ])->first();
            @endphp
                <input type="hidden" name="result_id[]" value="{{isset($result->id)?$result->id:''}}">
                <div class="row" id="row{{$key}}">
                    <div class="col-md-4 col-md-12">
                        <div class="form-group">
                            <label class="" for="student_id">শিক্ষার্থী<span class="star">*</span></label>
                            <div class="">
                                <input type="hidden" name="student_id[]" value="{{$student->student_id}}">
                                <input type="text" placeholder="শিক্ষার্থী" class="form-control" value="{{$student->user->name}}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-12">
                        <div class="form-group">
                            <label class="" for="roll">শ্রেণী রোল<span class="star">*</span></label>
                            <div class="">
                                <input type="text" placeholder="শ্রেণী রোল" name="roll[]" class="form-control" value="{{$student->roll}}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-md-12">
                        <div class="form-group">
                            <label class="" for="marks">প্রাপ্ত নম্বর</label>
                            <div class="">
                                <input value="{{isset($result->marks)&&$result->marks>0?$result->marks:'--'}}" class="form-control" type="text" name="marks[]">
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
        document.forms['result_from'].elements['master_class_id'].value="{{$search['master_class_id']}}";
        document.forms['result_from'].elements['group_class_id'].value="{{$search['group_class_id']}}";
        document.forms['result_from'].elements['shift'].value="{{$search['shift']}}";
        document.forms['result_from'].elements['section'].value="{{$search['section']}}";
        document.forms['result_from'].elements['exam_year'].value="{{$search['exam_year']}}";
        document.forms['result_from'].elements['subject_id'].value="{{$search['subject_id']}}";
        document.forms['result_from'].elements['exam_type_id'].value="{{$search['exam_type_id']}}";
        </script>
    @endif
    @if($errors->any())
    <script type="text/javascript">
        document.forms['result_from'].elements['master_class_id'].value="{{old('master_class_id')}}";
        document.forms['result_from'].elements['group_class_id'].value="{{old('group_class_id')}}";
        document.forms['result_from'].elements['shift'].value="{{old('shift')}}";
        document.forms['result_from'].elements['section'].value="{{old('section')}}";
        document.forms['result_from'].elements['exam_year'].value="{{old('exam_year')}}";
        document.forms['result_from'].elements['subject_id'].value="{{old('subject_id')}}";
        document.forms['result_from'].elements['exam_type_id'].value="{{old('exam_type_id')}}";
    </script>
    @endif
@endsection
