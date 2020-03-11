@extends('backEnd.master')

@section('mainTitle', 'বার্তার সেটিং')
@section('message_length', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বার্তা সেটিং করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-8 col-md-offset-2">
            <form action="{{ route('messageLength.store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="content">প্রতিষ্ঠান নির্বাচন করুন</label>
                            <select class="form-control" name="school_id" id="school_id" required>
                                {{-- <option value="">প্রতিষ্ঠান নির্বাচন করুন</option> --}}
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}" >{{$school->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="content">জন্মদিনের বার্তা (অটোমেটিক)</label>
                            <select class="form-control" name="birthday_sms" id="birthday_sms" required>
                                <option selected value="0">নিষ্ক্রিয়</option>
                                <option value="1">সক্রিয়</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="notification">নোটিফিকেশন বার্তার লিমিট </label>
                            <div class="">
                                <input type="number" name="notification" value="{{ old('notification') }}" class="form-control">
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
