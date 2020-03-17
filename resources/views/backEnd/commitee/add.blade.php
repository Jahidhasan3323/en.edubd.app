@extends('backEnd.master')

@section('mainTitle', 'Add Commitee')
@section('active_commitee', 'active')
@section('style')
<style type="text/css">
    .form-group {
    margin-bottom: 0;
}
</style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Academic Information</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form id="validate" name="validate" action="{{url('/commitee')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">Full Name <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" class="form-control" type="text" name="name" id="name" placeholder="Commitee Full Name">
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
                    <!--  -->
                    <input type="text" name="group_id" id="group_id" value="6" style="display: none">
                    <input type="text" name="school_id" id="school_id" value="{{$school->id}}" style="display: none">

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('edu_quali') ? 'has-error' : ''}}">
                            <label class="" for="edu_quali">Educational Qualification <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('edu_quali')}}" class="form-control" type="text" name="edu_quali" id="edu_quali" placeholder="Commitee Full Name">
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
                                <select class="form-control" name="designation_id" id="designation_id">
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
                                <input value="{{old('join_date')}}" class="form-control date" type="text" name="join_date" id="date">
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
                                <input value="{{old('retire_date')}}" class="form-control date" type="text" name="retire_date" id="retire_date">
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
                                <input value="{{old('birth_date')}}" class="form-control date" type="text" name="birth_date" id="birth_date">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 {{$errors->has('blood') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="blood">Blood Group</label>
                            <div class="">
                                <select class="form-control" name="blood" id="blood" >
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
                                <input value="{{old('mobile')}}" class="form-control" type="text" name="mobile" id="mobile" placeholder="Mobile Number">
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
                                <select class="form-control" name="religion" id="religion" >
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
                            <label class="" for="email">Email  <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('email',rand(4, 999999999).'@gmail.com')}}" class="form-control" type="email" name="email" id="email" placeholder="Commitee Email">
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
                                <input value="{{ rand(10, 999999999) }}" class="form-control" type="text" name="password" id="password" placeholder="Teacher Password">
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
                                <input value="{{old('nid')}}" class="form-control" type="text" name="nid" id="nid" placeholder="Commitee National ID Number">
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
                            <label for="">House Name :</label>
                            <div class="">
                                <input type="text" value="{{old('home_name')}}" name="home_name" class="form-control" placeholder="Home name..." id="home_name">
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
                                <input type="text" value="{{old('holding_name')}}" name="holding_name" class="form-control" placeholder="Home name..." id="holding_name">
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
                                <input type="text" value="{{old('road_name')}}" name="road_name" class="form-control" placeholder="Home name..." id="road_name">
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
                            <label for="">Village/Para/Moholla : <font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="text" value="{{old('village')}}" name="village" class="form-control" placeholder="Village name..." id="village">
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
                                <input type="text" value="{{old('post_office')}}" name="post_office" class="form-control" placeholder="Postoffice name..." id="post_office">
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
                            <label for="">Union / Municipility <font color="red" size="4">*</font></label>
                            <div class="">
                                <input type="text" value="{{old('unione')}}" name="unione" class="form-control" placeholder="Unione name..." id="unione">
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
                                <input type="text" value="{{old('thana')}}" name="thana" class="form-control" placeholder="Thana name..." id="thana">
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
                                <input type="text" value="{{old('district')}}" name="district" class="form-control" placeholder="Postoffice name..." id="district">
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
                                <input type="text" value="{{old('post_code')}}" name="post_code" class="form-control" placeholder="Unione name..." id="post_code">
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
                            <input type="file" name="image" accept="image/*">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{$errors->first('image')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>

                 <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
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
    @if($errors->any())
    <script type="text/javascript">
        document.getElementById("designation").value="{{old('designation')}}";
        document.getElementById("religion").value="{{old('religion')}}";
        document.getElementById("gender").value="{{old('gender')}}";
        document.getElementById("blood").value="{{old('blood')}}";
    </script>
    @endif
@endsection
