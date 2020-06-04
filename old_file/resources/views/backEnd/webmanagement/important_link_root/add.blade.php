@extends('backEnd.master')

@section('mainTitle', 'Add Important Link')
@section('head_section')
    <style>

    </style>
@endsection
@section('date_language', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Add Important Link</h1>
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
            <form action="{{url('/important_link_root/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                          <label class="" for="tittle">Title <span class="star">*</span></label>
                          <div class="">
                            <input type="text" class="form-control" name="tittle" id="tittle" placeholder="Title" data-validation="required length " data-validation-length="max100" value="{{old('tittle')}}">
                          </div>
                          @if ($errors->has('tittle'))
                              <span class="help-block">
                                  <strong>{{$errors->first('tittle')}}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group {{$errors->has('link') ? 'has-error' : ''}}">
                          <label class="" for="link">Link <span class="star">*</span></label>
                          <div class="">
                            <input type="text"   class="form-control" name="link" placeholder="Link" id="link" data-validation="required length " data-validation-length="max100" value="{{old('link')}}">
                          </div>
                          @if ($errors->has('link'))
                              <span class="help-block">
                                  <strong>{{$errors->first('link')}}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                </div>

                  <div class="row">
                    <div class="col-sm-4 {{$errors->has('wm_important_links_category_root_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="wm_important_links_category_root_id"> Category <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="wm_important_links_category_root_id" id="wm_important_links_category_root_id" data-validation="required" required>
                                    <option value="">Select Category</option>
                                    @if($categorys)
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}">{{$category->tittle}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($errors->has('wm_important_links_category_root_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('wm_important_links_category_root_id')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-4{{$errors->has('school_type_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="school_type_id">Select Institute Type <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="school_type_id[]" id="school_type_id" data-validation="required" required multiple="true" >
                                    <option value="">Select type</option>
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
                    <div class="col-sm-4 {{$errors->has('header_status') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="header_status">Is show header ? <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="header_status" id="header_status" data-validation="required " required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>

                                </select>
                            </div>
                        </div>
                        @if($errors->has('header_status'))
                            <span class="help-block">
                                <strong>{{$errors->first('header_status')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  @if($errors->any())
    <script type="text/javascript">
        document.getElementById('wm_important_links_category_root_id').value="{{old('wm_important_links_category_root_id')}}";
    </script>
  @endif
  @if($errors->any())
    <script type="text/javascript">
        document.getElementById('school_type_id').value="{{old('school_type_id')}}";
    </script>
  @endif
  @if($errors->any())
    <script type="text/javascript">
        document.getElementById('header_status').value="{{old('header_status')}}";
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
