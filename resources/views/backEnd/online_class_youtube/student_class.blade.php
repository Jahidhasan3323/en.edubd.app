@extends('backEnd.master')

@section('mainTitle', 'Online Class')
@section('online_class_youtube', 'active')

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
                            <td> 
                                 <a class="btn btn-danger" target="_blank" href="https://www.youtube.com/watch?v=<?=$row->link?>"><i class="fa fa-external-link"></i></a>
                                <a class="btn btn-info" href="{{url('/online_class_youtube/view/'.$row->id)}}" >Ofline Video</a>
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
