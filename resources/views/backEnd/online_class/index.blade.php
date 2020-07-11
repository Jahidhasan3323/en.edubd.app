@extends('backEnd.master')

@section('mainTitle', 'Online Class')
@section('online_class', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Online Class</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">

                <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SI</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Password</th>
                            <th>Shift</th>
                            <th>Class</th>
                            <th>Group </th>
                            <th>Section </th>
                            <th>User </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($online_class)
                        <?php $i=1?>
                        @foreach($online_class as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->title}}</td>                            
                            <td>{{$row->link}} <a href="{{$row->link}}" target="_blank"><i class="fa fa-external-link"></i></a></td>
                            <td>{{$row->password}}</td>                            
                            <td>{{$row->shift ?? ''}}</td>                            
                            <td>{{$row->masterClass->name ?? ''}}</td>
                            <td>{{$row->group ?? ''}}</td>                            
                            <td>{{$row->section ?? ''}}</td>                            
                            <td>{{$row->type==1 ? 'Student' : 'Staff'}}</td>                            
                            <td>
                                <a  class="btn btn-success"  href="{{url('/online_class/edit/'.$row->id)}}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a  class="btn btn-danger" onclick="return confirm('Are you sure to delete it ?')" href="{{url('/online_class/delete/'.$row->id)}}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                <script>
                                    function deleteNodice{{$row->id}}() {
                                        if (!confirm('Are you sure to delete it ?')){
                                            event.preventDefault();
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                        
                        @endforeach
                        @endif
                    </tbody>
                    
                </table>
                
            </div>
        </div>
    </div>
    
@endsection
@section('script')
    {{--<script src="{{asset('backEnd/js/jquery-3.1.1.min.js')}}"></script>--}}
    {{--<script src="{{asset('backEnd/js/appsJs/studentInfo.js')}}"></script>--}}
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection
