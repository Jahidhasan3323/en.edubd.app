@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Speech Details')
@section('head_section')
    <style>

    </style>
@endsection
@section('school_settings', 'active')
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
          <h4>{{$video_gallery->tittle}}</h4>
        </div>
        <div class="panel-body">
          <iframe width="500" height="313" src="https://www.youtube.com/embed/{{$video_gallery->path}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <p>{{$video_gallery->date}}</p>
            {!!$video_gallery->details!!}
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