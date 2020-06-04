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
            <h3 class="text-center">Academic Information</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">Full Name </th><td>{{$staff->user->name}}</td></tr>
                    <tr><th>Gender </th><td>{{$staff->gender}}</td></tr>
                    <tr><th>Designation </th><td>{{$staff->designation->name}}</td></tr>
                    <tr><th>Job Type </th><td>{{$staff->type}}</td></tr>
                    <tr><th>Monthly Salary </th><td>{{$staff->salary}}</td></tr>
                    <tr><th>Appointed for that job </th><td>{{$staff->subject}}</td></tr>
                    <tr><th>Educational Qualification </th><td>{{$staff->edu_qulif}}</td></tr>
                    <tr><th>Training </th><td>{{$staff->training}}</td></tr>
                    <tr><th>Joining Date</th><td>{{$staff->joining_date}}</td></tr>
                    <tr><th>Retirement Date</th><td>{{$staff->retirement_date}}</td></tr>
                    <tr><th>Index No.</th><td>{{$staff->index_no}}</td></tr>
                    <tr><th>Date of MPO Registration </th><td>{{$staff->date_of_mpo}}</td></tr>
                    <tr><th>Staff ID No. </th><td>{{$staff->staff_id}}</td></tr>
                    <tr><th>Staff Access</th><td>{{$staff->user->group->name}}</td></tr>
                </table>
            </div>
        </div>
        <!-- //Add Academic Information -->

        <!-- Add Personal Information -->
        <div class="page-header">
            <h3 class="text-center">Personal Information</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">Email </th><td>{{$staff->user->email}}</td></tr>
                    <tr><th>Mobile number </th><td>{{$staff->user->mobile}}</td></tr>
                    <tr><th>Date of Birth </th><td>{{$staff->birthday}}</td></tr>
                    <tr><th>Blood Group </th><td>{{$staff->type}}</td></tr>
                    <tr><th>Religion </th><td>{{$staff->religion}}</td></tr>
                    <tr><th>National ID / Passport / Driving License Number </th><td>{{$staff->nid_card_no}}</td></tr>
                    <tr><th>Name of the last service organization </th><td>{{$staff->  last_org_name}}</td></tr>
                    <tr><th>Reason for leaving  </th><td>{{$staff->reason_to_leave}}</td></tr>
                    <tr><th>Company address (with phone number) </th><td>{{$staff->last_org_address}}</td></tr>

                </table>
            </div>
        </div>
        <!-- //Add Personal Information -->

        <!-- Present Address -->
        <div class="page-header">
            <h3 class="text-center">Current Address</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">House name  </th><td>{{$staff->pre_address}}</td></tr>
                    <tr><th>Home / Holding number </th><td>{{$staff->Pre_h_no}}</td></tr>
                    <tr><th>Road number </th><td>{{$staff->pre_ro_no}}</td></tr>
                    <tr><th>Name of village / Para / Mahalla  </th><td>{{$staff->pre_vpm}}</td></tr>
                    <tr><th>Post office  </th><td>{{$staff->pre_poff}}</td></tr>
                    <tr><th>Name of union / municipality  </th><td>{{$staff->pre_unim}}</td></tr>
                    <tr><th>Name of the Upazila / Police Station </th><td>{{$staff->pre_subd}}</td></tr>
                    <tr><th>District name </th><td>{{$staff->pre_district}}</td></tr>
                    <tr><th>The postal code number </th><td>{{$staff->pre_postc}}</td></tr>

                </table>
            </div>
        </div>
        <!-- //Present Address -->


        <!-- Permanent Address -->
        <div class="page-header">
            <h3 class="text-center">Permanent Address</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">House name  </th><td>{{$staff->per_address}}</td></tr>
                    <tr><th>Home / Holding number </th><td>{{$staff->per_h_no}}</td></tr>
                    <tr><th>Road number </th><td>{{$staff->per_ro_no}}</td></tr>
                    <tr><th>Name of village / Para / Mahalla  </th><td>{{$staff->per_vpm}}</td></tr>
                    <tr><th>Post office </th><td>{{$staff->per_poff}}</td></tr>
                    <tr><th>Name of union / municipality  </th><td>{{$staff->per_unim}}</td></tr>
                    <tr><th>Name of the Upazila / Police Station </th><td>{{$staff->per_subd}}</td></tr>
                    <tr><th>District name </th><td>{{$staff->per_district}}</td></tr>
                    <tr><th>The postal code number </th><td>{{$staff->per_postc}}</td></tr>

                </table>
            </div>
        </div>
        <!-- //Permanent Address -->


        <!-- Family Information -->
        <div class="page-header">
            <h3 class="text-center">Family Information</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr><th width="50%">Father's Name </th><td>{{$staff->father_name}}</td></tr>
                    <tr><th>Profession </th><td>{{$staff->f_career}}</td></tr>
                    <tr><th>Monthly Income </th><td>{{$staff->f_m_income}}</td></tr>
                    <tr><th>Educational Qualification  </th><td>{{$staff->f_edu_c}}</td></tr>
                    <tr><th>Phone Number </th><td>{{$staff->f_mobile_no}}</td></tr>
                    <tr><th>Email </th><td>{{$staff->f_email}}</td></tr>
                    <tr><th>National ID / Passport / Driving License Number  </th><td>{{$staff->f_nid}}</td></tr>

                </table>
                 <hr>
                <table class="table table-hover table-bordered">

                    <tr><th width="50%">Mothers's Name </th><td>{{$staff->mother_name}}</td></tr>
                    <tr><th>Profession </th><td>{{$staff->m_career}}</td></tr>
                    <tr><th>Monthly Income </th><td>{{$staff->m_m_income}}</td></tr>
                    <tr><th>Educational Qualification  </th><td>{{$staff->m_edu_c}}</td></tr>
                    <tr><th>Phone Number </th><td>{{$staff->m_mobile_no}}</td></tr>
                    <tr><th>Email </th><td>{{$staff->m_email}}</td></tr>
                    <tr><th>National ID / Passport / Driving License Number  </th><td>{{$staff->m_nid}}</td></tr>

                </table>
                @if($staff->h_w_name)
                 <hr>
                <table class="table table-hover table-bordered">

                    <tr><th width="50%">Name of husband / wife in case of married </th><td>{{$staff->h_w_name}}</td></tr>
                    <tr><th>Profession </th><td>{{$staff->profession}}</td></tr>
                    <tr><th>Marriage date </th><td>{{$staff->wedding_date}}</td></tr>
                    <tr><th>Educational Qualification </th><td>{{$staff->h_w_edu_qulif}}</td></tr>
                    <tr><th>Email </th><td>{{$staff->h_w_email}}</td></tr>
                    <tr><th>Mobile Number </th><td>{{$staff->h_w_mobile_no}}</td></tr>
                    <tr><th>Write how many boys and girls And who does what? </th><td>{{$staff->kids}}</td></tr>

                </table>
                @endif
            </div>
        </div>
        <!-- //Family Information -->

    </div>
@endsection
