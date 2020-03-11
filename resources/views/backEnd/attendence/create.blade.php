@extends('backEnd.master')

@section('mainTitle', 'উপস্থিতি ব্যাবস্থাপনা')
@section('active_attendance', 'active')

@section('content')

    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">উপস্থিতি এন্ট্রি </h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <form id="validate" name="validate" action="{{url('attendence/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                     <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{$errors->has('id_card_no') ? 'has-error' : ''}}">
                                <label for="id_card_no">আইডি নাম্বার<font color="red" size="4">*</font></label>
                                <input type="text" name="id_card_no" id="id_card_no" placeholder="Enter ID Number" class="form-control" autofocus="true">

                                @if ($errors->has('id_card_no'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('id_card_no')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                      </div> 
                    </div>
                    <div class="col-sm-offset-1 col-sm-6">
                        @if (session()->has('photo_path'))
                        <img src="{{Storage::url(session()->get('photo_path'))}}" class="img-thumbnail pull-right" style="height: 300px">
                        @endif
                    </div>
                </div>

            </form> 
        </div>
    </div>

@endsection

@section('script')
    
@endsection

