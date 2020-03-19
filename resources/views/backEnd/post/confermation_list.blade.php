@extends('backEnd.master')

@section('mainTitle', 'routines')
@section('post', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">পোস্ট</h1>
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
                            <th>পোস্ট</th>
                            <th>নাম</th>
                            @if(Auth::is('root'))
                                <th>প্রতিষ্ঠান</th>
                                <th>অ্যাপ্লিকেশন</th>
                            @endif
                            <th>তারিখ</th>
                            <th>ছবি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($posts)
                        <?php $i=1?>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{!!substr($post->message, 0, 100)!!}</td>
                            
                            
                            @if(Auth::is('admin'))
                             <td>{{$post->user->name}}</td>
                             @endif
                            @if(Auth::is('root'))
                                @if($post->db==1)
                                    <td>{{$post->user->name}}</td>
                                    @if($post->user->group_id==1)
                                        <td>Root</td>
                                    @else
                                        <td>{{$post->school->user->name}}</td>
                                    @endif
                                    <td>বাংলা সাইট </td>
                                @endif
                                @if($post->db==2)
                                    <td>{{$post->user2->name}}</td>
                                    @if($post->user2->group_id==1)
                                        <td>Root</td>
                                    @else
                                        <td>{{$post->school2->user->name}}</td>
                                    @endif
                                    <td>ইংরেজি সাইট </td>
                                @endif
                                @if($post->db==3)
                                    <td>{{$post->user3->name}}</td>
                                    @if($post->user3->group_id==1)
                                        <td>Root</td>
                                    @else
                                        <td>{{$post->school3->user->name}}</td>
                                    @endif
                                    <td>মাদ্রাসা সাইট </td>
                                @endif
                                @if($post->db==4)
                                    <td>{{$post->user4->name}}</td>
                                    @if($post->user4->group_id==1)
                                        <td>Root</td>
                                    @else
                                        <td>{{$post->school4->user->name}}</td>
                                    @endif
                                    <td>টেকনিক্যাল সাইট </td>
                                @endif
                            @endif
                            <td>{{$post->created_at->format('h:i:s , d-m-Y')}}</td>
                            <td>
                                @if($post->db==1)
                                @if(($post->user->group_id==1))
                                    <img src="{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; ">
                                @elseif(($post->user->group_id==2))
                                    <img src="{{Storage::url($post->school->logo)}}" height="50px" width="50px" style="width: 50px !important; "> 
                                @elseif(($post->user->group_id==3 || $post->user->group_id==5))
                                    <img src="{{Storage::url($post->user->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                @elseif(($post->user->group_id==4))
                                    <img src="{{Storage::url($post->user->student->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                @elseif(($post->user->group_id==6))
                                    <img src="{{Storage::url($post->user->committee->image)}}" height="50px" width="50px" style="width: 50px !important; ">
                                @endif 
                            @endif
                            @if($post->db==2)
                                @if(($post->user2->group_id==1))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user2->group_id==2))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url($post->school2->logo)}}" height="50px" width="50px" style="width: 50px !important; "> 
                                    @elseif(($post->user2->group_id==3 || $post->user->group_id==5))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url($post->user2->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user2->group_id==4))
                                        <img src="{{Helpers::db2_url()}}{{Storage::url($post->user2->student->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user2->group_id==6))
                                        <img src="{{Helpers::db2_url()}} {{Storage::url($post->user2->committee->image)}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @endif 
                               
                            @endif
                            @if($post->db==3)
                                @if(($post->user3->group_id==1))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user3->group_id==2))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url($post->school3->logo)}}" height="50px" width="50px" style="width: 50px !important; "> 
                                    @elseif(($post->user3->group_id==3 || $post->user->group_id==5))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url($post->user3->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user3->group_id==4))
                                        <img src="{{Helpers::db3_url()}}{{Storage::url($post->user3->student->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user3->group_id==6))
                                        <img src="{{Helpers::db3_url()}} {{Storage::url($post->user3->committee->image)}}" height="50px" width="50px" style="width: 50px !important; ">
                                @endif
                                
                            @endif 

                            @if($post->db==4)
                                @if(($post->user4->group_id==1))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user4->group_id==2))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url($post->school4->logo)}}" height="50px" width="50px" style="width: 50px !important; "> 
                                    @elseif(($post->user4->group_id==3 || $post->user->group_id==5))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url($post->user4->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user4->group_id==4))
                                        <img src="{{Helpers::db4_url()}}{{Storage::url($post->user4->student->photo)}}" height="50px" width="50px" style="width: 50px !important; ">
                                    @elseif(($post->user4->group_id==6))
                                        <img src="{{Helpers::db4_url()}} {{Storage::url($post->user4->committee->image)}}" height="50px" width="50px" style="width: 50px !important; ">
                                @endif 
                                
                            @endif
                                
                            </td>
                            <td>
                                <a  href="{{url('post/view/'.$post->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                                @if(Auth::is('admin') || Auth::is('root'))
                                   
                                        
                                    @if($post->status==0)
                                        <a href="{{url('/post/accept/'.$post->id)}}" class="btn btn-success">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a href="{{url('/post/cancel/'.$post->id)}}" class="btn btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        @elseif($post->status==1)
                                        <a href="{{url('/post/cancel/'.$post->id)}}" class="btn btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    @else
                                    
                                    @endif
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
