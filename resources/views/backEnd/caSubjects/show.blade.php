@extends('backEnd.master')

@section('mainTitle', 'বিষয় তথ্য (সিএ)')
@section('active_ca_subject', 'active')

@section('content')
   
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিষয় তথ্য</h1>
            <h3 class="text-center text-temp">শ্রেী : {{$subjects[0]->masterClass->name}}, ট্রেড : {{$subjects[0]->groupClass->name}}</h3>
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
                        <th rowspan="2"># ক্রমিক নং</th>
                        <th rowspan="2" style="width:10%">বিষয়</th>
                        <th rowspan="2">কোড</th>
                        <th rowspan="2">মোট নম্বর</th>
                        <th rowspan="2" class="text-center">পাশ নম্বর</th>
                        <th rowspan="2">অ্যাকশন</th>
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


