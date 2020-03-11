
@extends('backEnd.master')

@section('mainTitle', 'Important Link')
@section('date_language', 'active')

@section('content')
<?php use App\SchoolType; ?>
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">গুরুত্বপূর্ণ লিঙ্ক </h1>
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
                            <th>টাইটেল</th>
                            <th>লিঙ্ক</th>
                            <th>ক্যাটাগরি</th>
                            <th>টাইপ</th>
                            <th>হেডারে দেখাবে ?</th>
                            <th>অ্যাকশন</th>
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
                            <td>{{$important_link->important_links_category_root->tittle}}</td>
                            <?php
                                $school_type_ids=explode('|', $important_link->school_type_id);
                                $school_types=SchoolType::whereIn('id',$school_type_ids)->select('type')->get();
                            ?>
                            <td>
                                @foreach($school_types as $school_type)
                                    {{$school_type->type}},
                                @endforeach
                            </td>

                            <td>{{$important_link->header_status==0 ? 'না' : 'হ্যাঁ'}}</td>
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/important_link_root/edit/'.$important_link->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a>

                               <a style="margin-bottom: 10px" href=""  onclick="event.preventDefault(); clickFunction{{$important_link->id}}()"
                                       class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                <form style="display: none;" id="delete-form{{$important_link->id}}" method="post" action="{{url('/important_link_root/delete/'.$important_link->id)}}" style="padding: 0; margin: 0; outline: 0;">
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
