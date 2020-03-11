@extends('backEnd.master')

@section('mainTitle', 'উপস্থিতি ব্যাবস্থাপনা')
@section('active_attendance', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">শিক্ষার্থী উপস্থিতি</h1>
        </div>
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <h3 class="text-center text-temp">
             মোট শিক্ষার্থী : {{str_replace($s,$r,$current_students)}} জন,
             মোট উপস্থিতি : {{str_replace($s,$r,$students->total_present())}} জন, 
             মোট ছুটি : {{str_replace($s,$r,$students->total_leave()+$students->total_holiday())}} জন, 
             মোট অনুপস্থিত : {{str_replace($s, $r,$current_students-$students->total_present()-$students->total_leave()-$students->total_holiday())}} জন
            </h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>ক্রমিক নং</th>
                        <th>শ্রেণী</th>
                        <th>বিভাগ</th>
                        <th>শিফট</th>
                        <th>শাখা</th>
                        <th>শিক্ষার্থী</th>
                        <th>উপস্থিত</th>
                        <th>ছুটি</th>
                        <th>অনুপস্থিত</th>
                        <th>অ্যাকশন</th>
                    </tr>
                    @php $serial = Get::serial($students) @endphp
                    @foreach($students as $student)
                        @php
                            $query=[
                            'master_class_id'=> $student->master_class_id,
                            'group'=>$student->group,
                            'shift'=>$student->shift,
                            'section'=>$student->section,
                            ];
                            $total_class_student=$students->total_students($query);
                            $total_present=$students->total($query,'P');
                            $total_leave=$students->total($query,'L');
                            $total_holidays=$students->total($query,'H');
                            $total_absent=$students->total($query,'A');
                        @endphp
                        <tr>
                            <td>{{str_replace($s, $r,$serial)}}</td>
                            <td>{{$student->masterClass->name}}</td>
                            <td>{{$student->group}}</td>
                            <td>{{$student->shift}}</td>
                            <td>{{$student->section}}</td>
                            <td>{{str_replace($s, $r,$total_class_student)}}</td>
                            <td>{{str_replace($s, $r,$total_present)}}</td>
                            <td>{{str_replace($s, $r, ($total_leave+$total_holidays))}}</td>
                            <td>{{str_replace($s, $r, $total_class_student-$total_present-$total_leave-$total_holidays)}}</td>
                            <td><a href="{{url('attendence/view',[$student->master_class_id,$student->group,$student->shift,$student->section])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        </tr>
                        @php($serial++)
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection


