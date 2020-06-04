@extends('backEnd.master')

@section('mainTitle', 'Holiday List')
@section('active_class1', 'active')

@section('content')

    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Holiday List</h1>
            <h3 class="text-center text-temp">
            Year : {{str_replace($s, $r, $year)}},
            Month : {{str_replace($s, $r, $months[$month-1])}},
            Holiday : {{str_replace($s, $r, count($holidays).' day')}}
          </h3>
        </div>


        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
           <div class="table-responsive">
            <table id="subject_tbl" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Day/Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($holidays as $holiday)
                      <tr>
                        <td>{{$x++}}</td>
                        <td>{{$holiday->date->format('l d-m-Y')}}</td>
                        @if($x==2)
                        <td rowspan="{{count($holidays)}}">
                            <div class="text-center" style="margin-top:{{count($holidays)*9/2}}%">
                                <a style="" href="{{url('/holiday/edit',[$month,$year])}}" class="btn btn-default" title="Edit">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a style="" href="{{url('/holiday/delete',[$month,$year])}}" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure delete this...?');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </td>
                        @endif
                      </tr>
                @endforeach
                </tbody>
                        <tfoot>
                           <tr>
                               <th>Serial</th>
                               <th>Day/Date</th>
                               <th>Action</th>
                           </tr>
                        </tfoot>
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
    $('#subject_tbl').DataTable();
} );
</script>
@endsection
