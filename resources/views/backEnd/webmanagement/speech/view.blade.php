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
          <h4>{{$speech->tittle}}</h4>
        </div>
        <div class="panel-body">
            {!!$speech->speech!!}
        </div>
    </div>
    
    <script type="text/javascript">
       var openFile = function(event) {
       var input = event.target;
       var reader = new FileReader();
       reader.onload = function(){
       var dataURL = reader.result;
       var output = document.getElementById('image');
       output.src = dataURL;
       };
       reader.readAsDataURL(input.files[0]);
       };
   </script>
    <script type="text/javascript">
        document.getElementById('type_id').value="{{$speech->type_id}}";
    </script>
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'speech' );
  </script>
@endsection