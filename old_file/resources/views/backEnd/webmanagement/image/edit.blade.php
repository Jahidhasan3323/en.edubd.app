@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Edit Image')
@section('head_section')
    <style>

    </style>
@endsection
@section('gallery', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Image</h1>
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
            <form action="{{url('/image_gallery/edit',$image_gallery->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="row">

                   <div class="col-sm-4">
                      <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                           <label for="photo">Title </label>
                           <input type="text" name="tittle" class="form-control" placeholder="Title"  value="{{$image_gallery->tittle}}">
                           @if ($errors->has('tittle'))
                               <span class="help-block">
                                   <strong>{{$errors->first('tittle')}}</strong>
                               </span>
                           @endif
                       </div>
                    </div>
                   <div class="col-sm-4 {{$errors->has('wm_gallery_category_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="wm_gallery_category_id">Gallery Category<span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="wm_gallery_category_id" id="wm_gallery_category_id" data-validation="required" required>
                                    <option value="">Select Gallery</option>
                                    @if($categorys)
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}">{{$category->tittle}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($errors->has('wm_gallery_category_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('wm_gallery_category_id')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-4 {{$errors->has('type') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="type">Gallery Type <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type" id="type" data-validation="required " required>
                                    <option value="">Select Type</option>
                                    <option value="1">Photo</option>
                                    <option value="2">Video</option>

                                </select>
                            </div>
                        </div>
                        @if($errors->has('type'))
                            <span class="help-block">
                                <strong>{{$errors->first('type')}}</strong>
                            </span>
                        @endif
                    </div>
                  </div>
                  <div class="row">

                   <div class="col-sm-4">
                       <div class="form-group {{$errors->has('path') ? 'has-error' : ''}}">
                           <label for="photo">Photo <span class="star">*</span></label>
                           <input type="file" name="path" onchange="openFile(event)" accept="image/*"  data-validation="mime size"
                              data-validation-allowing="jpg, png, gif,jpeg,svg"
                              data-validation-max-size="2mb"
                              data-validation-error-msg-size="You can not upload images larger than 2mb"
                              data-validation-error-msg-mime="You can only upload images"
                              >
                           @if ($errors->has('path'))
                               <span class="help-block">
                                   <strong>{{$errors->first('path')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-sm-4">
                      <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                           <label for="photo">Date </label>
                           <input type="text" name="date" class="form-control date" placeholder="Date"  value="{{$image_gallery->date}}">
                           @if ($errors->has('date'))
                               <span class="help-block">
                                   <strong>{{$errors->first('date')}}</strong>
                               </span>
                           @endif
                       </div>
                    </div>


               </div>
               <div class="row">
                   <div class="col-sm-4">
                      <div>
                          <img id="image" width="100px" height="120px" src="{{Storage::url($image_gallery->path)}}">
                      </div>
                   </div>
               </div>
               <hr>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group {{$errors->has('details') ? 'has-error' : ''}}">
                          <label class="" for="details">Description </label>
                          <div class="">
                            <textarea  class="form-control" name="details" id="details" >{{$image_gallery->details}}</textarea>
                          </div>
                          @if ($errors->has('details'))
                              <span class="help-block">
                                  <strong>{{$errors->first('details')}}</strong>
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
    @if($image_gallery->type)
    <script type="text/javascript">
        document.getElementById('type').value="{{$image_gallery->type}}";
    </script>
    @endif
    @if($image_gallery->wm_gallery_category_id)
    <script type="text/javascript">
        document.getElementById('wm_gallery_category_id').value="{{$image_gallery->wm_gallery_category_id}}";
    </script>
    @endif

@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'details' );
  </script>
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( ".date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true
            }).val();
        } );
    </script>
@endsection
