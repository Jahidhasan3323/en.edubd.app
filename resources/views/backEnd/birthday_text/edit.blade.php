@extends('backEnd.master')

@section('mainTitle', 'জন্মদিনের বার্তা')
@section('active_birthday_text', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">জন্মদিনের বার্তা পরিবর্তন করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-8 col-md-offset-2">
            <form action="{{ route('birthdayText.update', $birthdat_text->id) }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="type" value="1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="content">প্রতিষ্ঠান নির্বাচন করুন</label>
                            <select class="form-control" name="school_id" id="school_id">
                                <option selected value="{{ $birthdat_text->school_id }}">{{ $birthdat_text->school->user->name }}</option>
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}" >{{$school->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="content">জন্মদিনের বার্তা </label>
                            <div class="">
                                <textarea name="content" rows="3" class="form-control">{{ $birthdat_text->content }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
