@extends('backEnd.master')

@section('mainTitle', 'Add class Routine')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_notice', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">নোটিশ যোগ করুন</h1>
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
            <form action="{{url('/notice')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">নোটিশের নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" type="text" name="name" class="form-control" placeholder="Notice Name">
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
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('notice') ? 'has-error' : ''}}">
                            <label for="notice">নোটিশ ফাইল আপলোড করুন  </label>
                            <input type="file" name="notice">
                            @if ($errors->has('notice'))
                                <span class="help-block">
                                    <strong>{{$errors->first('notice')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 {{$errors->has('is_admission_notice') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="is_admission_notice"> ভর্তি নোটিশ </label>
                            <div class="">
                                <select class="form-control" name="is_admission_notice" id="is_admission_notice" >
                                    <option value=""> নির্বাচন করুন</option>
                                    <option value="1">হ্যা</option>
                                    <option value="0">না</option>
                                    
                                </select>
                            </div>
                        </div>
                        @if($errors->has('is_admission_notice'))
                            <span class="help-block">
                                <strong>{{$errors->first('is_admission_notice')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                          <label class="" for="description">বর্ণনা </label>
                          <div class="">
                            <textarea  class="form-control" name="description" id="description" >{{old('description')}}</textarea>
                          </div>
                          @if ($errors->has('description'))
                              <span class="help-block">
                                  <strong>{{$errors->first('description')}}</strong>
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
    @if($errors->any())
    <script type="text/javascript">
        document.getElementById('is_admission_notice').value="{{old('is_admission_notice')}}";
    </script>
    @endif
@endsection
@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description' );
  </script>
@endsection
