@extends('backEnd.master')

@section('mainTitle', 'Commitee Information')
@section('active_commitee', 'active')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">{{isset($old)?"প্রাক্তন":""}} কমিটির তথ্য</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <div class="table-responsive">
                <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>নাম</th>
                            <th>মোবাইল নম্বর</th>
                            <th>ইমেইল</th>
                            <th>পদবী</th>
                            <th>ছবি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($sl = Get::serial($commitees))
                    @foreach($commitees as $commitee)
                        <tr>
                            <td>{{$sl}}</td>
                            <td>{{$commitee->user->name}}</td>
                            <td>{{$commitee->user->mobile}}</td>
                            <td>{{$commitee->user->email}}</td>
                            <td>{{$commitee->designation->name??''}}</td>
                            <td><img class="img-responsive img-thumbnail" src="{{Storage::url($commitee->image ? $commitee->image : '')}}" width="50px" height="60px" alt="Image"></td>
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/commitee/'.$commitee->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>

                                @if(Auth::is('admin'))
                                  @if(! isset($old))
                                    <a style="margin-bottom: 10px;" href="{{url('/commitee/'.$commitee->id.'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                                  @endif
                                    <a style="margin-bottom: 10px" href=""  onclick="event.preventDefault(); clickFunction{{$commitee->id}}()"
                                       class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                @endif
                                <form style="display: none;" id="delete-form{{$commitee->id}}" method="post" action="{{url('/commitee/'.$commitee->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>
                            </td>
                        </tr>
                        <script>
                            function clickFunction{{$commitee->id}}() {
                                if (confirm("Are you sure to delete this?")){
                                    document.getElementById("delete-form{{$commitee->id}}").submit();
                                }
                            }
                        </script>
                        @php($sl++)
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>নাম</th>
                            <th>মোবাইল নম্বর</th>
                            <th>ইমেইল</th>
                            <th>পদবী</th>
                            <th>ছবি</th>
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
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection
