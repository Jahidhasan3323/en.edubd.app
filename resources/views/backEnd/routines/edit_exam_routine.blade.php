@extends('backEnd.master')

@section('mainTitle', 'Add Exam Routine')
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
@section('active_routine', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">পরীক্ষা রুটিন সম্পাদন করুন</h1>
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
            <form name="form_exam" action="{{url('/examRoutine/update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="class">শ্রেণী <span class="star">*</span></label>
                            <div class="">
                                <select name="master_class_id" id="class" class="form-control">
                                    <option>...শ্রেণী নির্বাচন করুন...</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->class}}</option>
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
                        <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <label class="" for="exam_type_id">পরীক্ষার নাম <span class="star">*</span></label>
                            <select style="" name="exam_type_id" id="exam_type_id" class="form-control">
                                <option value="">...পরীক্ষার ধরন নির্বাচন করুন...</option>
                                @foreach($exams as $exam)
                                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{$routine->id}}" name="routine_id">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">ফাইলের নাম <span class="star">*</span></label>
                            <div class="">
                                <input type="text" name="name" id="name" value="{{$routine->name}}" class="form-control" placeholder="File Name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('routine') ? 'has-error' : ''}}">
                            <label for="photo">ফাইল আপলোড করুন </label>
                            <input type="file" name="routine">
                            @if ($errors->has('routine'))
                                <span class="help-block">
                                    <strong>{{$errors->first('routine')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>বর্তমান ফাইল  <span class="star">*</span></label><br>
                            <strong>{{$file_name}}</strong>
                        </div>
                    </div>

                </div>
                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">হালনাগাদ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        document.forms['form_exam'].elements['master_class_id'].value="{{$routine->master_class_id}}";

        document.forms['form_exam'].elements['exam_type_id'].value="{{$routine->exam_type_id}}"
    </script>
@endsection

