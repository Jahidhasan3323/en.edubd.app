<?php

namespace App\Http\Controllers;

use App\PostComment;
use App\Post;
use Illuminate\Http\Request;
use Helpers;
use Storage;
use Auth;
class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=Post::where('id',$request->post_id)->first();
        $data=$request->all();
        $data['db']=1;
        $data['user_id']=Auth::id();
        $data['school_id']=Auth::getSchool() ?? 0;
        $data['post_creator']=$post->user_id;
        PostComment::create($data);

        $comments=PostComment::where('post_id',$request->post_id)->orderby('id','DESC')->get(); ?>
            <div class="well">
			    <ul style="list-style: none;">
			    	<?php if($post->comments){
        				foreach($post->comments as $comment){
        				  	if($comment->parent==0){ ?>
        				  <li>
				  				<div class="image">
				  					<?php if($comment->db==1){
			        					if($comment->user->group_id==1){ ?>
		                                    <img src="<?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php }elseif($comment->user->group_id==2){ ?>
		                                    <img src="<?= Storage::url($comment->school->logo) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
		                                
		                                <?php }elseif($comment->user->group_id==3 || $post->user->group_id==5){ ?>
		                                    <img src="<?= Storage::url($comment->user->staff->photo) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php }elseif($comment->user->group_id==4){ ?>
		                                    <img src="<?= Storage::url($comment->user->student->photo) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                               <?php }
		                                elseif($comment->user->group_id==6){ ?>
		                                    <img src="<?= Storage::url($comment->user->committee->image)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php }else{} ?>
		                                
			        				</div>
			        				<div class="text">
			        					<h6><a href="<?= url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db) ?>"><b><?= $comment->user->name?></b></a> , <span>
			        						<?php
			        							if($comment->user->group_id==1){
			        								echo "Company";
			        							}else{
			        								echo $comment->school->user->name;
			        							}
			        						?>
			        						
			        					</span></h6>
			        					<p><span><?=$comment->user->group->name?>,  </span> <?=$comment->created_at->diffForHumans()?></p>
			        					
			        				</div>
		        				<?php }
		        				if($comment->db==2){ ?>
		        				<div class="image">
			        				<?php if($comment->user2->group_id==1){ ?>
		                                    <img src="<?= Helpers::db2_url()?> <?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php } elseif($comment->user2->group_id==2){ ?>
		                                    <img src="<?= Helpers::db2_url()?> <?= Storage::url($comment->school2->logo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
		                                <?php } elseif($comment->user2->group_id==3 || $comment->user->group_id==5){ ?>
		                                    <img src="<?= Helpers::db2_url()?> <?=Storage::url($comment->user2->staff->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php }elseif($comment->user2->group_id==4){ ?>
		                                    <img src="<?= Helpers::db2_url()?> <?=Storage::url($comment->user2->student->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php } elseif($comment->user2->group_id==6){ ?>
		                                    <img src="<?= Helpers::db2_url()?> <?=Storage::url($comment->user2->committee->image) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                               <?php  } else{}?> 
			        				</div>
			        				<div class="text">
			        					<h6><a href="<?= url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db)?>"><b><?= $comment->user2->name?></b></a> , <span>
			        						<?php
			        							if($comment->user2->group_id==1){
			        								echo "Company";
			        							}else{
			        								echo $comment->school2->user->name;
			        							}
			        						?>
			        						</span></h6>
			        					<p><span><?= $comment->user2->group->name ?>,  </span> <?= $comment->created_at->diffForHumans()?></p>
			        				</div>
			        			<?php } 
			        			if($comment->db==3){ ?>
		        				<div class="image">
			        				<?php if($comment->user3->group_id==1){ ?>
		                                    <img src="<?= Helpers::db3_url()?> <?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php } elseif($comment->user3->group_id==2){ ?>
		                                    <img src="<?= Helpers::db3_url()?> <?= Storage::url($comment->school3->logo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
		                                <?php } elseif($comment->user3->group_id==3 || $comment->user->group_id==5){ ?>
		                                    <img src="<?= Helpers::db3_url()?> <?=Storage::url($comment->user3->staff->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php }elseif($comment->user3->group_id==4){ ?>
		                                    <img src="<?= Helpers::db3_url()?> <?=Storage::url($comment->user3->student->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php } elseif($comment->user3->group_id==6){ ?>
		                                    <img src="<?= Helpers::db3_url()?> <?=Storage::url($comment->user3->committee->image) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                               <?php  } else{}?> 
			        				</div>
			        				<div class="text">
			        					<h6><a href="<?= url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db)?>"><b><?= $comment->user3->name?></b></a> , <span>
			        						<?php
			        							if($comment->user3->group_id==1){
			        								echo "Company";
			        							}else{
			        								echo $comment->school3->user->name;
			        							}
			        						?>
			        							
			        						</span></h6>
			        					<p><span><?= $comment->user3->group->name ?>,  </span> <?= $comment->created_at->diffForHumans()?></p>
			        				</div>
			        			<?php } 
			        			if($comment->db==4){ ?>
		        				<div class="image">
			        				<?php if($comment->user4->group_id==1){ ?>
		                                    <img src="<?= Helpers::db4_url()?> <?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php } elseif($comment->user4->group_id==2){ ?>
		                                    <img src="<?= Helpers::db4_url()?> <?= Storage::url($comment->school4->logo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 


		                                <?php } elseif($comment->user4->group_id==3 || $comment->user->group_id==5){ ?>
		                                    <img src="<?= Helpers::db4_url()?> <?=Storage::url($comment->user4->staff->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php }elseif($comment->user4->group_id==4){ ?>
		                                    <img src="<?= Helpers::db4_url()?> <?=Storage::url($comment->user4->student->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                                <?php } elseif($comment->user4->group_id==6){ ?>
		                                    <img src="<?= Helpers::db4_url()?> <?=Storage::url($comment->user4->committee->image) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
		                               <?php  } else{}?> 
			        				</div>
			        				<div class="text">
			        					<h6><a href="<?= url('comment/creator/profile/'.$comment->user_id.'/'.$comment->db)?>"><b><?= $comment->user4->name?></b></a> , <span>
			        						<?php
			        							if($comment->user4->group_id==1){
			        								echo "Company";
			        							}else{
			        								echo $comment->school4->user->name;
			        							}
			        						?>
			        						</span></h6>
			        					<p><span><?= $comment->user4->group->name ?>,  </span> <?= $comment->created_at->diffForHumans()?></p>
			        				</div>
			        			<?php } ?>
                                <div class="clearfix" style="width: 100%; float: right; padding-left: 50px;">
                                	
        	  						<?= $comment->text?>
        	  						
        	  					</div>
        	  					<hr>
        	  					<?php 
			  					$reply=Helpers::comment_reply($comment->id);
			  					if($reply){
			  					foreach($reply as $reply){ ?>
						  			<ul style="list-style: none;">
						  			<li>
					  				<div class="image">
					  					<?php if($reply->db==1){
				        					if($reply->user->group_id==1){ ?>
			                                    <img src="<?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
			                                <?php }elseif($reply->user->group_id==2){ ?>
			                                    <img src="<?= Storage::url($reply->school->logo) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
			                                
			                                <?php }elseif($reply->user->group_id==3 || $post->user->group_id==5){ ?>
			                                    <img src="<?= Storage::url($reply->user->staff->photo) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
			                                <?php }elseif($reply->user->group_id==4){ ?>
			                                    <img src="<?= Storage::url($reply->user->student->photo) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
			                               <?php }
			                                elseif($reply->user->group_id==6){ ?>
			                                    <img src="<?= Storage::url($reply->user->committee->image)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
			                                <?php }else{} ?>
			                                
				        				</div>
				        				<div class="text">
				        					<h6><a href="<?= url('comment/creator/profile/'.$reply->user_id.'/'.$reply->db) ?>"><b><?= $reply->user->name?></b></a> , <span>
				        						<?php
				        							if($reply->user->group_id==1){
				        								echo "Company";
				        							}else{
				        								echo $reply->school->user->name;
				        							}
				        						?>
				        							
				        						</span></h6>
				        					<p><span><?=$reply->user->group->name?>,  </span> <?=$reply->created_at->diffForHumans()?></p>
				        					
				        				</div>
				        				<?php }
				        				if($reply->db==2){ ?>
				        				<div class="image">
					        				<?php if($reply->user2->group_id==1){ ?>
				                                    <img src="<?= Helpers::db2_url()?> <?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php } elseif($reply->user2->group_id==2){ ?>
				                                    <img src="<?= Helpers::db2_url()?> <?= Storage::url($reply->school2->logo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
				                                <?php } elseif($reply->user2->group_id==3 || $reply->user->group_id==5){ ?>
				                                    <img src="<?= Helpers::db2_url()?> <?=Storage::url($reply->user2->staff->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php }elseif($reply->user2->group_id==4){ ?>
				                                    <img src="<?= Helpers::db2_url()?> <?=Storage::url($reply->user2->student->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php } elseif($reply->user2->group_id==6){ ?>
				                                    <img src="<?= Helpers::db2_url()?> <?=Storage::url($reply->user2->committee->image) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                               <?php  } else{}?> 
					        				</div>
					        				<div class="text">
					        					<h6><a href="<?= url('comment/creator/profile/'.$reply->user_id.'/'.$reply->db)?>"><b><?= $reply->user2->name?></b></a> , <span>
					        						<?php
					        							if($reply->user2->group_id==1){
					        								echo "Company";
					        							}else{
					        								echo $reply->school2->user->name;
					        							}
					        						?>

					        							
					        						</span></h6>
					        					<p><span><?= $reply->user2->group->name ?>,  </span> <?= $reply->created_at->diffForHumans()?></p>
					        				</div>
					        			<?php } 
					        			if($reply->db==3){ ?>
				        				<div class="image">
					        				<?php if($reply->user3->group_id==1){ ?>
				                                    <img src="<?= Helpers::db3_url()?> <?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php } elseif($reply->user3->group_id==2){ ?>
				                                    <img src="<?= Helpers::db3_url()?> <?= Storage::url($reply->school3->logo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
				                                <?php } elseif($reply->user3->group_id==3 || $reply->user->group_id==5){ ?>
				                                    <img src="<?= Helpers::db3_url()?> <?=Storage::url($reply->user3->staff->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php }elseif($reply->user3->group_id==4){ ?>
				                                    <img src="<?= Helpers::db3_url()?> <?=Storage::url($reply->user3->student->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php } elseif($reply->user3->group_id==6){ ?>
				                                    <img src="<?= Helpers::db3_url()?> <?=Storage::url($reply->user3->committee->image) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                               <?php  } else{}?> 
					        				</div>
					        				<div class="text">
					        					<h6><a href="<?= url('comment/creator/profile/'.$reply->user_id.'/'.$reply->db)?>"><b><?= $reply->user3->name?></b></a> , <span>
					        						<?php
					        							if($reply->user3->group_id==1){
					        								echo "Company";
					        							}else{
					        								echo $reply->school3->user->name;
					        							}
					        						?>

					        							
					        						</span></h6>
					        					<p><span><?= $reply->user3->group->name ?>,  </span> <?= $reply->created_at->diffForHumans()?></p>
					        				</div>
					        			<?php }  
					        			if($reply->db==4){ ?>
				        				<div class="image">
					        				<?php if($reply->user4->group_id==1){ ?>
				                                    <img src="<?= Helpers::db4_url()?> <?= Storage::url('img/ehsan-logo.png')?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php } elseif($reply->user4->group_id==2){ ?>
				                                    <img src="<?= Helpers::db4_url()?> <?= Storage::url($reply->school4->logo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 


				                                <?php } elseif($reply->user4->group_id==3 || $reply->user->group_id==5){ ?>
				                                    <img src="<?= Helpers::db4_url()?> <?=Storage::url($reply->user4->staff->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php }elseif($reply->user4->group_id==4){ ?>
				                                    <img src="<?= Helpers::db4_url()?> <?=Storage::url($reply->user4->student->photo)?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                                <?php } elseif($reply->user4->group_id==6){ ?>
				                                    <img src="<?= Helpers::db4_url()?> <?=Storage::url($reply->user4->committee->image) ?>" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
				                               <?php  } else{}?> 
					        				</div>
					        				<div class="text">
					        					<h6><a href="<?= url('comment/creator/profile/'.$reply->user_id.'/'.$reply->db)?>"><b><?= $reply->user4->name?></b></a> , <span>
					        						<?php
					        							if($reply->user4->group_id==1){
					        								echo "Company";
					        							}else{
					        								echo $reply->school4->user->name;
					        							}
					        						?>
	
					        						</span></h6>
					        					<p><span><?= $reply->user4->group->name ?>,  </span> <?= $reply->created_at->diffForHumans()?></p>
					        				</div>
					        			<?php } ?>
		                                <div class="clearfix" style="width: 100%; float: right; padding-left: 50px;">
		                                	
		        	  						<?= $reply->text?>
		        	  						
		        	  					</div>
		        	  				</li>

					        		</ul>
	      				  				
			  					<?php  } }?>
			  					<form class="form-horizontal submit_comment" >
	        				    	<?= csrf_field()?>
		        				      <div class="form-group">
		        				        <input type="hidden" name="post_id" value="<?= $comment->post->id ?>">
		        				        <input type="hidden" name="parent" value="<?=$comment->id?>">
		        				        <div class="col-sm-11">
		        				          <input type="text" class="form-control comment_text" id="" placeholder="Comment here ..." name="text">
		        				        </div>
		        				        <div class="col-sm-1">
		        				        	<button class="btn btn-primary" type="submit"><i class="fa fa-comment"></i></button>
		        				        </div>
		        				      </div>
		        				  </form>

			    
			    	</li>
				<?php } 
			} 
		}?>	
			    </ul>
			    <form class="form-horizontal submit_comment" >
			    	<?= csrf_field()?> 
			      <div class="form-group">
			        <input type="hidden" name="post_id" value="<?=$post->id?>">
			        <div class="col-sm-11">
			          <input type="text" class="form-control comment_text" id="" placeholder="Comment here ..." name="text">
			        </div>
			        <div class="col-sm-1">
			        	<button class="btn btn-primary" type="submit"><i class="fa fa-comment"></i></button>
			        </div>
			      </div>
			  </form>
			</div>
    		

			<?php 
        //return response()->json($comment_html);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function edit(PostComment $postComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostComment $postComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostComment $postComment)
    {
        //
    }
}
