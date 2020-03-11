
@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Others Informatin')
@section('information', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">অন্যান্য তথ্য </h1>
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
                            <th>ফাইল</th>
                            <th>টাইটেল</th>
                            <th>বাণীর ধরণ </th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($general_texts)
                        <?php $i=1?>
                        @foreach($general_texts as $general_text)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>@if(!empty($general_text->file))<a style="margin-bottom: 10px;" href="{{url('general_text/view/'.$general_text->id)}}" class="btn btn-success">ফাইল</a>@endif</td>
                            <td>{{$general_text->tittle}}</td>
                            <td>{{$general_text->general_text_type->tittle}}</td>
                            
                            
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('general_text/view/'.$general_text->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a style="margin-bottom: 10px;" href="{{url('general_text/edit/'.$general_text->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a>
                                <a style="margin-bottom: 10px" href=""  onclick="event.preventDefault(); clickFunction{{$general_text->id}}()"
                                    class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                </a>
                                <form style="display: none;" id="delete-form{{$general_text->id}}" method="post" action="{{url('general_text/delete/'.$general_text->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>
                                <script>
                                function clickFunction{{$general_text->id}}() {
                                if (confirm("Are you sure to delete this?")){
                                document.getElementById("delete-form{{$general_text->id}}").submit();
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
