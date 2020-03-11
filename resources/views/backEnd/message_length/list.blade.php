@extends('backEnd.master')

@section('mainTitle', 'বার্তা সেটিং')
@section('message_length', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বার্তা সেটিং তালিকা</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <div class="table-responsive">
                <table id="birthday_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ক্রমিক</th>
                            <th class="text-center">প্রতিষ্ঠান</th>
                            <th class="text-center">নোটিফিকেশন</th>
                            <th class="text-center">জন্মদিনের বার্তা</th>
                            <th class="text-center">অ্যাকশন</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($message_lengths as $message_length)
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $message_length->school->user->name }}</td>
                                <td class="text-center">{{ $message_length->notification }}</td>
                                <td class="text-center">
                                    @if ($message_length->birthday_sms==1) <span class="text-success">সক্রিয়</span>
                                    @else <span class="text-danger">নিষ্ক্রিয়</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                   <a href="{{ route('messageLength.edit', $message_length->id) }}">
                                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </button>
                                   </a>
                                   {{-- <a href="{{ route('messageLength.delete', $message_length->id) }}">
                                       <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i> </button>
                                   </a> --}}
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
            $('#birthday_tbl').DataTable();
        } );
    </script>
@endsection
