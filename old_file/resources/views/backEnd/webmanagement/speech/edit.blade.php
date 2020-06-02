@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Edit Speech')
@section('head_section')
    <style>

    </style>
@endsection
@section('information', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Speech</h1>
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
            <form action="{{url('/speech/edit',$speech->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="row">
                   <div class="col-sm-4">
                       <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                           <label for="photo">Photo <span class="star">*</span></label>
                           <input type="file" name="image" onchange="openFile(event)" accept="image/*"  data-validation=" mime size"
                              data-validation-allowing="jpg, png, gif,jpeg,svg"
                              data-validation-max-size="2mb"
                              data-validation-error-msg-size="You can not upload images larger than 2mb"
                              data-validation-error-msg-mime="You can only upload images"
                              >
                           @if ($errors->has('image'))
                               <span class="help-block">
                                   <strong>{{$errors->first('image')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-sm-4">
                       <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                           <label for="photo">Title <span class="star">*</span></label>
                           <input type="text" name="tittle" class="form-control" placeholder="Title" data-validation="required length " data-validation-length="max100" value="{{$speech->tittle}}">
                           @if ($errors->has('tittle'))
                               <span class="help-block">
                                   <strong>{{$errors->first('tittle')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-sm-4">
                       <div class="col-sm-6 {{$errors->has('type_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="type_id">Speech Type <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type_id" id="type_id" required>
                                    <option value="">Select Speech</option>
                                    @if($types)
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->tittle}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($errors->has('type_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('type_id')}}</strong>
                            </span>
                        @endif
                    </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-sm-4">
                      <div>
                          <img id="image" width="100px" height="120px" src="{{Storage::url($speech->image)}}">
                      </div>
                   </div>
                   <div class="col-sm-6">
                       <div class="form-group {{$errors->has('position') ? 'has-error' : ''}}">
                           <label for="photo">Position <span class="star">*</span></label>
                           <input type="text" name="position" class="form-control" placeholder="Position" data-validation="required length number" data-validation-length="max10" value="{{$speech->position}}">
                           @if ($errors->has('position'))
                               <span class="help-block">
                                   <strong>{{$errors->first('position')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
               </div>
               <hr>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group {{$errors->has('speech') ? 'has-error' : ''}}">
                          <label class="" for="speech">Speech <span class="star">*</span></label>
                          <div class="">
                            <textarea  class="form-control" name="speech" id="speech" >{{$speech->speech}}</textarea>
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
                                <button id="save" type="submit" class="btn btn-block btn-info">Update</button>
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
       var output = document.getElementById('image');
       output.src = dataURL;
       };
       reader.readAsDataURL(input.files[0]);
       };
   </script>
    <script type="text/javascript">
        document.getElementById('type_id').value="{{$speech->type_id}}";
    </script>
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'speech' );
  </script>
@endsection