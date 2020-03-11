@extends('backEnd.master')

@section('mainTitle', 'Edit Teacher Designation')
@section('active_exam', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">পদ সম্পাদনা করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form action="{{url('/examTypes/'.$examType->id)}}" method="post" enctype="multipart/form-data">
                {{method_field('PATCH')}}
                {{csrf_field()}}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">পরীক্ষার ধরন <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$examType->name}}" name="name" id="name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
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
                                <button type="submit" class="btn btn-block btn-info">হালনাগাদ</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
