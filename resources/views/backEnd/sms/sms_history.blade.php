@extends('backEnd.master')

@section('mainTitle', 'Sending SMS history')
@section('active_sms', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">SMS History</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <table id="sms_history" class="table table-bordered table-responsive table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Serial</th>
                        <th class="text-center">Mobile Number</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Cost</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i =1;
                    // dd($sms_history['half_yearly']);
                    @endphp
                    @foreach($sms_history['half_yearly']??[] as $sms)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="auto_width">{{ $sms['phone_number']??'' }}</td>
                            <td class="auto_width">{{ $sms['message']??'' }}</td>
                            <td class="text-center">{{ number_format($sms['cost'],2) }}</td>
                            <td class="text-center">{{ $sms['created_at']?date('d F Y',strtotime($sms['created_at'])):'' }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .table .auto_width{
            max-width: 150px;;
            overflow:scroll;
        }
    </style>
@endsection
@section('script')

    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#sms_history').DataTable();
    });
    </script>


@endsection
