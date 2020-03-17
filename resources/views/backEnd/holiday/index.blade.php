@extends('backEnd.master')

@section('mainTitle', 'Holiday List')
@section('active_class1', 'active')

@section('content')

    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Holiday List</h1>
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
                        <th>Month</th>
                        <th>Year</th>
                        <th>Total Holiday</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($holidays as $holiday)
                      <tr>
                        <td>{{$x++}}</td>
                        <td>{{$months[$holiday->date->format('m')-1]}}</td>
                        <td>{{$holiday->date->format('Y')}}</td>
                        <td>{{$holiday->total}}</td>
                        <td>
                            <a style="" href="{{url('/holiday/edit',[$holiday->date->format('m'),$holiday->date->format('Y')])}}" class="btn btn-default">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a style="" href="{{url('/holiday/show',[$holiday->date->format('m'),$holiday->date->format('Y')])}}" class="btn btn-info">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                        <tfoot>
                           <tr>
                               <th>Serial</th>
                               <th>Month</th>
                               <th>Year</th>
                               <th>Total Holiday</th>
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
