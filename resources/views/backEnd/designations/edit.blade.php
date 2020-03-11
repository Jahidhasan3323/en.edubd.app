@extends('backEnd.master')

@section('mainTitle', 'Edit Teacher Designation')
@section('active_designation', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">পদ সম্পাদন করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-8 col-md-offset-2">
            <form action="{{url('/designations/'.$designation->id)}}" method="post" enctype="multipart/form-data">
                {{method_field('PATCH')}}
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">পদবী নাম <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$designation->name}}" name="name" id="name" placeholder="Designation Name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 {{$errors->has('type') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="type">পদবীর ধরণ<span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type" id="type">
                                    <option selected value="{{ $designation->type }}">{{ $designation->type==1?'শিক্ষক ও কর্মচারী':'কমিটি' }}</option>
                                    <option value="1">শিক্ষক ও কর্মচারী </option>
                                    <option value="2">কমিটি</option>
                                </select>
                            </div>
                        </div>
                        @if($errors->has('type'))
                            <span class="help-block">
                                <strong>{{$errors->first('type')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">হালনাগাদ</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
