@extends('backEnd.master')

@section('mainTitle', 'Manage School Info')
@section('active_school', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Institute List</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <table id="school_tbl" class="table table-bordered table-responsive table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th width="13%">Phone</th>
                        <th>Expire</th>
                        <th>Status</th>
                        <th>Service Type</th>
                        <th>Students</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php($serial = Get::serial($schools))
                @foreach($schools as $school)
                    <tr>
                        <td>{{$serial++}}</td>
                        <td>{{$school->name}}</td>
                        <td>{{$school->mobile}}</td>
                        <td>{{$school->expiry_date}}</td>
                        <td>{{($school->status === 1) ? 'Enable' : 'Disable'}}</td>
                        <td>
                            {{$school->service_type}}
                        </td>
                        <td>
                            <a href="{{url('students_control',$school->id)}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </td>
                        <td>
                            <a href="{{url('/schools/'.$school->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a href="{{url('/schools/'.$school->id.'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="{{url('/online_class_us/index/'.$school->id)}}" class="btn btn-warning"><span class="fa fa-video-camera"></span></a>
                            <a href="{{url('/schools/'.$school->id.'/delete')}}" onclick="return confirm('Are you sure delete this institute..?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th width="13%">Phone</th>
                        <th>Expire</th>
                        <th>Status</th>
                        <th>Service Type</th>
                        <th>Students</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <!-- <div class="text-center">
            </div> -->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#school_tbl').DataTable();
         });
    </script>
@endsection
