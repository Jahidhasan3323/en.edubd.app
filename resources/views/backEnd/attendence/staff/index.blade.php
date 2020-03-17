@extends('backEnd.master')

@section('mainTitle', 'Attendance Management')
@section('active_attendance', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Employee Attendance</h1>
            <h3 class="text-center text-temp">
             Total Employee : {{$total_employees}} ,
             Total Present : {{$employees->total_present()}} ,
             Total Holiday : {{$employees->total_leave()+$employees->total_holiday()}} ,
             Total Absent : {{$total_employees-$employees->total_present()-$employees->total_leave()-$employees->total_holiday()}}
            </h3>
        </div>
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Designation</th>
                        <th>Employee</th>
                        <th>Present</th>
                        <th>Holiday</th>
                        <th>Absent</th>
                        <th>Action</th>
                    </tr>
                    @php $serial = Get::serial($employees) @endphp
                    @foreach($employees as $employee)
                    @php
                        $query=[
                        'group_id'=>$employee->group_id
                        ];
                        $group_wise_employees=$employees->total_employees($query);
                        $total_leave=$employees->total($query,'L');
                        $total_absent=$employees->total($query,'A');
                        $total_present=$employees->total($query,'P');
                        $total_holiday=$employees->total($query,'H');
                    @endphp
                        <tr>
                            <td>{{str_replace($s, $r,$serial)}}</td>
                            <td>{{($employee->group_id==3)?'Teacher':'Staff'}}</td>
                            <td>{{str_replace($s, $r,$group_wise_employees)}}</td>
                            <td>{{str_replace($s, $r,$total_present)}}</td>
                            <td>{{str_replace($s, $r,$total_leave+$total_holiday)}}</td>
                            <td>{{str_replace($s, $r,($group_wise_employees - $total_present - $total_leave-$total_holiday))}}</td>
                            <td><a href="{{url('atten_employee/view',[$employee->group_id])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a></td>
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
