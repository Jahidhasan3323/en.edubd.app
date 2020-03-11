@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Add others information')
@section('head_section')
    <style>

    </style>
@endsection
@section('information', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">অন্যান্য তথ্য যোগ করুন</h1>
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
            <form action="{{url('/general_text/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                   <div class="col-sm-4">
                       <div class="form-group {{$errors->has('file') ? 'has-error' : ''}}">
                           <label for="photo">ছবি </label>
                           <input type="file" name="file"    data-validation="mime size"
                              data-validation-allowing="jpg,png,gif,jpeg,svg,pdf"
                              data-validation-max-size="2mb"
                              data-validation-error-msg-size="You can not upload images larger than 2mb"
                              data-validation-error-msg-mime="You can only upload images"
                              >
                           @if ($errors->has('file'))
                               <span class="help-block">
                                   <strong>{{$errors->first('file')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-sm-4">
                       <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                           <label for="photo">টাইটেল </label>
                           <input type="text" name="tittle" class="form-control" placeholder="টাইটেল" value="{{old('tittle')}}">
                           @if ($errors->has('tittle'))
                               <span class="help-block">
                                   <strong>{{$errors->first('tittle')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-sm-4">
                       <div class="col-sm-6 {{$errors->has('wm_general_text_type_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="wm_general_text_type_id">বাণীর ধরণ <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="wm_general_text_type_id" id="wm_general_text_type_id" data-validation="required" required>
                                    <option value="">বাণী নির্বাচন</option>
                                    @if($types)
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->tittle}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($errors->has('wm_general_text_type_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('wm_general_text_type_id')}}</strong>
                            </span>
                        @endif
                    </div>
                   </div>
               </div>
               
               <hr>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group {{$errors->has('speech') ? 'has-error' : ''}}">
                          <label class="" for="speech">বাণী </label>
                          <div class="">
                            <textarea  class="form-control" name="speech" id="speech" >{{old('speech')}}</textarea>
                          </div>
                          @if ($errors->has('speech'))
                              <span class="help-block">
                                  <strong>{{$errors->first('speech')}}</strong>
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
    
    <script type="text/javascript">
       var openFile = function(event) {
       var input = event.target;
       var reader = new FileReader();
       reader.onload = function(){
       var dataURL = reader.result;
       var output = document.getElementById('file');
       output.src = dataURL;
       };
       reader.readAsDataURL(input.files[0]);
       };
   </script>
   @if($errors->any())
    <script type="text/javascript">
        document.getElementById('wm_general_text_type_id').value="{{old('wm_general_text_type_id')}}";
    </script>
    @endif
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'speech' );
  </script>
@endsection