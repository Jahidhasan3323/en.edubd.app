@extends('backEnd.master')

@section('mainTitle', 'Commitee Details')
@section('active_commitee', 'active')
@section('style')
    <style>
        th{
            max-width: 130px;
        }
    </style>
@endsection
@section('content')
    <div class="panel col-sm-12">
            <p class="text-center">
                <img class="img-responsive img-thumbnail" src="{{Storage::url($commitee->image ? $commitee->image : '')}}" width="200px" alt="Photo"></p>


        <div class="page-header">
            <h1 class="text-center">একাডেমিক তথ্য</h1>
        </div>
        <div class="panel-body">
            <div class=" table-responsive">
                <table class="table table-hover table-bordered">
                   <tr><th style="width: 50%">পুরো নাম</th><td colspan="4">{{$commitee->user->name}}</td></tr>
                    <tr><th>লিঙ্গ</th><td>{{$commitee->gender}}</td></tr>
                    <tr><th>শিক্ষগত যোগ্যতা </th><td>{{$commitee->edu_quali}}</td></tr>
                    <tr><th>কমিটি পদবী</th><td>{{$commitee->designation->name??''}}</td></tr>
                    <tr><th>যোগদানের তারিখ</th><td>{{$commitee->join_date}}</td></tr>
                    <tr><th>অবসরের তারিখ</th><td>{{$commitee->retire_date}}</td></tr>
                </table>
            </div>
        </div>


        <div class="page-header">
            <h1 class="text-center">ব্যক্তিগত তথ্য</h1>
        </div>
        <div class="panel-body">
            <div class=" table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th style="width: 50%">জন্ম তারিখ</th><td colspan="4">{{$commitee->birth_date}}</td></tr>
                    <tr><th>রক্তের গ্রুপ</th><td>{{$commitee->blood}}</td></tr>
                    <tr><th>মোবাইল নম্বর </th><td>{{$commitee->user->mobile}}</td></tr>
                    <tr><th>ধর্ম</th><td>{{$commitee->religion}}</td></tr>
                    <tr><th>ইমেইল</th><td>{{$commitee->user->email}}</td></tr>
                    <tr><th>জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর</th><td>{{$commitee->nid}}</td></tr>
                </table>
            </div>
        </div>

        <div class="page-header">
            <h1 class="text-center">বর্তমান ঠিকানা</h1>
        </div>
        <div class="panel-body">
            <div class=" table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th style="width: 50%">বাড়ির নাম</th><td colspan="4">{{$commitee->home_name}}</td></tr>
                    <tr><th>বাড়ি / হোল্ডিং নাম্বার</th><td>{{$commitee->holding_name}}</td></tr>
                    <tr><th>রোড নাম্বার</th><td>{{$commitee->road_name}}</td></tr>
                    <tr><th>গ্রাম / পাড়া / মহল্লার নাম</th><td>{{$commitee->village}}</td></tr>
                    <tr><th>ডাকঘর</th><td>{{$commitee->post_office}}</td></tr>
                    <tr><th>ইউনিয়ন / পৌরসভার নাম</th><td>{{$commitee->unione}}</td></tr>
                    <tr><th>উপজেলা / থানার নাম</th><td>{{$commitee->thana}}</td></tr>
                    <tr><th>জেলার নাম</th><td>{{$commitee->district}}</td></tr>
                    <tr><th>পোষ্ট কোড নাম্বার</th><td>{{$commitee->post_code}}</td></tr>
                </table>
            </div>
        </div>

    </div>
@endsection
