@extends('backEnd.master')

@section('mainTitle', 'Student Profile Editing')
@section('active_student', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
        <h1 class="text-center text-temp">Edit Profile</h1>
    </div>

    @if(Session::has('errmgs'))
        @include('backEnd.includes.errors')
    @endif
    @if(Session::has('sccmgs'))
        @include('backEnd.includes.success')
    @endif

    <div class="panel-body">
        <form name="edit_form" action="{{url('/students/'.$studentData->id)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label class="" for="email">ই-মেইল <span class="star"></span></label>
                        <div class="">
                            <input class="form-control" value="{{$studentData->user->email}}" type="text" name="email" id="email" placeholder="Student Full Name">
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
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

        document.forms['edit_form'].elements['class_id'].value="{{$studentData->class_id}}"
        document.forms['edit_form'].elements['unit_id'].value="{{$studentData->unit_id}}"
    </script>
@endsection
