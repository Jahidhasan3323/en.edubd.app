@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Speech Details')
@section('head_section')
    <style>

    </style>
@endsection
@section('information', 'active')
@section('content')
    <div class="panel panel-info col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">সম্পূর্ণ বাণী</h1>
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
          <h4>{{$general_text->tittle}}</h4>
        </div>
        <div class="panel-body">
            {!!$general_text->speech!!}

           @if(!empty($general_text->file))<a style="margin-bottom: 10px;" target="_blank" href="{{url(Storage::url($general_text->file))}}" class="btn btn-success">ফাইল</a>@endif
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