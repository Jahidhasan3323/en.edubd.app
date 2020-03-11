
@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Video')
@section('gallery', 'active')
@section('content')

    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ভিডিও </h1>
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
                            <th>ভিডিও</th>
                            <th>টাইটেল</th>
                            <th>ক্যাটাগরি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                @if($video_gallerys)
                    <?php $i=1?>
                    @foreach($video_gallerys as $video_gallery)
                        <tr>
                            <td>{{$i++}}</td>
                            <td><iframe width="50" height="50" src="https://www.youtube.com/embed/{{$video_gallery->path}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                            <td>{{$video_gallery->tittle}}</td>
                            <td>{{$video_gallery->gallery_category->tittle}}</td>
                           
                            
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/video_gallery/view/'.$video_gallery->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a style="margin-bottom: 10px;" href="{{url('/video_gallery/edit/'.$video_gallery->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a>

                               <a style="margin-bottom: 10px" href=""  onclick="event.preventDefault(); clickFunction{{$video_gallery->id}}()"
                                       class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                <form style="display: none;" id="delete-form{{$video_gallery->id}}" method="post" action="{{url('/video_gallery/delete/'.$video_gallery->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>
                                <script>
                                    function clickFunction{{$video_gallery->id}}() {
                                        if (confirm("Are you sure to delete this?")){
                                            document.getElementById("delete-form{{$video_gallery->id}}").submit();
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
