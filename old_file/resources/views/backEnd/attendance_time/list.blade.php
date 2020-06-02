@extends('backEnd.master')

@section('mainTitle', 'উপস্থিতি সময়')
@section('active_attendance_text', 'active')

@section('content')
    @if(Session::has('errmgs'))
        @include('backEnd.includes.errors')
    @endif
    @if(Session::has('sccmgs'))
        @include('backEnd.includes.success')
    @endif

    <div class="panel col-md-12" style="border: 1px solid #ddd;">
        <div class="page-header">
            <h1 class="text-center text-temp">উপস্থিতি সময় তালিকা</h1>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table id="attend_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ক্রমিক</th>
                            <th class="text-center">প্রতিষ্ঠান</th>
                            <th class="text-center">উপস্থিত সময়</th>
                            <th class="text-center">ত্যাগের সময়</th>
                            <th class="text-center">অ্যাকশন</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    <tbody>
                        @foreach($times as $time)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $time->school->user->name }}</td>
                                <td>{{ $time->in_time }}</td>
                                <td>{{ $time->out_time }}</td>
                                <td class="text-center">
                                   <a href="{{ route('attendanceTime.edit', $time->id) }}">
                                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </button>
                                   </a>
                                   <a href="{{ route('attendanceTime.delete', $time->id) }}">
                                       <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('আপনি কি সময় মুছে ফেলতে চান ?')"> <i class="fa fa-trash-o"></i> </button>
                                   </a>
                                </td>
                            </tr>
                        @endforeach
                     </tbody>
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
