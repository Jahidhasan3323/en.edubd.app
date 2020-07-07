@extends('backEnd.master')

@section('mainTitle', 'Online Class')
@section('online_class_youtube', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
        <h4 class=" text-temp text-center"><b>Title:</b> {{$online_class->title}}, <b>Shift :</b> {{$online_class->shift}}, <b>Group :</b> {{$online_class->group}}, <b>Class :</b> {{$online_class->masterClass->name}}</h4>
        </div>
    
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">

                <iframe width="860" height="350" src="https://www.youtube.com/embed/<?=$online_class->link?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                
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
