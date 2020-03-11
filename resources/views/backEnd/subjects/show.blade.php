@extends('backEnd.master')

@section('mainTitle', 'বিষয় তথ্য')
@section('active_subject', 'active')

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
                        <th rowspan="2" class="text-center">মোট পাশ নম্বর</th>
                        <th colspan="4" class="text-center">নম্বর বন্টন</th>
                        <th colspan="4" class="text-center">পাশ নম্বর বন্টন</th>
                        <th rowspan="2">স্টেটাস</th>
                        <th rowspan="2">অ্যাকশন</th>
                    </tr>
                    <tr>
                        <th>সিএ</th>
                        <th>সিআর/তত্ত্বীয়</th>
                        <th>এমসিকিউ</th>
                        <th>পিআর</th>

                        <th>সিএ</th>
                        <th>সিআর/তত্ত্বীয়</th>
                        <th>এমসিকিউ</th>
                        <th>পিআর</th>
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
