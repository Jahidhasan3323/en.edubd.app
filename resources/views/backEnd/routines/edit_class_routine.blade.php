@extends('backEnd.master')

@section('mainTitle', 'Edit class Routine')
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
            <h1 class="text-center text-temp">ক্লাস রুটিন সম্পাদন করুন</h1>
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
            <form action="{{url('/classRoutines/update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="class">শ্রেণী <span class="star">*</span></label>
                            <div class="">
                                <select name="master_class_id" id="class" class="form-control">
                                    <option>...শ্রেণী নির্বাচন করুন...</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->class ? 'Class - '.$class->class : 'Class - KG'}}</option>
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
                
                <input type="hidden" name="routine_id" value="{{$routine->id}}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="subject_id">ফাইলের নাম <span class="star">*</span></label>
                            <div class="">
                                <input type="text" name="name" value="{{$routine->name}}" class="form-control" placeholder="File Name">
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
                            <label for="routine">রুটিন ফাইল আপলোড করুন</label>
                            <input type="file" name="routine" id="routine">
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
        document.getElementById('class').value="{{$routine->master_class_id}}";
        document.getElementById('group_class_id').value="{{$routine->group_class_id}}";
    </script>
@endsection
