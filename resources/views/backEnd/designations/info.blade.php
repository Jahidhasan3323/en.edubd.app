@extends('backEnd.master')

@section('mainTitle', 'Designations Information')
@section('active_designation', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">স্টাফ পদ তালিকা</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <table id="commitee_tbl" class="table table-bordered table-responsive table-hover table-striped">
                <thead>
                    <tr>
                        <th>ক্রমিক নং</th>
                        <th>নাম</th>
                        <th>পদবীর ধরণ</th>
                        @if (Auth::is('root'))
                        <th>অ্যাকশন</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($serial = Get::serial($designations))
                    @foreach($designations as $designation)
                        <tr>
                            <td>{{$serial}}</td>
                            <td>{{$designation->name}}</td>
                            <td>{{$designation->type==1?'শিক্ষক ও কর্মচারী':'কমিটি'}}</td>
                            @if (Auth::is('root'))
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/designations/'.$designation->id.'/edit')}}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                                    <a style="margin-bottom: 10px" href="#"  onclick="clickFunction{{$designation->id}}()"
                                       class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                <form style="display: none;" id="delete-form{{$designation->id}}" method="post" action="{{url('/designations/'.$designation->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>
                            </td>
                            @endif
                        </tr>
                        <script>
                            function clickFunction{{$designation->id}}() {
                                if (confirm("Are you sure to delete this?")){
                                    document.getElementById("delete-form{{$designation->id}}").submit();
                                }
                            }
                        </script>
                        @php($serial++)
                    @endforeach
                </tbody>

            </table>
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
