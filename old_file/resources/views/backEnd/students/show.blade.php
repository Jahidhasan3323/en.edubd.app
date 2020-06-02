@extends('backEnd.master')

@section('mainTitle', 'Student Details')
@section('active_student', 'active')
@section('style')
<style>
    th{
        max-width: 120px;
    }
</style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <table class="table">
                <tr class="text-center">
                    <td>
                        <img class="img-responsive img-thumbnail" src="{{Storage::url($student->photo ? $student->photo : '')}}" width="200px" alt="Student Photo">
                        <p>Student: {{$student->user->name}}</p>
                    </td>
                    <td>
                        <img class="img-responsive img-thumbnail" src="{{Storage::url($student->f_photo ? $student->f_photo : '')}}" width="200px" alt="Father Photo">
                        <p>Father: {{$student->father_name}}</p>
                    </td>
                    <td>
                        <img class="img-responsive img-thumbnail" src="{{Storage::url($student->m_photo ? $student->m_photo : '')}}" width="200px" alt="Mother Photo">
                        <p>Mother: {{$student->mother_name}}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="panel-body" style="margin: auto auto; width: 100%">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h3>Academic Information</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">Student's Name</th>
                            <td>{{$student->user->name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Gender</th>
                            <td>{{$student->gender}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Class</th>
                            <td>{{$student->masterClass->name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Shift </th>
                            <td>{{$student->shift}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Section </th>
                            <td>{{$student->section}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Group/Division</th>
                            <td>{{$student->group}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Class Roll No. </th>
                            <td>{{$student->roll}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Student's ID No. </th>
                            <td>{{$student->student_id}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Date of Admission </th>
                            <td>{{$student->created_at->format('D-m-Y')}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Session</th>
                            <td>{{$student->session}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Student Type </th>
                            <td>{{$student->regularity}}</td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            


            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>Personal Information </h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">Birth Day</th>
                            <td>{{$student->birthday}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Blood Group</th>
                            <td>{{$student->blood_group}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">E-Mail </th>
                            <td>{{$student->user->email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Religion </th>
                            <td>{{$student->religion}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Birth Registration Number </th>
                            <td>{{$student->birth_rg_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Mobile No.</th>
                            <td>{{$student->user->mobile}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Name and Address of the latest study institution</th>
                            <td>{{$student->last_sd_org}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Reason for Leaving</th>
                            <td>{{$student->re_to_lve}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            
           

            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="text-center">
                    <h3>Current Address</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">Home Name</th>
                            <td>{{$student->pre_address}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">House / Holding Number</th>
                            <td>{{$student->Pre_h_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Road Number</th>
                            <td>{{$student->pre_ro_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Name of Village / Para / Mahalla Area</th>
                            <td>{{$student->pre_vpm}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Post Office </th>
                            <td>{{$student->pre_poff}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Name of Union / Municipality </th>
                            <td>{{$student->pre_unim}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Name of the Upazila / Police Station </th>
                            <td>{{$student->pre_subd}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">District Name </th>
                            <td>{{$student->pre_district}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Post Code No. </th>
                            <td>{{$student->pre_postc}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>Permanent Address </h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">Home Name</th>
                            <td>{{$student->per_address}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">House / Holding Number</th>
                            <td>{{$student->per_h_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Road Number</th>
                            <td>{{$student->per_ro_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Name of Village / Para / Mahalla Area </th>
                            <td>{{$student->per_vpm}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Post Office </th>
                            <td>{{$student->per_poff}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Name of Union / Municipality </th>
                            <td>{{$student->per_unim}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Name of the Upazila / Police Station </th>
                            <td>{{$student->per_subd}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">District Name </th>
                            <td>{{$student->per_district}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Post Code No. </th>
                            <td>{{$student->per_postc}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>Parent Information</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">Father's Name</th>
                            <td>{{$student->father_name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Career </th>
                            <td>{{$student->f_career}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Monthly Income</th>
                            <td>{{$student->f_m_income}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Educational Qualification</th>
                            <td>{{$student->f_edu_c}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Mobile No.</th>
                            <td>{{$student->f_mobile_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">E-Mail</th>
                            <td>{{$student->f_email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">National ID / Passport / Driving license number 
                            </th>
                            <td>{{$student->f_nid}}</td>
                        </tr>
                        <tr><th colspan="2"><hr></th></tr>
                        <tr>
                            <th style="width:50%">Mother's Name</th>
                            <td>{{$student->mother_name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Career </th>
                            <td>{{$student->m_career}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Monthly Income</th>
                            <td>{{$student->m_m_income}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Educational Qualification</th>
                            <td>{{$student->m_edu_quali}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Mobile No.</th>
                            <td>{{$student->m_mobile_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">E-Mail</th>
                            <td>{{$student->m_email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">National ID / Passport / Driving license number 
                            </th>
                            <td>{{$student->m_nid}}</td>
                        </tr>
                        <tr><th colspan="2"><hr></th></tr>
                        <tr>
                            <th style="width:50%">The name of the local parent in the absence of the parent</th>
                            <td>{{$student->local_gar}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Career </th>
                            <td>{{$student->career}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">সম্পর্ক</th>
                            <td>{{$student->relation}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Educational Qualification</th>
                            <td>{{$student->guardian_edu}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Mobile No.</th>
                            <td>{{$student->guardian_mobile}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">E-Mail</th>
                            <td>{{$student->guardian_email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">National ID / Passport / Driving license number </th>
                            <td>{{$student->guardian_nid}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            

        </div>

    </div>
@endsection