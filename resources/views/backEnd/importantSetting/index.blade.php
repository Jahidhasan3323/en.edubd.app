@extends('backEnd.master')

@section('mainTitle', 'Manage Important Settings')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">গুরুত্বপূর্ণ কিছু সেটিংস</h1>
        </div>
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <form action="{{url('/important-settings')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">উপস্থিতি এন্ট্রির সময় নির্ধারণ</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('atten_start_time') ? 'has-error' : ''}}">
                                            <label for="atten_start_time">প্রবেশের সময় শুরু<span class="star">*</span></label>
                                            <input type="time" class="form-control" id="atten_start_time" name="atten_start_time" value="{{isset($imp_setting->atten_start_time)?$imp_setting->atten_start_time:''}}">
                                            @if ($errors->has('atten_start_time'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('atten_start_time')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                            <label for="atten_end_time">প্রবেশের শেষ সময়<span class="star">*</span></label>
                                            <input type="time" class="form-control" id="atten_end_time" name="atten_end_time" value="{{isset($imp_setting->atten_end_time)?$imp_setting->atten_end_time:''}}">
                                            @if ($errors->has('atten_end_time'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('atten_end_time')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('leave_start_time') ? 'has-error' : ''}}">
                                            <label for="leave_start_time">প্রস্থানের সময় শুরু<span class="star">*</span></label>
                                            <input type="time" class="form-control" id="leave_start_time" name="leave_start_time" value="{{isset($imp_setting->leave_start_time)?$imp_setting->leave_start_time:''}}">
                                            @if ($errors->has('leave_start_time'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('leave_start_time')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                            <label for="leave_end_time">প্রস্থানের শেষ সময়<span class="star">*</span></label>
                                            <input type="time" class="form-control" id="leave_end_time" name="leave_end_time" value="{{isset($imp_setting->leave_end_time)?$imp_setting->leave_end_time:''}}">
                                            @if ($errors->has('leave_end_time'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('leave_end_time')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">রেজাল্টশীট ভিউ ডিজাইন</div>
                            <div class="panel-body">
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label for="result_photo_permission">শিক্ষার্থীর ছবি প্রদর্শন<span class="star">*</span></label>
                                    <select class="form-control" id="result_photo_permission" name="result_photo_permission">
                                        <option value="no">না</option>
                                        <option value="yes">হ্যাঁ</option>
                                    </select>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('result_photo_permission')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">ফলাফল এন্ট্রির ধরণ</div>
                            <div class="panel-body">
                                <div class="form-group {{$errors->has('result_entry_type') ? 'has-error' : ''}}">
                                    <label for="result_entry_type">ফলাফল এন্ট্রির ধরণ নির্বাচন করুন<span class="star">*</span></label>
                                    <select class="form-control" id="result_entry_type" name="result_entry_type">
                                        <option value="all">সব</option>
                                        <option value="single">একক</option>
                                    </select>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('result_entry_type')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">শ্রেণীর অবস্থান নির্ণয়ের ধরণ নির্ধারণ</div>
                            <div class="panel-body">
                               <div class="form-group {{$errors->has('class_position_identify') ? 'has-error' : ''}}">
                                   <label for="class_position_identify">পরীক্ষার ধরণ নির্বাচন করুন<span class="star">*</span></label>
                                   <select name="class_position_identify[]" id="class_position_identify" class="form-control" multiple="true">
                                    <option value="">পরীক্ষার ধরণ নির্বাচন করুন</option>
                                    @foreach($exam_types as $exam_type)
                                       <option value="{{$exam_type->id}}">{{$exam_type->name}}</option>
                                    @endforeach
                                   </select>
                                     
                                   @if ($errors->has('class_position_identify'))
                                       <span class="help-block">
                                           <strong>{{$errors->first('class_position_identify')}}</strong>
                                       </span>
                                   @endif
                               </div>
                            </div>
                        </div> 
                    </div>

                </div>

                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-5 col-sm-12">
                            <div class="form-group">
                                <button id="save_btn" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

       
    </div>
@endsection
@section('script')
<link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
<script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
 @if($imp_setting)
  <script type="text/javascript">
    document.getElementById('result_photo_permission').value = "{{$imp_setting->result_photo_permission}}";
    document.getElementById('result_entry_type').value = "{{$imp_setting->result_entry_type}}";
    var exam_types = {!!json_encode(explode('|',$imp_setting->class_position_identify))!!};
    $( "#class_position_identify" ).val(exam_types);
  </script>
 @endif
@endsection