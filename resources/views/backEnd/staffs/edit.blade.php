@extends('backEnd.master')

@section('mainTitle', 'Edit Teacher')
@section('active_teacher', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

<br>
        <div class="panel-body">
            <form name="edit_form" class="validate" action="{{url('/staff/'.$staff->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('patch')}}

       
        <!-- Edit academic information -->
        <div class="page-header">
            <h1 class="text-center text-temp">একাডেমিক তথ্য সম্পাদন করুন</h1>
        </div>
        <div class="panel-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">পুরো নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$staff->user->name}}" class="form-control" type="text" name="name" id="name" placeholder="Teacher Full Name">
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
                                    <option value="">লিংগ নির্বাচন</option>
                                    <option value="ছেলে">ছেলে</option>
                                    <option value="মেয়ে">মেয়ে</option>
                                    <option value="অন্যান্য">অন্যান্য</option>
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
                            <label class="" for="designation_id">পদবি <span class="star">*</span></label>
                            <div class="">
                                <select name="designation_id" id="designation_id" class="form-control">
                                    <option value="">... পদবি নির্বাচন করুন ...</option>
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
                            <label class="" for="type">কাজের ধরন <span class="star">*</span></label>
                            <div class="">
                                <select name="type" id="type" class="form-control">
                                    <option value="">টাইপ নির্বাচন করুন</option>
                                    <option value="ফুল টাইম">ফুল টাইম</option>
                                    <option value="পার্ট টাইম">পার্ট টাইম</option>
                                    <option value="কন্ট্রাক্টওয়াল">কন্ট্রাক্টওয়াল</option>
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
                            <label class="" for="salary">মাসিক বেতন </label>
                            <div class="">
                                <input value="{{$staff->salary}}" class="form-control" type="text" name="salary" id="salary" placeholder="Monthly Salary">
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
                            <label class="" for="subject">যে কাজের জন্য নিয়োগ পেয়েছেন<span class="star">*</span></label>
                            <div class="">
                                <input value="{{$staff->subject}}" class="form-control" type="text" name="subject" id="subject" placeholder="Specialist Subject">
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
                            <label class="" for="edu_qulif">শিক্ষাগত যোগ্যতা <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$staff->edu_qulif}}" class="form-control" type="text" name="edu_qulif" id="edu_qulif" placeholder="Educational Qualification">
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
                            <label class="" for="training">প্রশিক্ষণ </label>
                            <div class="">
                                <input value="{{$staff->training}}" class="form-control" type="text" name="training" id="training" placeholder="Special training">
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
                            <label for="joining_date">যোগদানের তারিখ<span class="star">*</span></label>
                            <div class="">
                                <input value="{{$staff->joining_date}}" class="form-control date" type="text" name="joining_date" id="date">
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
                            <label for="retirement_date">অবসরের তারিখ</label>
                            <div class="">
                                <input value="{{$staff->retirement_date}}" class="form-control date" type="text" name="retirement_date" id="date">
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
                            <label for="index_no">ইনডেক্স নং </label>
                            <div class="">
                                <input value="{{$staff->index_no}}" class="form-control" type="text" name="index_no" id="index_no" placeholder="Index Number">
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
                            <label for="date_of_mpo">এমপিও ভূক্তির তারিখ</label>
                            <div class="">
                                <input value="{{$staff->date_of_mpo}}" class="form-control date" type="text" name="date_of_mpo" id="date">
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
                        <div class="form-group {{$errors->has('group_id') ? 'has-error' : ''}}">
                            <label class="" for="group_id">স্টাফ অ্যাক্সেস <span class="star">*</span></label>
                            <select class="form-control" id="group_id" name="group_id">
                                <option value="">অ্যাক্সেস নির্বাচন করুন</option>
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
            
        </div>
        <!-- Edit academic information -->






        <!-- Edit Personal information -->
        <div class="page-header">
            <h1 class="text-center text-temp">ব্যক্তিগত তথ্য সম্পাদন করুন</h1>
        </div>
        <div class="panel-body">
            

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label class="" for="email">ইমেইল <span class="star">*</span></label>
                        <div class="">
                            <input value="{{$staff->user->email}}" class="form-control" type="email" name="email" id="email" placeholder="Teacher Email">
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
                        <label class="control-label" for="password">পাসওয়ার্ড <span class="star">*</span></label>
                        <div class="">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Teacher Password">
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
                        <label class="" for="mobile">মোবাইল নাম্বার <span class="star">*</span></label>
                        <div class="">
                            <input value="{{$staff->user->mobile}}" class="form-control" type="text" name="mobile" id="mobile" placeholder="Teacher Contact">
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
                        <label for="birthday">জন্ম তারিখ <span class="star">*</span></label>
                        <div class="">
                            <input value="{{$staff->birthday}}" class="form-control date" type="text" name="birthday" id="birthday">
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
                        <label for="blood_group">রক্তের গ্রুপ </label>
                        <div class="">
                            <select class="form-control" name="blood_group" id="blood_group">
                                <option value="">...রক্ত গ্রুপ নির্বাচন করুন...</option>
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
                        <label for="religion">ধর্ম <span class="star">*</span></label>
                        <div class="">
                            <select class="form-control" name="religion" id="religion">
                                <option value="">...ধর্ম নির্বাচন করুন...</option>
                                <option value="ইসলাম">ইসলাম</option>
                                <option value="হিন্দুধর্ম">হিন্দুধর্ম</option>
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

                
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('nid_card_no') ? 'has-error' : ''}}">
                        <label for="nid_card_no">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর <span class="star">*</span></label>
                        <div class="">
                            <input value="{{$staff->nid_card_no}}" class="form-control" type="text" name="nid_card_no" id="nid_card_no" placeholder="National ID / Passport / Driving License Number">
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
                        <label for="last_org_name">সর্বশেষ সার্ভিস প্রতিষ্ঠানের নাম  </label>
                        <div class="">
                            <input value="{{$staff->last_org_name}}" class="form-control" type="text" name="last_org_name" id="last_org_name" placeholder="Name of Organization of Last Service ">
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
                        <label for="reason_to_leave">ছেড়ে আসার কারন </label>
                        <div class="">
                            <input value="{{$staff->reason_to_leave}}" class="form-control" type="text" name="reason_to_leave" id="reason_to_leave" placeholder="National ID / Passport / Driving License Number">
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
                        <label for="last_org_address">প্রতিষ্ঠানের ঠিকানা (ফোন নাম্বার সহ) </label>
                        <div class="">
                            <input value="{{$staff->last_org_address}}" class="form-control" type="text" name="last_org_address" id="last_org_address" placeholder="Name of Organization of Last Service ">
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
        <!-- Edit Personal information -->



        <!-- Edit present address information -->
        <div class="page-header">
            <h1 class="text-center text-temp">বর্তমান ঠিকানা সম্পাদন করুন</h1>
        </div>
        <div class="panel-body">
           <div class="row">
               <div class="col-sm-4">
                   <div class="form-group {{$errors->has('pre_address') ? 'has-error' : ''}}">
                       <label for="pre_address">বাড়ির নাম </label>
                       <div>
                           <input value="{{$staff->pre_address}}" type="text" class="form-control" name="pre_address" id="pre_address" placeholder="Student present address">
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
                       <label for="Pre_h_no">বাড়ি / হোল্ডিং নাম্বার</label>
                       <div>
                           <input value="{{$staff->Pre_h_no}}" type="text" class="form-control" name="Pre_h_no" id="Pre_h_no" placeholder="Student House / Holding Number">
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
                       <label for="pre_ro_no">রোড নাম্বার</label>
                       <div>
                           <input value="{{$staff->pre_ro_no}}" type="text" class="form-control" name="pre_ro_no" id="pre_ro_no" placeholder="Student Road Number">
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
                       <label for="pre_vpm">গ্রাম / পাড়া / মহল্লার নাম <span class="star">*</span></label>
                       <div>
                           <input value="{{$staff->pre_vpm}}" type="text" class="form-control" name="pre_vpm" id="pre_vpm" placeholder="Student Village / Para / Mahalla">
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
                       <label for="pre_poff">ডাকঘর <span class="star">*</span></label>
                       <div>
                           <input value="{{$staff->pre_poff}}" type="text" class="form-control" name="pre_poff" id="pre_poff" placeholder="Student Post office">
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
                       <label for="pre_unim">ইউনিয়ন / পৌরসভার নাম <span class="star">*</span></label>
                       <div>
                           <input value="{{$staff->pre_unim}}" type="text" class="form-control" name="pre_unim" id="pre_unim" placeholder="Student Union / Municipality">
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
                       <label for="pre_subd">উপজেলা / থানার নাম <span class="star">*</span></label>
                       <div>
                           <input value="{{$staff->pre_subd}}" type="text" class="form-control" name="pre_subd" id="pre_subd" placeholder="Student Sub District / Thana">
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
                           <input value="{{$staff->pre_district}}" type="text" class="form-control" name="pre_district" id="pre_district" placeholder="Student District">
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
                       <label for="pre_postc">পোষ্ট কোড নাম্বার</label>
                       <div>
                           <input value="{{$staff->pre_postc}}" type="text" class="form-control" name="pre_postc" id="pre_postc" placeholder="Student Post Code">
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
        <!-- Edit present address information -->



        <!-- Edit Permanent Address information -->
        <div class="page-header">
            <h1 class="text-center text-temp">স্থায়ী ঠিকানা সম্পাদন করুন</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group {{$errors->has('per_address') ? 'has-error' : ''}}">
                        <label for="per_address">বাড়ির নাম </label>
                        <div>
                            <input value="{{$staff->per_address}}" type="text" class="form-control" name="per_address" id="per_address" placeholder="Student persent address">
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
                        <label for="per_h_no">বাড়ি / হোল্ডিং নাম্বার</label>
                        <div>
                            <input value="{{$staff->per_h_no}}" type="text" class="form-control" name="per_h_no" id="per_h_no" placeholder="Student House / Holding Number">
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
                        <label for="per_ro_no">রোড নাম্বার</label>
                        <div>
                            <input value="{{$staff->per_ro_no}}" type="text" class="form-control" name="per_ro_no" id="per_ro_no" placeholder="Student Road Number">
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
                        <label for="per_vpm">গ্রাম / পাড়া / মহল্লার নাম </label>
                        <div>
                            <input value="{{$staff->per_vpm}}" type="text" class="form-control" name="per_vpm" id="per_vpm" placeholder="Student Village / Para / Mahalla">
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
                        <label for="per_poff">ডাকঘর </label>
                        <div>
                            <input value="{{$staff->per_poff}}" type="text" class="form-control" name="per_poff" id="per_poff" placeholder="Student Post office">
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
                        <label for="per_unim">ইউনিয়ন / পৌরসভার নাম </label>
                        <div>
                            <input value="{{$staff->per_unim}}" type="text" class="form-control" name="per_unim" id="per_unim" placeholder="Student Union / Municipality">
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
                        <label for="per_subd">উপজেলা / থানার নাম </label>
                        <div>
                            <input value="{{$staff->per_subd}}" type="text" class="form-control" name="per_subd" id="per_subd" placeholder="Student Sub District / Thana">
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
                            <input value="{{$staff->per_district}}" type="text" class="form-control" name="per_district" id="per_district" placeholder="Student District">
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
                        <label for="per_postc">পোষ্ট কোড নাম্বার</label>
                        <div>
                            <input value="{{$staff->per_postc}}" type="text" class="form-control" name="per_postc" id="per_postc" placeholder="Student Post Code">
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
        <!-- Edit Permanent Address information -->



        <!-- Edit Family Information information -->
        <div class="page-header">
            <h1 class="text-center text-temp">পারিবারিক তথ্য সম্পাদন করুন</h1>
        </div>
        <div class="panel-body">
            <!-- father information -->       
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="form-group {{$errors->has('father_name') ? 'has-error' : ''}}">
                               <label class="" for="father_name">পিতার নাম <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$staff->father_name}}" class="form-control" type="text" name="father_name" id="father_name" placeholder="Student Fater name">
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
                                    <input value="{{$staff->f_career}}" class="form-control" type="text" name="f_career" id="f_career" placeholder="Student Father Career">
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
                                    <input value="{{$staff->f_m_income}}" class="form-control" type="text" name="f_m_income" id="f_m_income" placeholder="Father Monthly Income">
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
                                    <input value="{{$staff->f_edu_c}}" class="form-control" type="text" name="f_edu_c" id="f_edu_c" placeholder="Father Educational Qualification">
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
                                <label class="" for="f_mobile_no">ফোন নাম্বার</label>
                                <div class="">
                                    <input value="{{$staff->f_mobile_no}}" class="form-control" type="text" name="f_mobile_no" id="f_mobile_no" placeholder=" Father Mobile No.">
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
                                <label class="" for="f_email">ইমেইল</label>
                                <div class="">
                                    <input value="{{$staff->f_email}}" class="form-control" type="text" name="f_email" id="f_email" placeholder="Father Email">
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
                                <label class="" for="f_nid">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর </label>
                                <div class="">
                                    <input value="{{$staff->f_nid}}" class="form-control" type="text" name="f_nid" id="f_nid" placeholder="Student Fater NID/Passport/Driving Number">
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
                                   <input value="{{$staff->mother_name}}" class="form-control" type="text" name="mother_name" id="mother_name" placeholder="Student Mother Name">
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
                                   <input value="{{$staff->m_career}}" class="form-control" type="text" name="m_career" id="m_career" placeholder="Mother Career">
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
                                   <input value="{{$staff->m_m_income}}" class="form-control" type="text" name="m_m_income" id="m_m_income" placeholder="Mother Monthly Income">
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
                               <label class="" for="m_edu_c">শিক্ষাগত যোগ্যতা</label>
                               <div class="">
                                   <input value="{{$staff->m_edu_c}}" class="form-control" type="text" name="m_edu_c" id="m_edu_c" placeholder="Relation with guardian">
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
                               <label class="" for="m_mobile_no">ফোন নাম্বার </label>
                               <div class="">
                                   <input value="{{$staff->m_mobile_no}}" class="form-control" type="text" name="m_mobile_no" id="m_mobile_no" placeholder=" Mother Mobile No.">
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
                               <label class="" for="m_email">ইমেইল</label>
                               <div class="">
                                   <input value="{{$staff->m_email}}" class="form-control" type="text" name="m_email" id="m_email" placeholder="Father Email">
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
                               <label class="" for="m_nid">জাতীয় পরিচয় পত্র নাম্বার / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর </label>
                               <div class="">
                                   <input value="{{$staff->m_nid}}" class="form-control" type="text" name="m_nid" id="m_nid" placeholder="Student Mother NID/Passport/Driving Number">
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
                        <label class="" for="h_w_name">বিবাহিতদের ক্ষেত্রে স্বামী/স্ত্রী'র নাম </label>
                        <div class="">
                            <input value="{{$staff->h_w_name}}" class="form-control" type="text" name="h_w_name" id="h_w_name" placeholder="Name of Husband / Wife in case of Married">
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
                        <label class="" for="profession">পেশা</label>
                        <div class="">
                            <input value="{{$staff->profession}}" class="form-control" type="text" name="profession" id="profession" placeholder="Profession">
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
                        <label class="" for="wedding_date">বিবাহের তারিখ </label>
                        <div class="">
                            <input value="{{$staff->wedding_date}}" class="form-control" type="text" name="wedding_date" id="date">
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
                        <label class="" for="h_w_edu_qulif">শিক্ষাগত যোগ্যতা</label>
                        <div class="">
                            <input value="{{$staff->h_w_edu_qulif}}" class="form-control" type="text" name="h_w_edu_qulif" id="h_w_edu_qulif" placeholder="Educational Qualification">
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
                        <label class="" for="h_w_email">জাতীয় পরিচয় পত্র নাম্বার / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর </label>
                        <div class="">
                            <input value="{{old('h_w_nid_no',$staff->h_w_nid_no)}}" class="form-control" type="text" name="h_w_nid_no" id="h_w_nid_no" placeholder="National ID Number">
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
                        <label class="" for="h_w_mobile_no">মোবাইল নাম্বার</label>
                        <div class="">
                            <input value="{{$staff->h_w_mobile_no}}" class="form-control" type="text" name="h_w_mobile_no" id="h_w_mobile_no" placeholder="Mobile Number">
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
                        <label class="" for="kids">ছেলে ও মেয়ে কতজন এবং কে কি করে লিখুন </label>
                        <div class="">
                            <textarea name="kids" id="kids" placeholder="Write below, How many Kids and Who does what..??" rows="5" class="form-control">{{$staff->kids}}</textarea>
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
                        <label class="" for="photo">ছবি আপলোড </label>
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
                        <img id="photo_up" width="80px" height="90px" src="{{Storage::url($staff->photo)}}">
                    </div>
                </div>
                
            </div>

            <hr>

            <div class="">
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">হালনাগাদ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Family Information information -->

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
    <script type="text/javascript">
        document.getElementById('gender').value="{{$staff->gender}}";
        document.getElementById('designation_id').value="{{$staff->designation_id}}";
        document.getElementById('type').value="{{$staff->type}}";
        document.getElementById('group_id').value="{{$staff->user->group_id}}";
        document.getElementById('blood_group').value="{{$staff->blood_group}}";
        document.getElementById('religion').value="{{$staff->religion}}";
    </script>
@endsection
