@extends('backEnd.master')

@section('mainTitle', 'Assign Subject to Teacher')
@section('active_subject', 'active')

@section('head_section')
    <style>
        .select2-selection.select2-selection--single {
            height:  35px;
        }
    </style>
@endsection

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিষয় ভিত্তিক শিক্ষক যোগ করুন</h1>
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

        <div class="panel-body">
            <form action="{{url('/subjectTeachers/store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('staff_id') ? 'has-error' : ''}}">
                            <label class="" for="staff_id">শিক্ষক নির্বাচন করুন <span class="star">*</span></label>
                            <div class="">
                                <select name="staff_id" id="staff_id" class="form-control">
                                    <option value="">... শিক্ষক নির্বাচন করুন ...</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->name.' ('.$teacher->subject.')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('staff_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('staff_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">শ্রেণী নির্বাচন করুন <span class="star">*</span></label>
                            <div class="">
                                <select name="master_class_id" id="master_class_id" class="form-control">
                                    <option value="">... শ্রেণী নির্বাচন করুন ...</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('master_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('master_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">শিফট <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="shift" id="shift">
                                    <option value="">শিফট নির্বাচন করুন</option>
                                    <option value="সকাল">সকাল</option>
                                    <option value="দিন">দিন</option>
                                    <option value="সন্ধ্যা">সন্ধ্যা</option>
                                    <option value="রাত">রাত</option>
                                </select>
                            </div>
                            @if ($errors->has('shift'))
                                <span class="help-block">
                                    <strong>{{$errors->first('shift')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section">শাখা নির্বাচন করুন </label>
                            <div class="">
                                <select name="section" id="section" class="form-control">
                                    <option value="">... শাখা নির্বাচন করুন ...</option>
                                    <option value="ক">ক</option>
                                    <option value="খ">খ</option>
                                    <option value="গ">গ</option>
                                    <option value="ঘ">ঘ</option>
                                    @foreach($units as $unit)
                                    <option value="{!!$unit->name!!}">{!!$unit->name!!}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{$errors->first('section')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group_class_id">বিভাগ নির্বাচন করুন </label>
                            <div class="">
                                <select name="group_class_id" id="group_class_id" class="form-control">
                                    <option value="">... বিভাগ নির্বাচন করুন ...</option>
                                    @foreach($class_groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('group_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('group_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('ca_subject_id') ? 'has-error' : ''}}">
                            <label class="" for="subject_id">বিষয় নির্বাচন করুন <span class="star">*</span></label>
                            <div class="">
                                <select name="subject_id" id="subject_id" class="form-control">
                                    <option value="{{old('subject_id')}}">
                            @if($errors->any())
                                @php($old_sb_t=DB::table('CaSubjects')->where(['id'=>old('subject_id'),'school_id'=>Auth::getSchool()])->first())
                            @endif
                                {{isset($old_sb_t->subject_name)?$old_sb_t->subject_name:''}}</option>
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
                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
  <script src="{{asset('backEnd/js/appsJs/subjectTeacher.js')}}"></script>
  @if($errors->any())
  <script type="text/javascript">
     document.getElementById('staff_id').value="{{old('staff_id')}}";
     document.getElementById('master_class_id').value="{{old('master_class_id')}}";
     document.getElementById('shift').value="{{old('shift')}}";
     document.getElementById('section').value="{{old('section')}}";
     document.getElementById('group_class_id').value="{{old('group_class_id')}}";
     document.getElementById('ca_subject_id').value="{{old('ca_subject_id')}}";
  </script>
  @endif
@endsection