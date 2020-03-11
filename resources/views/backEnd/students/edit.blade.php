
@extends('backEnd.master')

@section('mainTitle', 'Edit Student')
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
               <form name="edit_form" class="validate" action="{{url('/students/'.$studentData->id)}}" method="post" enctype="multipart/form-data">
                   {{csrf_field()}}
                   {{method_field('PATCH')}}
   <div class="row">
       <div class="col-sm-12 text-center">
           <h3>Edit academic information</h3>
          <hr> 
       </div>
   </div>
                    
                   <div class="row">
                       <div class="col-sm-6">
                           <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                               <label class="" for="name">Student Name <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$studentData->user->name}}" class="form-control" type="text" name="name" id="name" placeholder="Student Full Name">
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
                                       <option value="">Select Gender</option>
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
                           <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                               <label class="" for="master_class_id">Class <span class="star">*</span></label>
                               <div class="">
                                   <select class="form-control" name="master_class_id" id="master_class_id">
                                       <option value="">Select Class</option>
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
                               <label class="" for="shift">Shift <span class="star">*</span></label>
                               <div class="">
                                   <select class="form-control" name="shift" id="shift">
                                       <option value="">Select Shift</option>
                                       <option value="Morning">Morning</option>
                                       <option value="Day">Day</option>
                                       <option value="Evening">Evening</option>
                                       <option value="Night">Night</option>
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
                               <label class="" for="section">Section <span class="star">*</span></label>
                               <div class="">
                                   <select class="form-control" name="section" id="section">
                                       <option value="">...Select Section...</option>
                                       <option value="A">A</option>
                                       <option value="B">B</option>
                                       <option value="C">C</option>
                                       <option value="D">D</option>
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
                               <label class="" for="group">Group/Division<span class="star">*</span></label>
                               <div class="">
                                   <select class="form-control" name="group" id="group">
                                       <option value="">Select Group/Division</option>
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
                               <label for="roll">Class Roll No. <span class="star">*</span></label>
                               <div>
                                   <input value="{{$studentData->roll}}" type="text" class="form-control" name="roll" id="roll" placeholder="Student Class Roll">
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
                               <label for="session">Session</label>
                               <div>
                                   <input value="{{$studentData->session}}" type="text" class="form-control" name="session" id="session">
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
                     <div class="col-sm-12">
                         <div class="form-group {{$errors->has('regularity') ? 'has-error' : ''}}">
                             <label class="" for="regularity">Student Type <span class="star">*</span></label>
                             <div class="">
                                 <select class="form-control" name="regularity" id="regularity">
                                    <option value="">Select Student Type</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Irregular">Irregular</option>
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
           <h3>Edit Personal Information</h3>
          <hr> 
       </div>
   </div>

                   <div class="row">
                       <div class="col-sm-6">
                           <div class="form-group {{$errors->has('birthday') ? 'has-error' : ''}}">
                               <label for="birthday">Birth Day <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$studentData->birthday}}" class="form-control date" type="text" name="birthday" id="birthday" placeholder="Birth Day">
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
                            <label class="" for="blood_group">Blood Group</label>
                            <div class="">
                                <select class="form-control" name="blood_group" id="blood_group">
                                    <option value="">Select Blood Group</option>
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
                               <label class="" for="email">Email <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$studentData->user->email}}" class="form-control" type="email" name="email" id="email" placeholder="Student Email">
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
                               <label class="" for="password">Password </label>
                               <div class="">
                                   <input class="form-control" type="password" name="password" value="{{old('password')}}" id="password" placeholder="Student Password">
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
                               <label class="" for="religion">Religion <span class="star">*</span></label>
                               <div class="">
                                   <select class="form-control" name="religion" id="religion">
                                       <option value="">Select Religion</option>
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
                       <div class="col-sm-6">
                           <div class="form-group {{$errors->has('birth_rg_no') ? 'has-error' : ''}}">
                               <label class="" for="birth_rg_no">Birth Registration Number <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$studentData->birth_rg_no}}" class="form-control" type="text" name="birth_rg_no" id="birth_rg_no" placeholder="Student Birth Registration No">
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
                               <label class="" for="mobile">Mobile No. </label>
                               <div class="">
                                   <input value="{{$studentData->user->mobile}}" class="form-control" type="text" name="mobile" id="mobile" placeholder="Student Contact">
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
                               <label class="" for="last_sd_org"> Name and address of the latest study institution </label>
                               <div class="">
                                   <input value="{{$studentData->last_sd_org}}" class="form-control" type="text" name="last_sd_org" id="last_sd_org" placeholder="The Latest Study Organization of Student">
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
                               <label class="" for="re_to_lve"> Reason for leaving </label>
                               <div class="">
                                   <input value="{{$studentData->re_to_lve}}" class="form-control" type="text" name="re_to_lve" id="re_to_lve" placeholder="Reason to leave">
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
           <h3>Edit Current Address</h3>
          <hr>
       </div>
   </div>

         
                   <div class="row">
                       <div class="col-sm-4">
                           <div class="form-group {{$errors->has('pre_address') ? 'has-error' : ''}}">
                               <label for="pre_address">Home </label>
                               <div>
                                   <input value="{{$studentData->pre_address}}" type="text" class="form-control" name="pre_address" id="pre_address" placeholder="Student present address">
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
                               <label for="Pre_h_no">House / Holding No.</label>
                               <div>
                                   <input value="{{$studentData->Pre_h_no}}" type="text" class="form-control" name="Pre_h_no" id="Pre_h_no" placeholder="Student House / Holding Number">
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
                               <label for="pre_ro_no">Road No.</label>
                               <div>
                                   <input value="{{$studentData->pre_ro_no}}" type="text" class="form-control" name="pre_ro_no" id="pre_ro_no" placeholder="Student Road Number">
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
                               <label for="pre_vpm">Name of Village / Para / Mahalla Area<span class="star">*</span></label>
                               <div>
                                   <input value="{{$studentData->pre_vpm}}" type="text" class="form-control" name="pre_vpm" id="pre_vpm" placeholder="Student Village / Para / Mahalla">
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
                               <label for="pre_poff">Post Office<span class="star">*</span></label>
                               <div>
                                   <input value="{{$studentData->pre_poff}}" type="text" class="form-control" name="pre_poff" id="pre_poff" placeholder="Student Post office">
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
                               <label for="pre_unim">Name of Union / Municipality <span class="star">*</span></label>
                               <div>
                                   <input value="{{$studentData->pre_unim}}" type="text" class="form-control" name="pre_unim" id="pre_unim" placeholder="Student Union / Municipality">
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
                                   <input value="{{$studentData->pre_subd}}" type="text" class="form-control" name="pre_subd" id="pre_subd" placeholder="Student Sub District / Thana">
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
                               <label for="pre_district">District <span class="star">*</span></label>
                               <div>
                                   <input value="{{$studentData->pre_district}}" type="text" class="form-control" name="pre_district" id="pre_district" placeholder="Student District">
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
                               <label for="pre_postc">Post Code No. </label>
                               <div>
                                   <input value="{{$studentData->pre_postc}}" type="text" class="form-control" name="pre_postc" id="pre_postc" placeholder="Student Post Code">
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
           <h3>Edit Parmanent Address</h3>
          <hr> <hr>
       </div>
   </div>

                   <div class="row">
                       <div class="col-sm-4">
                           <div class="form-group {{$errors->has('per_address') ? 'has-error' : ''}}">
                               <label for="per_address">Home </label>
                               <div>
                                   <input value="{{$studentData->per_address}}" type="text" class="form-control" name="per_address" id="per_address" placeholder="Student persent address">
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
                               <label for="per_h_no">House / Holding No.</label>
                               <div>
                                   <input value="{{$studentData->per_h_no}}" type="text" class="form-control" name="per_h_no" id="per_h_no" placeholder="Student House / Holding Number">
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
                               <label for="per_ro_no">Road No.</label>
                               <div>
                                   <input value="{{$studentData->per_ro_no}}" type="text" class="form-control" name="per_ro_no" id="per_ro_no" placeholder="Student Road Number">
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
                               <label for="per_vpm">Name of Village / Para / Mahalla Area</label>
                               <div>
                                   <input value="{{$studentData->per_vpm}}" type="text" class="form-control" name="per_vpm" id="per_vpm" placeholder="Student Village / Para / Mahalla">
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
                               <label for="per_poff">Post Office</label>
                               <div>
                                   <input value="{{$studentData->per_poff}}" type="text" class="form-control" name="per_poff" id="per_poff" placeholder="Student Post office">
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
                               <label for="per_unim">Name of Union / Municipality </label>
                               <div>
                                   <input value="{{$studentData->per_unim}}" type="text" class="form-control" name="per_unim" id="per_unim" placeholder="Student Union / Municipality">
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
                                   <input value="{{$studentData->per_subd}}" type="text" class="form-control" name="per_subd" id="per_subd" placeholder="Student Sub District / Thana">
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
                               <label for="per_district">District </label>
                               <div>
                                   <input value="{{$studentData->per_district}}" type="text" class="form-control" name="per_district" id="per_district" placeholder="Student District">
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
                               <label for="per_postc">Post Code No. </label>
                               <div>
                                   <input value="{{$studentData->per_postc}}" type="text" class="form-control" name="per_postc" id="per_postc" placeholder="Student Post Code">
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
           <h3>Add Parent Information</h3>
          <hr> 
       </div>
   </div>
            <!-- father information -->       
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="form-group {{$errors->has('father_name') ? 'has-error' : ''}}">
                               <label class="" for="father_name">Father's Name <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$studentData->father_name}}" class="form-control" type="text" name="father_name" id="father_name" placeholder="Student Fater name">
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
                                <label class="" for="f_career">Career <span class="star">*</span></label>
                                <div class="">
                                    <input value="{{$studentData->f_career}}" class="form-control" type="text" name="f_career" id="f_career" placeholder="Student Father Career">
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
                                    <input value="{{$studentData->f_m_income}}" class="form-control" type="text" name="f_m_income" id="f_m_income" placeholder="Father Monthly Income">
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
                                    <input value="{{$studentData->f_edu_c}}" class="form-control" type="text" name="f_edu_c" id="f_edu_c" placeholder="Father Educational Qualification">
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
                                <label class="" for="f_mobile_no">Mobile No.</label>
                                <div class="">
                                    <input value="{{$studentData->f_mobile_no}}" class="form-control" type="text" name="f_mobile_no" id="f_mobile_no" placeholder=" Father Mobile">
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
                                    <input value="{{$studentData->f_email}}" class="form-control" type="text" name="f_email" id="f_email" placeholder="Father Email">
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
                                <label class="" for="f_nid">National ID / Passport / Driving license number </label>
                                <div class="">
                                    <input value="{{$studentData->f_nid}}" class="form-control" type="text" name="f_nid" id="f_nid" placeholder="Student Fater NID/Passport/Driving Number">
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
                               <label class="" for="mother_name">Mother Name <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$studentData->mother_name}}" class="form-control" type="text" name="mother_name" id="mother_name" placeholder="Student Mother Name">
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
                               <label class="" for="m_career">Career <span class="star">*</span></label>
                               <div class="">
                                   <input value="{{$studentData->m_career}}" class="form-control" type="text" name="m_career" id="m_career" placeholder="Mother Career">
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
                                   <input value="{{$studentData->m_m_income}}" class="form-control" type="text" name="m_m_income" id="m_m_income" placeholder="Mother Monthly Income">
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
                               <label class="" for="m_edu_quali">Educational Qualification</label>
                               <div class="">
                                   <input value="{{$studentData->m_edu_quali}}" class="form-control" type="text" name="m_edu_quali" id="m_edu_quali" placeholder="Educational Qualification">
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
                               <label class="" for="m_mobile_no">Mobile No. </label>
                               <div class="">
                                   <input value="{{$studentData->m_mobile_no}}" class="form-control" type="text" name="m_mobile_no" id="m_mobile_no" placeholder=" Father Mobile">
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
                                   <input value="{{$studentData->m_email}}" class="form-control" type="text" name="m_email" id="m_email" placeholder="Father Email">
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
                               <label class="" for="m_nid">National ID / Passport / Driving license number </label>
                               <div class="">
                                   <input value="{{$studentData->m_nid}}" class="form-control" type="text" name="m_nid" id="m_nid" placeholder="Student Mother NID/Passport/Driving Number">
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
                              <label class="" for="local_gar">The name of the local parent in the absence of the parent </label>
                              <div class="">
                                  <input value="{{$studentData->local_gar}}" class="form-control" type="text" name="local_gar" id="local_gar" placeholder="Student Mother Name">
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
                              <label class="" for="career">Career </label>
                              <div class="">
                                  <input value="{{$studentData->career}}" class="form-control" type="text" name="career" id="career" placeholder="Guardian Career">
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
                              <label class="" for="relation">Relation</label>
                              <div class="">
                                  <input value="{{$studentData->relation}}" class="form-control" type="text" name="relation" id="relation" placeholder="Relation With Student">
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
                              <label class="" for="guardian_edu">Educational Qualification </label>
                              <div class="">
                                  <input value="{{$studentData->guardian_edu}}" class="form-control" type="text" name="guardian_edu" id="guardian_edu Educational Qualification" placeholder="Guardian Educational Qualification">
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
                              <label class="" for="guardian_mobile">Mobile No. </label>
                              <div class="">
                                  <input value="{{$studentData->guardian_mobile}}" class="form-control" type="text" name="guardian_mobile" id="guardian_mobile" placeholder="Guardian Mobile">
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
                              <label class="" for="guardian_email">Email </label>
                              <div class="">
                                  <input value="{{$studentData->guardian_email}}" class="form-control" type="text" name="guardian_email" id="guardian_email" placeholder="Guardian email">
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
                              <label class="" for="guardian_nid">National ID / Passport / Driving license number </label>
                              <div class="">
                                  <input value="{{$studentData->guardian_nid}}" class="form-control" type="text" name="guardian_nid" id="guardian_nid" placeholder="Student National ID / Passport / Driving License">
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
                               <label for="photo">Student Photo</label>
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
                               <label for="f_photo">Father's Photo</label>
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
                               <label for="m_photo">Mother's Photo</label>
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
                              <img id="photo_up" width="100px" height="120px" src="{{Storage::url($studentData->photo)}}">
                          </div>
                       </div>
                       <div class="col-sm-4">
                              <div>
                                  <img id="f_photo_up" width="100px" height="120px" src="{{Storage::url($studentData->f_photo)}}">
                              </div>
                       </div>
                       <div class="col-sm-4">
                              <div>
                                  <img id="m_photo_up" width="100px" height="120px" src="{{Storage::url($studentData->m_photo)}}">
                              </div>
                       </div>
                   </div>
                    <hr>

           <div class="">
               <div class="row">
                   <div class="col-sm-2 col-sm-offset-5">
                       <div class="form-group">
                           <button id="submit_btn" readonly="" type="submit" class="btn btn-block btn-info">Update</button>
                       </div>
                   </div>
               </div>
           </div>           
                   
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
    <script type="text/javascript">
        document.getElementById('gender').value="{{$studentData->gender}}";
        document.getElementById('shift').value="{{$studentData->shift}}";
        document.getElementById('master_class_id').value="{{$studentData->master_class_id}}";
         document.getElementById('section').value="{{$studentData->section}}";
         document.getElementById('group').value="{{$studentData->group}}";
         document.getElementById('blood_group').value="{{$studentData->blood_group}}";
         document.getElementById('religion').value="{{$studentData->religion}}";
         document.getElementById('regularity').value="{{$studentData->regularity}}";
    </script>
@endsection