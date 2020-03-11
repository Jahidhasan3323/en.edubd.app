@extends('backEnd.master')

@section('mainTitle', 'Add Date Language')
@section('head_section')
    <style>

    </style>
@endsection
@section('date_language', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">তারিখের ভাষা যোগ করুন</h1>
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
            <form action="{{url('/admin_date_language/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                            <label class="" for="tittle">ভাষার নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('title')}}" type="text" name="tittle" class="form-control" placeholder="ভাষার নাম">
                            </div>
                            @if ($errors->has('tittle'))
                                <span class="help-block">
                                    <strong>{{$errors->first('tittle')}}</strong>
                                </span>
                            @endif
                        </div>
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
@endsection
