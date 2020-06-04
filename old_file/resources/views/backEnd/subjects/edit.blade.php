@extends('backEnd.master')

@section('mainTitle', 'Edit Subject')
@section('active_subject', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Subject</h1>
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
                           <label class="control-label" for="subject_name">Subject Name<span class="star">*</span></label>
                           <div class="">
                               <input value="{{old('subject_name',$subject->subject_name)}}" class="form-control" type="text" name="subject_name" id="subject_name" placeholder="Subject Name">
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
                           <label class="control-label" for="subject_code">Subject Code</label>
                           <div class="">
                               <input value="{{old('subject_code',$subject->subject_code)}}" class="form-control" type="text" name="subject_code" id="subject_code" placeholder="Subject Code">
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
                           <label class="control-label" for="ca_mark">CA Marks</label>
                           <div class="">
                               <input value="{{old('ca_mark',$subject->ca_mark)}}" class="form-control" type="text" name="ca_mark" id="ca_mark" placeholder="CA Marks" onkeyup="totalMark();">
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
                           <label class="control-label" for="cr_mark">CR/Written</label>
                           <div class="">
                               <input value="{{old('cr_mark',$subject->cr_mark)}}" class="form-control" type="text" name="cr_mark" id="cr_mark" placeholder="CR/Written" onkeyup="totalMark();">
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
                           <label class="control-label" for="mcq_mark">MCQ Marks</label>
                           <div class="">
                               <input value="{{old('mcq_mark',$subject->mcq_mark)}}" class="form-control" type="text" name="mcq_mark" id="mcq_mark" placeholder="MCQ Marks" onkeyup="totalMark();">
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
                           <label class="control-label" for="pr_mark">PR/Practical Marks</label>
                           <div class="">
                               <input value="{{old('pr_mark',$subject->pr_mark)}}" class="form-control" type="text" name="pr_mark" id="pr_mark" placeholder="PR/Practical Marks" onkeyup="totalMark();">
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
                           <label class="control-label" for="total_mark">Total Marks<span class="star">*</span></label>
                           <div class="">
                               <input value="{{old('total_mark',$subject->total_mark)}}" class="form-control" type="text" name="total_mark" id="total_mark" placeholder="Total Marks">
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
                           <label class="control-label" for="ca_pass_mark">CA Pass</label>
                           <div class="">
                               <input value="{{old('ca_pass_mark',$subject->ca_pass_mark)}}" class="form-control" type="text" name="ca_pass_mark" id="ca_pass_mark" placeholder="CA Pass">
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
                           <label class="control-label" for="cr_pass_mark">CR/Written Pass Marks</label>
                           <div class="">
                               <input value="{{old('cr_pass_mark',$subject->cr_pass_mark)}}" class="form-control" type="text" name="cr_pass_mark" id="cr_pass_mark" placeholder="CR/Written Pass Marks">
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
                           <label class="control-label" for="mcq_pass_mark">MCQ Pass Marks</label>
                           <div class="">
                               <input value="{{old('mcq_pass_mark',$subject->mcq_pass_mark)}}" class="form-control" type="text" name="mcq_pass_mark" id="mcq_pass_mark" placeholder="MCQ Pass Marks">
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
                           <label class="control-label" for="pr_pass_mark">PR Pass marks</label>
                           <div class="">
                               <input value="{{old('pr_pass_mark',$subject->pr_pass_mark)}}" class="form-control" type="text" name="pr_pass_mark" id="pr_pass_mark" placeholder="PR Pass marks">
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
                           <label class="control-label" for="total_pass_mark">Total Pass marks</label>
                           <div class="">
                               <input value="{{old('total_pass_mark',$subject->total_pass_mark)}}" class="form-control" type="text" name="total_pass_mark" id="total_pass_mark" placeholder="Total Pass marks">
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
                            <label class="" for="status">Subject Status<span class="star">*</span></label>
                            <div class="">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Subject Status</option>
                                    <option value="Compulsory">Compulsory</option>
                                    <option value="Optional">Optional</option>
                                    <option value="Common">Common</option>
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
                            <label class="" for="subject_type">Subject Type<span class="star">*</span></label>
                            <div class="">
                                <select name="subject_type" id="subject_type" class="form-control">
                                    <option value="">Select Subject Type</option>
                                    <option value="General">General</option>
                                    <option value="Elective">Elective</option>
                                    <option value="Religion Education">Religion Education</option>
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
                            <label class="" for="master_class_id">Class <span class="star">*</span></label>
                            <div class="">
                                <select name="master_class_id" id="master_class_id" class="form-control">
                                    <option value="">Select Class</option>
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
                            <label class="" for="group_class_id">Group<span class="star">*</span></label>
                            <div class="">
                                <select name="group_class_id" id="group_class_id" class="form-control">
                                    <option value="">Select Group</option>
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
                            <button id="save_btn" type="submit" class="btn btn-block btn-info">Update</button>
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
