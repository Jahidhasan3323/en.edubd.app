@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Add Important Link')
@section('head_section')
    <style>

    </style>
@endsection
@section('important_link', 'active')
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
            <form action="{{url('/important_link/create')}}" method="post" enctype="multipart/form-data">
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
                  <div class="col-sm-12 {{$errors->has('wm_important_links_category_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="wm_important_links_category_id"> Category <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="wm_important_links_category_id" id="wm_important_links_category_id" data-validation="required" required>
                                    <option value="">Select Category</option>
                                    @if($categorys)
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}">{{$category->tittle}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($errors->has('wm_important_links_category_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('wm_important_links_category_id')}}</strong>
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
        document.getElementById('wm_important_links_category_id').value="{{old('wm_important_links_category_id')}}";
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