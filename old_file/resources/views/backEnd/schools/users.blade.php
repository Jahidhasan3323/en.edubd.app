@extends('backEnd.master')

@section('mainTitle', 'Manage School Users')
@section('active_school', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রতিষ্ঠান ব্যবহারকারীর  তালিকা</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <table class="table table-bordered table-responsive table-hover table-striped">
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>নাম</th>
                    <th>ব্যবহারকারী</th>
                    <th>মেয়াদ শেষ হওয়ার তারিখ</th>
                    <th>অবস্থা</th>
                </tr>
                @php($serial = Get::serial($schools))
                @foreach($schools as $school)
                    <tr>
                        <td>{{$serial}}</td>
                        <td>{{$school->name}}</td>
                        @php($users=DB::table('students')->where('school_id',$school->id)->get())
                        <td>{{count($users)}}</td>
                        <td>{{$school->expiry_date}}</td>
                        <td>{{($school->status === 1) ? 'সক্রিয়' : 'নিষ্ক্রিয়'}}</td>
                    </tr>
                    @php($serial++)
                @endforeach
            </table>
            <span class="col-sm-2 col-sm-offset-10">{{$schools->links()}}</span>
        </div>
    </div>
@endsection