@extends('backEnd.master')

@section('mainTitle', 'Manage Schools Group fo Class')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিভাগ সম্পাদন করুন</h1>
        </div>
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <form action="{{url('/group/update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label for="name">বিভাগের নাম<span class="star">*</span></label>
                            <input class="form-control" type="text" placeholder="Type a group name.." id="name" value="{{$group_class->name}}" name="name">
                              
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" readonly="true" value="{{$group_class->id}}" name="id">
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset">
                            <div class="form-group">
                                <button id="save_btn" type="submit" class="btn btn-block btn-info">হালনাগাদ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

       
    </div>
@endsection
