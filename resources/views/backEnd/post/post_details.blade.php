@extends('backEnd.master')

@section('mainTitle', 'routines')
@section('post', 'active')
@section('head_section')
    <link rel="stylesheet" type="text/css" href="{{asset('css/lightbox.css')}}">
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.4-rc1/css/foundation.css'>
 <link href="{{asset('/css/components.min.css')}}" rel="stylesheet" type="text/css">
@endsection
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
        <div class="row">
            <div class="user-section">
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="image">
                           @if($post->db==1)
                      @if(($post->user->group_id==1))
                            <img src="{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user->group_id==2))
                            <img src="{{Storage::url($post->school->logo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;"> 
                        @elseif(($post->user->group_id==3 || $post->user->group_id==5))
                            <img src="{{Storage::url($post->user->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user->group_id==4))
                            <img src="{{Storage::url($post->user->student->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user->group_id==6))
                            <img src="{{Storage::url($post->user->committee->image)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @endif 
                      </div>
                      <div class="text">
                        <h6><a href="{{url('post/creator/profile/'.$post->user_id.'/'.$post->db)}}"><b>{{$post->user->name}}</b></a> , <span>{{$post->school->user->name}}</span></h6>
                        <p><span>{{$post->user->group->name}},  </span> {{$post->created_at->diffForHumans()}}</p>
                      </div>
                      @endif
                      @if($post->db==2)
                        @if(($post->user2->group_id==1))
                            <img src="{{Helpers::db2_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user2->group_id==2))
                            <img src="{{Helpers::db2_url()}}{{Storage::url($post->school2->logo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;"> 
                        @elseif(($post->user2->group_id==3 || $post->user->group_id==5))
                            <img src="{{Helpers::db2_url()}}{{Storage::url($post->user2->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user2->group_id==4))
                            <img src="{{Helpers::db2_url()}}{{Storage::url($post->user2->student->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user2->group_id==6))
                            <img src="{{Helpers::db2_url()}} {{Storage::url($post->user2->committee->image)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @endif 
                        </div>
                        <div class="text">
                          <h6><a href="{{url('post/creator/profile/'.$post->user_id.'/'.$post->db)}}"><b>{{$post->user2->name}}</b></a> , <span>{{$post->school2->user->name}}</span></h6>
                          <p><span>{{$post->user2->group->name}},  </span> {{$post->created_at->diffForHumans()}}</p>
                        </div>
                      @endif
                      @if($post->db==3)
                        @if(($post->user3->group_id==1))
                            <img src="{{Helpers::db3_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user3->group_id==2))
                            <img src="{{Helpers::db3_url()}}{{Storage::url($post->school3->logo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;"> 
                        @elseif(($post->user3->group_id==3 || $post->user->group_id==5))
                            <img src="{{Helpers::db3_url()}}{{Storage::url($post->user3->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user3->group_id==4))
                            <img src="{{Helpers::db3_url()}}{{Storage::url($post->user3->student->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user3->group_id==6))
                            <img src="{{Helpers::db3_url()}} {{Storage::url($post->user3->committee->image)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                          @endif
                          </div>
                          <div class="text">
                            <h6><a href="{{url('post/creator/profile/'.$post->user_id.'/'.$post->db)}}"><b>{{$post->user3->name}}</b></a> , <span>{{$post->school3->user->name}}</span></h6>
                            <p><span>{{$post->user3->group->name}},  </span> {{$post->created_at->diffForHumans()}}</p>
                          </div>
                      @endif 

                      @if($post->db==4)
                        @if(($post->user4->group_id==1))
                            <img src="{{Helpers::db4_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user4->group_id==2))
                            <img src="{{Helpers::db4_url()}}{{Storage::url($post->school4->logo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;"> 
                        @elseif(($post->user4->group_id==3 || $post->user->group_id==5))
                            <img src="{{Helpers::db4_url()}}{{Storage::url($post->user4->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user4->group_id==4))
                            <img src="{{Helpers::db4_url()}}{{Storage::url($post->user4->student->photo)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @elseif(($post->user4->group_id==6))
                            <img src="{{Helpers::db4_url()}} {{Storage::url($post->user4->committee->image)}}" height="50px" width="50px" style="width: 50px !important; border-radius: 50%;">
                        @endif 
                        </div>
                        <div class="text">
                          <h6><a href="{{url('post/creator/profile/'.$post->user_id.'/'.$post->db)}}"><b>{{$post->user4->name}}</b></a> , <span>{{$post->school4->user->name}}</span></h6>
                          <p><span>{{$post->user4->group->name}},  </span> {{$post->created_at->diffForHumans()}}</p>
                        </div>
                      @endif
                          
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!!$post->message!!}
                        @php $images=explode('@', $post->file); @endphp 
                             <div class="post-image">
                               @foreach($images as $image)
                                    <div class="col-md-3">
                                        <a class="example-image-link" href="{{Storage::url($image)}}" data-lightbox="example-set" ><img  style="width: 100%; margin-bottom: 20px; height: 250px" class="example-image" src="{{Storage::url($image)}}" alt=""/></a>
                                    </div>
                                @endforeach
                            </div>
                    </div>
<div  class="react-box" >
                  <hr>
                    <div class="col-md-4">
                      <a class="like" id="{{$post->id}}"><i id="icon{{$post->id}}" class="{{Helpers::like_status($post->user_id,$post->id)==1 ? 'fa fa-thumbs-up' : 'fa fa-thumbs-o-up' }}"></i> Like <span class="count" id="count{{$post->id}}">{{count($post->likes)}}</span></a>
                    </div>
                    <div class="col-md-4">
                      <a class="love" id="{{$post->id}}"><i id="icon_love{{$post->id}}" class="{{Helpers::love_status($post->user_id,$post->id)==1 ? 'fa fa-heart text-danger' : 'fa fa-heart-o' }}"></i> Love <span id="count_love{{$post->id}}">{{count($post->loves)}}</span></a>
                    </div>
                    <div class="col-md-4">
                      <a role="button" data-toggle="collapse" href="#collapseExample{{$post->id}}" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-comment-o"></i> Comment <span>0</span></a>
                    </div>
                    <div class="col-md-12">
                      <div class="collapse" id="collapseExample{{$post->id}}" style="margin-top: 20px">
                        <div class="well">
                          <ul style="list-style: none;">
                            @if($post->comments)
                              @foreach($post->comments as $comment)
                                @if($comment->parent==0)
                                <li>
                                <div class="image">
                                  @if($comment->db==1)
                                  @if(($comment->user->group_id==1))
                                                  <img src="{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @elseif(($post->user->group_id==2))
                                                  <img src="{{Storage::url($comment->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                              @elseif(($comment->user->group_id==3 || $post->user->group_id==5))
                                                  <img src="{{Storage::url($comment->user->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @elseif(($comment->user->group_id==4))
                                                  <img src="{{Storage::url($comment->user->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @elseif(($comment->user->group_id==6))
                                                  <img src="{{Storage::url($comment->user->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @endif 
                                </div>
                                <div class="text">
                                  <h6><a href="{{url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db)}}"><b>{{$comment->user->name}}</b></a> , <span>
                                    @if($comment->user->group_id==1)
                                      Company
                                    @else()
                                      {{$comment->school->user->name}}
                                    @endif
                                  </span></h6>
                                  <p><span>{{$comment->user->group->name}},  </span> {{$comment->created_at->diffForHumans()}}</p>
                                  
                                </div>
                                @endif
                                @if($comment->db==2)
                                <div class="image">
                                  @if(($comment->user2->group_id==1))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user2->group_id==2))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url($comment->school2->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                                @elseif(($comment->user2->group_id==3 || $comment->user->group_id==5))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url($comment->user2->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user2->group_id==4))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url($comment->user2->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user2->group_id==6))
                                                    <img src="{{Helpers::db2_url()}} {{Storage::url($comment->user2->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @endif 
                                  </div>
                                  <div class="text">
                                    <h6><a href="{{url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db)}}"><b>{{$comment->user2->name}}</b></a> , <span>
                                      @if($comment->user2->group_id==1)
                                        Company
                                      @else()
                                        {{$comment->school2->user->name}}
                                      @endif
                                    </span></h6>
                                    <p><span>{{$comment->user2->group->name}},  </span> {{$comment->created_at->diffForHumans()}}</p>
                                  </div>
                                @endif
                                @if($comment->db==3)
                                <div class="image">
                                  @if(($comment->user3->group_id==1))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user3->group_id==2))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url($comment->school3->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                                @elseif(($comment->user3->group_id==3 || $comment->user->group_id==5))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url($comment->user3->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user3->group_id==4))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url($comment->user3->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user3->group_id==6))
                                                    <img src="{{Helpers::db3_url()}} {{Storage::url($comment->user3->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                            @endif
                                            </div>
                                            <div class="text">
                                              <h6><a href="{{url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db)}}"><b>{{$comment->user3->name}}</b></a> , <span>
                                                @if($comment->user3->group_id==1)
                                                  Company
                                                @else()
                                                  {{$comment->school3->user->name}}
                                                @endif
                                              </span></h6>
                                              <p><span>{{$comment->user3->group->name}},  </span> {{$comment->created_at->diffForHumans()}}</p>
                                            </div>
                                        @endif 

                                        @if($comment->db==4)
                                        <div class="image">
                                  @if(($comment->user4->group_id==1))

                                                    <img src="{{Helpers::db4_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user4->group_id==2))
                                                    <img src="{{Helpers::db4_url()}}{{Storage::url($comment->school4->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                                @elseif(($comment->user4->group_id==3 || $comment->user->group_id==5))
                                                    <img src="{{Helpers::db4_url()}}{{Storage::url($comment->user4->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user4->group_id==4))
                                                    <img src="{{Helpers::db4_url()}}{{Storage::url($comment->user4->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($comment->user4->group_id==6))
                                                    <img src="{{Helpers::db4_url()}} {{Storage::url($comment->user4->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                            @endif 
                                            </div>
                                            <div class="text">
                                              <h6><a href="{{url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db)}}"><b>{{$comment->user3->name}}</b></a> , <span>
                                                @if($comment->user4->group_id==1)
                                                  Company
                                                @else()
                                                  {{$comment->school4->user->name}}
                                                @endif
                                              </span></h6>
                                              <p><span>{{$comment->user3->group->name}},  </span> {{$comment->created_at->diffForHumans()}}</p>
                                            </div>
                                        @endif 
                                        <div class="clearfix" style="width: 100%; float: right; padding-left: 50px;">
                                          
                                      {{$comment->text}}
                                    
                                  </div>
                                <hr>
                                  @php
                                  $reply=Helpers::comment_reply($comment->id);@endphp

                                    @foreach($reply as $reply) 
                              <ul style="list-style: none;">
                                <li>
                                <div class="image">
                                  @if($reply->db==1)
                                  @if(($reply->user->group_id==1))
                                                  <img src="{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @elseif(($post->user->group_id==2))
                                                  <img src="{{Storage::url($reply->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                              @elseif(($reply->user->group_id==3 || $post->user->group_id==5))
                                                  <img src="{{Storage::url($reply->user->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @elseif(($reply->user->group_id==4))
                                                  <img src="{{Storage::url($reply->user->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @elseif(($reply->user->group_id==6))
                                                  <img src="{{Storage::url($reply->user->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                              @endif 
                                </div>
                                <div class="text">
                                  <h6><a href="{{url('reply/creator/profile/'.$reply->user_id.'/'.$reply->db)}}"><b>{{$reply->user->name}}</b></a> , <span>
                                    @if($reply->user->group_id==1)
                                      Company
                                    @else()
                                      {{$reply->school->user->name}}
                                    @endif
                                  </span></h6>
                                  <p><span>{{$reply->user->group->name}},  </span> {{$reply->created_at->diffForHumans()}}</p>
                                  
                                </div>
                                @endif
                                @if($reply->db==2)
                                <div class="image">
                                  @if(($reply->user2->group_id==1))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user2->group_id==2))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url($reply->school2->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                                @elseif(($reply->user2->group_id==3 || $reply->user->group_id==5))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url($reply->user2->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user2->group_id==4))
                                                    <img src="{{Helpers::db2_url()}}{{Storage::url($reply->user2->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user2->group_id==6))
                                                    <img src="{{Helpers::db2_url()}} {{Storage::url($reply->user2->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @endif 
                                  </div>
                                  <div class="text">
                                    <h6><a href="{{url('reply/creator/profile/'.$reply->user_id.'/'.$reply->db)}}"><b>{{$reply->user2->name}}</b></a> , <span>
                                      @if($reply->user2->group_id==1)
                                      Company
                                      @else()
                                        {{$reply->school2->user->name}}
                                      @endif
                                    </span></h6>
                                    <p><span>{{$reply->user2->group->name}},  </span> {{$reply->created_at->diffForHumans()}}</p>
                                  </div>
                                @endif
                                @if($reply->db==3)
                                <div class="image">
                                  @if(($reply->user3->group_id==1))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user3->group_id==2))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url($reply->school3->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                                @elseif(($reply->user3->group_id==3 || $reply->user->group_id==5))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url($reply->user3->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user3->group_id==4))
                                                    <img src="{{Helpers::db3_url()}}{{Storage::url($reply->user3->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user3->group_id==6))
                                                    <img src="{{Helpers::db3_url()}} {{Storage::url($reply->user3->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                            @endif
                                            </div>
                                            <div class="text">
                                              <h6><a href="{{url('reply/creator/profile/'.$reply->user_id.'/'.$reply->db)}}"><b>{{$reply->user3->name}}</b></a> , <span>
                                                @if($reply->user3->group_id==1)
                                      Company
                                      @else()
                                        {{$reply->school3->user->name}}
                                      @endif
                                              </span></h6>
                                              <p><span>{{$reply->user3->group->name}},  </span> {{$reply->created_at->diffForHumans()}}</p>
                                            </div>
                                        @endif 

                                        @if($reply->db==4)
                                        <div class="image">
                                  @if(($reply->user4->group_id==1))
                                                    <img src="{{Helpers::db4_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user4->group_id==2))
                                                    <img src="{{Helpers::db4_url()}}{{Storage::url($reply->school4->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                                @elseif(($reply->user4->group_id==3 || $reply->user->group_id==5))
                                                    <img src="{{Helpers::db4_url()}}{{Storage::url($reply->user4->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user4->group_id==4))
                                                    <img src="{{Helpers::db4_url()}}{{Storage::url($reply->user4->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                                @elseif(($reply->user4->group_id==6))
                                                    <img src="{{Helpers::db4_url()}} {{Storage::url($reply->user4->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                            @endif 
                                            </div>
                                            <div class="text">
                                              <h6><a href="{{url('reply/creator/profile/'.$reply->user_id.'/'.$reply->db)}}"><b>{{$reply->user4->name}}</b></a> , <span>

                                                @if($reply->user4->group_id==1)
                                        Company
                                      @else()
                                        {{$reply->school4->user->name}}
                                      @endif
                                              </span></h6>
                                              <p><span>{{$reply->user4->group->name}},  </span> {{$reply->created_at->diffForHumans()}}</p>
                                            </div>
                                        @endif 
                                        <div class="clearfix" style="width: 100%; float: right; padding-left: 50px;">
                                          
                                      {{$reply->text}}
                                    
                                  </div>
                                </li>
                                <hr>
                              </ul>
                            @endforeach
                                
                                <form class="form-horizontal submit_comment" >
                                {{csrf_field()}}
                                  <div class="form-group">
                                    <input type="hidden" name="post_id" value="{{$comment->post->id}}">
                                    <input type="hidden" name="parent" value="{{$comment->id}}">
                                    <div class="col-sm-11">
                                      <input type="text" class="form-control comment_text" id="" placeholder="Comment here ..." name="text">
                                    </div>
                                    <div class="col-sm-1">
                                      <button class="btn btn-primary" type="submit"><i class="fa fa-comment"></i></button>
                                    </div>
                                  </div>
                              </form>
                              @endif
                              @endforeach

                            @endif
                          </ul>
                          <form class="form-horizontal submit_comment" id="submit_comment">
                            {{csrf_field()}}
                            <div class="form-group">
                              <input type="hidden" name="post_id" value="{{$post->id}}">
                              <div class="col-sm-11">
                                <input type="text" class="form-control comment_text" id="" placeholder="Comment here ..." name="text">
                              </div>
                              <div class="col-sm-1">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-comment"></i></button>
                              </div>
                            </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                
            </div>
        </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/lightbox-plus-jquery.js')}}"></script>
    
    <script type="text/javascript">var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:1e3,fadeduration:[500,100]},controlHTML:'<img src="https://i1155.photobucket.com/albums/p559/scrolltotop/arrow23.png" />',controlattrs:{offsetx:5,offsety:5},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();</script>


    <script src="//cdn.ckeditor.com/4.14.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'message' );
    </script>

    <script >
        $(document).ready(function(){
            var i=1;
          $(".more_image").click(function(){
            i++;
            $(".more_div").append('<div class="col-sm-3" style="padding-top: 10px;"> <input type="file" name="file[]" onchange="openFile(event)" accept="image/*" class="file" id="file-'+i+'"></div>');

            $(".more_div").append('<div class="col-sm-3" style="padding-top: 10px;"> <img id="header_background_logo-file-'+i+'" width="100px" height="120px" src="" style="border: 4px solid #fff;"></div>');
                      
          });

        });
        var openFile = function(event) {
          var input = event.target;
          var input_id = event.target.id;
          var show_image='header_background_logo-'+input_id;
          console.log('header_background_logo-'+input_id);
          var reader = new FileReader();
          reader.onload = function(){
          var dataURL = reader.result;
          var output = document.getElementById(show_image);
          output.src = dataURL;
          };
          reader.readAsDataURL(input.files[0]);
          };
    </script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.like',function(){
      // console.log("hmm its change");
      var post_id=$(this).attr(('id'));
      $.ajax({
        type:'get',
        url:'{!!URL::to('/post/like')!!}',
        data:{'post_id':post_id,'react':1},
        success:function(data){
          var count= '#count'+post_id;
          var icon= '#icon'+post_id;
          $(count).html(data[0].count_react);
          if (data[0].like==1) {
            $(icon).attr('class', 'fa fa-thumbs-up');
          }else{
            $(icon).attr('class', 'fa fa-thumbs-o-up');
          }
        },
        error:function(){
            console.log('error');
        }
      });
    });
});
  
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.love',function(){
      // console.log("hmm its change");
      var post_id=$(this).attr(('id'));
      $.ajax({
        type:'get',
        url:'{!!URL::to('/post/love')!!}',
        data:{'post_id':post_id,'react':2},
        success:function(data){
          var count= '#count_love'+post_id;
          var icon= '#icon_love'+post_id;
          $(count).html(data[0].count_react);
          if (data[0].love==1) {
            $(icon).attr('class', 'fa fa-heart text-danger');
          }else{
            $(icon).attr('class', 'fa fa-heart-o');
          }
        },
        error:function(){
            console.log('error');
        }
      });
    });
});
  
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('form.submit_comment').on('submit',function(){
       //console.log("cmt");
      //return false;
      var frm=$(this);
      var post_id=frm[0][1].value;
      $.ajax({
        type:'post',
        url:'{!!URL::to('/add/comment')!!}',
        data:frm.serialize(),
        success:function(data){
          $('.comment_text').val("");
          $('#collapseExample'+post_id).html(data);
        },
        error:function(){
          console.log('error');
        }
      });
        return false;
    });
});
  
</script>
@endsection
