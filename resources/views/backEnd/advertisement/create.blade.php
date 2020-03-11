@extends('backEnd.master')

@section('mainTitle', 'বিজ্ঞাপন ব্যাবস্থাপনা ')
@section('active_commitee', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিজ্ঞাপন ব্যাবস্থাপনা </h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <form id="validate" name="validate" action="{{url($advertisement?'/advertisement/update/'.$advertisement->id : '/advertisement/store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('top_banner_advertisement') ? 'has-error' : ''}}">
                            <label for="top_banner_advertisement">ব্যানার বিজ্ঞাপন<font color="red" size="4">*</font></label>
                            <label>( Mini-Width=1140px, Max-Width=1200px )</label>
                            <input type="file" name="top_banner_advertisement" onchange="openFile(event,1)" accept="top_banner_advertisement/*" id="top_banner_advertisement">
                            @if ($errors->has('top_banner_advertisement'))
                                <span class="help-block">
                                    <strong>{{$errors->first('top_banner_advertisement')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div style="height: 100px;border:1px solid #ddd;">
                            <img src="{{Storage::url($advertisement->top_banner_advertisement ?? '')}}" id="photo_up1" width="100%" height="100%">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('slider_bottom_advertisement') ? 'has-error' : ''}}">
                            <label for="slider_bottom_advertisement">স্লাইডারের নীচে বিজ্ঞাপন<font color="red" size="4">*</font></label>
                            <label>( Mini-Width=500px, Max-Width=800px )</label>
                            <input type="file" name="slider_bottom_advertisement" onchange="openFile(event,2)" accept="slider_bottom_advertisement/*" id="slider_bottom_advertisement">
                            @if ($errors->has('slider_bottom_advertisement'))
                                <span class="help-block">
                                    <strong>{{$errors->first('slider_bottom_advertisement')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div style="height: 100px;border:1px solid #ddd;">
                            <img src="{{Storage::url($advertisement->slider_bottom_advertisement ?? '')}}" id="photo_up2" width="100%" height="100%">
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('footer_advertisement') ? 'has-error' : ''}}">
                            <label for="footer_advertisement">ফুটার বিজ্ঞাপন<font color="red" size="4">*</font></label>
                            <label>( Mini-Width=500px, Max-Width=800px )</label>
                            <input type="file" name="footer_advertisement" onchange="openFile(event,3)" accept="footer_advertisement/*" id="footer_advertisement">
                            @if ($errors->has('footer_advertisement'))
                                <span class="help-block">
                                    <strong>{{$errors->first('footer_advertisement')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div style="height: 100px;border:1px solid #ddd;">
                            <img src="{{Storage::url($advertisement->footer_advertisement ?? '')}}" id="photo_up3" width="100%" height="100%">
                        </div>
                    </div>
                </div>
                <hr>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{$errors->has('slider_right_advertisement') ? 'has-error' : ''}}">
                                    <label for="slider_right_advertisement">স্লাইডারের ডানের বিজ্ঞাপন<font color="red" size="4">*</font></label>
                                    <label>( Mini-Width=100px, Max-Width=200px )</label>
                                    <input type="file" name="slider_right_advertisement" onchange="openFile(event,4)" accept="slider_right_advertisement/*" id="slider_right_advertisement">
                                    @if ($errors->has('slider_right_advertisement'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('slider_right_advertisement')}}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div style="height:450px;border:1px solid #ddd;">
                                      <img src="{{Storage::url($advertisement->slider_right_advertisement ?? '')}}" id="photo_up4" width="100%" height="100%">
                                  </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{$errors->has('slider_left_advertisement') ? 'has-error' : ''}}">
                                    <label for="slider_left_advertisement">স্লাইডারের বামের বিজ্ঞাপন<font color="red" size="4">*</font></label>
                                    <label>( Mini-Width=100px, Max-Width=200px )</label>
                                    <input type="file" name="slider_left_advertisement" onchange="openFile(event,5)" accept="slider_bottom_advertisement/*" id="slider_left_advertisement">
                                    @if ($errors->has('slider_left_advertisement'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('slider_left_advertisement')}}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div style="height:450px;border:1px solid #ddd;">
                                      <img src="{{Storage::url($advertisement->slider_left_advertisement ?? '')}}" id="photo_up5" width="100%" height="100%">
                                  </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{$errors->has('sitebar_right_advertisement') ? 'has-error' : ''}}">
                                    <label for="sitebar_right_advertisement">সাইডবারে ডানের বিজ্ঞাপন<font color="red" size="4">*</font></label>
                                    <label>( Mini-Width=100px, Max-Width=200px )</label>
                                    <input type="file" name="sitebar_right_advertisement" onchange="openFile(event,6)" accept="sitebar_right_advertisement/*" id="sitebar_right_advertisement">
                                    @if ($errors->has('sitebar_right_advertisement'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('sitebar_right_advertisement')}}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div style="height:450px;border:1px solid #ddd;">
                                      <img src="{{Storage::url($advertisement->sitebar_right_advertisement ?? '')}}" id="photo_up6" width="100%" height="100%">
                                  </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{$errors->has('sitebar_bottom_advertisement') ? 'has-error' : ''}}">
                                    <label for="sitebar_bottom_advertisement">সাইডবারে নিচের বিজ্ঞাপন<font color="red" size="4">*</font></label>
                                    <label>( Mini-Width=100px, Max-Width=200px )</label>
                                    <input type="file" name="sitebar_bottom_advertisement" onchange="openFile(event,7)" accept="sitebar_bottom_advertisement/*" id="sitebar_bottom_advertisement">
                                    @if ($errors->has('sitebar_bottom_advertisement'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('sitebar_bottom_advertisement')}}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div style="height:450px;border:1px solid #ddd;">
                                      <img src="{{Storage::url($advertisement->sitebar_bottom_advertisement ?? '')}}" id="photo_up7" width="100%" height="100%">
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('backEnd/js/appsJs/advertisement.js')}}"></script>
@endsection

