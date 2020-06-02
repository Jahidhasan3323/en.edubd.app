@extends('backEnd.master')

@section('mainTitle', 'Edit Your Profile')

{{--@section('active_school', 'active')--}}
@section('passwordReset')
    <a href="{{url('/SchoolPasswordReset')}}" class="btn btn-danger square-btn-adjust">Password Reset</a>
@endsection
@section('profile')
    <a href="{{url('/editSchoolProfile')}}" class="btn btn-danger square-btn-adjust">Edit Profile</a>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">স্কুল সম্পাদনা করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form name="edit_form" action="{{url('/schools/'.$showData->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                            <label class="" for="name">প্রতিষ্ঠানের পুরো নাম <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->name}}" name="name" id="name" placeholder="School's Full Name">
                            </div>

                            @if($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                            @endif
                        </div>
                        <input type="hidden" name="api_key" value="{{$showData->api_key}}">
                        <input type="hidden" name="sender_id" value="{{$showData->sender_id}}">
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('short_name') ? ' has-error' : ''}}">
                            <label class="" for="short_name">সংক্ষিপ্ত নাম </label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->short_name}}" name="short_name" id="short_name" placeholder="School's Short Name">
                            </div>

                            @if($errors->has('short_name'))
                                <span class="help-block">
                                        <strong>{{$errors->first('short_name')}}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('established_date') ? 'has-error' : ''}}">
                            <label for="date">প্রতিষ্ঠার তারিখ <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" type="text" value="{{$showData->established_date}}" name="established_date" id="date">
                            </div>
                            @if($errors->has('established_date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('established_date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <label class="" for="email">ইমেইল <span class="star">*</span></label>
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
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
                            <label class="" for="address">ঠিকানা <span class="star">*</span></label>
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
                        <div class="form-group {{$errors->has('code') ? 'has-error' : ''}}">
                            <label class="" for="code">কোড <span class="star">*</span></label>
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
                        <div class="form-group">
                            <label class="" for="website">ওয়েব ঠিকানা</label>
                            <div class="">
                                <input class="form-control" value="{{$showData->website}}" type="text" name="website" id="website" placeholder="School's Web Address">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                            <label class="" for="mobile">যোগাযোগ <span class="star">*</span></label>
                            <div class="">
                                <input class="form-control" value="{{$showData->mobile}}" type="text" name="mobile" id="mobile" placeholder="School's Official Phone No">
                            </div>

                            @if($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{$errors->first('mobile')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="fax">ফ্যাক্স</label>
                            <div class="">
                                <input class="form-control" value="{{$showData->fax}}" type="text" name="fax" id="fax" placeholder="School's Fax no">
                            </div>
                        </div>
                    </div>
                </div>
                 
                 <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('logo') ? 'has-error' : ''}}">
                            <label for="logo">প্রতিষ্ঠানের প্রতীক </label>
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
                            <label for="signature_p">প্রিন্সিপালের স্বাক্ষর</label>
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
                                <button type="submit" class="btn btn-block btn-info">হালনাগাদ</button>
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
    <script>
        var schoolType = {!!json_encode($school_type_ids)!!};
        document.forms['edit_form'].elements['status'].value="{{$showData->status}}";
        var multipleValues = $( "#school_type_id" ).val(schoolType);
    </script>
@endsection