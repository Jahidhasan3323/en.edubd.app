@extends('backEnd.master')

@section('mainTitle', 'উপস্থিতি ব্যাবস্থাপনা')
@section('active_attendance', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">শিক্ষার্থী উপস্থিতি</h1>
            <h3 class="text-center text-temp">শ্রেণী : {{$class->name}}, বিভাগ : {{$group}} , শিফট : {{$shift}} ত্ত শাখা : {{$section}}</h3>
        </div>
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <div class="table-responsive">
                <table id="attendance_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>শিক্ষার্থী</th>
                            <th>শিক্ষার্থীর আইডি</th>
                            <th>উপস্থিতি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($serial = Get::serial($attendances))
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{$serial}}</td>
                            <td>{{$attendance->student->user->name}}</td>
                            <td>{{$attendance->student_id}}</td>
                            <td>{{($attendance->status=="L"||$attendance->status=="H")?'ছুটি':($attendance->status=="P"?'উপস্থিত':($attendance->status=="A"?'অনুপস্থিত':''))}}</td>
                            <td><a href="{{url('attendence/details',[$attendance->student_id])}}" class="btn btn-info" title="Details view ...!!!"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        </tr>
                        @php($serial++)
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>শিক্ষার্থী</th>
                            <th>শিক্ষার্থীর আইডি</th>
                            <th>উপস্থিতি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('#attendance_tbl').DataTable();
         });
    </script>
@endsection


