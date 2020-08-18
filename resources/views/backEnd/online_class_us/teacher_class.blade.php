@extends('backEnd.master')

@section('mainTitle', 'Online Class')
@section('online_class_us', 'active')

@section('content')
<?php
    use App\OnlineClassUs;
?>
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
        <div class="col-sm-12">
            <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
                <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">
                    <h4>Staff Conferance List</h4>
                    <hr>
                    <table id="commitee_tbl1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                            
                                <th>Si</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($conferance)
                            <?php $i=1?>
                            @foreach($conferance as $row)
                           

                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                   
                                    @if($row->type==3)
                                    Guardian
                                    @elseif($row->type==2)
                                    {{"Staff"}}
                                    @endif
                                    
                                </td>
                                <td>
                                    
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
                                </td>                         
                            </tr>
                            
                            @endforeach
                            @endif
                        </tbody>
                        
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
                <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">
                    <h4>Student Class List</h4>
                    <hr>
                    <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                            
                                <th>Si</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($teacher_class)
                            <?php $i=1?>
                            @foreach($teacher_class as $row)
                            <?php $online_class=OnlineClassUs::where('id',$row->online_class_us_id)->first(); ?>

                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    @if ($online_class->type==2)
                                        {{$online_class->masterClass->name ?? 'Staff'}}
                                        
                                    @elseif($online_class->type==3)
                                    Guardian
                                    @elseif($online_class->type==1)
                                    {{$online_class->masterClass->name}}
                                    @endif
                                    
                                </td>
                                <td>{{$online_class->subject }}</td> 
                                <td>
                                    @php
                                        $class_subject = str_replace(' ','_',$online_class->subject);
                                    @endphp
                                    @if ($online_class->type==1)
                                    <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$online_class->school->serial_no}}-{{$online_class->masterClass->name}}-{{$online_class->group}}-{{$online_class->shift}}-{{$class_subject}}">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    @endif
                                
                                    @if ($online_class->type==2)
                                        <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$online_class->school->serial_no}}-teacher">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
                                    @endif
                                    @if ($online_class->type==3)
                                        <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$online_class->school->serial_no}}-guardian">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                        </a>
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
