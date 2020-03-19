@extends('backEnd.master')

@section('mainTitle', 'Attendance SMS Text')
@section('active_attendance_text', 'active')

@section('content')
    @if(Session::has('errmgs'))
        @include('backEnd.includes.errors')
    @endif
    @if(Session::has('sccmgs'))
        @include('backEnd.includes.success')
    @endif

    <div class="panel col-md-12">
        <div class="page-header">
            <h1 class="text-center text-temp">Attendance SMS Text List</h1>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table id="attend_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Serial</th>
                            <th class="text-center">Institute</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($attendances as $attendance)
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $attendance->school->user->name }}</td>
                                <td>{{ $attendance->content }}</td>
                                <td class="text-center">
                                    @if ($attendance->type==1) Present
                                    @elseif ($attendance->type==2) Absent
                                    @elseif ($attendance->type==3) Institute Leave
                                    @endif
                                </td>
                                <td class="text-center">
                                   <a href="{{ route('attendanceText.edit', $attendance->id) }}" style="margin: 1px;">
                                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </button>
                                   </a>
                                   <a href="{{ route('attendanceText.delete', $attendance->id) }}">
                                       <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete ?')"> <i class="fa fa-trash-o"></i> </button>
                                   </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
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
            $('#attend_tbl').DataTable();
        } );
    </script>
@endsection
