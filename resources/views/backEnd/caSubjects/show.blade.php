@extends('backEnd.master')

@section('mainTitle', 'CA Subject List')
@section('active_ca_subject', 'active')

@section('content')

    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">CA Subjects</h1>
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
                        <th rowspan="2" class="text-center">Pass marks</th>
                        <th rowspan="2">Action</th>
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
                            <td>{{$subject->pass_mark}}</td>
                            <td>
                                <a style="" href="{{url('/ca-subjects/edit',[$subject->id])}}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a style="" href="{{url('/ca-subjects/delete',[$subject->id])}}" class="btn btn-danger">
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
