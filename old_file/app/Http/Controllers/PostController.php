<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\UserDb2;
use App\UserDb3;
use App\UserDb4;
use App\PostComment;
use Illuminate\Http\Request;
use Auth;
use DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        $posts=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves','comments')->where('status',1)->orderby('id','DESC')->get();
        //dd($posts);
        return view('backEnd.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data=$request->all();
       if($imageFiles = $request->file('file')){
            foreach ($imageFiles as $imageFile) {
               $image_file=$this->imagesProcessing1($imageFile,'post/',350,350);
               $abc[]=$image_file;
            }
             $a=implode("@",$abc);
            $data['file']=$a;
        }
      
       Post::create($data);
       return $this->returnWithSuccessRedirect('আপনার পোস্ট আপলোড হয়েছে','post'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::is('admin')){
            $post=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->where(['id'=>$id,'school_id'=>Auth::getSchool()])->first();
        }
        if(Auth::is('root')){
            $post=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->where(['id'=>$id])->first();
        }
        return view('backEnd.post.view',compact('post'));
    }
 public function details($id)
    {
        $post=Post::with('school.user','user','likes','loves')->where(['id'=>$id,'status'=>1])->first();
       
        return view('backEnd.post.post_details',compact('post'));
    }

    public function profile($db)
    {
        $id=Auth::id();
        if($db==1){
           $user=User::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }elseif($db==2){
           $user=UserDb2::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }elseif($db==3){
           $user=UserDb3::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }elseif($db==4){
           $user=UserDb4::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }
        //dd($user);
        $posts=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->where(['status'=>1,'user_id'=>$id,'db'=>$db])->orderby('id','DESC')->get();
        //dd($posts);
        return view('backEnd.post.profile',compact('posts','user','db'));
    }
    public function creator_profile($id, $db)
    {
        if($db==1){
           $user=User::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }elseif($db==2){
           $user=UserDb2::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }elseif($db==3){
           $user=UserDb3::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }elseif($db==4){
           $user=UserDb4::with('student','staff', 'committee')->where(['id'=>$id])->first();
        }
        //dd($user);
        $posts=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->where(['status'=>1,'user_id'=>$id,'db'=>$db])->orderby('id','DESC')->get();
        //dd($posts);
        return view('backEnd.post.profile',compact('posts','user','db'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function pending_list()
    {

        if(Auth::is('admin')){
            if($this->school()->social_post_access==0){
                return $this->returnWithErrorRedirect('আপনার এই অংশের এক্সেস নেই ! ', 'home');
            }
            $posts=Post::with('school.user','user')->where(['status'=>0,'school_id'=>Auth::getSchool(),'db'=>1])->orderby('id','DESC')->get();
        }
        if(Auth::is('root')){
            $posts=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->where(['status'=>0])->orderby('id','DESC')->get();
        }
        return view('backEnd.post.confermation_list',compact('posts'));
    }
    public function accept_list()
    {
        if(Auth::is('admin')){
            if($this->school()->social_post_access==0){
                return $this->returnWithErrorRedirect('আপনার এই অংশের এক্সেস নেই ! ', 'home');
            }
            $posts=Post::with('school.user','user')->where(['status'=>1,'school_id'=>Auth::getSchool(),'db'=>1])->orderby('id','DESC')->get();
        }
        if(Auth::is('root')){
            $posts=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->where(['status'=>1])->orderby('id','DESC')->get();
        }
        return view('backEnd.post.confermation_list',compact('posts'));
    }
    public function cancel_list()
    {
        if(Auth::is('admin')){
            if($this->school()->social_post_access==0){
                return $this->returnWithErrorRedirect('আপনার এই অংশের এক্সেস নেই ! ', 'home');
            }
            $posts=Post::with('school.user','user')->where(['status'=>2,'school_id'=>Auth::getSchool(),'db'=>1])->orderby('id','DESC')->get();
        }
        if(Auth::is('root')){
           $posts=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->where(['status'=>2])->orderby('id','DESC')->get();
        }
        return view('backEnd.post.confermation_list',compact('posts'));
    }
    public function delete_list()
    {
        if(Auth::is('admin')){
            $posts=Post::with('school.user','user')->where(['school_id'=>Auth::getSchool(),'db'=>1])->onlyTrashed()->orderby('id','DESC')->get();
        }
        if(Auth::is('root')){
            $posts=Post::with('school.user','school2.user','school3.user','school4.user','school','school2','school3','school4','user.school','user.student','user.staff','user.committee','user.group','user2.school','user2.student','user2.staff','user2.committee','user3.school','user3.student','user3.staff','user4.school','user4.student','user4.staff','user4.committee','likes','loves')->orderby('id','DESC')->onlyTrashed()->get();
        }
        return view('backEnd.post.confermation_list',compact('posts'));
    }

    public function accept($id)
    {
        if (Auth::is('root')) {
            Post::where(['id'=>$id])->update(['status'=>1]);
        }else{
            Post::where(['id'=>$id, 'school_id'=>Auth::getSchool()])->update(['status'=>1]);
        }
        return $this->returnWithSuccess('পোস্ট একসেপ্ট হয়েছে'); 
    }
    public function cancel($id)
    {
        if (Auth::is('root')) {
            Post::where(['id'=>$id])->update(['status'=>2]);
        }else{
            Post::where(['id'=>$id, 'school_id'=>Auth::getSchool()])->update(['status'=>2]);
        }
        return $this->returnWithSuccess('পোস্ট বাতিল করা হয়েছে'); 
    }
}
