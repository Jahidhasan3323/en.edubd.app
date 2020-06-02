
@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Important Link')
@section('important_link', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Important Link </h1>
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
                            <th>Serial</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                @if($important_links)
                    <?php $i=1?>
                    @foreach($important_links as $important_link)
                        <tr>
                            <td>{{$i++}}</td>

                            <td>{{$important_link->tittle}}</td>
                            <td>{{$important_link->link}}</td>
                            <td>{{$important_link->important_links_category->tittle}}</td>
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/important_link/edit/'.$important_link->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a>

                               <a style="margin-bottom: 10px" href=""  onclick="event.preventDefault(); clickFunction{{$important_link->id}}()"
                                       class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                <form style="display: none;" id="delete-form{{$important_link->id}}" method="post" action="{{url('/important_link/delete/'.$important_link->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>
                                <script>
                                    function clickFunction{{$important_link->id}}() {
                                        if (confirm("Are you sure to delete this?")){
                                            document.getElementById("delete-form{{$important_link->id}}").submit();
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

    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection