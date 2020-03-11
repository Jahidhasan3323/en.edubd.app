@extends('backEnd.master')

@section('mainTitle', 'routines')
@section('active_notice', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">নোটিশ</h1>
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
                            <th>ফাইল</th>
                            <th>তারিখ</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($notices)
                        <?php $i=1?>
                        @foreach($notices as $notice)
                        @php($status=$notice->status)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$notice->name}}</td>
                            <td>@if(!empty($notice->path))<a style="margin-bottom: 10px;" href="{{url('notice/view/'.$notice->id)}}" class="btn btn-success">ফাইল</a>@endif</td>
                            
                            <td>{{$notice->updated_at->format('d-m-Y')}}</td>
                            
                            <td>
                                <a  href="{{url('notice/view/'.$notice->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                                @if(Auth::is('admin'))
                                   
                                        
                                        @if($status==0)
                                        <a href="{{url('/notice/status/'.$notice->id.'/'.$status)}}" class="btn btn-success">
                                            প্রকাশিত
                                        </a>
                                        @else
                                        <a href="{{url('/notice/status/'.$notice->id.'/'.$status)}}" class="btn btn-danger">
                                            অপ্রকাশিত
                                        </a>
                                        @endif
                                        <a  class="btn btn-success"  href="{{url('/notice/edit/'.$notice->id)}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a  class="btn btn-danger" onclick="return confirm('Are you sure to delete it ?')" href="{{url('/notice/delete/'.$notice->id)}}">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <script>
                                            function deleteNodice{{$notice->id}}() {
                                                if (!confirm('Are you sure to delete it ?')){
                                                    event.preventDefault();
                                                }
                                            }
                                        </script>
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
