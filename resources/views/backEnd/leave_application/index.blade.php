
@extends('backEnd.master')

@section('mainTitle', 'Leave Application')
@section('leave_application','active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">{{$tittle}} </h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12 " style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">

               
                <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>শুরুর তারিখ</th>
                            <th>শেষের তারিখ</th>
                            <th>মোট দিন</th>
                            <th>ছুটির কারণ </th>
                            <th>ছুটির ধরণ </th>
                            <th>স্ট্যাটাস </th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                @if($leave_applications)
                    <?php $i=1?>
                    @foreach($leave_applications as $leave_application)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$leave_application->form_date->format('d-m-Y')}}</td>
                            <td>{{$leave_application->to_date->format('d-m-Y')}}</td>
                            <td>{{$leave_application->total_day}}</td>
                            <td>{{$leave_application->purpose}}</td>
                            <td>{{$leave_application->leave_type==1 ? 'অগ্রিম' : 'অনুপস্থিত'}}</td>
                            <td>{{$leave_application->status==0 ? 'প্রক্রিয়াধীন' : ($leave_application->status==1 ? 'গ্রহণ করা হয়েছে' : 'বাতিল করা হয়েছে')}}</td>
                            <td>
                                
                                <a style="margin-bottom: 10px;" href="{{url('leave_application/view/'.$leave_application->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                                @if(Auth::is('admin'))
                                    @if($leave_application->status==0)
                                    <a style="margin-bottom: 10px;" href="{{url('leave_application/accept/'.$leave_application->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-check"></span></a>
                                    <a style="margin-bottom: 10px;" href="{{url('leave_application/cancle/'.$leave_application->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                    @endif
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
 
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection
