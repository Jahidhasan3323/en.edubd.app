@extends('backEnd.master')

@section('mainTitle', 'Student Details')
@section('online_admission', 'active')
@section('style')
<style>
    th{
        max-width: 120px;
    }
</style>
@endsection
@section('content')
<?php
    
?>
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <table class="table">
                <tr class="text-center">
                    <td>
                        <img class="img-responsive img-thumbnail" src="{{Storage::url($student->picture ? $student->picture : '')}}" width="200px" alt="Student Photo">
                        <p>ছাত্র: {{$student->name_bn}}</p>
                    </td>
                    <td>
                        <img class="img-responsive img-thumbnail" src="{{Storage::url($student->signature ? $student->signature : '')}}" width="200px" alt="Father Photo">
                        <p>স্বাক্ষর: {{$student->father_name}}</p>
                    </td>
                    
                </tr>
            </table>
        </div>

        <div class="panel-body" style="margin: auto auto; width: 100%">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h3>ব্যক্তিগত তথ্য</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%"> নাম</th>
                            <td>{{$student->name_bn}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> নাম ইংরেজি</th>
                            <td>{{$student->name_en}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">পিতার নাম</th>
                            <td>{{$student->father_name_bn}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> পিতার নাম ইংরেজি</th>
                            <td>{{$student->father_name_en}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">মাতার নাম</th>
                            <td>{{$student->mother_name_bn}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> মাতার নাম ইংরেজি</th>
                            <td>{{$student->mother_name_en}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জন্ম নিবন্ধন কার্ডের নাম্বার</th>
                            <td>{{$student->birth_certificate_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জন্ম তারিখ</th>
                            <td>{{$student->dob}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">অভিভাবকের বার্ষিক আয়</th>
                            <td>{{$student->parents_income}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">অভিভাবকের মোবাইল নাম্বার</th>
                            <td>{{$student->parents_phone}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ছাত্রের মোবাইল নাম্বার</th>
                            <td>{{$student->phone}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শ্রেণী</th>
                            <td>{{$student->class}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ইমেল </th>
                            <td>{{$student->email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ধর্ম </th>
                            <td>{{$student->religion}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জাতীয়তা</th>
                            <td>{{$student->nationality}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> রেজিস্ট্রেশন নং </th>
                            <td>{{$student->reg_no}}</td>
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
                            <th style="width:50%">গ্রাম </th>
                            <td>{{$student->present_vill}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ডাকঘর </th>
                            <td>{{$student->present_post}}</td>
                        </tr>
                        
                        <tr>
                            <th style="width:50%">উপ জেলা / থানা নাম </th>
                            <td>{{$student->present_upozila}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জেলার নাম </th>
                            <td>{{$student->present_zila}}</td>
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
                            <th style="width:50%">গ্রাম </th>
                            <td>{{$student->parmanent_vill}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">ডাকঘর </th>
                            <td>{{$student->parmanent_post}}</td>
                        </tr>
                        
                        <tr>
                            <th style="width:50%">উপ জেলা / থানা নাম </th>
                            <td>{{$student->parmanent_upozila}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জেলার নাম </th>
                            <td>{{$student->parmanent_zila}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>একাডেমিক তথ্য </h3><hr>
                    </div>
                    <div class="table-responsive">
                    @foreach($accademic_info as $row)
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">পরিক্ষার নাম </th>
                            <td>{{$row->exam_name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">বোর্ড </th>
                            <td>{{$row->board}}</td>
                        </tr>
                        
                        <tr>
                            <th style="width:50%">রোল </th>
                            <td>{{$row->roll_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">রেজিস্ট্রেশন নং </th>
                            <td>{{$row->registration_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">শিক্ষা প্রতিষ্ঠানের নাম </th>
                            <td>{{$row->institute}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">পাশের সন  </th>
                            <td>{{$row->passing_year}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">জি.পি.এ </th>
                            <td>{{$row->gpa}}</td>
                        </tr>

                    </table>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>বিষয় </h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:25%">বিষয়  </th>
                            <th style="width:25%">ধরণ </th>
                        </tr>
                    @foreach($subject as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                        
                            <td>{{$row->type==1 ? 'আবশ্যিক' : ($row->type==2 ? 'নির্বাচনিক' :($row->type==3 ? 'ঐচ্ছিক' : '') )}}</td>
                        </tr>
                        
                        

                    @endforeach
                    </table>
                    </div>
                </div>
            </div>
            

            
            

        </div>

    </div>
@endsection