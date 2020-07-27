@extends('backEnd.master')

@section('mainTitle', 'Institute Based Daily SMS Report')
@section('active_sms_login_info', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Institute Based Daily SMS Report</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <div class="table-responsive">
                <table id="report_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Serial</th>
                            <th class="text-center">Institute</th>
                            <th class="text-center">Email / Domain</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Today SMS</th>
                            <th class="text-center">SMS Rate</th>
                            <th class="text-center">Today SMS Cost </th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    <tbody>
                        @foreach($daily_sms_reports as $daily_sms_report)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-left">{{ $daily_sms_report['name'] }}</td>
                                <td class="text-left">
                                    {{ $daily_sms_report['email']??$daily_sms_report['domain'] }}
                                </td>
                                <td class="text-left">{{ $daily_sms_report['mobile'] }}</td>
                                <td class="text-center">
                                    {{ ceil($daily_sms_report['cost']/$daily_sms_report['sms_rate']) }}
                                </td>
                                <td class="text-center">
                                    {{ number_format( $daily_sms_report['sms_rate'],2) }} ৳
                                </td>
                                <td class="text-center">
                                    {{ number_format($daily_sms_report['cost'],2) }} ৳
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
            $('#report_tbl').DataTable();
        } );
    </script>
@endsection
