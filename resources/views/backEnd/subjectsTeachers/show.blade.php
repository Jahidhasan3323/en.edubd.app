@extends('backEnd.master')

@section('mainTitle', 'Assign Statistic')
@section('active_subject', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Subject Wise Teacher</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <div class="panel-body">
                        <table id="sub_techer_tbl" class="table table-bordered table-hover table-striped">
                          <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Class</th>
                                <th>Shift</th>
                                <th>Section</th>
                                <th>Group</th>
                                <th>Teacher</th>
                                <th>Subject</th>
                                @if(Auth::is('admin'))
                                    <th>Action</th>
                                @endif
                            </tr>
                         </thead>
                         <tbody>
                            @php($sl = Get::serial($statisticsData))
                            @foreach($statisticsData as $item)
                                <tr>
                                    <td>{{$sl}}</td>
                                    <td>{{$item->masterClass->name}}</td>
                                    <td>{{$item->shift}}</td>
                                    <td>{{$item->section}}</td>
                                    <td>{{$item->groupClass->name}}</td>
                                    <td>{{$item->staff->user->name}}</td>
                                    <td>{{$item->subject->subject_name}}</td>
                                    @if(Auth::is('admin'))
                                        <td>
                                          <a style="" href="{{url('/subjectTeachers/edit/'.$item->id)}}" class="btn btn-success">
                                            <span class="glyphicon glyphicon-edit"></span>
                                          </a>
                                          <a href="{{url('/subjectTeachers/delete/'.$item->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure delete this...??');">
                                            <span class="glyphicon glyphicon-trash"></span>
                                          </a>

                                        </td>
                                    @endif

                                </tr>
                                @php($sl++)
                            @endforeach
                         </tbody>
                         <tfoot>
                             <tr>
                                 <th>Serial</th>
                                 <th>Class</th>
                                 <th>Shift</th>
                                 <th>Section</th>
                                 <th>Group</th>
                                 <th>Teacher</th>
                                 <th>Subject</th>
                                 @if(Auth::is('admin'))
                                     <th>Action</th>
                                 @endif
                             </tr>
                         </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#sub_techer_tbl').DataTable();
    } );
    </script>
@endsection
