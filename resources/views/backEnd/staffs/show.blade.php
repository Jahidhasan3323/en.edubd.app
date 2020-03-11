@extends('backEnd.master')

@section('mainTitle', 'Teacher Details')
@section('active_teacher', 'active')
@section('style')
    <style>
        th{
            max-width: 130px;
        }
    </style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

            <p class="text-center"><img class="img-responsive img-thumbnail" src="{{Storage::url($staff->photo ? $staff->photo : '')}}" width="200px" alt="Staff Photo"></p>
        
        <!-- Add Academic Information -->
        <div class="page-header">
            <h3 class="text-center">একাডেমিক তথ্য</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">নাম </th><td>{{$staff->user->name}}</td></tr>
                    <tr><th>লিঙ্গ </th><td>{{$staff->gender}}</td></tr>
                    <tr><th>পদবি </th><td>{{$staff->designation->name}}</td></tr>
                    <tr><th>কাজের ধরন </th><td>{{$staff->type}}</td></tr>
                    <tr><th>মাসিক বেতন </th><td>{{$staff->salary}}</td></tr>
                    <tr><th>যে কাজের জন্য নিয়োগ পেয়েছেন </th><td>{{$staff->subject}}</td></tr>
                    <tr><th>শিক্ষাগত যোগ্যতা </th><td>{{$staff->edu_qulif}}</td></tr>
                    <tr><th>প্রশিক্ষণ </th><td>{{$staff->training}}</td></tr>
                    <tr><th>যোগদানের তারিখ</th><td>{{$staff->joining_date}}</td></tr>
                    <tr><th>অবসরের তারিখ</th><td>{{$staff->retirement_date}}</td></tr>
                    <tr><th>ইনডেক্স নং</th><td>{{$staff->index_no}}</td></tr>
                    <tr><th>এমপিও ভূক্তির তারিখ </th><td>{{$staff->date_of_mpo}}</td></tr>
                    <tr><th>স্টাফ আইডি নং </th><td>{{$staff->staff_id}}</td></tr>
                    <tr><th>স্টাফ অ্যাক্সেস</th><td>{{$staff->user->group->name}}</td></tr>
                </table>
            </div>
        </div>
        <!-- //Add Academic Information -->

        <!-- Add Personal Information -->
        <div class="page-header">
            <h3 class="text-center">ব্যক্তিগত তথ্য</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">ইমেইল </th><td>{{$staff->user->email}}</td></tr>
                    <tr><th>মোবাইল নাম্বার </th><td>{{$staff->user->mobile}}</td></tr>
                    <tr><th>জন্ম তারিখ </th><td>{{$staff->birthday}}</td></tr>
                    <tr><th>রক্তের গ্রুপ </th><td>{{$staff->blood_group}}</td></tr>
                    <tr><th>ধর্ম </th><td>{{$staff->religion}}</td></tr>
                    <tr><th>জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর </th><td>{{$staff->nid_card_no}}</td></tr>
                    <tr><th>সর্বশেষ সার্ভিস প্রতিষ্ঠানের নাম </th><td>{{$staff->  last_org_name}}</td></tr>
                    <tr><th>ছেড়ে আসার কারন  </th><td>{{$staff->reason_to_leave}}</td></tr>
                    <tr><th>প্রতিষ্ঠানের ঠিকানা (ফোন নাম্বার সহ) </th><td>{{$staff->last_org_address}}</td></tr>
                   
                </table>
            </div>
        </div>
        <!-- //Add Personal Information -->

        <!-- Present Address -->
        <div class="page-header">
            <h3 class="text-center">বর্তমান ঠিকানা</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">বাড়ির নাম  </th><td>{{$staff->pre_address}}</td></tr>
                    <tr><th>বাড়ি / হোল্ডিং নাম্বার </th><td>{{$staff->Pre_h_no}}</td></tr>
                    <tr><th>রোড নাম্বার </th><td>{{$staff->pre_ro_no}}</td></tr>
                    <tr><th>গ্রাম / পাড়া / মহল্লার নাম  </th><td>{{$staff->pre_vpm}}</td></tr>
                    <tr><th>ডাকঘর  </th><td>{{$staff->pre_poff}}</td></tr>
                    <tr><th>ইউনিয়ন / পৌরসভার নাম  </th><td>{{$staff->pre_unim}}</td></tr>
                    <tr><th>উপজেলা / থানার নাম </th><td>{{$staff->pre_subd}}</td></tr>
                    <tr><th>জেলার নাম </th><td>{{$staff->pre_district}}</td></tr>
                    <tr><th>পোষ্ট কোড নাম্বার </th><td>{{$staff->pre_postc}}</td></tr>
                   
                </table>
            </div>
        </div>
        <!-- //Present Address -->


        <!-- Permanent Address -->
        <div class="page-header">
            <h3 class="text-center">স্থায়ী ঠিকানা</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">বাড়ির নাম  </th><td>{{$staff->per_address}}</td></tr>
                    <tr><th>বাড়ি / হোল্ডিং নাম্বার </th><td>{{$staff->per_h_no}}</td></tr>
                    <tr><th>রোড নাম্বার </th><td>{{$staff->per_ro_no}}</td></tr>
                    <tr><th>গ্রাম / পাড়া / মহল্লার নাম  </th><td>{{$staff->per_vpm}}</td></tr>
                    <tr><th>ডাকঘর </th><td>{{$staff->per_poff}}</td></tr>
                    <tr><th>ইউনিয়ন / পৌরসভার নাম  </th><td>{{$staff->per_unim}}</td></tr>
                    <tr><th>উপজেলা / থানার নাম </th><td>{{$staff->per_subd}}</td></tr>
                    <tr><th>জেলার নাম </th><td>{{$staff->per_district}}</td></tr>
                    <tr><th>পোষ্ট কোড নাম্বার </th><td>{{$staff->per_postc}}</td></tr>
                   
                </table>
            </div>
        </div>
        <!-- //Permanent Address -->


        <!-- Family Information -->
        <div class="page-header">
            <h3 class="text-center">পারিবারিক তথ্যাবলী</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">পিতার নাম </th><td>{{$staff->father_name}}</td></tr>
                    <tr><th>পেশা </th><td>{{$staff->f_career}}</td></tr>
                    <tr><th>মাসিক আয় </th><td>{{$staff->f_m_income}}</td></tr>
                    <tr><th>শিক্ষাগত যোগ্যতা  </th><td>{{$staff->f_edu_c}}</td></tr>
                    <tr><th>ফোন নাম্বার </th><td>{{$staff->f_mobile_no}}</td></tr>
                    <tr><th>ইমেইল  </th><td>{{$staff->f_email}}</td></tr>
                    <tr><th>জাতীয় পরিচয় পত্র নাম্বার / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর  </th><td>{{$staff->f_nid}}</td></tr>

                </table>
                 <hr>
                <table class="table table-hover table-bordered">

                    <tr><th width="50%">মাতার নাম </th><td>{{$staff->mother_name}}</td></tr>
                    <tr><th>পেশা </th><td>{{$staff->m_career}}</td></tr>
                    <tr><th>মাসিক আয় </th><td>{{$staff->m_m_income}}</td></tr>
                    <tr><th>শিক্ষাগত যোগ্যতা  </th><td>{{$staff->m_edu_c}}</td></tr>
                    <tr><th>ফোন নাম্বার </th><td>{{$staff->m_mobile_no}}</td></tr>
                    <tr><th>ইমেইল  </th><td>{{$staff->m_email}}</td></tr>
                    <tr><th>জাতীয় পরিচয় পত্র নাম্বার / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর  </th><td>{{$staff->m_nid}}</td></tr>

                </table>
                @if($staff->h_w_name)
                 <hr>
                <table class="table table-hover table-bordered">

                    <tr><th width="50%">বিবাহিতদের ক্ষেত্রে স্বামী/স্ত্রী'র নাম </th><td>{{$staff->h_w_name}}</td></tr>
                    <tr><th>পেশা </th><td>{{$staff->profession}}</td></tr>
                    <tr><th>বিবাহের তারিখ </th><td>{{$staff->wedding_date}}</td></tr>
                    <tr><th>শিক্ষাগত যোগ্যতা </th><td>{{$staff->h_w_edu_qulif}}</td></tr>
                    <tr><th>জাতীয় পরিচয় পত্র নাম্বার / পাসপোর্ট / ড্রাইভিং লাইসেন্স নম্বর </th><td>{{$staff->h_w_nid_no}}</td></tr>
                    <tr><th>মোবাইল নাম্বার </th><td>{{$staff->h_w_mobile_no}}</td></tr>
                    <tr><th>ছেলে ও মেয়ে কতজন এবং কে কি করে লিখুন </th><td>{{$staff->kids}}</td></tr>

                </table>
                @endif
            </div>
        </div>
        <!-- //Family Information -->

    </div>
@endsection