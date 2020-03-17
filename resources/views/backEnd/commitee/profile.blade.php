@extends('backEnd.master')

@section('mainTitle', 'Commitee Details')
{{--@section('active_commitee', 'active')--}}
@section('style')
    <style>
        th{
            max-width: 120px;
        }
        .img-circle{
           width: 150px;
           height: 150px;
        }
    </style>
@endsection

@section('changePassword')
    <a href="{{url('/changePassword')}}" class="btn btn-danger square-btn-adjust">Change Password</a>
@endsection

@section('profile')
    <a href="{{url('/editCommiteeProfile')}}" class="btn btn-danger square-btn-adjust">Edit Profile</a>
@endsection

@section('content')
    <div class="panel col-sm-12">
            <p class="text-center">
                <img class="img-responsive img-thumbnail" src="{{Storage::url($commitee->image ? $commitee->image : '')}}" width="200px" alt="Photo"></p>


        <div class="page-header">
            <h1 class="text-center">Academic Information</h1>
        </div>
        <div class="panel-body">
            <div class=" table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th style="width: 50%">Full Name</th><td colspan="4">{{$commitee->user->name}}</td></tr>
                    <tr><th>Gender</th><td>{{$commitee->gender}}</td></tr>
                    <tr><th>Educational Qualification</th><td>{{$commitee->edu_quali}}</td></tr>
                    <tr><th>Designation</th><td>{{$commitee->designation->name??''}}</td></tr>
                    <tr><th>Join Date</th><td>{{$commitee->join_date}}</td></tr>
                    <tr><th>Retired Date</th><td>{{$commitee->retire_date}}</td></tr>
                </table>
            </div>
        </div>


        <div class="page-header">
            <h1 class="text-center">Personal Information</h1>
        </div>
        <div class="panel-body">
            <div class=" table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th style="width: 50%">Birth Date</th><td colspan="4">{{$commitee->birth_date}}</td></tr>
                    <tr><th>Blood Group</th><td>{{$commitee->blood}}</td></tr>
                    <tr><th>Mobile Number</th><td>{{$commitee->user->mobile}}</td></tr>
                    <tr><th>Religion</th><td>{{$commitee->religion}}</td></tr>
                    <tr><th>Email</th><td>{{$commitee->user->email}}</td></tr>
                    <tr><th>National ID / Passport / Driving Licence</th><td>{{$commitee->nid}}</td></tr>
                </table>
            </div>
        </div>

        <div class="page-header">
            <h1 class="text-center">Present Address</h1>
        </div>
        <div class="panel-body">
            <div class=" table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th style="width: 50%">House name</th><td colspan="4">{{$commitee->home_name}}</td></tr>
                    <tr><th>House/Holding No.</th><td>{{$commitee->holding_name}}</td></tr>
                    <tr><th>Road No.</th><td>{{$commitee->road_name}}</td></tr>
                    <tr><th>Village/Para/Moholla</th><td>{{$commitee->village}}</td></tr>
                    <tr><th>Post Office</th><td>{{$commitee->post_office}}</td></tr>
                    <tr><th>Union/Municipility</th><td>{{$commitee->unione}}</td></tr>
                    <tr><th>Upzilla</th><td>{{$commitee->thana}}</td></tr>
                    <tr><th>Zilla</th><td>{{$commitee->district}}</td></tr>
                    <tr><th>Postal Code</th><td>{{$commitee->post_code}}</td></tr>
                </table>
            </div>
        </div>

    </div>
@endsection
