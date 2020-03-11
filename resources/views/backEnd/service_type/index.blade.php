@extends('backEnd.master')

@section('mainTitle', 'routines')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">সেবার ধরণ তালিকা</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">

                <table id="service_type_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ধরণ তালিকা</th>
                            <th>স্টেটাস </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1?>
                        @foreach($service_types as $service_type)
                        @php($status=$service_type->status)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$service_type->type}}</td>
                            <td>
                                <a href="{{url('/service-type/status/'.$service_type->id.'/'.$status)}}" class="btn {{$status=='1'?'btn-danger':'btn-success'}}">
                                    {{$status=='1'?'নিষ্ক্রিয়':'সক্রিয়'}}
                                </a>
                            </td>
                        </tr>
                        
                        @endforeach
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
    $('#service_type_tbl').DataTable();
} );
</script>
@endsection
