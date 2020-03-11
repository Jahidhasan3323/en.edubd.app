@extends('backEnd.master')

@section('mainTitle', 'Add Important links')
@section('head_section')
    <style>

    </style>
@endsection
@section('date_language', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">গুরুত্বপূর্ণ লিঙ্ক ক্যাটাগরি যোগ করুন</h1>
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
            <form action="{{url('/important_links_category_root/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
               
              
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                          <label for="photo">টাইটেল <span class="star">*</span></label>
                          <input type="text" name="tittle" class="form-control" placeholder="টাইটেল" data-validation="required length " data-validation-length="max100" value="{{old('tittle')}}">
                          @if ($errors->has('tittle'))
                              <span class="help-block">
                                  <strong>{{$errors->first('tittle')}}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6 {{$errors->has('school_type_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="school_type_id">প্রতিষ্ঠানের টাইপ নির্বাচন করুন <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="school_type_id[]" id="school_type_id" data-validation="required" multiple="true" required>
                                    <option value="">টাইপ নির্বাচন</option>
                                    @if($school_types)
                                        @foreach($school_types as $school_type)
                                            <option value="{{$school_type->id}}">{{$school_type->type}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($errors->has('school_type_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('school_type_id')}}</strong>
                            </span>
                        @endif
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
          document.getElementById('school_type_id').value="{{old('school_type_id')}}";
      </script>
    @endif
  
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( '' );
  </script>
@endsection