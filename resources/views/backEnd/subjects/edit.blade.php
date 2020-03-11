@extends('backEnd.master')

@section('mainTitle', 'বিষয় যুক্ত করুন')
@section('active_subject', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিষয় সম্পাদন করুন</h1>
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
            <form action="{{url('subjects/update',[$subject->id])}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
               <div class="row">
                   <div class="col-md-8">
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

                   
               </div>

               <div class="row">
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('ca_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="ca_mark">সিএ নম্বর</label>
                           <div class="">
                               <input value="{{old('ca_mark',$subject->ca_mark)}}" class="form-control" type="text" name="ca_mark" id="ca_mark" placeholder="সিএ নম্বর" onkeyup="totalMark();">
                           </div>
                           @if ($errors->has('ca_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('ca_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('cr_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="cr_mark">সিআর/তত্ত্বীয় নম্বর</label>
                           <div class="">
                               <input value="{{old('cr_mark',$subject->cr_mark)}}" class="form-control" type="text" name="cr_mark" id="cr_mark" placeholder="সিআর নম্বর" onkeyup="totalMark();">
                           </div>
                           @if ($errors->has('cr_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('cr_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('mcq_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="mcq_mark">এমসিকিউ নম্বর</label>
                           <div class="">
                               <input value="{{old('mcq_mark',$subject->mcq_mark)}}" class="form-control" type="text" name="mcq_mark" id="mcq_mark" placeholder="এমসিকিউ নম্বর" onkeyup="totalMark();">
                           </div>
                           @if ($errors->has('mcq_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('mcq_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('pr_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="pr_mark">পিআর নম্বর</label>
                           <div class="">
                               <input value="{{old('pr_mark',$subject->pr_mark)}}" class="form-control" type="text" name="pr_mark" id="pr_mark" placeholder="পিআর নম্বর" onkeyup="totalMark();">
                           </div>
                           @if ($errors->has('pr_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('pr_mark')}}</strong>
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
                   
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('ca_pass_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="ca_pass_mark">সিএ পাশ</label>
                           <div class="">
                               <input value="{{old('ca_pass_mark',$subject->ca_pass_mark)}}" class="form-control" type="text" name="ca_pass_mark" id="ca_pass_mark" placeholder="সিএ পাশ নম্বর">
                           </div>
                           @if ($errors->has('ca_pass_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('ca_pass_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('cr_pass_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="cr_pass_mark">সিআর/তত্ত্বীয় পাশ নম্বর</label>
                           <div class="">
                               <input value="{{old('cr_pass_mark',$subject->cr_pass_mark)}}" class="form-control" type="text" name="cr_pass_mark" id="cr_pass_mark" placeholder="সিআর পাশ নম্বর">
                           </div>
                           @if ($errors->has('cr_pass_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('cr_pass_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('mcq_pass_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="mcq_pass_mark">এমসিকিউ পাশ নম্বর</label>
                           <div class="">
                               <input value="{{old('mcq_pass_mark',$subject->mcq_pass_mark)}}" class="form-control" type="text" name="mcq_pass_mark" id="mcq_pass_mark" placeholder="এমসিকিউ পাশ নম্বর">
                           </div>
                           @if ($errors->has('mcq_pass_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('mcq_pass_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="form-group {{$errors->has('pr_pass_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="pr_pass_mark">পিআর পাশ নম্বর</label>
                           <div class="">
                               <input value="{{old('pr_pass_mark',$subject->pr_pass_mark)}}" class="form-control" type="text" name="pr_pass_mark" id="pr_pass_mark" placeholder="পিআর পাশ নম্বর">
                           </div>
                           @if ($errors->has('pr_pass_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('pr_pass_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>

                   <div class="col-md-4">
                       <div class="form-group {{$errors->has('total_pass_mark') ? 'has-error' : ''}}">
                           <label class="control-label" for="total_pass_mark">মোট পাশ নম্বর</label>
                           <div class="">
                               <input value="{{old('total_pass_mark',$subject->total_pass_mark)}}" class="form-control" type="text" name="total_pass_mark" id="total_pass_mark" placeholder="মোট পাশ নম্বর">
                           </div>
                           @if ($errors->has('total_pass_mark'))
                               <span class="help-block">
                                   <strong>{{$errors->first('total_pass_mark')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
               </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
                            <label class="" for="status">সাবজেক্ট স্টেটাস <span class="star">*</span></label>
                            <div class="">
                                <select name="status" id="status" class="form-control">
                                    <option value="">সাবজেক্টের স্টেটাস নির্বাচন করুন</option>
                                    <option value="আবশ্যিক">আবশ্যিক</option>
                                    <option value="ঐচ্ছিক">ঐচ্ছিক</option>
                                    <option value="কমন">কমন</option>
                                </select>
                            </div>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{$errors->first('status')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group {{$errors->has('subject_type') ? 'has-error' : ''}}">
                            <label class="" for="subject_type">সাবজেক্ট ধরণ<span class="star">*</span></label>
                            <div class="">
                                <select name="subject_type" id="subject_type" class="form-control">
                                    <option value="">সাবজেক্টের ধরণ নির্বাচন করুন</option>
                                    <option value="সাধারণ">সাধারণ</option>
                                    <option value="নির্বাচনী">নির্বাচনী</option>
                                    <option value="ধর্ম শিক্ষা">ধর্ম শিক্ষা</option>
                                </select>
                            </div>
                            @if ($errors->has('subject_type'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject_type')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
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
                    <div class="col-md-3">
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
        document.getElementById('status').value = "{{old('status')}}";
        document.getElementById('subject_type').value = "{{old('subject_type')}}";
        document.getElementById('master_class_id').value = "{{old('master_class_id')}}";
        document.getElementById('group_class_id').value = "{{old('group_class_id')}}";
    </script>
    @else
    <script type="text/javascript">
        document.getElementById('status').value = "{{$subject->status}}";
        document.getElementById('subject_type').value = "{{$subject->subject_type}}";
        document.getElementById('master_class_id').value = "{{$subject->master_class_id}}";
        document.getElementById('group_class_id').value = "{{$subject->group_class_id}}";
    </script>
    @endif
    <script type="text/javascript">
        function totalMark(){
            var written_mark = document.getElementById('written_mark').value;
            var tik_mark = document.getElementById('tik_mark').value;
            var practical_mark = document.getElementById('practical_mark').value;
            if(written_mark==''){
               var written_mark = 0; 
            }
            if(tik_mark==''){
               var tik_mark = 0; 
            }
            if(practical_mark==''){
               var practical_mark = 0; 
            }
            var total = (parseInt(written_mark) + parseInt(tik_mark) + parseInt(practical_mark));
            document.getElementById('total_mark').value = total;
        }
    </script>
@endsection