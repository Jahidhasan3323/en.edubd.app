@extends('backEnd.master')

@section('mainTitle', 'Add Staff')
@section('active_teacher', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif


        <form id="validate" name="validate" class="validate" action="{{url('/staff')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}


        <!-- add academic information -->
        <div class="page-header">
            <h1 class="text-center text-temp">Academic Information</h1>
        </div>
        <div class="panel-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">Full Name<span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" class="form-control" type="text" name="name" id="name" placeholder=" Full Name">
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
                            <label class="" for="gender">Gender <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="gender" id="gender">
                                    <<option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
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
                        <div class="form-group {{$errors->has('designation_id') ? 'has-error' : ''}}">
                            <label class="" for="designation_id">Designation <span class="star">*</span></label>
                            <div class="">
                                <select value="{{old('designation_id')}}" name="designation_id" id="designation_id" class="form-control">
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('designation_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('designation_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('type') ? 'has-error' : ''}}">
                            <label class="" for="type">Job Type <span class="star">*</span></label>
                            <div class="">
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select Job Type</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Contractual">Contractual</option>
                                </select>
                            </div>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{$errors->first('type')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('salary') ? 'has-error' : ''}}">
                            <label class="" for="salary">Monthly Salary </label>
                            <div class="">
                                <input value="{{old('salary')}}" class="form-control" type="number" name="salary" id="salary" placeholder="Monthly Salary">
                            </div>
                            @if ($errors->has('salary'))
                                <span class="help-block">
                                    <strong>{{$errors->first('salary')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('subject') ? 'has-error' : ''}}">
                            <label class="" for="subject">Appointed for that job<span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('subject')}}" class="form-control" type="text" name="subject" id="subject" placeholder="Specialist Subject">
                            </div>
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('edu_qulif') ? 'has-error' : ''}}">
                            <label class="" for="edu_qulif">Educational Qualification <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('edu_qulif')}}" class="form-control" type="text" name="edu_qulif" id="edu_qulif" placeholder="Educational Qualification">
                            </div>
                            @if ($errors->has('edu_qulif'))
                                <span class="help-block">
                                    <strong>{{$errors->first('edu_qulif')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('training') ? 'has-error' : ''}}">
                            <label class="" for="training">Training </label>
                            <div class="">
                                <input value="{{old('training')}}" class="form-control" type="text" name="training" id="training" placeholder="Special training">
                            </div>
                            @if ($errors->has('training'))
                                <span class="help-block">
                                    <strong>{{$errors->first('training')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('joining_date') ? 'has-error' : ''}}">
                            <label for="joining_date">Join Date<span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('joining_date')}}" class="form-control date" type="text" name="joining_date" id="joining_date">
                            </div>
                            @if ($errors->has('joining_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('joining_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('retirement_date') ? 'has-error' : ''}}">
                            <label for="retirement_date">Retired Date</label>
                            <div class="">
                                <input value="{{old('retirement_date')}}" class="form-control date" type="text" name="retirement_date" id="retirement_date">
                            </div>
                            @if ($errors->has('retirement_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('retirement_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('index_no') ? 'has-error' : ''}}">
                            <label for="index_no">Index No. </label>
                            <div class="">
                                <input value="{{old('index_no')}}" class="form-control" type="number" name="index_no" id="index_no" placeholder="Index Number">
                            </div>
                            @if ($errors->has('index_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('index_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('date_of_mpo') ? 'has-error' : ''}}">
                            <label for="date_of_mpo">M.P.O Date</label>
                            <div class="">
                                <input value="{{old('date_of_mpo')}}" class="form-control date" type="text" name="date_of_mpo" id="date">
                            </div>
                            @if ($errors->has('date_of_mpo'))
                                <span class="help-block">
                                    <strong>{{$errors->first('date_of_mpo')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('staff_id') ? 'has-error' : ''}}">
                            <label class="" for="staff_id">Staff ID<span class="star">* Don't try to change this</span></label>
                            <div class="form-control">
                                <span>{{$staff_id}}</span>
                                <input value="{{$staff_id}}" type="hidden" name="staff_id" id="staff_id" placeholder="staff Id">
                            </div>
                            @if ($errors->has('staff_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('staff_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('group_id') ? 'has-error' : ''}}">
                            <label class="" for="group_id">Staff Access<span class="star">*</span></label>
                            <select class="form-control" id="group_id" name="group_id">
                                <option value="">Select Staff Access</option>
                                @foreach($groups as $group)
                                  <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('group_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('group_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                {{--
                |.. Authentication Group. 3 for  Authentication
                |.. School id for identify which school for this .
                --}}
                <input type="text" name="school_id" id="school_id" value="{{$school_id}}" style="display: none">

        </div>
        <!-- add academic information -->






        <!-- add Personal information -->
        <div class="page-header">
            <h1 class="text-center text-temp">Personal Information</h1>
        </div>
        <div class="panel-body">


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label class="" for="email">Email <span class="star">*</span></label>
                        <div class="">
                            <input value="{{old('email',$staff_id.'@gmail.com')}}" class="form-control" type="email" name="email" id="email" placeholder=" Email">
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
                        <label class="" for="password">Password <span class="star">*</span></label>
                        <div class="">
                            <input class="form-control" type="text" name="password" id="password" value="{{ rand(10, 999999999) }}">
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
                    <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                        <label class="" for="mobile">Mobile Number <span class="star">*</span></label>
                        <div class="">
                            <input value="{{old('mobile')}}" class="form-control" type="number" name="mobile" id="mobile" placeholder=" Contact">
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
                    <div class="form-group {{$errors->has('birthday') ? 'has-error' : ''}}">
                        <label for="birthday">Date of Birth <span class="star">*</span></label>
                        <div class="">
                            <input value="{{old('birthday')}}" class="form-control date" type="text" name="birthday" id="birthday">
                        </div>
                         @if ($errors->has('birthday'))
                            <span class="help-block">
                                <strong>{{$errors->first('birthday')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('blood_group') ? 'has-error' : ''}}">
                        <label for="blood_group">Blood group</label>
                        <label for="blood_group">Blood Group </label>
                        <div class="">
                            <select class="form-control" name="blood_group" id="blood_group">
                                <option value="">...Select Blood Group...</option>
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

                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('religion') ? 'has-error' : ''}}">
                        <label for="religion">Religion <span class="star">*</span></label>
                        <div class="">
                            <select class="form-control" name="religion" id="religion">
                                <option value="">...Select Religion...</option>
                                <option value="Islam">Islam</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Jainism">Jainism</option>
                            </select>
                        </div>
                        @if ($errors->has('religion'))
                            <span class="help-block">
                                <strong>{{$errors->first('religion')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('nid_card_no') ? 'has-error' : ''}}">
                        <label for="nid_card_no">National ID / Passport / Driving License Number <span class="star">*</span></label>
                        <div class="">
                            <input value="{{old('nid_card_no')}}" class="form-control" type="text" name="nid_card_no" id="nid_card_no" placeholder="National ID / Passport / Driving License Number">
                        </div>
                        @if ($errors->has('nid_card_no'))
                            <span class="help-block">
                                <strong>{{$errors->first('nid_card_no')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('last_org_name') ? 'has-error' : ''}}">
                        <label for="last_org_name">Name of the last service organization  </label>
                        <div class="">
                            <input value="{{old('last_org_name')}}" class="form-control" type="text" name="last_org_name" id="last_org_name" placeholder="Name of Organization of Last Service ">
                        </div>
                        @if ($errors->has('last_org_name'))
                            <span class="help-block">
                                <strong>{{$errors->first('last_org_name')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('reason_to_leave') ? 'has-error' : ''}}">
                        <label for="reason_to_leave">Reason for leaving</label>
                        <div class="">
                            <input value="{{old('reason_to_leave')}}" class="form-control" type="text" name="reason_to_leave" id="reason_to_leave" placeholder="National ID / Passport / Driving License Number">
                        </div>
                        @if ($errors->has('reason_to_leave'))
                            <span class="help-block">
                                <strong>{{$errors->first('reason_to_leave')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('last_org_address') ? 'has-error' : ''}}">
                        <label for="last_org_address">Company address (with phone number) </label>
                        <div class="">
                            <input value="{{old('last_org_address')}}" class="form-control" type="text" name="last_org_address" id="last_org_address" placeholder="Name of Organization of Last Service ">
                        </div>
                        @if ($errors->has('last_org_address'))
                            <span class="help-block">
                                <strong>{{$errors->first('last_org_address')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>


            </div>


        </div>
        <!-- add Personal information -->



        <!-- add present address information -->
        <div class="page-header">
            <h1 class="text-center text-temp">Add Current Address</h1>
        </div>
        <div class="panel-body">
           <div class="row">
               <div class="col-sm-4">
                   <div class="form-group {{$errors->has('pre_address') ? 'has-error' : ''}}">
                       <label for="pre_address">House name</label>
                       <div>
                           <input value="{{old('pre_address')}}" type="text" class="form-control" name="pre_address" id="pre_address" placeholder="House name">
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
                       <label for="Pre_h_no">Home / Holding number</label>
                       <div>
                           <input value="{{old('Pre_h_no')}}" type="text" class="form-control" name="Pre_h_no" id="Pre_h_no" placeholder="House / Holding Number">
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
                       <label for="pre_ro_no">Road number</label>
                       <div>
                           <input value="{{old('pre_ro_no')}}" type="text" class="form-control" name="pre_ro_no" id="pre_ro_no" placeholder="Road Number">
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
                       <label for="pre_vpm">Name of village / Para / Mahalla <span class="star">*</span></label>
                       <div>
                           <input value="{{old('pre_vpm')}}" type="text" class="form-control" name="pre_vpm" id="pre_vpm" placeholder="Village / Para / Mahalla">
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
                       <label for="pre_poff">Post office <span class="star">*</span></label>
                       <div>
                           <input value="{{old('pre_poff')}}" type="text" class="form-control" name="pre_poff" id="pre_poff" placeholder="Post office">
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
                       <label for="pre_unim">Name of union / municipality <span class="star">*</span></label>
                       <div>
                           <input value="{{old('pre_unim')}}" type="text" class="form-control" name="pre_unim" id="pre_unim" placeholder="Union / Municipality">
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
                       <label for="pre_subd">Name of the Upazila / Police Station <span class="star">*</span></label>
                       <div>
                           <input value="{{old('pre_subd')}}" type="text" class="form-control" name="pre_subd" id="pre_subd" placeholder="Name of the Upazila / Police Station">
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
                       <label for="pre_district">District name <span class="star">*</span></label>
                       <div>
                           <input value="{{old('pre_district')}}" type="text" class="form-control" name="pre_district" id="pre_district" placeholder="District">
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
                       <label for="pre_postc">The postal code number</label>
                       <div>
                           <input value="{{old('pre_postc')}}" type="number" class="form-control" name="pre_postc" id="pre_postc" placeholder="Post Code">
                       </div>
                       @if ($errors->has('pre_postc'))
                           <span class="help-block">
                               <strong>{{$errors->first('pre_postc')}}</strong>
                           </span>
                       @endif
                   </div>
               </div>
           </div>
        </div>
        <!-- add present address information -->



        <!-- add Permanent Address information -->
        <div class="page-header">
            <h1 class="text-center text-temp">Add Permanent address</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group {{$errors->has('per_address') ? 'has-error' : ''}}">
                        <label for="per_address">House name</label>
                        <div>
                            <input value="{{old('per_address')}}" type="text" class="form-control" name="per_address" id="per_address" placeholder="persent address">
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
                        <label for="per_h_no">Home / Holding number</label>
                        <div>
                            <input value="{{old('per_h_no')}}" type="text" class="form-control" name="per_h_no" id="per_h_no" placeholder="House / Holding Number">
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
                        <label for="per_ro_no">Road Number</label>
                        <div>
                            <input value="{{old('per_ro_no')}}" type="text" class="form-control" name="per_ro_no" id="per_ro_no" placeholder="Road Number">
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
                        <label for="per_vpm">Name of village / Para / Mahalla </label>
                        <div>
                            <input value="{{old('per_vpm')}}" type="text" class="form-control" name="per_vpm" id="per_vpm" placeholder="Village / Para / Mahalla">
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
                        <label for="per_poff">Post office </label>
                        <div>
                            <input value="{{old('per_poff')}}" type="text" class="form-control" name="per_poff" id="per_poff" placeholder="Post office">
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
                        <label for="per_unim">Name of union / municipality </label>
                        <div>
                            <input value="{{old('per_unim')}}" type="text" class="form-control" name="per_unim" id="per_unim" placeholder="Union / Municipality">
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
                        <label for="per_subd">Name of the Upazila / Police Station </label>
                        <div>
                            <input value="{{old('per_subd')}}" type="text" class="form-control" name="per_subd" id="per_subd" placeholder="Upzilla / Thana">
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
                        <label for="per_district">District name</label>
                        <div>
                            <input value="{{old('per_district')}}" type="text" class="form-control" name="per_district" id="per_district" placeholder="District">
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
                        <label for="per_postc">The postal code number</label>
                        <div>
                            <input value="{{old('per_postc')}}" type="number" class="form-control" name="per_postc" id="per_postc" placeholder="Post Code">
                        </div>
                        @if ($errors->has('per_postc'))
                            <span class="help-block">
                                <strong>{{$errors->first('per_postc')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- add Permanent Address information -->



        <!-- add Family Information information -->
        <div class="page-header">
            <h1 class="text-center text-temp">Add Family Information</h1>
        </div>
        <div class="panel-body">
            <!-- father information -->
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="form-group {{$errors->has('father_name') ? 'has-error' : ''}}">
                               <label class="" for="father_name">Father's Name <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{old('father_name')}}" class="form-control" type="text" name="father_name" id="father_name" placeholder="Fater name">
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
                                <label class="" for="f_career">Profession  <span class="star">*</span></label>
                                <div class="">
                                    <input value="{{old('f_career')}}" class="form-control" type="text" name="f_career" id="f_career" placeholder="Father Career">
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
                                <label class="" for="f_m_income">Monthly Income</label>
                                <div class="">
                                    <input value="{{old('f_m_income')}}" class="form-control" type="number" name="f_m_income" id="f_m_income" placeholder="Father Monthly Income">
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
                                <label class="" for="f_edu_c">Educational Qualification</label>
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
                                <label class="" for="f_mobile_no">Phone Number</label>
                                <div class="">
                                    <input value="{{old('f_mobile_no')}}" class="form-control" type="number" name="f_mobile_no" id="f_mobile_no" placeholder=" Father Mobile No.">
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
                                <label class="" for="f_email">Email</label>
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
                                <label class="" for="f_nid">National ID / Passport / Driving License Number </label>
                                <div class="">
                                    <input value="{{old('f_nid')}}" class="form-control" type="text" name="f_nid" id="f_nid" placeholder="Fater NID/Passport/Driving Number">
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
                               <label class="" for="mother_name">Mother's name <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{old('mother_name')}}" class="form-control" type="text" name="mother_name" id="mother_name" placeholder="Mother Name">
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
                               <label class="" for="m_career">Profession  <span class="star">*</span></label>
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
                               <label class="" for="m_m_income">Monthly Income</label>
                               <div class="">
                                   <input value="{{old('m_m_income')}}" class="form-control" type="number" name="m_m_income" id="m_m_income" placeholder="Mother Monthly Income">
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
                               <label class="" for="m_edu_c">Educational Qualification</label>
                               <div class="">
                                   <input value="{{old('m_edu_c')}}" class="form-control" type="text" name="m_edu_c" id="m_edu_c" placeholder="Relation with guardian">
                               </div>
                               @if ($errors->has('m_edu_c'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('m_edu_c')}}</strong>
                                    </span>
                                @endif
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-sm-6 {{$errors->has('m_mobile_no') ? 'has-error' : ''}}">
                           <div class="form-group">
                               <label class="" for="m_mobile_no">Phone number </label>
                               <div class="">
                                   <input value="{{old('m_mobile_no')}}" class="form-control" type="number" name="m_mobile_no" id="m_mobile_no" placeholder=" Mother Mobile No.">
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
                               <label class="" for="m_email">Email</label>
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
                               <label class="" for="m_nid">National ID number / passport / driving license number</label>
                               <div class="">
                                   <input value="{{old('m_nid')}}" class="form-control" type="text" name="m_nid" id="m_nid" placeholder="Mother NID/Passport/Driving Number">
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


            <div class="row"><hr><hr>
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('h_w_name') ? 'has-error' : ''}}">
                        <label class="" for="h_w_name">Name of husband / wife in case of married </label>
                        <div class="">
                            <input value="{{old('h_w_name')}}" class="form-control" type="text" name="h_w_name" id="h_w_name" placeholder="Name of Husband / Wife in case of Married">
                        </div>
                        @if ($errors->has('h_w_name'))
                             <span class="help-block">
                                 <strong>{{$errors->first('h_w_name')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('profession') ? 'has-error' : ''}}">
                        <label class="" for="profession">Profession</label>
                        <div class="">
                            <input value="{{old('profession')}}" class="form-control" type="text" name="profession" id="profession" placeholder="Profession">
                        </div>
                        @if ($errors->has('profession'))
                             <span class="help-block">
                                 <strong>{{$errors->first('profession')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('wedding_date') ? 'has-error' : ''}}">
                        <label class="" for="wedding_date">Marriage date</label>
                        <div class="">
                            <input value="{{old('wedding_date')}}" class="form-control" type="text" name="wedding_date" id="date">
                        </div>
                        @if ($errors->has('wedding_date'))
                             <span class="help-block">
                                 <strong>{{$errors->first('wedding_date')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('h_w_edu_qulif') ? 'has-error' : ''}}">
                        <label class="" for="h_w_edu_qulif">Educational Qualification</label>
                        <div class="">
                            <input value="{{old('h_w_edu_qulif')}}" class="form-control" type="text" name="h_w_edu_qulif" id="h_w_edu_qulif" placeholder="Educational Qualification">
                        </div>
                        @if ($errors->has('h_w_edu_qulif'))
                             <span class="help-block">
                                 <strong>{{$errors->first('h_w_edu_qulif')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('h_w_email') ? 'has-error' : ''}}">
                        <label class="" for="h_w_email">National ID number / passport / driving license number </label>
                        <div class="">
                            <input value="{{old('h_w_nid_no')}}" class="form-control" type="text" name="h_w_nid_no" id="h_w_nid_no" placeholder="National ID Number">
                        </div>
                        @if ($errors->has('h_w_nid_no'))
                             <span class="help-block">
                                 <strong>{{$errors->first('h_w_nid_no')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('h_w_mobile_no') ? 'has-error' : ''}}">
                        <label class="" for="h_w_mobile_no">Mobile Number</label>
                        <div class="">
                            <input value="{{old('h_w_mobile_no')}}" class="form-control" type="number" name="h_w_mobile_no" id="h_w_mobile_no" placeholder="Mobile Number">
                        </div>
                        @if ($errors->has('h_w_mobile_no'))
                             <span class="help-block">
                                 <strong>{{$errors->first('h_w_mobile_no')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group {{$errors->has('kids') ? 'has-error' : ''}}">
                        <label class="" for="kids">Write how many boys and girls And who does what? </label>
                        <div class="">
                            <textarea name="kids" id="kids" placeholder="Write below, How many Kids and Who does what...?" rows="5" class="form-control">{{old('kids')}}</textarea>
                        </div>
                        @if ($errors->has('kids'))
                             <span class="help-block">
                                 <strong>{{$errors->first('kids')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('photo') ? 'has-error' : ''}}">
                        <label class="" for="photo">Upload photo<span class="star">*</span> </label>
                        <div class="">
                            <input type="file" onchange="openFile(event)" class="form-control" id="photo" name="photo">
                        </div>
                        @if ($errors->has('photo'))
                             <span class="help-block">
                                 <strong>{{$errors->first('photo')}}</strong>
                             </span>
                         @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <img id="photo_up" width="80px" height="90px" src="">
                    </div>
                </div>

            </div>

            <hr>

            <div class="">
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">Sasve</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add Family Information information -->

        </form>
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
    </script>
    @if($errors->any())
    <script type="text/javascript">
        document.getElementById('gender').value="{{old('gender')}}";
        document.getElementById('designation_id').value="{{old('designation_id')}}";
        document.getElementById('type').value="{{old('type')}}";
        document.getElementById('group_id').value="{{old('group_id')}}";
        document.getElementById('blood_group').value="{{old('blood_group')}}";
        document.getElementById('religion').value="{{old('religion')}}";
    </script>
    @endif
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
    <script src="{{asset('backEnd/js/appsJs/addTeacher.js')}}"></script>
@endsection
