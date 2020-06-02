@extends('backEnd.master')

@section('mainTitle', 'Subject Information')
@section('active_subject', 'active')

@section('content')

    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Subject Information</h1>
            <h3 class="text-center text-temp">Class : {{$subjects[0]->masterClass->name}}, Group : {{$subjects[0]->groupClass->name}}</h3>
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
                        <th rowspan="2">Serial</th>
                        <th rowspan="2" style="width:10%">Subject</th>
                        <th rowspan="2">Code</th>
                        <th rowspan="2">Total Marks</th>
                        <th rowspan="2" class="text-center">Total Pass marks</th>
                        <th colspan="4" class="text-center">Marks Distribution</th>
                        <th colspan="4" class="text-center">Pass Marks Distribution</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>CA</th>
                        <th>CR/Written</th>
                        <th>MCQ</th>
                        <th>PR</th>

                        <th>CA</th>
                        <th>CR/Written</th>
                        <th>MCQ</th>
                        <th>PR</th>
                    </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @if($subjects->count())
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{{$subject->subject_name}}</td>
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->total_mark}}</td>
                            <td>{{$subject->total_pass_mark}}</td>
                            <td>{{$subject->ca_mark}}</td>
                            <td>{{$subject->cr_mark}}</td>
                            <td>{{$subject->mcq_mark}}</td>
                            <td>{{$subject->pr_mark}}</td>
                            <td>{{$subject->ca_pass_mark}}</td>
                            <td>{{$subject->cr_pass_mark}}</td>
                            <td>{{$subject->mcq_pass_mark}}</td>
                            <td>{{$subject->pr_pass_mark}}</td>
                            <td>{{$subject->status}}</td>
                            <td>
                                <a style="" href="{{url('/subjects/edit',[$subject->id])}}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a style="" href="{{url('/subjects/delete',[$subject->id])}}" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                @endif

                </tbody>

                </table>
           </div>
        </div>
    </div>
@endsection

@section('script')
<!--
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#subject_tbl').DataTable();
} );
</script> -->
@endsection
