@extends('backEnd.master')

@section('mainTitle', 'Your Profile ')
{{--@section('active_school', 'active')--}}
@section('style')
    <style>
        th{
            max-width: 100px;
        }
    </style>
@endsection
@section('changePassword')
    <a href="{{url('/changePassword')}}" class="btn btn-danger square-btn-adjust">Change Password</a>
@endsection
@section('profile')
    <a href="{{url('/editSchoolProfile')}}" class="btn btn-danger square-btn-adjust">Edit Profile</a>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <p class="text-center"><img class="img-circle img-responsive img-thumbnail" src="{{Storage::url($showData->logo)}}" width="200px"></p>
        </div>

        <div class="panel-body" style="margin: auto auto; width: 90%">
            <table class="table table-responsive table-bordered table-hover">
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Start Date</th>
                    <td>{{date('d-m-Y h:i:s A',strtotime($showData->created_at))}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Serial</th>
                    <td>{{$showData->serial_no}}</td>
                </tr>

                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Code</th>
                    <td>{{$showData->code}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Institute Name</th>
                    <td>{{$showData->name}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Short Name</th>
                    <td>{{$showData->short_name}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">পInstitute Type</th><td>
                    @foreach($school_types as $school_type)
                    {!!'>>> '.$school_type->type.'<br>'!!}
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Country Code</th>
                    <td>{{$showData->country_code}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Email </th>
                    <td>{{$showData->email}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Phone Number</th>
                    <td>{{$showData->mobile}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">API Key</th>
                    <td>{{$showData->api_key}}</td></tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">SMS Sender ID</th>
                    <td>{{$showData->sender_id}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Address</th>
                    <td>{{$showData->address}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Fax</th>
                    <td>{{$showData->fax}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Web Address</th>
                    <td>{{$showData->website}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Establish Date</th>
                    <td>{{$showData->established_date}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Total Students</th>
                    <td>{{$showData->total_student}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Status</th>
                    <td>{{$showData->status ? 'Enable' : 'Disable'}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Expiry Date</th>
                    <td>{{$showData->expiry_date}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">Principal Signature</th>
                    <td><img src="{{Storage::url($showData->signature_p)}}"></td>
                </tr>
            </table>
        </div>

    </div>
@endsection
