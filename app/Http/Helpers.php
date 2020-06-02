<?php
use App\Post;
use App\PostReact;
use App\PostComment;
	class Helpers{
		public static function db2_url(){
			return 'https://en.edubd.app';
		}
		public static function db3_url(){
			return 'https://madrasah.edubd.app';
		}
		public static function db4_url(){
			return 'https://technical.edubd.app';
		}
		public static function like_status($user_id,$post_id){
			return PostReact::where(['user_id'=>$user_id,'post_id'=>$post_id,'react'=>1, 'status'=>1])->count();
		}
		public static function love_status($user_id,$post_id){
			return PostReact::where(['user_id'=>$user_id,'post_id'=>$post_id,'react'=>2, 'status'=>1])->count();
		}

		public static function comment_reply($comment_id){
			return PostComment::where(['parent'=>$comment_id,'status'=>1])->get();
		}



	}
?>