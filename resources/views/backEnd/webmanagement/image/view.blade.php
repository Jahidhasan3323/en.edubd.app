@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Speech Details')
@section('head_section')
    <style>

    </style>
@endsection
@section('gallery', 'active')
@section('content')
    <div class="panel panel-info col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ছবির বর্ণনা</h1>
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

        <div class="panel-heading">
          <h4>{{$image_gallery->tittle}}</h4>
        </div>
        <div class="panel-body">
          <img src="{{Storage::url($image_gallery->path)}}" width="100%" >
          <p>{{$image_gallery->date}}</p>
            {!!$image_gallery->details!!}
        </div>
    </div>
    
    
    
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'speech' );
  </script>
@endsection