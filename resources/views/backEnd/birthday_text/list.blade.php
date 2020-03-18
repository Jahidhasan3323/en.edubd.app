@extends('backEnd.master')

@section('mainTitle', 'Birthday SMS Text List')
@section('active_birthday_text', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Birthday SMS Text List</h1>
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
                            <th class="text-center">Serial</th>
                            <th class="text-center">Institute</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($birthdat_texts as $birthdat_text)
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $birthdat_text->school->user->name }}</td>
                                <td>{{ $birthdat_text->content }}</td>
                                <td class="text-center">
                                   <a href="{{ route('birthdayText.edit', $birthdat_text->id) }}">
                                       <button type="button" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </button>
                                   </a>
                                   <a href="{{ route('birthdayText.delete', $birthdat_text->id) }}">
                                       <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i> </button>
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
            $('#birthday_tbl').DataTable();
        } );
    </script>
@endsection
