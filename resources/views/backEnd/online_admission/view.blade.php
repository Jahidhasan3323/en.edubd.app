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
                        <p>Student: {{$student->name_bn}}</p>
                    </td>
                    <td>
                        <img class="img-responsive img-thumbnail" src="{{Storage::url($student->signature ? $student->signature : '')}}" width="200px" alt="Father Photo">
                        <p>Signature: {{$student->father_name}}</p>
                    </td>
                    
                </tr>
            </table>
        </div>

        <div class="panel-body" style="margin: auto auto; width: 100%">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h3>Personal Information</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%"> Name</th>
                            <td>{{$student->name_bn}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> Name English</th>
                            <td>{{$student->name_en}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Father Name</th>
                            <td>{{$student->father_name_bn}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> Father Name English</th>
                            <td>{{$student->father_name_en}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Mother Name</th>
                            <td>{{$student->mother_name_bn}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> Mother Name English</th>
                            <td>{{$student->mother_name_en}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Birth Certificate No</th>
                            <td>{{$student->birth_certificate_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Date of Birth</th>
                            <td>{{$student->dob}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Parents Income</th>
                            <td>{{$student->parents_income}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Parents Phone No</th>
                            <td>{{$student->parents_phone}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Student Phone No</th>
                            <td>{{$student->phone}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Class</th>
                            <td>{{$student->masterClass->name ?? ' '}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Email </th>
                            <td>{{$student->email}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Religion </th>
                            <td>{{$student->religion}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Nationality</th>
                            <td>{{$student->nationality}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%"> Reg No</th>
                            <td>{{$student->reg_no}}</td>
                        </tr>
                        
                    </table>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="text-center">
                    <h3>Present Address</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                       
                        <tr>
                            <th style="width:50%">Village </th>
                            <td>{{$student->present_vill}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Post Office </th>
                            <td>{{$student->present_post}}</td>
                        </tr>
                        
                        <tr>
                            <th style="width:50%">Upozila </th>
                            <td>{{$student->present_upozila}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">District </th>
                            <td>{{$student->present_zila}}</td>
                        </tr>
                        

                    </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>Permanent Address</h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">Village </th>
                            <td>{{$student->parmanent_vill}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Post Office </th>
                            <td>{{$student->parmanent_post}}</td>
                        </tr>
                        
                        <tr>
                            <th style="width:50%">Upozila </th>
                            <td>{{$student->parmanent_upozila}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">District </th>
                            <td>{{$student->parmanent_zila}}</td>
                        </tr>

                    </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                    <h3>Accademic Information </h3><hr>
                    </div>
                    <div class="table-responsive">
                    @foreach($accademic_info as $row)
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:50%">Exam name</th>
                            <td>{{$row->exam_name}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Board </th>
                            <td>{{$row->board}}</td>
                        </tr>
                        
                        <tr>
                            <th style="width:50%">Roll </th>
                            <td>{{$row->roll_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Reg No </th>
                            <td>{{$row->registration_no}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Institute Name </th>
                            <td>{{$row->institute}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Passing Year </th>
                            <td>{{$row->passing_year}}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">GPA</th>
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
                    <h3>Subject </h3><hr>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width:25%">Subject  </th>
                            <th style="width:25%">Type </th>
                        </tr>
                    @foreach($subject as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                        
                            <td>{{$row->type==1 ? 'Compulsory' : ($row->type==2 ? 'Departmental' :($row->type==3 ? 'Optional' : '') )}}</td>
                        </tr>
                        
                        

                    @endforeach
                    </table>
                    </div>
                </div>
            </div>
            

            
            

        </div>

    </div>
@endsection