@extends('backEnd.master')

@section('mainTitle', 'Message Settings')
@section('message_length', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Message Settings</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-8 col-md-offset-2">
            <form action="{{ route('messageLength.update', $message_length->id) }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="content">Select Institute</label>
                            <select class="form-control" name="school_id" id="school_id">
                                <option selected value="{{ $message_length->school_id }}">{{ $message_length->school->user->name }}</option>
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}" >{{$school->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="content">Birthday Wish Text</label>
                            <select class="form-control" name="birthday_sms" id="birthday_sms" required>
                                <option selected value="{{ $message_length->birthday_sms }}">{{ $message_length->birthday_sms==1?'Enable':'Disable' }}</option>
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="content">Notification SMS Text Limit</label>
                            <div class="">
                                <input type="number" name="notification" value="{{ old('notification',$message_length->notification) }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection