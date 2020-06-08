@extends('backEnd.master')

@section('mainTitle', $title)
@section('online_admission', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">{{$title}}</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel col-sm-12" >
            <div class="page-header" style="margin: 0 0 7px 0; padding-bottom: 25px">
                <a href="{{url('/online_admission/application/'.$id)}}" class="btn btn-{{$status==1 ? 'success' : 'info'}}"> প্রক্রিয়াধীন তালিকা</a>
                <a href="{{url('/online_admission/merit_list/'.$id.'/2')}}" class="btn btn-{{$status==2 ? 'success' : 'info'}}"> মেধাতালিকা</a>
                <a href="{{url('/online_admission/waiting_list/'.$id.'/3')}}" class="btn btn-{{$status==3 ? 'success' : 'info'}}"> অপেক্ষাধীন তালিকা</a>
                <a href="{{url('/online_admission/reject_list/'.$id.'/0')}}" class="btn btn-{{$status==0 ? 'success' : 'info'}}"> বাতিল তালিকা</a>
            </div>
        </div>
        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">

                <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>ছবি </th>
                            <th>রেজিস্ট্রেশন নং </th>
                            <th>নাম</th>
                            <th>মোবাইল নং </th>
                            <th>স্ট্যাটাস </th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($online_admission)
                        <?php $i=1?>
                        @foreach($online_admission as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td><img src="{{Storage::url($row->picture)}}" width="50px" height="50px"></td>                            
                            <td>{{$row->reg_no}}</td>                            
                            <td>{{$row->name_bn}}</td>                            
                            <td>{{$row->phone}}</td>                            
                            <td>{{$row->status==1 ? "প্রক্রিয়াধীন" :($row->status==2 ? "মেধাতালিকা" :($row->status==3 ? "অপেক্ষাধীন" :($row->status==4 ? "বাতিল" : '')))}}</td>
                            <td>
                                
                                <a title="View"  class="btn btn-primary"  href="{{url('/online_admission/view/'.$row->id)}}"><span class="fa fa-eye"></span>
                                </a>
                                <a title="Accept" onclick="return confirm('Are you sure to add application to merit list  ?')"  class="btn btn-success"  href="{{url('/online_admission/add_merit/'.$row->id)}}">
                                    <span class="fa fa-check-circle"></span>
                                </a>
                                <a title="waiting"  onclick="return confirm('Are you sure to add application to waiting list  ?')" class="btn btn-info"  href="{{url('/online_admission/add_waiting/'.$row->id)}}">
                                   W
                                </a>
                                <a title="reject"  class="btn btn-warning" onclick="return confirm('Are you sure to reject it ?')" href="{{url('/online_admission/add_reject/'.$row->id)}}">
                                    <span class="fa fa-times-circle"></span>
                                </a>
                                <a title="delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete it ?')" href="{{url('/online_admission/application/delete/'.$row->id)}}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                <script>
                                    function deleteNodice{{$row->id}}() {
                                        if (!confirm('Are you sure to delete it ?')){
                                            event.preventDefault();
                                        }
                                    }
                                </script>
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
