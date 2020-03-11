@extends('backEnd.master')

@section('mainTitle', 'বিষয় সম্পাদন করুন (সিএ)')
@section('active_ca_subject', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিষয় সম্পাদন করুন (সিএ)</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-md-8 col-md-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>
        <style type="text/css">
            hr{
                margin:0;
                margin-bottom: 10px;
            }
        </style>
        <div class="panel-body">
            <form action="{{url('ca-subjects/update',[$subject->id])}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
               <div class="row">
                   <div class="col-md-4">
                       <div class="form-group {{$errors->has('subject_name') ? 'has-error' : ''}}">
                           <label class="control-label" for="subject_name">বিষয়<span class="star">*</span></label>
                           <div class="">
                               <input value="{{old('subject_name',$subject->subject_name)}}" class="form-control" type="text" name="subject_name" id="subject_name" placeholder="বিষয়ের নাম">
                           </div>
                           @if ($errors->has('subject_name'))
                               <span class="help-block">
                                   <strong>{{$errors->first('subject_name')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>

                   <div class="col-md-4">
                       <div class="form-group {{$errors->has('subject_code') ? 'has-error' : ''}}">
                           <label class="control-label" for="subject_code">বিষয় কোড</label>
                           <div class="">
                               <input value="{{old('subject_code',$subject->subject_code)}}" class="form-control" type="text" name="subject_code" id="subject_code" placeholder="বিষয় কোড">
                           </div>
                           @if ($errors->has('subject_code'))
                               <span class="help-block">
                                   <strong>{{$errors->first('subject_code')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   
                   <div class="col-md-4">
                       <div class="form-group {{$errors->has('total_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="total_mark">মোট নম্বর<span class="star">*</span></label>
                           <div class="">
                               <input value="{{old('total_mark',$subject->total_mark)}}" class="form-control" type="text" name="total_mark" id="total_mark" placeholder="মোট নম্বর">
                           </div>
                           @if ($errors->has('total_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('total_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
               </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('pass_mark') ? 'has-error' : ''}}">
                            <label class="control-label" for="pass_mark">মোট পাশ নম্বর</label>
                            <div class="">
                                <input value="{{old('pass_mark',$subject->pass_mark)}}" class="form-control" type="text" name="pass_mark" id="pass_mark" placeholder="মোট পাশ নম্বর">
                            </div>
                            @if ($errors->has('pass_mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pass_mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">শ্রেণী <span class="star">*</span></label>
                            <div class="">
                                <select name="master_class_id" id="master_class_id" class="form-control">
                                    <option value="">... শ্রেণী নির্বাচন করুন ...</option>
                                    @foreach($master_classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="help-block">
                                <strong>{{($errors->has('master_class_id')?$errors->first('master_class_id'):'')}}</strong>
                            </span>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group_class_id">গ্রুপ / বিভাগ <span class="star">*</span></label>
                            <div class="">
                                <select name="group_class_id" id="group_class_id" class="form-control">
                                    <option value="">... গ্রুপ / বিভাগ নির্বাচন করুন ...</option>
                                    @foreach($group_classes as $group_class)
                                        <option value="{{$group_class->id}}">{{$group_class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="help-block">
                                <strong>{{($errors->has('group_class_id')?$errors->first('group_class_id'):'')}}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row" style="display: none;">
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('year') ? 'has-error' : ''}}">
                            <label class="" for="year">Year <span class="star">*</span></label>
                            <div class="">
                                  <input type="text" name="year" id="year" value="{{old('year',$subject->year)}}" class="form-control">
                            </div>
                            <span class="help-block">
                                <strong>{{($errors->has('year')?$errors->first('year'):'')}}</strong>
                            </span>
                          </div>
                     </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <div class="form-group">
                            <button id="save_btn" type="submit" class="btn btn-block btn-info">হালনাগাদ করুন</button>
                        </div>
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>

    @if($errors->any())
    <script type="text/javascript">
        document.getElementById('master_class_id').value = "{{old('master_class_id')}}";
        document.getElementById('group_class_id').value = "{{old('group_class_id')}}";
    </script>
    @else
    <script type="text/javascript">
        document.getElementById('master_class_id').value = "{{$subject->master_class_id}}";
        document.getElementById('group_class_id').value = "{{$subject->group_class_id}}";
    </script>
    @endif

@endsection