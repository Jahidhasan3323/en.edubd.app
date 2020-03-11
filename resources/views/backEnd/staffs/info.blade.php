@extends('backEnd.master')

@section('mainTitle', 'Teachers Information')
@section('active_teacher', 'active')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">{{isset($old)?"প্রাক্তন":""}} কর্মকর্তার তথ্য</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <div class="table-responsive">
                <table id="staff_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>আইডি নাম্বার</th>
                            <th>ইমেইল</th>
                            <th>ফোন</th>
                            <th>পদবী</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($sl = Get::serial($staffs))
                    @foreach($staffs as $staff)
                        <tr>
                            <td>{{$sl}}</td>
                            <td><img src="{{Storage::url($staff->photo)}}" style="width: 50px;height: 55px;"></td>
                            <td>{{$staff->user->name}}</td>
                            <td>{{$staff->staff_id}}</td>
                            <td>{{$staff->user->email}}</td>
                            <td>{{$staff->user->mobile}}</td>
                            <td>{{$staff->designation->name}}</td>
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/staff/'.$staff->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                                @if (Auth::is('admin'))
                                   @if(! isset($old))
                                    <a style="margin-bottom: 10px;" href="{{url('/staff/'.$staff->id.'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                                   @endif
                                    <a style="margin-bottom: 10px" href=""  onclick="event.preventDefault(); clickFunction{{$staff->id}}()"
                                       class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                @endif
                                <form style="display: none;" id="delete-form{{$staff->id}}" method="post" action="{{url('/staff/'.$staff->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>
                            </td>
                        </tr>
                        <script>
                            function clickFunction{{$staff->id}}() {
                                if (confirm("Are you sure to delete this?")){
                                    document.getElementById("delete-form{{$staff->id}}").submit();
                                }
                            }
                        </script>
                        @php($sl++)
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>আইডি নাম্বার</th>
                            <th>ইমেইল</th>
                            <th>ফোন</th>
                            <th>পদবী</th>
                            <th>অ্যাকশন</th>
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
    $('#staff_tbl').DataTable();
} );
</script>


@endsection
