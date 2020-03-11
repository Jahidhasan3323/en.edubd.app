@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Edit Gallery')
@section('head_section')
    <style>

    </style>
@endsection
@section('gallery', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">গ্যালারি ক্যাটাগরি পরিবর্তন করুন</h1>
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
            <form action="{{url('/gallery_category/edit',$gallery_category->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
               {{method_field('PUT')}}
              
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                          <label for="photo">টাইটেল <span class="star">*</span></label>
                          <input type="text" name="tittle" class="form-control" placeholder="টাইটেল" data-validation="required length " data-validation-length="max100" value="{{$gallery_category->tittle}}">
                          @if ($errors->has('tittle'))
                              <span class="help-block">
                                  <strong>{{$errors->first('tittle')}}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="col-sm-6 {{$errors->has('type') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="type">গ্যালারির ধরণ <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type" id="type" data-validation="required " required>
                                    <option value="">ধরণ নির্বাচন</option>
                                    <option value="1">ছবি</option>
                                    <option value="2">ভিডিও</option>
                                    
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
    
    
 
    <script type="text/javascript">
        document.getElementById('type').value="{{$gallery_category->type}}";
    </script>

@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( '' );
  </script>
@endsection