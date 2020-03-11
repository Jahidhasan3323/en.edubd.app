@extends('backEnd.master')

@section('mainTitle', 'Change Password')
{{--@section('active_subject', 'active')--}}

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">পাসওয়ার্ড পরিবর্তন করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form action="{{url('/updatePassword')}}" method="post" enctype="multipart/form-data">
                {{--{{method_field('PATCH')}}--}}
                {{csrf_field()}}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('current_password') ? 'has-error' : ''}}">
                            <label class="" for="current_password">বর্তমান পাসওয়ার্ড <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="password" name="current_password" id="current_password" placeholder="Your Current Password">
                            </div>
                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('current_password')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('new_password') ? 'has-error' : ''}}">
                            <label class="" for="new_password">নতুন পাসওয়ার্ড <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Your New Password">
                            </div>
                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('new_password')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('new_password_again') ? 'has-error' : ''}}">
                            <label class="" for="currentPassword">পাসওয়ার্ড পুনরায় টাইপ করুন <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="password" name="new_password_again" id="new_password_again" placeholder="Retype Your New Password">
                            </div>
                            @if ($errors->has('new_password_again'))
                                <span class="help-block">
                                    <strong>{{$errors->first('new_password_again')}}</strong>
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

@section('script')

@endsection