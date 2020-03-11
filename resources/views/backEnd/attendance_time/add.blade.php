@extends('backEnd.master')

@section('mainTitle', 'উপস্থিতি সময়')
@section('active_attendance_text', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">উপস্থিতি সময় যোগ করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-8 col-md-offset-2" style="border: 1px solid #ddd;">
            <form action="{{ route('attendanceTime.store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="school_id">প্রতিষ্ঠান নির্বাচন করুন</label>
                            <select class="form-control" name="school_id" id="school_id">
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}" >{{$school->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="in_time">উপস্থিত সময় </label>
                            <div class="">
                                <input type="time" name="in_time" value="{{ date('h:i') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="out_time">প্রতিষ্ঠান ত্যাগের সময় </label>
                            <div class="">
                                <input type="time" name="out_time" value="{{ date('h:i') }}" class="form-control">
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
@section('script')

@endsection
