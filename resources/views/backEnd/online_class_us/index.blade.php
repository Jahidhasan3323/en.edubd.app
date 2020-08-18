@extends('backEnd.master')

@section('mainTitle', 'Online Class')
@section('online_class_us', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Online Class
            <a style="margin-left: 5px" class="btn btn-info pull-right" href="{{url('online_class_us/create/'.$school_id)}}"><i class="fa fa-plus"></i>  Add Student Class</a> 
            <a style="margin-left: 5px" class="btn btn-warning pull-right" href="{{url('online_class_us/create_guardian/'.$school_id)}}"><i class="fa fa-plus"></i>Add Guardian Meeting</a>
            <a class="btn btn-success pull-right" href="{{url('online_class_us/create_staff/'.$school_id)}}"><i class="fa fa-plus"></i> Add Teacher Meeting</a></h1>
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
                            <th>Class</th>
                            {{--  <th>পাসওয়ার্ড</th> --}}
                            <th>Shift</th>
                            <th>Group </th>
                            <th>Section </th>
                            <th>Subject</th>
                            <th>Teacher </th>
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
                           
                            <td>{{$row->masterClass->name ?? ''}}</td>
                            {{-- <td>{{$row->password}}</td>  --}}                           
                            <td>{{$row->shift ?? ''}}</td>
                            <td>{{$row->group ?? ''}}</td>
                            <td>{{$row->section ?? ''}}</td>
                            <td>{{$row->subject}}</td>  
                            <td>
                                <?php
                                    if ($row->online_class_teacher) {
                                       foreach ($row->online_class_teacher as $teacher) { ?>
                                           <span>{{$teacher->user->name.', ' }}</span>
                                <?php  }  }  ?>
                            </td>                            
                            <td>{{$row->type==1 ? 'Student' :($row->type==2 ? 'Staff': 'Guardian')}}</td>
                            <td>

                                @if(Auth::is('root'))
                                    @if ($row->type==1)
                                    @php
                                        $class_subject = str_replace(' ','_',$row->subject);
                                    @endphp
                                    <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$row->school->serial_no}}-{{$row->masterClass->name}}-{{$row->group}}-{{$row->shift}}-{{$class_subject}}">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <a  class="btn btn-success"  href="{{url('/online_class_us/edit/'.$row->id.'/'.$row->school_id)}}">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a  class="btn btn-warning"  href="{{url('/online_class_us/add_multiple_teacher/'.$row->id.'/'.$row->school_id)}}">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                    @endif
                                
                                    @if ($row->type==2)
                                        <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$row->school->serial_no}}-teacher">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    @endif
                                    @if ($row->type==3)
                                        <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$row->school->serial_no}}-guardian">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    @endif
                                
                                    
                                    
                                    <a  class="btn btn-danger" onclick="return confirm('Are you sure to delete it ?')" href="{{url('/online_class_us/delete/'.$row->id)}}">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    <script>
                                        function deleteNodice{{$row->id}}() {
                                            if (!confirm('Are you sure to delete it ?')){
                                                event.preventDefault();
                                            }
                                        }
                                    </script>
                                @endif
                                @if(Auth::is('admin'))
                                    @if ($row->type==1)
                                        <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$row->school->serial_no}}-{{$row->masterClass->name}}-{{$row->group}}-{{$row->shift}}-{{$class_subject}}">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    
                                    @endif
                                
                                    @if ($row->type==2)
                                        <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$row->school->serial_no}}-teacher">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    @endif
                                @endif
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
