@extends('backEnd.master')

@section('mainTitle', 'Online Class')
@section('online_class_us', 'active')

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
                            <th>Si</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($online_class)
                        <?php $i=1?>
                        @foreach($online_class as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->subject=='0' ? 'Guardian' : $row->subject}}</td>
                            <td>
                                <?php
                                    if ($row->online_class_teacher) {
                                    foreach ($row->online_class_teacher as $teacher) { ?>
                                        <span>{{$teacher->user->name.', ' }}</span>
                                <?php  }  }  ?></td>                             
                            <td>
                                @php
                                    $class_subject = str_replace(' ','_',$row->subject);
                                @endphp
                                @if ($row->type==1)
                                <a target="_blank"  class="btn btn-info"  href="https://us.worldehsan.org/{{$row->school->serial_no}}-{{$row->masterClass->name}}-{{$row->group}}-{{$row->shift}}-{{$class_subject}}">
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
