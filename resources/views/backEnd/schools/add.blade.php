@extends('backEnd.master')

@section('mainTitle', 'Add School')

@section('active_school', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রতিষ্ঠান যোগ করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form id="validate" name="validate" action="{{url('/schools')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                            <label class="" for="name">প্রতিষ্ঠানের পুরো নাম <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{old('name')}}" name="name" id="name" placeholder="School's Full Name">
                            </div>

                            @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('total_student') ? ' has-error' : ''}}">
                            <label class="" for="total_student">প্রতিষ্ঠানের মোট শিক্ষার্থী <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{old('total_student')}}" name="total_student" id="total_student" placeholder="School's Total Studetns">
                            </div>

                            @if($errors->has('total_student'))
                                <span class="help-block">
                                        <strong>{{$errors->first('total_student')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <label class="" for="email">ইমেইল <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{old('email')}}" type="email" name="email" id="email" placeholder="School's Official Email">
                            </div>

                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                            <label class="" for="password">পাসওয়ার্ড <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="password" name="password" id="password" placeholder="Login Password">
                            </div>

                            @if($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
                            <label class="" for="address">ঠিকানা <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{old('address')}}" type="text" name="address" id="address" placeholder="School's Address">
                            </div>

                            @if($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{$errors->first('address')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="website">ওয়েব ঠিকানা</label>
                            <div class="">
                                <input class="form-control" value="{{old('website')}}" type="text" name="website" id="website" placeholder="School's Web Address">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                            <label class="" for="contact">যোগাযোগ <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{old('mobile')}}" type="text" name="mobile" id="mobile" placeholder="School's Official Phone No">
                            </div>
                            <div id="mobileError" class="has-error" style="display: none">
                                <span class="help-block">
                                    <strong class="mobileError"></strong>
                                </span>
                            </div>
                            @if($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{$errors->first('mobile')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="fax">ফ্যাক্স</label>
                            <div class="">
                                <input class="form-control" value="{{old('fax')}}" type="text" name="fax" id="fax" placeholder="School's Fax no">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('established_date') ? 'has-error' : ''}}">
                            <label for="date">প্রতিষ্ঠার তারিখ <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" name="established_date" id="date">
                            </div>

                            @if($errors->has('established_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('established_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('expiry_date') ? 'has-error' : ''}}">
                            <label for="expiry_date">মেয়াদ শেষ হওয়ার তারিখ <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control date" type="text" name="expiry_date" id="expiry_date">
                            </div>

                            @if($errors->has('expiry_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('expiry_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="sms_service">প্রতিষ্ঠানের এস,এম,এস সার্ভিস<span class="star">*</span></label>
                            <select class="form-control" id="sms_service" name="sms_service">
                                <option value="1">অটোমেটিক</option>
                                <option value="0">ম্যানুয়ালি</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="attendance_sms">অটোমেটিক উপস্থিতি এস,এম,এস সেন্ড<span class="star">*</span></label>
                            <select class="form-control" id="attendance_sms" name="attendance_sms">
                                <option value="0">এস,এম,এস বন্ধ রাখুন</option>
                                <option value="1">শিক্ষক ও কর্মচারী এস,এম,এস</option>
                                <option value="2">শিক্ষার্থী এস,এম,এস</option>
                                <option value="3">শিক্ষক-কর্মচারী ও শিক্ষার্থী এস,এম,এস</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
                            <label class="" for="code">কোড <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{old('code')}}" type="text" name="code" id="code" placeholder="School's Code">
                            </div>

                            @if($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{$errors->first('code')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="status">অবস্থা <span class="star">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">সক্রিয়</option>
                                <option value="0">নিষ্ক্রিয়</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('country_code') ? 'has-error' : ''}}">
                            <label class="" for="country_code">কান্ট্রি কোড <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{old('country_code')}}" type="text" name="country_code" id="country_code" placeholder="School's country_code">
                            </div>

                            @if($errors->has('country_code'))
                                <span class="help-block">
                                    <strong>{{$errors->first('country_code')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('serial_no') ? 'has-error' : ''}}">
                            <label class="" for="serial_no">ক্রমিক নং <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{old('serial_no')}}" type="text" name="serial_no" id="serial_no" placeholder="School's serial_no">
                            </div>

                            @if($errors->has('serial_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('serial_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('attend_percentage_limit') ? 'has-error' : ''}}">
                            <label for="attend_percentage_limit">এস,এম,এসের জন্য উপস্থিতি লিমিট (%) </label>
                            <div class="">
                                <input class="form-control" type="text" value="{{ old('attend_percentage_limit',10) }}" name="attend_percentage_limit" id="attend_percentage_limit">
                            </div>

                            @if($errors->has('attend_percentage_limit'))
                                <span class="help-block">
                                    <strong>{{$errors->first('attend_percentage_limit')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('school_type_id') ? 'has-error' : ''}}">
                            <label for="school_type_id">প্রতিষ্ঠানের টাইপ নির্বাচন করুন <span class="star">*</span></label>
                            <select name="school_type_id[]" id="school_type_id" class="form-control" multiple="true">
                                @foreach($school_types as $school_type)
                                <option value="{{$school_type->id}}">{{$school_type->type}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('school_type_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('school_type_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('service_type_id') ? 'has-error' : ''}}">
                            <label for="service_type_id">সেবার ধরণ <span class="star">*</span></label>
                            <select name="service_type_id" id="service_type_id" class="form-control">
                                <option value="">সেবার ধরণ নির্বাচন করুন</option>
                                @foreach($service_types as $service_type)
                                <option value="{{$service_type->id}}">{{$service_type->type}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('service_type_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('service_type_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('logo') ? 'has-error' : ''}}">
                            <label for="logo">প্রতিষ্ঠানের প্রতীক <span class="star">*</span></label>
                            <input type="file" name="logo" accept="image/*">

                            @if($errors->has('logo'))
                                <span class="help-block">
                                    <strong>{{$errors->first('logo')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('signature_p') ? 'has-error' : ''}}">
                            <label for="signature_p">প্রিন্সিপালের স্বাক্ষর</label>
                            <input type="file" name="signature_p" accept="image/*">

                            @if($errors->has('signature_p'))
                                <span class="help-block">
                                    <strong>{{$errors->first('signature_p')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="row" style="display: none">
                    <div class="col-sm-12">
                        <input name="group_id" type="text" value="2">
                    </div>
                </div>

                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<!-- date css ans js -->
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( ".date" ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true
            }).val();
        } );
    </script>
<!-- date css ans js -->

    <script src="{{asset('backEnd/js/appsJs/addSchool.js')}}"></script>

    <script>
        document.forms['validate'].elements['status'].value="{{old('status')}}";
        document.forms['validate'].elements['service_type_id'].value="{{old('service_type_id')}}";
    </script>
@endsection
