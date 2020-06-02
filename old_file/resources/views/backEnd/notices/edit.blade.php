@extends('backEnd.master')

@section('mainTitle', 'Edit Notice')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_notice', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Notice</h1>
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
            <form action="{{url('/notice/update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name"> Notice Name <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$notice->name}}" type="text" name="name" class="form-control" placeholder="Notice Name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" name="notice_id" value="{{$notice->id}}">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('notice') ? 'has-error' : ''}}">
                            <label for="notice">Upload Notice File</label>
                            <input type="file" name="notice">
                            @if ($errors->has('notice'))
                                <span class="help-block">
                                    <strong>{{$errors->first('notice')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('notice') ? 'has-error' : ''}}">
                            <label>Current File<span class="star">*</span></label>
                            <br>
                            <strong>{{$file_name}}</strong>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 {{$errors->has('is_admission_notice') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="is_admission_notice"> Admission Notice </label>
                            <div class="">
                                <select class="form-control" name="is_admission_notice" id="is_admission_notice" >
                                    <option value=""> Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>

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
                          <label class="" for="description">Description </label>
                          <div class="">
                            <textarea  class="form-control" name="description" id="description" >{{$notice->description}}</textarea>
                          </div>
                          @if ($errors->has('description'))
                              <span class="help-block">
                                  <strong>{{$errors->first('description')}}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                </div>

                <input type="hidden" name="school_id" value="{{Auth::getSchool()}}">
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
        document.getElementById('is_admission_notice').value="{{$notice->is_admission_notice}}";
    </script>
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description' );
  </script>
@endsection