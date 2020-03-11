
@extends('backEnd.master')

@section('mainTitle', 'Admid Card')
@section('head_section')

    <style>
        .select2-container, .select2-container--default, .select2-container--below, .select2-container--focus{
            /*padding: 5% !important;*/
        }
        .select2-selection.select2-selection--single {
            height:  35px;
        }
    </style>
@endsection
@section('active_latter', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রবেশপত্র তৈরি করুন</h1>
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
            <form id="result_from" action="{{url('/admit-card/show')}}" method="get">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('exam_year') ? 'has-error' : ''}}">
                            <label class="" for="exam_year">বছর <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" name="exam_year" id="exam_year" value="{{old('exam_year',date('Y'))}}">
                            </div>
                            @if ($errors->has('exam_year'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_year')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <label class="" for="exam_type_id">পরীক্ষা <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="exam_type_id" id="exam_type_id" >
                                    <option value="">...পরীক্ষা টাইপ নির্বাচন করুন...</option>
                                    @foreach($exams as $exam)
                                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('exam_type_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_type_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
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
                    <div class="col-sm-6">
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
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">শিফট <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" style="width: 100% !important;" name="shift" id="shift">
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
                    <div class="col-sm-6">
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

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="student_id">নির্ধারিত শিক্ষার্থীর/শিক্ষার্থীদের আইডি  নম্বর ( উদাহরণ: 880000000000001,880000000000002 )</label>
                            <div class="">
                                <textarea class="form-control" name="student_id" id="student_id" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">সাবমিট</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
  @if($errors->any())
    <script>
        var exam_type_id = "{{old('exam_type_id')}}";
        var master_class_id = "{{old('master_class_id')}}";
        var group_class_id = "{{old('group_class_id')}}";
        var shift = "{{old('shift')}}";
        var section = "{{old('section')}}"; 

        $("#exam_type_id").val(exam_type_id);
        $("#master_class_id").val(master_class_id);
        $("#group_class_id").val(group_class_id);
        $("#shift").val(shift);
        $("#section").val(section);
    </script>
  @endif
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
    </script>
@endsection




