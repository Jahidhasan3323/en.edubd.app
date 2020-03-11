@extends('backEnd.master')

@section('mainTitle', 'অটোমেটিক উপস্থিতি অপশন')
@section('message_length', 'active')

@section('content')
    @if(Session::has('errmgs'))
        @include('backEnd.includes.errors')
    @endif
    @if(Session::has('sccmgs'))
        @include('backEnd.includes.success')
    @endif

    <div class="panel col-md-12" style="border: 1px solid #ddd;">
        <div class="page-header">
            <h1 class="text-center text-temp">অটোমেটিক উপস্থিতি অপশন তালিকা</h1>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table id="option_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ক্রমিক</th>
                            <th class="text-center">প্রতিষ্ঠান</th>
                            <th class="text-center">উপস্থিতি অপশন</th>
                            <th class="text-center">অ্যাকশন</th>
                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                     <tbody>
                        @foreach($attendance_options as $attendance_option)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $attendance_option->user->name }}</td>
                                <td class="text-center">{{ $attendance_option->attendance_option==1?'উপস্থিতি এস,এম,এস':'উপস্থিতি ও প্রতিষ্ঠান ত্যাগ এস,এম,এস' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#option{{ $attendance_option->id }}"> <i class="fa fa-edit"></i> </button>
                                </td>
                            </tr>
                            <div id="option{{ $attendance_option->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title text-center">অটোমেটিক উপস্থিতি অপশন আপডেট</h4>
                                        </div>
                                        <div class="modal-body">
                                                <form action="{{ route('attendanceOption.store') }}" method="post" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="school_id" value="{{ $attendance_option->id }}">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="" for="attendance_option">অটোমেটিক উপস্থিতি অপশন</label>
                                                                <select class="form-control" name="attendance_option" id="attendance_option" style="width:100%;">
                                                                    <option selected value="{{ $attendance_option->attendance_option }}">{{ $attendance_option->attendance_option==1?'উপস্থিতি এস,এম,এস':'উপস্থিতি ও ত্যাগ এস,এম,এস' }}</option>
                                                                    <option value="1">উপস্থিত সময় এস,এম,এস</option>
                                                                    <option value="2">উপস্থিত সময় ও প্রতিষ্ঠান ত্যাগের এস,এম,এস</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-info">আপডেট করুন</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                  </div>
                             </div>
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
            $('#option_tbl').DataTable();
        } );
    </script>
@endsection
