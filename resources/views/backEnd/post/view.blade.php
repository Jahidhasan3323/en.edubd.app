@extends('backEnd.master')

@section('mainTitle', 'routines')
@section('post', 'active')
@section('head_section')
    <link rel="stylesheet" type="text/css" href="{{asset('css/lightbox.css')}}">
@endsection
@section('content')

    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Post</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        @if($post->db==1)
                            <li class="list-group-item"><b>নাম: </b> {{$post->user->name}}</li>
                            @if(($post->user->group_id==4))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user->Student->student_id}}</li>
                                <li class="list-group-item"><b>Roll: </b> {{$post->user->Student->roll}}</li>
                                <li class="list-group-item"><b>Shift: </b> {{$post->user->Student->shift}}</li>
                                <li class="list-group-item"><b>Group: </b> {{$post->user->Student->group}}</li>
                                <li class="list-group-item"><b>Class: </b> {{$post->user->Student->masterClass->name}}</li>
                                <li class="list-group-item"><b>Section: </b> {{$post->user->Student->section}}</li>

                            @endif
                            @if(($post->user->group_id==3 || $post->user->group_id==5))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user->staff->staff_id}}</li>
                                <li class="list-group-item"><b>Gender: </b> {{$post->user->staff->gender}}</li>

                            @endif
                            @if(($post->user->group_id==6))
                                <li class="list-group-item"><b>Gender: </b> {{$post->user->staff->gender}}</li>

                            @endif
                        @endif
                        @if($post->db==2)
                            <li class="list-group-item"><b>নাম: </b> {{$post->user2->name}}</li>
                            @if(($post->user2->group_id==4))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user2->Student->student_id}}</li>
                                <li class="list-group-item"><b>Roll: </b> {{$post->user2->Student->roll}}</li>
                                <li class="list-group-item"><b>Shift: </b> {{$post->user2->Student->shift}}</li>
                                <li class="list-group-item"><b>Group: </b> {{$post->user2->Student->group}}</li>
                                <li class="list-group-item"><b>Class: </b> {{$post->user2->Student->masterClass->name}}</li>
                                <li class="list-group-item"><b>Section: </b> {{$post->user2->Student->section}}</li>

                            @endif
                            @if(($post->user2->group_id==3 || $post->user2->group_id==5))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user2->staff->staff_id}}</li>
                                <li class="list-group-item"><b>Gender: </b> {{$post->user2->staff->gender}}</li>

                            @endif
                            @if(($post->user2->group_id==6))
                                <li class="list-group-item"><b>Gender: </b> {{$post->user2->staff->gender}}</li>

                            @endif
                        @endif
                        @if($post->db==3)
                            <li class="list-group-item"><b>নাম: </b> {{$post->user3->name}}</li>
                            @if(($post->user3->group_id==4))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user3->Student->student_id}}</li>
                                <li class="list-group-item"><b>Roll: </b> {{$post->user3->Student->roll}}</li>
                                <li class="list-group-item"><b>Shift: </b> {{$post->user3->Student->shift}}</li>
                                <li class="list-group-item"><b>Group: </b> {{$post->user3->Student->group}}</li>
                                <li class="list-group-item"><b>Class: </b> {{$post->user3->Student->masterClass->name}}</li>
                                <li class="list-group-item"><b>Section: </b> {{$post->user3->Student->section}}</li>
                            @endif
                            @if(($post->user3->group_id==3 || $post->user3->group_id==5))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user3->staff->staff_id}}</li>
                                <li class="list-group-item"><b>Gender: </b> {{$post->user3->staff->gender}}</li>

                            @endif
                            @if(($post->user3->group_id==6))
                                <li class="list-group-item"><b>Gender: </b> {{$post->user3->staff->gender}}</li>

                            @endif
                        @endif
                        @if($post->db==4)
                            <li class="list-group-item"><b>নাম: </b> {{$post->user4->name}}</li>
                            @if(($post->user4->group_id==4))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user4->Student->student_id}}</li>
                                <li class="list-group-item"><b>Roll: </b> {{$post->user4->Student->roll}}</li>
                                <li class="list-group-item"><b>Shift: </b> {{$post->user4->Student->shift}}</li>
                                <li class="list-group-item"><b>Group: </b> {{$post->user4->Student->group}}</li>
                                <li class="list-group-item"><b>Class: </b> {{$post->user4->Student->masterClass->name}}</li>
                                <li class="list-group-item"><b>Section: </b> {{$post->user4->Student->section}}</li>

                            @endif
                            @if(($post->user4->group_id==3 || $post->user4->group_id==5))
                                <li class="list-group-item"><b>ID No.: </b> {{$post->user4->staff->staff_id}}</li>
                                <li class="list-group-item"><b>Gender: </b> {{$post->user4->staff->gender}}</li>

                            @endif
                            @if(($post->user4->group_id==6))
                                <li class="list-group-item"><b>Gender: </b> {{$post->user4->staff->gender}}</li>

                            @endif
                        @endif
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        @if($post->db==1)
                            @if(($post->user->group_id==4))

                                <li class="list-group-item"><b>Gender: </b> {{$post->user->student->gender}}</li>
                                <li class="list-group-item"><b>Student Type: </b> {{$post->user->regularity}}</li>
                            @endif

                            <li class="list-group-item"><b>Designation: </b> {{$post->user->group->name}}</li>
                            <li class="list-group-item">
                                @if(($post->user->group_id==1))
                                    <img src="{{Storage::url('img/ehsan-logo.png')}}" height="160px" width="200px" style="width: 200px !important; ">
                                @elseif(($post->user->group_id==2))
                                    <img src="{{Storage::url($post->school->logo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                @elseif(($post->user->group_id==3 || $post->user->group_id==5))
                                    <img src="{{Storage::url($post->user->staff->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                @elseif(($post->user->group_id==4))
                                    <img src="{{Storage::url($post->user->student->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                @elseif(($post->user->group_id==6))
                                    <img src="{{Storage::url($post->user->committee->image)}}" height="160px" width="200px" style="width: 200px !important; ">
                                @endif
                        @endif
                        @if($post->db==2)
                            @if(($post->user2->group_id==4))

                                <li class="list-group-item"><b>Gender: </b> {{$post->user2->student->gender}}</li>
                                <li class="list-group-item"><b>Student Type: </b> {{$post->user2->regularity}}</li>
                            @endif

                            <li class="list-group-item"><b>Designation: </b> {{$post->user2->group->name}}</li>
                            <li class="list-group-item">
                                @if(($post->user2->group_id==1))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user2->group_id==2))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url($post->school2->logo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user2->group_id==3 || $post->user->group_id==5))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url($post->user2->staff->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user2->group_id==4))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url($post->user2->student->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user2->group_id==6))
                                        <img src="{{Helpers::db2_url()}} {{Storage::url($post->user2->committee->image)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @endif
                        @endif
                        @if($post->db==3)
                            @if(($post->user3->group_id==4))

                                <li class="list-group-item"><b>Gender: </b> {{$post->user3->student->gender}}</li>
                                <li class="list-group-item"><b>Student Type: </b> {{$post->user3->regularity}}</li>
                            @endif

                            <li class="list-group-item"><b>Designation: </b> {{$post->user3->group->name}}</li>
                            <li class="list-group-item">
                               @if(($post->user3->group_id==1))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user3->group_id==2))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url($post->school3->logo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user3->group_id==3 || $post->user->group_id==5))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url($post->user3->staff->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user3->group_id==4))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url($post->user3->student->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user3->group_id==6))
                                        <img src="{{Helpers::db3_url()}} {{Storage::url($post->user3->committee->image)}}" height="160px" width="200px" style="width: 200px !important; ">
                                @endif
                        @endif
                        @if($post->db==4)
                            @if(($post->user4->group_id==4))

                                <li class="list-group-item"><b>Gender: </b> {{$post->user4->student->gender}}</li>
                                <li class="list-group-item"><b>Student Type: </b> {{$post->user4->regularity}}</li>
                            @endif

                            <li class="list-group-item"><b>Designation: </b> {{$post->user4->group->name}}</li>
                            <li class="list-group-item">
                                 @if(($post->user4->group_id==1))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user4->group_id==2))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url($post->school4->logo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user4->group_id==3 || $post->user->group_id==5))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url($post->user4->staff->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user4->group_id==4))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url($post->user4->student->photo)}}" height="160px" width="200px" style="width: 200px !important; ">
                                    @elseif(($post->user4->group_id==6))
                                        <img src="{{Helpers::db4_url()}} {{Storage::url($post->user4->committee->image)}}" height="160px" width="200px" style="width: 200px !important; ">
                                @endif
                        @endif
                        </li>

                    </ul>
                </div>
                <div class="col-md-12">
                    {!!$post->message!!}
                    @php $images=explode('@', $post->file); @endphp
                         <div class="post-image">
                           @foreach($images as $image)
                                <div class="col-md-3">
                                    <a class="example-image-link" href="{{Storage::url($image)}}" data-lightbox="example-set" ><img  style="width: 100%; margin-bottom: 20px; height: 300px" class="example-image" src="{{Storage::url($image)}}" alt=" "/></a>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/lightbox-plus-jquery.js')}}"></script>

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
