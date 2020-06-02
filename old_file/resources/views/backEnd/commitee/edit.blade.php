@extends('backEnd.master')

@section('mainTitle', 'Edit Commitee')
@section('active_commitee', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Committee</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form id="validate" name="validate" action="{{url('/commitee/'.$commiteeData->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('patch')}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">Full Name <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$commiteeData->user->name}}" class="form-control" type="text" name="name" id="name">
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
                                <select class="form-control"  name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        @if($errors->has('gender'))
                            <span class="help-block">
                                <strong>{{$errors->first('gender')}}</strong>
                            </span>
                        @endif
                    </div>


                    {{--
                    |.. Authentication Group. 3 for teacher Authentication
                    |.. School id for identify which school for this teacher.
                    --}}


                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('edu_quali') ? 'has-error' : ''}}">
                            <label class="" for="edu_quali"> Educational Qualification <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$commiteeData->edu_quali}}" class="form-control" type="text" name="edu_quali" id="edu_quali">
                            </div>
                            @if ($errors->has('edu_quali'))
                                <span class="help-block">
                                    <strong>{{$errors->first('edu_quali')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 {{$errors->has('designation_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="designation_id">Designation<span class="star">*</span></label>
                            <div class="">
                                <select class="form-control"  name="designation_id" id="designation_id">
                                    <option selected value="{{ $commiteeData->designation->id }}">{{ $commiteeData->designation->name }}</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if($errors->has('designation_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('designation_id')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('join_date') ? 'has-error' : ''}}">
                            <label for="join_date">Join Date<span class="star">*</span></label>
                            <div class="">
                                <input value="{{$commiteeData->join_date}}" class="form-control date" type="text" name="join_date" id="date">
                            </div>
                            @if ($errors->has('join_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('join_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="retire_date">Retired Date</label>
                            <div class="">
                                <input value="{{$commiteeData->retire_date}}" class="form-control date" type="text" name="retire_date" id="retire_date">
                            </div>
                        </div>
                    </div>
                </div>

        <div class="page-header">
            <h3 class="text-center text-temp">Personal Information</h3>
        </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="birth_date">Birth Date<span class="star">*</span></label>
                            <div class="">
                                <input value="{{$commiteeData->birth_date}}" class="form-control date" type="text" name="birth_date" id="birth_date">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 {{$errors->has('blood') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="blood">Blood Group</label>
                            <div class="">
                                <select value="{{$commiteeData->blood}}" class="form-control" name="blood" id="blood" >
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
                        </div>
                        @if($errors->has('blood'))
                            <span class="help-block">
                                <strong>{{$errors->first('blood')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                            <label class="" for="mobile">Mobile Number <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$commiteeData->user->mobile}}" class="form-control" type="number" name="mobile" id="mobile" placeholder="Teacher Contact">
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

                    <div class="col-sm-6 {{$errors->has('religion') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="religion">Religion</label>
                            <div class="">
                                <select value="{{$commiteeData->religion}}" class="form-control" name="religion" id="religion" >
                                    <option value="">Select Religion</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Hinduism">Hinduism</option>
                                    <option value="Christianity">Christianity</option>
                                    <option value="Buddhism">Buddhism</option>
                                    <option value="Jainism">Jainism</option>
                                </select>
                            </div>
                        </div>
                        @if($errors->has('religion'))
                            <span class="help-block">
                                <strong>{{$errors->first('religion')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                 <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <label class="" for="email">Email <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$commiteeData->user->email}}" class="form-control" type="email" name="email" id="email" placeholder="Commitee Email">
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
                                <label class="" for="nid">Password <span class="star">*</span></label>
                                <div class="">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">
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

                    <div class="col-sm-12">
                            <div class="form-group {{$errors->has('nid') ? 'has-error' : ''}}">
                                <label class="" for="nid">National ID / Passport / Driving licence <span class="star">*</span></label>
                                <div class="">
                                    <input value="{{$commiteeData->nid}}" class="form-control" type="text" name="nid" id="nid" placeholder="Commitee National ID Number">
                                </div>
                                @if ($errors->has('nid'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('nid')}}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                 </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">Add Present Address</h3>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('home_name') ? 'has-error' : ''}}">
                            <label for="">House Name</label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->home_name}}" name="home_name" class="form-control" placeholder="Home name..." id="home_name">
                            </div>
                            @if($errors->has('home_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('home_name')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('holding_name') ? 'has-error' : ''}}">
                            <label for="">House/Holding No.</label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->holding_name}}" name="holding_name" class="form-control" placeholder="House/Holding No..." id="holding_name">
                            </div>
                            @if($errors->has('holding_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('holding_name')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('road_name') ? 'has-error' : ''}}">
                            <label for="">Road No.</label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->road_name}}" name="road_name" class="form-control" placeholder="Road No...." id="road_name">
                            </div>
                            @if($errors->has('road_name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('road_name')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('village') ? 'has-error' : ''}}">
                            <label for="">Village/Para/Moholla <font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->village}}" name="village" class="form-control" placeholder="Village name..." id="village">
                            </div>
                            @if($errors->has('village'))
                                <span class="help-block">
                                    <strong>{{$errors->first('village')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('post_office') ? 'has-error' : ''}}">
                            <label for="">Post Office <font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->post_office}}" name="post_office" class="form-control" placeholder="Postoffice name..." id="post_office">
                            </div>
                            @if($errors->has('post_office'))
                                <span class="help-block">
                                    <strong>{{$errors->first('post_office')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('unione') ? 'has-error' : ''}}">
                            <label for="">Union / Municipility<font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->unione}}" name="unione" class="form-control" placeholder="Unione name..." id="unione">
                            </div>
                            @if($errors->has('unione'))
                                <span class="help-block">
                                    <strong>{{$errors->first('unione')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('thana') ? 'has-error' : ''}}">
                            <label for="">Upzilla <font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->thana}}" name="thana" class="form-control" placeholder="Upzilla name..." id="thana">
                            </div>
                            @if($errors->has('thana'))
                                <span class="help-block">
                                    <strong>{{$errors->first('thana')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('district') ? 'has-error' : ''}}">
                            <label for="">Zilla  <font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="text" value="{{$commiteeData->district}}" name="district" class="form-control" placeholder="Zilla name..." id="district">
                            </div>
                            @if($errors->has('district'))
                                <span class="help-block">
                                    <strong>{{$errors->first('district')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('post_code') ? 'has-error' : ''}}">
                            <label for="">Postal Code<font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="number" value="{{$commiteeData->post_code}}" name="post_code" class="form-control" placeholder="Postal Code..." id="post_code">
                            </div>
                            @if($errors->has('post_code'))
                                <span class="help-block">
                                    <strong>{{$errors->first('post_code')}}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                            <label for="image">Upload Photo<font color="red" size="4">*</font></label>
                            <input type="file" name="image" onchange="openFile(event)" accept="image/*">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{$errors->first('image')}}</strong>
                                </span>
                            @endif
                            <img class="img-responsive img-thumbnail" src="{{Storage::url($commiteeData->image ? $commiteeData->image : '')}}" width="90px" height="120px" alt="Image" id="photo_up">
                        </div>
                    </div>
                </div>

                <hr>

                 <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script type="text/javascript">
	document.getElementById("designation_id").value="{{$commiteeData->designation_id}}";
	document.getElementById("religion").value="{{$commiteeData->religion}}";
	document.getElementById("gender").value="{{$commiteeData->gender}}";
	document.getElementById("blood").value="{{$commiteeData->blood}}";
</script>
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
@endsection