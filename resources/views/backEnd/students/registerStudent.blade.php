@extends('backEnd.master')

@section('mainTitle', 'Register Student')
@section('active_student', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">


        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form name="validate" class="validate" action="{{url('/students')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>একাডেমিক তথ্য যোগ করুন</h3>
                       <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">শিক্ষার্থীর নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" class="form-control" type="text" name="name" id="name" placeholder="Student Full Name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 {{$errors->has('gender') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="gender">লিঙ্গ <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">লিঙ্গ নির্বাচন করুন</option>
                                    <option value="ছেলে">ছেলে</option>
                                    <option value="মেয়ে">মেয়ে</option>
                                </select>
                            </div>
                        </div>
                        @if($errors->has('gender'))
                            <span class="help-block">
                                <strong>{{$errors->first('gender')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">শ্রেণী <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="master_class_id" id="master_class_id">
                                    <option value="">শ্রেণী নির্বাচন করুন</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @if ($errors->has('master_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('master_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">শিফট <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="shift" id="shift">
                                    <option value="">শিফট নির্বাচন করুন</option>
                                    <option value="সকাল">সকাল</option>
                                    <option value="দিন">দিন</option>
                                    <option value="সন্ধ্যা">সন্ধ্যা</option>
                                    <option value="রাত">রাত</option>
                                </select>
                            </div>
                            @if ($errors->has('shift'))
                                <span class="help-block">
                                    <strong>{{$errors->first('shift')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section">শাখা <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="section" id="section">
                                    <option value="">...শাখা নির্বাচন করুন...</option>
                                    <option value="ক">ক</option>
                                    <option value="খ">খ</option>
                                    <option value="গ">গ</option>
                                    <option value="ঘ">ঘ</option>
                                    @foreach($units as $unit)
                                    <option value="{{$unit->name}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{$errors->first('section')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('group') ? 'has-error' : ''}}">
                            <label class="" for="group">গ্রুপ / বিভাগ <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="group" id="group">
                                    <option value="">গ্রুপ / বিভাগ নির্বাচন করুন</option>
                                    @foreach($group_classes as $group_class)
                                    <option value="{{$group_class->name}}">{{$group_class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('group'))
                                <span class="help-block">
                                    <strong>{{$errors->first('group')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('roll') ? 'has-error' : ''}}">
                            <label for="roll">শ্রেণী রোল নং <span class="star">*</span></label>
                            <div>
                                <input value="{{old('roll')}}" type="text" class="form-control" name="roll" id="roll" placeholder="Student Class Roll">
                            </div>
                            @if ($errors->has('roll'))
                                <span class="help-block">
                                    <strong>{{$errors->first('roll')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('session') ? 'has-error' : ''}}">
                            <label for="session">শিক্ষাবর্ষ</label>
                            <div>
                                <input value="{{date('Y')}}" type="text" class="form-control" name="session" id="session">
                            </div>
                            @if ($errors->has('session'))
                                <span class="help-block">
                                    <strong>{{$errors->first('session')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('student_id') ? 'has-error' : ''}}">
                            <label class="" for="student_id">শিক্ষার্থীর আইডি নাম্বার <span class="star">* Don't try to change this</span></label>
                            <div class="form-control">
                                <span>{{$student_id}}</span>
                                <input value="{{$student_id}}" class="" type="hidden" name="student_id" id="student_id">
                            </div>
                            @if ($errors->has('student_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('student_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('regularity') ? 'has-error' : ''}}">
                            <label class="" for="regularity">শিক্ষার্থীর ধরণ <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="regularity" id="regularity">
                                    <option value="">শিক্ষার্থীর ধরণ নির্বাচন করুন</option>
                                    <option value="নিয়মিত">নিয়মিত</option>
                                    <option value="অনিয়মিত">অনিয়মিত</option>
                                </select>
                            </div>
                            @if ($errors->has('regularity'))
                                <span class="help-block">
                                    <strong>{{$errors->first('regularity')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

<div class="row">
    <div class="col-sm-12 text-center">
        <h3>ব্যক্তিগত তথ্য যোগ করুন</h3>
       <hr>
    </div>
</div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('birthday') ? 'has-error' : ''}}">
                            <label for="birthday">জন্ম তারিখ <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('birthday')}}" class="form-control date" type="text" name="birthday" id="birthday" placeholder="Birth Day">
                            </div>
                            @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{$errors->first('birthday')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('blood_group') ? 'has-error' : ''}}">
                            <label class="" for="blood_group">রক্তের গ্রুপ</label>
                            <div class="">
                                <select class="form-control" name="blood_group" id="blood_group">
                                    <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            @if ($errors->has('blood_group'))
                                <span class="help-block">
                                    <strong>{{$errors->first('blood_group')}}</strong>
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
                                <input value="{{old('email',$student_id.'@gmail.com')}}" class="form-control" type="email" name="email" id="email" placeholder="Student Email">
                            </div>
                            @if ($errors->has('email'))
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
                                <input class="form-control" type="text" name="password" value="{{ rand(10, 999999999) }}" id="password" placeholder="Student Password">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('religion') ? 'has-error' : ''}}">
                            <label class="" for="religion">ধর্ম <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="religion" id="religion">
                                    <option value="">ধর্ম নির্বাচন করুন</option>
                                    <option value="ইসলাম">ইসলাম</option>
                                    <option value="হিন্দু">হিন্দু</option>
                                    <option value="খ্রীষ্টধর্ম">খ্রীষ্টধর্ম</option>
                                    <option value="বৌদ্ধধর্ম">বৌদ্ধধর্ম</option>
                                    <option value="জৈনধর্ম">জৈনধর্ম</option>
                                </select>
                            </div>

                            @if ($errors->has('religion'))
                                <span class="help-block">
                                    <strong>{{$errors->first('religion')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('birth_rg_no') ? 'has-error' : ''}}">
                            <label class="" for="birth_rg_no">জন্ম নিবন্ধন নাম্বার <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('birth_rg_no')}}" class="form-control" type="text" name="birth_rg_no" id="birth_rg_no" placeholder="Student Birth Registration No">
                            </div>
                            @if($errors->has('birth_rg_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('birth_rg_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                            <label class="" for="mobile">মোবাইল নম্বর </label>
                            <div class="">
                                <input value="{{old('mobile')}}" class="form-control" type="text" name="mobile" id="mobile" placeholder="Student Contact">
                            </div>
                            <div id="mobileError" class="has-error" style="display: none">
                                <span class="help-block">
                                    <strong class="mobileError"></strong>
                                </span>
                            </div>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{$errors->first('mobile')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('last_sd_org') ? 'has-error' : ''}}">
                            <label class="" for="last_sd_org"> সর্বশেষ অধ্যয়ন প্রতিষ্ঠানের নাম ও ঠিকানা </label>
                            <div class="">
                                <input value="{{old('last_sd_org')}}" class="form-control" type="text" name="last_sd_org" id="last_sd_org" placeholder="The Latest Study Organization of Student">
                            </div>
                            @if($errors->has('last_sd_org'))
                                <span class="help-block">
                                    <strong>{{$errors->first('last_sd_org')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('re_to_lve') ? 'has-error' : ''}}">
                            <label class="" for="re_to_lve"> ছেড়ে আসার কারন </label>
                            <div class="">
                                <input value="{{old('re_to_lve')}}" class="form-control" type="text" name="re_to_lve" id="re_to_lve" placeholder="Reason to leave">
                            </div>
                            @if($errors->has('re_to_lve'))
                                <span class="help-block">
                                    <strong>{{$errors->first('re_to_lve')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

<div class="row">
    <div class="col-sm-12 text-center">
        <h3>বর্তমান ঠিকানা যোগ করুন</h3>
       <hr>
    </div>
</div>


                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_address') ? 'has-error' : ''}}">
                            <label for="pre_address">হোম নাম </label>
                            <div>
                                <input value="{{old('pre_address')}}" type="text" class="form-control" name="pre_address" id="pre_address" placeholder="Student present address">
                            </div>
                            @if ($errors->has('pre_address'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_address')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('Pre_h_no') ? 'has-error' : ''}}">
                            <label for="Pre_h_no">হাউস / হোল্ডিং নম্বর</label>
                            <div>
                                <input value="{{old('Pre_h_no')}}" type="text" class="form-control" name="Pre_h_no" id="Pre_h_no" placeholder="Student House / Holding Number">
                            </div>
                            @if ($errors->has('Pre_h_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('Pre_h_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_ro_no') ? 'has-error' : ''}}">
                            <label for="pre_ro_no">রাস্তা নম্বর</label>
                            <div>
                                <input value="{{old('pre_ro_no')}}" type="text" class="form-control" name="pre_ro_no" id="pre_ro_no" placeholder="Student Road Number">
                            </div>
                            @if ($errors->has('pre_ro_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_ro_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_vpm') ? 'has-error' : ''}}">
                            <label for="pre_vpm">গ্রাম / পারা / মহল্লা নাম <span class="star">*</span></label>
                            <div>
                                <input value="{{old('pre_vpm')}}" type="text" class="form-control" name="pre_vpm" id="pre_vpm" placeholder="Student Village / Para / Mahalla">
                            </div>
                            @if ($errors->has('pre_vpm'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_vpm')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_poff') ? 'has-error' : ''}}">
                            <label for="pre_poff">ডাকঘর<span class="star">*</span></label>
                            <div>
                                <input value="{{old('pre_poff')}}" type="text" class="form-control" name="pre_poff" id="pre_poff" placeholder="Student Post office">
                            </div>
                            @if ($errors->has('pre_poff'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_poff')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_unim') ? 'has-error' : ''}}">
                            <label for="pre_unim">ইউনিয়ন / পৌরসভার নাম <span class="star">*</span></label>
                            <div>
                                <input value="{{old('pre_unim')}}" type="text" class="form-control" name="pre_unim" id="pre_unim" placeholder="Student Union / Municipality">
                            </div>
                            @if ($errors->has('pre_unim'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_unim')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_subd') ? 'has-error' : ''}}">
                            <label for="pre_subd">উপ জেলা / থানা নাম <span class="star">*</span></label>
                            <div>
                                <input value="{{old('pre_subd')}}" type="text" class="form-control" name="pre_subd" id="pre_subd" placeholder="Student Sub District / Thana">
                            </div>
                            @if ($errors->has('pre_subd'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_subd')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_district') ? 'has-error' : ''}}">
                            <label for="pre_district">জেলার নাম <span class="star">*</span></label>
                            <div>
                                <input value="{{old('pre_district')}}" type="text" class="form-control" name="pre_district" id="pre_district" placeholder="Student District">
                            </div>
                            @if ($errors->has('pre_district'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_district')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('pre_postc') ? 'has-error' : ''}}">
                            <label for="pre_postc">পোস্ট কোড নং</label>
                            <div>
                                <input value="{{old('pre_postc')}}" type="text" class="form-control" name="pre_postc" id="pre_postc" placeholder="Student Post Code">
                            </div>
                            @if ($errors->has('pre_postc'))
                                <span class="help-block">
                                    <strong>{{$errors->first('pre_postc')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>


<div class="row">
    <div class="col-sm-12 text-center">
        <h3>স্থায়ী ঠিকানা যোগ করুন</h3>
       <hr> <hr>
    </div>
</div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_address') ? 'has-error' : ''}}">
                            <label for="per_address">হোম নাম </label>
                            <div>
                                <input value="{{old('per_address')}}" type="text" class="form-control" name="per_address" id="per_address" placeholder="Student persent address">
                            </div>
                            @if ($errors->has('per_address'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_address')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_h_no') ? 'has-error' : ''}}">
                            <label for="per_h_no">হাউস / হোল্ডিং নম্বর</label>
                            <div>
                                <input value="{{old('per_h_no')}}" type="text" class="form-control" name="per_h_no" id="per_h_no" placeholder="Student House / Holding Number">
                            </div>
                            @if ($errors->has('per_h_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_h_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_ro_no') ? 'has-error' : ''}}">
                            <label for="per_ro_no">রাস্তা নম্বর</label>
                            <div>
                                <input value="{{old('per_ro_no')}}" type="text" class="form-control" name="per_ro_no" id="per_ro_no" placeholder="Student Road Number">
                            </div>
                            @if ($errors->has('per_ro_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_ro_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_vpm') ? 'has-error' : ''}}">
                            <label for="per_vpm">গ্রাম / পারা / মহল্লা নাম </label>
                            <div>
                                <input value="{{old('per_vpm')}}" type="text" class="form-control" name="per_vpm" id="per_vpm" placeholder="Student Village / Para / Mahalla">
                            </div>
                            @if ($errors->has('per_vpm'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_vpm')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_poff') ? 'has-error' : ''}}">
                            <label for="per_poff">ডাকঘর</label>
                            <div>
                                <input value="{{old('per_poff')}}" type="text" class="form-control" name="per_poff" id="per_poff" placeholder="Student Post office">
                            </div>
                            @if ($errors->has('per_poff'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_poff')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_unim') ? 'has-error' : ''}}">
                            <label for="per_unim">ইউনিয়ন / পৌরসভার নাম </label>
                            <div>
                                <input value="{{old('per_unim')}}" type="text" class="form-control" name="per_unim" id="per_unim" placeholder="Student Union / Municipality">
                            </div>
                            @if ($errors->has('per_unim'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_unim')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_subd') ? 'has-error' : ''}}">
                            <label for="per_subd">উপ জেলা / থানা নাম</label>
                            <div>
                                <input value="{{old('per_subd')}}" type="text" class="form-control" name="per_subd" id="per_subd" placeholder="Student Sub District / Thana">
                            </div>
                            @if ($errors->has('per_subd'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_subd')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_district') ? 'has-error' : ''}}">
                            <label for="per_district">জেলার নাম </label>
                            <div>
                                <input value="{{old('per_district')}}" type="text" class="form-control" name="per_district" id="per_district" placeholder="Student District">
                            </div>
                            @if ($errors->has('per_district'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_district')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('per_postc') ? 'has-error' : ''}}">
                            <label for="per_postc">পোস্ট কোড নং</label>
                            <div>
                                <input value="{{old('per_postc')}}" type="text" class="form-control" name="per_postc" id="per_postc" placeholder="Student Post Code">
                            </div>
                            @if ($errors->has('per_postc'))
                                <span class="help-block">
                                    <strong>{{$errors->first('per_postc')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>




<div class="row">
    <div class="col-sm-12 text-center">
        <h3>পিতামাতার তথ্য যোগ করুন</h3>
       <hr>
    </div>
</div>
         <!-- father information -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('father_name') ? 'has-error' : ''}}">
                            <label class="" for="father_name">পিতার নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('father_name')}}" class="form-control" type="text" name="father_name" id="father_name" placeholder="Student Fater name">
                            </div>
                            @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('father_name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                 <div class="row">
                     <div class="col-sm-4">
                         <div class="form-group {{$errors->has('f_career') ? 'has-error' : ''}}">
                             <label class="" for="f_career">পেশা <span class="star">*</span></label>
                             <div class="">
                                 <input value="{{old('f_career')}}" class="form-control" type="text" name="f_career" id="f_career" placeholder="Student Father Career">
                             </div>
                             @if ($errors->has('f_career'))
                                <span class="help-block">
                                    <strong>{{$errors->first('f_career')}}</strong>
                                </span>
                            @endif
                         </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group {{$errors->has('f_m_income') ? 'has-error' : ''}}">
                             <label class="" for="f_m_income">মাসিক আয়</label>
                             <div class="">
                                 <input value="{{old('f_m_income')}}" class="form-control" type="text" name="f_m_income" id="f_m_income" placeholder="Father Monthly Income">
                             </div>
                             @if ($errors->has('f_m_income'))
                                <span class="help-block">
                                    <strong>{{$errors->first('f_m_income')}}</strong>
                                </span>
                            @endif
                         </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group {{$errors->has('f_edu_c') ? 'has-error' : ''}}">
                             <label class="" for="f_edu_c">শিক্ষাগত যোগ্যতা</label>
                             <div class="">
                                 <input value="{{old('f_edu_c')}}" class="form-control" type="text" name="f_edu_c" id="f_edu_c" placeholder="Father Educational Qualification">
                             </div>
                              @if ($errors->has('f_edu_c'))
                                 <span class="help-block">
                                     <strong>{{$errors->first('f_edu_c')}}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-6 {{$errors->has('f_mobile_no') ? 'has-error' : ''}}">
                         <div class="form-group">
                             <label class="" for="f_mobile_no">ফোন নাম্বার </label>
                             <div class="">
                                 <input value="{{old('f_mobile_no')}}" class="form-control" type="text" name="f_mobile_no" id="f_mobile_no" placeholder=" Father Mobile">
                             </div>
                         </div>
                         <div id="f_mobile_Error" class="has-error" style="display: none">
                             <span class="alert-danger">
                                 <strong class="f_mobile_Error"></strong>
                             </span>
                         </div>

                         @if($errors->has('f_mobile_no'))
                             <span class="help-block">
                                 <strong>{{$errors->first('f_mobile_no')}}</strong>
                             </span>
                         @endif
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group {{$errors->has('f_email') ? 'has-error' : ''}}">
                             <label class="" for="f_email">ইমেইল </label>
                             <div class="">
                                 <input value="{{old('f_email')}}" class="form-control" type="text" name="f_email" id="f_email" placeholder="Father Email">
                             </div>
                             @if ($errors->has('f_email'))
                                 <span class="help-block">
                                     <strong>{{$errors->first('f_email')}}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>

                 </div>
                 <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group {{$errors->has('f_nid') ? 'has-error' : ''}}">
                             <label class="" for="f_nid">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্সের নাম্বার </label>
                             <div class="">
                                 <input value="{{old('f_nid')}}" class="form-control" type="text" name="f_nid" id="f_nid" placeholder="Student Fater NID/Passport/Driving Number">
                             </div>
                              @if ($errors->has('f_nid'))
                                 <span class="help-block">
                                     <strong>{{$errors->first('f_nid')}}</strong>
                                 </span>
                             @endif
                         </div>
                     </div>
                 </div>
         <!-- //father information -->

         <hr>

         <!-- mother information -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('mother_name') ? 'has-error' : ''}}">
                            <label class="" for="mother_name">মাতার নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('mother_name')}}" class="form-control" type="text" name="mother_name" id="mother_name" placeholder="Student Mother Name">
                            </div>
                            @if ($errors->has('mother_name'))
                                 <span class="help-block">
                                     <strong>{{$errors->first('mother_name')}}</strong>
                                 </span>
                             @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('m_career') ? 'has-error' : ''}}">
                            <label class="" for="m_career">পেশা <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('m_career')}}" class="form-control" type="text" name="m_career" id="m_career" placeholder="Mother Career">
                            </div>
                            @if ($errors->has('m_career'))
                                 <span class="help-block">
                                     <strong>{{$errors->first('m_career')}}</strong>
                                 </span>
                             @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('f_nid') ? 'has-error' : ''}}">
                            <label class="" for="m_m_income">মাসিক আয়</label>
                            <div class="">
                                <input value="{{old('m_m_income')}}" class="form-control" type="text" name="m_m_income" id="m_m_income" placeholder="Mother Monthly Income">
                            </div>
                            @if ($errors->has('m_m_income'))
                                 <span class="help-block">
                                     <strong>{{$errors->first('m_m_income')}}</strong>
                                 </span>
                             @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('f_nid') ? 'has-error' : ''}}">
                            <label class="" for="m_edu_quali">শিক্ষাগত যোগ্যতা</label>
                            <div class="">
                                <input value="{{old('m_edu_quali')}}" class="form-control" type="text" name="m_edu_quali" id="m_edu_quali" placeholder="Educational Qualification">
                            </div>
                            @if ($errors->has('m_edu_quali'))
                                 <span class="help-block">
                                     <strong>{{$errors->first('m_edu_quali')}}</strong>
                                 </span>
                             @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 {{$errors->has('m_mobile_no') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="m_mobile_no">ফোন নাম্বার </label>
                            <div class="">
                                <input value="{{old('m_mobile_no')}}" class="form-control" type="text" name="m_mobile_no" id="m_mobile_no" placeholder=" Father Mobile">
                            </div>
                        </div>
                        <div id="m_mobile_Error" class="has-error" style="display: none">
                            <span class="alert-danger">
                                <strong class="m_mobile_Error"></strong>
                            </span>
                        </div>

                        @if($errors->has('m_mobile_no'))
                            <span class="help-block">
                                <strong>{{$errors->first('m_mobile_no')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('f_nid') ? 'has-error' : ''}}">
                            <label class="" for="m_email">ইমেইল </label>
                            <div class="">
                                <input value="{{old('m_email')}}" class="form-control" type="text" name="m_email" id="m_email" placeholder="Father Email">
                            </div>
                            @if ($errors->has('m_email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('m_email')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('m_nid') ? 'has-error' : ''}}">
                            <label class="" for="m_nid">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্সের নাম্বার </label>
                            <div class="">
                                <input value="{{old('m_nid')}}" class="form-control" type="text" name="m_nid" id="m_nid" placeholder="Student Mother NID/Passport/Driving Number">
                            </div>
                             @if ($errors->has('m_nid'))
                                <span class="help-block">
                                    <strong>{{$errors->first('m_nid')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
         <!-- //mother information -->


               <div class="row">
                   <div class="col-sm-12">
                       <div class="form-group {{$errors->has('local_gar') ? 'has-error' : ''}}">
                           <label class="" for="local_gar">পিতা / মাতার অবর্তমানে স্থানীয় অভিভাবকের নাম </label>
                           <div class="">
                               <input value="{{old('local_gar')}}" class="form-control" type="text" name="local_gar" id="local_gar" placeholder="Student Mother Name">
                           </div>
                            @if ($errors->has('relation'))
                               <span class="help-block">
                                   <strong>{{$errors->first('local_gar')}}</strong>
                               </span>
                            @endif
                       </div>
                   </div>
               </div>


               <div class="row">
                   <div class="col-sm-6 {{$errors->has('career') ? 'has-error' : ''}}">
                       <div class="form-group">
                           <label class="" for="career">পেশা </label>
                           <div class="">
                               <input value="{{old('career')}}" class="form-control" type="text" name="career" id="career" placeholder="Guardian Career">
                           </div>
                       </div>

                       @if($errors->has('career'))
                           <span class="help-block">
                               <strong>{{$errors->first('career')}}</strong>
                           </span>
                       @endif
                   </div>
                   <div class="col-sm-6">
                       <div class="form-group {{$errors->has('f_nid') ? 'has-error' : ''}}">
                           <label class="" for="relation">সম্পর্ক </label>
                           <div class="">
                               <input value="{{old('relation')}}" class="form-control" type="text" name="relation" id="relation" placeholder="Relation With Student">
                           </div>
                           @if ($errors->has('relation'))
                               <span class="help-block">
                                   <strong>{{$errors->first('relation')}}</strong>
                               </span>
                            @endif
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-sm-6 {{$errors->has('guardian_edu') ? 'has-error' : ''}}">
                       <div class="form-group">
                           <label class="" for="guardian_edu">শিক্ষাগত যোগ্যতা </label>
                           <div class="">
                               <input value="{{old('guardian_edu')}}" class="form-control" type="text" name="guardian_edu" id="guardian_edu Educational Qualification" placeholder="Guardian Educational Qualification">
                           </div>
                       </div>

                       @if($errors->has('guardian_edu'))
                           <span class="help-block">
                               <strong>{{$errors->first('guardian_edu')}}</strong>
                           </span>
                       @endif
                   </div>
                   <div class="col-sm-6">
                       <div class="form-group {{$errors->has('f_nid') ? 'has-error' : ''}}">
                           <label class="" for="guardian_mobile">ফোন নাম্বার </label>
                           <div class="">
                               <input value="{{old('guardian_mobile')}}" class="form-control" type="text" name="guardian_mobile" id="guardian_mobile" placeholder="Guardian Mobile">
                           </div>
                           <div id="Grdn_mobileError" class="has-error" style="display: none">
                               <span class="alert-danger">
                                   <strong class="Grdn_mobileError"></strong>
                               </span>
                           </div>
                           @if($errors->has('guardian_mobile'))
                               <span class="help-block">
                                   <strong>{{$errors->first('guardian_mobile')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-sm-6 {{$errors->has('guardian_email') ? 'has-error' : ''}}">
                       <div class="form-group">
                           <label class="" for="guardian_email">ইমেইল </label>
                           <div class="">
                               <input value="{{old('guardian_email')}}" class="form-control" type="text" name="guardian_email" id="guardian_email" placeholder="Guardian email">
                           </div>
                       </div>
                       @if($errors->has('guardian_email'))
                               <span class="help-block">
                                   <strong>{{$errors->first('guardian_email')}}</strong>
                               </span>
                       @endif
                   </div>
                   <div class="col-sm-6">
                       <div class="form-group {{$errors->has('guardian_nid') ? 'has-error' : ''}}">
                           <label class="" for="guardian_nid">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্সের নাম্বার </label>
                           <div class="">
                               <input value="{{old('guardian_nid')}}" class="form-control" type="text" name="guardian_nid" id="guardian_nid" placeholder="Student National ID / Passport / Driving License">
                           </div>
                           @if($errors->has('guardian_nid'))
                               <span class="help-block">
                                   <strong>{{$errors->first('guardian_nid')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
               </div>




                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('photo') ? 'has-error' : ''}}">
                            <label for="photo">শিক্ষার্থী ছবি  <span class="star">*</span> </label>
                            <input type="file" name="photo" onchange="openFile(event)" accept="image/*">
                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{$errors->first('photo')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('f_photo') ? 'has-error' : ''}}">
                            <label for="f_photo">পিতার ছবি <span class="star">*</span></label>
                            <input type="file" name="f_photo" onchange="openFile1(event)" accept="image/*">
                            @if ($errors->has('f_photo'))
                                <span class="help-block">
                                    <strong>{{$errors->first('f_photo')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{$errors->has('m_photo') ? 'has-error' : ''}}">
                            <label for="m_photo">মাতার ছবি <span class="star">*</span></label>
                            <input type="file" name="m_photo" onchange="openFile2(event)" accept="image/*">
                            @if ($errors->has('m_photo'))
                                <span class="help-block">
                                    <strong>{{$errors->first('m_photo')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-4">
                       <div>
                           <img id="photo_up" width="100px" height="120px" src="">
                       </div>
                    </div>
                    <div class="col-sm-4">
                           <div>
                               <img id="f_photo_up" width="100px" height="120px" src="">
                           </div>
                    </div>
                    <div class="col-sm-4">
                           <div>
                               <img id="m_photo_up" width="100px" height="120px" src="">
                           </div>
                    </div>
                </div>
                 <hr>


<!-- hedden school id-->
                <div class="row">
                     <div class="col-sm-6" style="display: none">
                         <div class="form-group">
                             <label for="school_id">School id</label>
                             <input type="hidden" value="{{$schoolId}}" name="school_id" id="school_id" class="form-control">
                         </div>
                     </div>
                     <div class="row" style="display: none">
                         <div class="col-sm-6">
                             <input name="group_id" type="text" value="4">
                         </div>
                     </div>
                 </div>
<!-- hedden school id-->
    @if($student_limit==$total_students)
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="text-danger">
                    <h3>Opps, Student limit cross || Please contact your management Service Provider !</h3>
                </span>
            </div>
        </div>

    @else
        <div class="">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-5">
                    <div class="form-group">
                        <button id="submit_btn" readonly="" type="submit" class="btn btn-block btn-info">নিবন্ধন করুন</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
                <input style="display: none" type="text" name="created_by" value="{{Auth::user()->id}}">
            </form>
        </div>
    </div>

        <script type="text/javascript">
            var openFile = function(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('photo_up');
            output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
            };

            var openFile1 = function(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('f_photo_up');
            output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
            };

            var openFile2 = function(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('m_photo_up');
            output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
            };

    </script>

@endsection

@section('script')
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
    <script src="{{asset('backEnd/js/appsJs/student_register.js')}}"></script>
    @if($errors->any())
    <script type="text/javascript">
        document.getElementById('gender').value="{{old('gender')}}";
        document.getElementById('shift').value="{{old('shift')}}";
        document.getElementById('master_class_id').value="{{old('master_class_id')}}";
         document.getElementById('section').value="{{old('section')}}";
         document.getElementById('group').value="{{old('group')}}";
         document.getElementById('blood_group').value="{{old('blood_group')}}";
         document.getElementById('religion').value="{{old('religion')}}";
    </script>
    @endif
@endsection
