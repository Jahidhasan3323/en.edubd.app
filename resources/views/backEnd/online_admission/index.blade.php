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

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">

                <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>টাইটেল</th>
                            <th>সেশন</th>
                            <th>শুরুর তারিখ</th>
                            <th>শেষের তারিখ</th>
                            <th>টাইপ </th>
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
                            <td>{{$row->title}}</td>                            
                            <td>{{$row->session}}</td>                            
                            <td>{{date_format(date_create($row->start_date),'d-m-Y')}}</td>
                            <td>{{date_format(date_create($row->end_date),'d-m-Y')}}</td>
                            <td>{{$row->type==1 ? "উচ্চ মাধ্যমিক" : ($row->type==2 ? "কলেজ" : '')}}</td>
                            <td>{{$row->status==1 ? "সক্রিয়" : "নিষ্ক্রিয়"}}</td>
                            
                            <td>
                                
                                <a  class="btn btn-success"  href="{{url('/online_admission/application/'.$row->id)}}">
                                    <span class="fa fa-clipboard"></span>
                                </a>
                                <a  class="btn btn-success"  href="{{url('/online_admission/edit/'.$row->id)}}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a  class="btn btn-danger" onclick="return confirm('Are you sure to delete it ?')" href="{{url('/online_admission/delete/'.$row->id)}}">
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
