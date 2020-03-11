@extends('backEnd.master')

@section('mainTitle', 'Edit Result')
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
            <h1 class="text-center text-temp">ফলাফল সম্পাদনার জন্য অনুসন্ধান করুন</h1>
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
            <form name="add-result-form" action="{{url('ca-result/edit')}}" method="get" >
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-3">
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
                    <div class="col-sm-3">
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
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">শ্রেণী <span class="star">*</span></label>
                            <select name="master_class_id" id="master_class_id" class="form-control">
                                <option value="">...শ্রেণী নির্বাচন করুন...</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('master_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('master_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group_class_id">গ্রুপ / বিভাগ <span class="star">*</span></label>
                            <select name="group_class_id" id="group_class_id" class="form-control">
                                <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
                                @foreach($group_classes as $group_class)
                                  <option value="{{$group_class->id}}">{{$group_class->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('group_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('group_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">শিফট <span class="star">*</span></label>
                            <select name="shift" id="shift" class="form-control">
                                <option value="">...শিফট নির্বাচন করুন...</option>
                                <option value="সকাল">সকাল</option>
                                <option value="দিন">দিন</option>
                                <option value="সন্ধ্যা">সন্ধ্যা</option>
                                <option value="রাত">রাত</option>
                            </select>
                            @if ($errors->has('shift'))
                                <span class="help-block">
                                    <strong>{{$errors->first('shift')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section">শাখা <span class="star">*</span></label>
                            <select name="section" id="section" class="form-control">
                                <option value="">...শাখা নির্বাচন করুন...</option>
                                <option value="ক">ক</option>
                                <option value="খ">খ</option>
                                <option value="গ">গ</option>
                                <option value="ঘ">ঘ</option>
                                @foreach($units as $unit)
                                <option value="{!!$unit->name!!}">{!!$unit->name!!}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{$errors->first('section')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('subject_id') ? 'has-error' : ''}}">
                            <label class="" for="subject_id">বিষয় <span class="star">*</span></label>
                            <div class="">
                                <select name="subject_id" id="subject_id" class="form-control">
                                    @if($errors->any())
                                    <option value="{{old('subject_id')}}">{{App\Subject::where(['school_id'=>Auth::getSchool(),'id'=> old('subject_id')])->first()->subject_name}}</option>
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
        </div>
    </div>
@endsection
@section('script')
   <script src="{{asset('backEnd/js/appsJs/caSubjectTeacher.js')}}"></script>
  
   @if($errors->any())
   <script>
       document.forms['add-result-form'].elements['exam_year'].value="{{old('exam_year')}}";
       document.forms['add-result-form'].elements['subject_id'].value="{{old('subject_id')}}";
       document.forms['add-result-form'].elements['exam_type_id'].value="{{old('exam_type_id')}}";
       document.forms['add-result-form'].elements['master_class_id'].value="{{old('master_class_id')}}";
       document.forms['add-result-form'].elements['group_class_id'].value="{{old('group_class_id')}}";
       document.forms['add-result-form'].elements['shift'].value="{{old('shift')}}";
       document.forms['add-result-form'].elements['section'].value="{{old('section')}}";
   </script>
   @endif
@endsection
