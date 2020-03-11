@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Notice')
@section('active_notice', 'active')
@section('head_section')
    <style>

    </style>
@endsection
@section('information', 'active')
@section('content')
    <div class="panel panel-info col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">নোটিশ</h1>
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
          <h4>{{$notice->name}}<span class="pull-right">{{$notice->updated_at->format('d-m-Y')}}</span></h4>
          
        </div>
        <div class="panel-body">
            @if(!empty($notice->path))<a style="margin-bottom: 10px;" target="_blank" href="{{url(Storage::url($notice->path))}}" class="btn btn-success">ফাইল</a>@endif
            {!!$notice->description!!}
        </div>
    </div>
    
    
@endsection

