@extends('backEnd.master')

@section('mainTitle', 'Student Attendence Entry')
@section('active_attendance', 'active')
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
            <h1 class="text-center text-temp">ম্যানুয়ালি শিক্ষার্থী উপস্থিতি এন্ট্রি</h1>
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
            <form name="add-result-form" action="{{url('menual/student-entry')}}" method="get" >
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
            <form id="result_from" action="{{url('/menual/student-entry-store')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12"><h4>সকল উপস্থিত শিক্ষার্থীদের মার্ক করুন</h4></div>
                </div>

                <div class="row">
                    @foreach($students as $student)
                    @php $check = \App\AttenStudent::where([
                    'student_id'=>$student->student_id,
                    'school_id'=>Auth::getSchool()
                    ])->whereDate('date',date('Y-m-d'))->first();
                    @endphp
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="student_id[]" value="{{$student->student_id}}" {{($check)?'checked':''}}>{{$student->user->name}} "শ্রেণী রোল-{{str_replace($s, $r, $student->roll)}}"
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                
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
   @if(isset($search) && $search!=NULL)
       <script>
           document.forms['add-result-form'].elements['master_class_id'].value="{{$search['master_class_id']}}";
           document.forms['add-result-form'].elements['group_class_id'].value="{{$search['group_class_id']}}";
           document.forms['add-result-form'].elements['shift'].value="{{$search['shift']}}";
           document.forms['add-result-form'].elements['section'].value="{{$search['section']}}";
       </script>
   @endif
@endsection
