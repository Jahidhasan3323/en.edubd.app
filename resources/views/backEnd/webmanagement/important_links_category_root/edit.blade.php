@extends('backEnd.master')

@section('mainTitle', 'Edit Important link')
@section('head_section')
    <style>

    </style>
@endsection
@section('date_language', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">গুরুত্বপূর্ণ লিঙ্ক ক্যাটাগরি পরিবর্তন করুন</h1>
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
            <form action="{{url('/important_links_category_root/edit',$important_links_category_root->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
               {{method_field('PUT')}}
              
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                          <label for="photo">টাইটেল <span class="star">*</span></label>
                          <input type="text" name="tittle" class="form-control" placeholder="টাইটেল" data-validation="required length " data-validation-length="max100" value="{{$important_links_category_root->tittle}}">
                          @if ($errors->has('tittle'))
                              <span class="help-block">
                                  <strong>{{$errors->first('tittle')}}</strong>
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
                                <button id="save" type="submit" class="btn btn-block btn-info">পরিবর্তন করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    
 

@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( '' );
  </script>
@endsection