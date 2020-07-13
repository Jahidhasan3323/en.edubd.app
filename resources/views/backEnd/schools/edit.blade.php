@extends('backEnd.master')

@section('mainTitle', 'Edit School')

@section('active_school', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Institute</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form id="validate" name="validate" action="{{url('/schools/'.$showData->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                            <label class="" for="name">Institute full name <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->name}}" name="name" id="name" placeholder="School's Full Name">
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
                            <label class="" for="total_student">Total Students <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->total_student}}" name="total_student" id="total_student" placeholder="School's Total Studetns">
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
                            <label class="" for="email">Email <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->email}}" type="email" name="email" id="email" placeholder="School's Official Email">
                            </div>

                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
                            <label class="" for="code">Code <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->code}}" type="text" name="code" id="code" placeholder="School's Code">
                            </div>

                            @if($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{$errors->first('code')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
                            <label class="" for="address">Address <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->address}}" type="text" name="address" id="address" placeholder="School's Address">
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
                            <label class="" for="website">Web Address</label>
                            <div class="">
                                <input class="form-control" value="{{$showData->website}}" type="text" name="website" id="website" placeholder="School's Web Address">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                            <label class="" for="mobile">Contact <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{old('mobile',$showData->mobile)}}" type="text" name="mobile" id="mobile" placeholder="School's Official Phone No">
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
                            <label class="" for="fax">Fax</label>
                            <div class="">
                                <input class="form-control" value="{{$showData->fax}}" type="text" name="fax" id="fax" placeholder="School's Fax no">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('established_date') ? 'has-error' : ''}}">
                            <label for="date">Establish Date<span class="star">*</span></label>
                            <div class="">
                                <input class="form-control date" type="text" value="{{$showData->established_date}}" name="established_date">
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
                            <label for="expiry_date">Expiry Date<span class="star">*</span></label>
                            <div class="">
                                <input class="form-control date" value="{{$showData->expiry_date}}" type="text" name="expiry_date" id="expiry_date">
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
                        <div class="form-group {{$errors->has('api_key') ? 'has-error' : ''}}">
                            <label for="api_key">API Key</label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->api_key}}" name="api_key" id="api_key">
                            </div>

                            @if($errors->has('api_key'))
                                <span class="help-block">
                                    <strong>{{$errors->first('api_key')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('sender_id') ? 'has-error' : ''}}">
                            <label for="sender_id">SMS Sender ID </label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->sender_id}}" name="sender_id" id="sender_id">
                            </div>

                            @if($errors->has('sender_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('sender_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('country_code') ? 'has-error' : ''}}">
                            <label class="" for="country_code">Country Code<span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->country_code}}" type="text" name="country_code" id="country_code" placeholder="School's country_code">
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
                            <label class="" for="serial_no">Serial <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->serial_no}}" type="text" name="serial_no" id="serial_no" placeholder="School's serial_no">
                            </div>

                            @if($errors->has('serial_no'))
                                <span class="help-block">
                                    <strong>{{$errors->first('serial_no')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('oc_user_name') ? 'has-error' : ''}}">
                            <label class="" for="oc_user_name">Online conferance user name <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->oc_user_name}}" type="text" name="oc_user_name" id="oc_user_name" placeholder="Online conferance user name">
                            </div>

                            @if($errors->has('oc_user_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('oc_user_name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('oc_user_password') ? 'has-error' : ''}}">
                            <label class="" for="oc_user_password">Online conferance user password <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->oc_user_password}}" type="text" name="oc_user_password" id="oc_user_password" placeholder="Online conferance user password">
                            </div>

                            @if($errors->has('oc_user_password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('oc_user_password')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="online_class_access">Online conferance access <span class="star">*</span></label>
                            <select class="form-control" id="online_class_access" name="online_class_access">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('attend_percentage_limit') ? 'has-error' : ''}}">
                            <label for="attend_percentage_limit">Present limit for send auto SMS (%) (%) </label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->attend_percentage_limit}}" name="attend_percentage_limit" id="attend_percentage_limit">
                            </div>

                            @if($errors->has('attend_percentage_limit'))
                                <span class="help-block">
                                    <strong>{{$errors->first('attend_percentage_limit')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('school_type_id') ? 'has-error' : ''}}">
                            <label for="school_type_id">Select institute type<span class="star">*</span></label>
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="sms_service">Service type<span class="star">*</span></label>
                            <select class="form-control" id="sms_service" name="sms_service">
                                <option selected value="{{ $showData->sms_service }}">
                                    @if ($showData->sms_service==1) Automatic
                                    @elseif($showData->sms_service==0) Manually
                                    @elseif($showData->sms_service==2) Disable SMS Service
                                    @endif
                                </option>
                                <option value="1">অটোমেটিক</option>
                                <option value="0">ম্যানুয়ালি</option>
                                <option value="2">Disable SMS Service</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="attendance_sms">Automatic Attendance SMS Service<span class="star">*</span></label>
                            <select class="form-control" id="attendance_sms" name="attendance_sms">
                                <option selected value="{{ $showData->attendance_sms }}">
                                    @if ($showData->attendance_sms==0) Stop SMS
                                    @elseif ($showData->attendance_sms==1) Employee SMS
                                    @elseif ($showData->attendance_sms==2)  Student SMS
                                    @elseif ($showData->attendance_sms==3)  Employee & Student SMS
                                    @endif
                                </option>
                                <option value="0">Stop SMS</option>
                                <option value="1">Employee SMS</option>
                                <option value="2">Student SMS</option>
                                <option value="3">Employee & Student SMS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="status">Status <span class="star">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('service_type_id') ? 'has-error' : ''}}">
                            <label for="service_type_id">Service type<span class="star">*</span></label>
                            <select name="service_type_id" id="service_type_id" class="form-control">
                                <option value="">Select service type</option>
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
                <hr>

                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('logo') ? 'has-error' : ''}}">
                            <label for="logo">Institute Logo </label>
                            <input type="file" name="logo" onchange="openFile(event)" accept="image/*">

                            @if($errors->has('logo'))
                                <span class="help-block">
                                    <strong>{{$errors->first('logo')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('signature_p') ? 'has-error' : ''}}">
                            <label for="signature_p">Principal Signature</label>
                            <input type="file" name="signature_p" onchange="openFile1(event)" accept="image/*">

                            @if($errors->has('signature_p'))
                                <span class="help-block">
                                    <strong>{{$errors->first('signature_p')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-6">
                       <div>
                           <img id="logo_up" width="100px" height="120px" src="{{Storage::url($showData->logo)}}">
                       </div>
                    </div>
                    <div class="col-sm-6">
                           <div>
                               <img id="signature_up" width="100px" height="40px" src="{{Storage::url($showData->signature_p)}}">
                           </div>
                    </div>
                </div>


                <div class="row" style="display: none">
                    <div class="col-sm-12">
                        <input name="group" type="text" value="2">
                    </div>
                </div>

                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">Uodate</button>
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
        var output = document.getElementById('logo_up');
        output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
        };

        var openFile1 = function(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
        var dataURL = reader.result;
        var output = document.getElementById('signature_up');
        output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
        };

</script>
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
    <script src="{{asset('backEnd/js/appsJs/editSchool.js')}}"></script>
    <script>
        var schoolType = {!!json_encode($school_type_ids)!!};
        document.forms['validate'].elements['status'].value="{{old('service_type_id',$showData->status)}}";
        var multipleValues = $( "#school_type_id" ).val(schoolType);
        document.forms['validate'].elements['service_type_id'].value="{{old('service_type_id',$showData->service_type_id)}}";
        document.getElementById('online_class_access').value={{$showData->online_class_access}};
    </script>
@endsection
