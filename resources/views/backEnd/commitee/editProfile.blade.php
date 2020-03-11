@extends('backEnd.master')

@section('mainTitle', 'Edit Commitee')
@section('active_commitee', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">কমিটির প্রোফাইল সম্পাদনা করুন</h1>
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
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <label class="" for="email">ইমেইল <span class="star">*</span></label>
                            <div class="">
                                <input value="{{$commiteeData->user->email}}" class="form-control" type="email" name="email" id="email" placeholder="Teacher Email">
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
<script type="text/javascript">
    document.getElementById("designation").value="{{$commiteeData->designation}}";
    document.getElementById("religion").value="{{$commiteeData->religion}}";
    document.getElementById("gender").value="{{$commiteeData->gender}}";
    document.getElementById("blood").value="{{$commiteeData->blood}}";
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
