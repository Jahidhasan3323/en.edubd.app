@extends('backEnd.master',['nav'=>'active','bg'=>'active'])

@section('mainTitle', 'Settings')
@section('head_section')
@endsection
@section('school_settings', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">স্কুল সেটিংস্‌</h1>
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
            <form action="{{url('school_settings')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="row">
                  <div class="col-sm-3">
                      <div class="form-group {{$errors->has('content_heading_background') ? 'has-error' : ''}}">
                          <label class="" for="content_heading_background">কন্টেন্ট হেডিং ব্যাকগ্রাউন্ড কালার </label>
                          <div class="">
                              <input value="@if($school_details){{$school_details->content_heading_background}}@endif" class="form-control my-colorpicker1" type="text" name="content_heading_background" id="content_heading_background" >
                          </div>
                          @if ($errors->has('content_heading_background'))
                              <span class="help-block">
                                  <strong>{{$errors->first('content_heading_background')}}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group {{$errors->has('content_heading_color') ? 'has-error' : ''}}">
                          <label class="" for="content_heading_color">কন্টেন্ট হেডিং কালার </label>
                          <div class="">
                              <input value="@if($school_details){{$school_details->content_heading_color}}@endif" class="form-control my-colorpicker1" type="text" name="content_heading_color" id="content_heading_color" >
                          </div>
                          @if ($errors->has('content_heading_color'))
                              <span class="help-block">
                                  <strong>{{$errors->first('content_heading_color')}}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group {{$errors->has('sidebar_heading_background') ? 'has-error' : ''}}">
                          <label class="" for="sidebar_heading_background">সাইডবার হেডিং ব্যাকগ্রাউন্ড কালার </label>
                          <div class="">
                              <input value="@if($school_details){{$school_details->sidebar_heading_background}}@endif" class="form-control my-colorpicker1" type="text" name="sidebar_heading_background" id="sidebar_heading_background" >

                          </div>
                          @if ($errors->has('sidebar_heading_background'))
                              <span class="help-block">
                                  <strong>{{$errors->first('sidebar_heading_background')}}</strong>
                              </span>
                          @endif
                      </div>
                  </div> 
                  <div class="col-sm-2">
                      <div class="form-group {{$errors->has('sidebar_heading_color') ? 'has-error' : ''}}">
                          <label class="" for="sidebar_heading_color">সাইডবার হেডিং  কালার </label>
                          <div class="">
                              <input value="@if($school_details){{$school_details->sidebar_heading_color}}@endif" class="form-control my-colorpicker1" type="text" name="sidebar_heading_color" id="sidebar_heading_color" >
                          </div>
                          @if ($errors->has('sidebar_heading_color'))
                              <span class="help-block">
                                  <strong>{{$errors->first('sidebar_heading_color')}}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group {{$errors->has('name_color') ? 'has-error' : ''}}">
                          <label class="" for="name_color">স্কুলের নামের কালার </label>
                          <div class="">
                              <input value="@if($school_details){{$school_details->name_color}}@endif" class="form-control my-colorpicker1" type="text" name="name_color" id="name_color" >
                          </div>
                          @if ($errors->has('name_color'))
                              <span class="help-block">
                                  <strong>{{$errors->first('name_color')}}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                       
                </div>
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group {{$errors->has('copyright') ? 'has-error' : ''}}">
                          <label class="" for="copyright">কপিরাইট <span class="star">*</span></label>
                          <div class="">
                            <textarea  class="form-control" name="copyright" id="copyright" required>@if($school_details){{$school_details->copyright}}@endif</textarea>
                          </div>
                          @if ($errors->has('copyright'))
                              <span class="help-block">
                                  <strong>{{$errors->first('copyright')}}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group {{$errors->has('map') ? 'has-error' : ''}}">
                          <label class="" for="map">গুগল ম্যাপ </label>
                          <div class="">
                            <textarea placeholder="how to you get code ? &#10; map->share-> embed a map->copy src code &#10; i.e. : https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7496722.01896206!2d85.8471739812547!3d23.442104785813886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30adaaed80e18ba7%3A0xf2d28e0c4e1fc6b!2z4Kas4Ka-4KaC4Kay4Ka-4Kam4KeH4Ka2!5e0!3m2!1sbn!2sbd!4v1579760305880!5m2!1sbn!2sbd "  class="form-control" name="map" id="map" >@if($school_details){{$school_details->map}}@endif</textarea>
                          </div>
                          @if ($errors->has('map'))
                              <span class="help-block">
                                  <strong>{{$errors->first('map')}}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                                       
                </div>
                   
                <div class="row">
                       <div class="col-sm-4">
                           <div class="form-group {{$errors->has('body_background') ? 'has-error' : ''}}">
                               <label for="photo">বডি ব্যাকগ্রাউন্ড</label>
                               <input type="file" name="body_background" onchange="openFile(event)" accept="image/*">
                               @if ($errors->has('body_background'))
                                   <span class="help-block">
                                       <strong>{{$errors->first('body_background')}}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>
                       <div class="col-sm-4">
                           <div class="form-group {{$errors->has('header_background_logo') ? 'has-error' : ''}}">
                               <label for="photo">হেডার ব্যাকগ্রাউন্ড</label>
                               <input type="file" name="header_background_logo" onchange="openFile1(event)" accept="image/*">
                               @if ($errors->has('header_background_logo'))
                                   <span class="help-block">
                                       <strong>{{$errors->first('header_background_logo')}}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>
                       {{-- <div class="col-sm-4">
                           <div class="form-group {{$errors->has('video') ? 'has-error' : ''}}">
                               <label class="" for="video">হেডার ভিডিও</label>
                               <div class="">
                                   <input  class="form-control" type="file" name="video" id="video" >
                               </div>
                               @if ($errors->has('video'))
                                   <span class="help-block">
                                       <strong>{{$errors->first('video')}}</strong>
                                   </span>
                               @endif
                           </div>
                       </div> --}}
               </div>
               
               </div>
                   <div class="row">

                       <div class="col-sm-4">
                          <div>
                              <img id="body_background" width="100px" height="120px" src="@if($school_details){{Storage::url($school_details->body_background)}}@endif">
                          </div>
                       </div>
                        <div class="col-sm-4">
                          <div>
                              <img id="header_background_logo" width="100px" height="120px" src="@if($school_details){{Storage::url($school_details->header_background_logo)}}@endif">
                          </div>
                       </div>
                       {{-- <div class="col-sm-4">
                          <div>
                              <video src="@if($school_details){{Storage::url($school_details->video)}}@endif"  controls loop width="100px" height="120px"></video>
                          </div>
                       </div> --}}
                      
                   </div>

                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">পরিবর্তন করুণ</button>
                            </div>
                        </div>
                        <div class="col-sm-2 col-sm-offset-8 pull-right">
                            <div class="form-group">
                                <a href="{{'school_settings/reset_color'}}" class="btn btn-block btn-info">ডিফল্ট অবস্থায় ফিরে যান</a>
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
       var output = document.getElementById('body_background');
       output.src = dataURL;
       };
       reader.readAsDataURL(input.files[0]);
       };
       var openFile1 = function(event) {
       var input = event.target;
       var reader = new FileReader();
       reader.onload = function(){
       var dataURL = reader.result;
       var output = document.getElementById('header_background_logo');
       output.src = dataURL;
       };
       reader.readAsDataURL(input.files[0]);
       };
   </script>
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( '' );
  </script>
@endsection