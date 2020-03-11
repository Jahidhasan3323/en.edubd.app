
@extends('backEnd.master')
 
@section('mainTitle', 'উপস্থিতির মাসিক তালিকাপত্র (ব্ল্যান্ক)')
@section('active_attendance', 'active')

@section('content')
@if(old('user_type')=="student")
<style type='text/css'>
    .user-type-student{
        display: block;
    }
</style>
@else
<style type='text/css'>
    .user-type-student{
        display: none;
    }
</style>
@endif
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">উপস্থিতির মাসিক তালিকাপত্র তৈরী করুন (ব্ল্যান্ক)</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <form id="validate" name="validate" target="__blank" action="{{url('attendance-list/view')}}" method="get" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('month') ? 'has-error' : ''}}">
                            <label for="month">মাস<font color="red" size="4">*</font></label>
                            <div class="">
                                <select name="month" id="month" class="form-control">
                                    <option value="">---মাস নির্বাচন করুন---</option>
                                     @php($months = json_decode($months))
                                     @foreach($months as $key=>$month)
                                     <option value="{{(strlen($key+1)==1)?'0'.($key+1): ($key+1)}}">{{str_replace($s, $r, $month)}}</option>
                                     @endforeach()
                                </select>
                            </div>

                            @if ($errors->has('month'))
                                <span class="help-block">
                                    <strong>{{$errors->first('month')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('year') ? 'has-error' : ''}}">
                            <label for="year">বছর<font color="red" size="4">*</font></label>
                            <div class="">
                                <select name="year" id="year" class="form-control">
                                    <option value="">---বছর নির্বাচন করুন---</option>
                                    @foreach($years as $year)
                                    <option value="{{$year}}">{{str_replace($s, $r, $year)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($errors->has('year'))
                                <span class="help-block">
                                    <strong>{{$errors->first('year')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('user_type') ? 'has-error' : ''}}">
                            <label for="user_type">শিক্ষার্থী/কর্মকর্তা<font color="red" size="4">*</font></label>
                            <div class="user_type">
                                <select name="user_type" id="user_type" class="form-control" onchange="display_required_field();">
                                    <option value="">---শিক্ষার্থী/কর্মকর্তা নির্বাচন করুন---</option>
                                    <option value="student">শিক্ষার্থী উপস্থিতি</option>
                                    <option value="employee">কর্মকর্তা উপস্থিতি</option>
                                </select>
                            </div>

                            @if ($errors->has('user_type'))
                                <span class="help-block">
                                    <strong>{{$errors->first('user_type')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row user-type-student">
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">শ্রেণী <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="master_class_id" id="master_class_id">
                                    <option value="">...শ্রেণী নির্বাচন করুন...</option>
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
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group_class_id">গ্রুপ / বিভাগ <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="group_class_id" id="group_class_id">
                                    <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
                                    @foreach($groups as $group)
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
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">শিফট <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="shift" id="shift" style="width: 100% !important;">
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
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section">শাখা <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="section" id="section">
                                    <option value="">...শাখা নির্বাচন করুন...</option>
                                    <option value="ক">ক</option>
                                    <option value="খ">খ</option>
                                    <option value="গ">গ</option>
                                    <option value="ঘ">ঘ</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->name}}">{{$unit->name}}</option>
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

                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">অনুসন্ধান করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form> 
        </div>
    </div>
    
@endsection

@section('script')
<!-- date css ans js -->
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script type="text/javascript">
         function display_required_field(){
            if($("#user_type").val()=="student"){
              $(".user-type-student").css("display", "inline");
            }else{
               $(".user-type-student").css("display", "none"); 
            }
         }
    </script>
   
    @if($errors->any())
    <script>
        document.getElementById('year').value = "{{old('year')}}";
        document.getElementById('month').value = "{{old('month')}}";
        document.getElementById('user_type').value = "{{old('user_type')}}";
    </script>
        @if(old('user_type')=="student")
           <script>
               document.getElementById('master_class_id').value = "{{old('master_class_id')}}";
               document.getElementById('group_class_id').value = "{{old('group_class_id')}}";
               document.getElementById('shift').value = "{{old('shift')}}";
               document.getElementById('section').value = "{{old('section')}}";
           </script>
        @endif
    @endif
@endsection