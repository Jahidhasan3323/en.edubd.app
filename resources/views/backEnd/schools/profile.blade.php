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
                    <th style="padding-left:10px;width:36%;text-align:right;">শুরুর তারিখ</th>
                    <td>{{date('d-m-Y h:i:s A',strtotime($showData->created_at))}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">ক্রমিক নং</th>
                    <td>{{$showData->serial_no}}</td>
                </tr>
 
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">কোড</th>
                    <td>{{$showData->code}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">প্রতিষ্ঠানের নাম</th>
                    <td>{{$showData->name}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">প্রতিষ্ঠানের সংক্ষিপ্ত নাম</th>
                    <td>{{$showData->short_name}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">প্রতিষ্ঠানের টাইপ</th><td>
                    @foreach($school_types as $school_type)
                    {!!'>>> '.$school_type->type.'<br>'!!}
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">কান্ট্রি কোড</th>
                    <td>{{$showData->country_code}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">ইমেইল </th>
                    <td>{{$showData->email}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">ফোন নম্বর</th>
                    <td>{{$showData->mobile}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">এপিআই কী</th>
                    <td>{{$showData->api_key}}</td></tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">এসএমএস প্রেরক আইডি</th>
                    <td>{{$showData->sender_id}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">ঠিকানা</th>
                    <td>{{$showData->address}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">ফ্যাক্স</th>
                    <td>{{$showData->fax}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">ওয়েব ঠিকানা</th>
                    <td>{{$showData->website}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">প্রতিষ্ঠার তারিখ</th>
                    <td>{{$showData->established_date}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">প্রতিষ্ঠানের মোট ছাত্র</th>
                    <td>{{$showData->total_student}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">অবস্থা</th>
                    <td>{{$showData->status ? 'সক্রিয়' : 'নিষ্ক্রিয়'}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">মেয়াদ শেষ হওয়ার তারিখ</th>
                    <td>{{$showData->expiry_date}}</td>
                </tr>
                <tr>
                    <th style="padding-left:10px;width:36%;text-align:right;">প্রিন্সিপালের স্বাক্ষর</th>
                    <td><img src="{{Storage::url($showData->signature_p)}}"></td>
                </tr>
            </table>
        </div>

    </div>
@endsection