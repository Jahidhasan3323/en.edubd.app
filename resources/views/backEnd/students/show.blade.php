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
                        <h3>একাডেমিক তথ্য</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">শিক্ষার্থীর নাম</th>
                            <td>{{$student->user->name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">লিঙ্গ</th>
                            <td>{{$student->gender}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শ্রেণী</th>
                            <td>{{$student->masterClass->name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিফট </th>
                            <td>{{$student->shift}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শাখা </th>
                            <td>{{$student->section}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">গ্রুপ / বিভাগ</th>
                            <td>{{$student->group}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শ্রেণী রোল নং </th>
                            <td>{{$student->roll}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিক্ষার্থীর আইডি নাম্বার </th>
                            <td>{{$student->student_id}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ভর্তির তারিখ </th>
                            <td>{{str_replace($s,$r,$student->created_at->format('D-m-Y'))}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিক্ষাবর্ষ </th>
                            <td>{{$student->session}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিক্ষার্থীর ধরন </th>
                            <td>{{$student->regularity}}</td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            


            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>ব্যক্তিগত তথ্য </h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">জন্ম তারিখ</th>
                            <td>{{$student->birthday}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">রক্তের গ্রুপ</th>
                            <td>{{$student->blood_group}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ইমেইল </th>
                            <td>{{$student->user->email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ধর্ম </th>
                            <td>{{$student->religion}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জন্ম নিবন্ধন নাম্বার </th>
                            <td>{{$student->birth_rg_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">মোবাইল নম্বর </th>
                            <td>{{$student->user->mobile}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">সর্বশেষ অধ্যয়ন প্রতিষ্ঠানের নাম ও ঠিকানা</th>
                            <td>{{$student->last_sd_org}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ছেড়ে আসার কারন</th>
                            <td>{{$student->re_to_lve}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            
           

            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="text-center">
                    <h3>বর্তমান ঠিকানা</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">হোম নাম</th>
                            <td>{{$student->pre_address}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">হাউস / হোল্ডিং নম্বর</th>
                            <td>{{$student->Pre_h_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">রাস্তা নম্বর</th>
                            <td>{{$student->pre_ro_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">গ্রাম / পারা / মহল্লা নাম </th>
                            <td>{{$student->pre_vpm}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ডাকঘর </th>
                            <td>{{$student->pre_poff}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ইউনিয়ন / পৌরসভার নাম </th>
                            <td>{{$student->pre_unim}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">উপ জেলা / থানা নাম </th>
                            <td>{{$student->pre_subd}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জেলার নাম </th>
                            <td>{{$student->pre_district}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">পোস্ট কোড নং </th>
                            <td>{{$student->pre_postc}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>স্থায়ী ঠিকানা </h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">হোম নাম</th>
                            <td>{{$student->per_address}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">হাউস / হোল্ডিং নম্বর</th>
                            <td>{{$student->per_h_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">রাস্তা নম্বর</th>
                            <td>{{$student->per_ro_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">গ্রাম / পারা / মহল্লা নাম </th>
                            <td>{{$student->per_vpm}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ডাকঘর </th>
                            <td>{{$student->per_poff}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ইউনিয়ন / পৌরসভার নাম </th>
                            <td>{{$student->per_unim}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">উপ জেলা / থানা নাম </th>
                            <td>{{$student->per_subd}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জেলার নাম </th>
                            <td>{{$student->per_district}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">পোস্ট কোড নং </th>
                            <td>{{$student->per_postc}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>পিতামাতার তথ্য</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">পিতার নাম</th>
                            <td>{{$student->father_name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">পেশা </th>
                            <td>{{$student->f_career}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">মাসিক আয়</th>
                            <td>{{$student->f_m_income}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিক্ষাগত যোগ্যতা</th>
                            <td>{{$student->f_edu_c}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ফোন নাম্বার</th>
                            <td>{{$student->f_mobile_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ইমেইল</th>
                            <td>{{$student->f_email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্সের নাম্বার 
                            </th>
                            <td>{{$student->f_nid}}</td>
                        </tr>
                        <tr><th colspan="2"><hr></th></tr>
                        <tr>
                            <th style="width:50%">মাতার নাম</th>
                            <td>{{$student->mother_name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">পেশা </th>
                            <td>{{$student->m_career}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">মাসিক আয়</th>
                            <td>{{$student->m_m_income}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিক্ষাগত যোগ্যতা</th>
                            <td>{{$student->m_edu_quali}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ফোন নাম্বার</th>
                            <td>{{$student->m_mobile_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ইমেইল</th>
                            <td>{{$student->m_email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্সের নাম্বার 
                            </th>
                            <td>{{$student->m_nid}}</td>
                        </tr>
                        <tr><th colspan="2"><hr></th></tr>
                        <tr>
                            <th style="width:50%">পিতা / মাতার অবর্তমানে স্থানীয় অভিভাবকের নাম</th>
                            <td>{{$student->local_gar}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">পেশা </th>
                            <td>{{$student->career}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">সম্পর্ক</th>
                            <td>{{$student->relation}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিক্ষাগত যোগ্যতা</th>
                            <td>{{$student->guardian_edu}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ফোন নাম্বার</th>
                            <td>{{$student->guardian_mobile}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ইমেইল</th>
                            <td>{{$student->guardian_email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জাতীয় পরিচয় পত্র / পাসপোর্ট / ড্রাইভিং লাইসেন্সের নাম্বার </th>
                            <td>{{$student->guardian_nid}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            

        </div>

    </div>
@endsection