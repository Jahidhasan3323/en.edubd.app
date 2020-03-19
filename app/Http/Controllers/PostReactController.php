<?php

namespace App\Http\Controllers;

use App\PostReact;
use App\Post;
use Illuminate\Http\Request;
use Auth;
class PostReactController extends Controller
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
        $like=0;
        $post_id=$request->post_id;
        $post=Post::where('id',$post_id)->first();
        if (Auth::id()) {
            $user_id=Auth::id();
            $school_id=Auth::getSchool() ?? 0;
        }else{
            $user_id=0;
            $school_id=0;
        }
        //return response()->json($post_id);
       $check_duplicate_react= PostReact::where(['post_id'=>$post_id, 'react'=>1,'user_id'=>Auth::id(),'status'=>1])->count('id');
       if($check_duplicate_react>=1){
            PostReact::where(['post_id'=>$post_id, 'react'=>1,'user_id'=>Auth::id(),'status'=>1])->update(['status'=>0]);
       }else{
        PostReact::create(['react'=>$request->react,'post_id'=>$post_id,'user_id'=>$user_id,'school_id'=>$school_id,'post_creator'=>$post->user_id,'db'=>1]);
        $like=1;
        }
        $count_react=PostReact::where(['post_id'=>$post_id, 'react'=>1,'status'=>1])->count('id');
        $data['count_react']=$count_react;
        $data['like']=$like;
        return response()->json([$data]);
    }
    public function loveStore(Request $request)
    {
        $love=0;
        $post_id=$request->post_id;
        $post=Post::where('id',$post_id)->first();
        if (Auth::id()) {
            $user_id=Auth::id();
            $school_id=Auth::getSchool() ?? 0;
        }else{
            $user_id=0;
        }
       $check_duplicate_react= PostReact::where(['post_id'=>$post_id, 'react'=>2,'user_id'=>Auth::id(),'status'=>1])->count('id');
       if($check_duplicate_react>=1){
            PostReact::where(['post_id'=>$post_id, 'react'=>2,'user_id'=>Auth::id(),'status'=>1])->update(['status'=>0]);
       }else{
        PostReact::create(['react'=>$request->react,'post_id'=>$post_id,'user_id'=>$user_id,'school_id'=>$school_id,'post_creator'=>$post->user_id,'db'=>1]);
        $love=1;
        }
        $count_react=PostReact::where(['post_id'=>$post_id, 'react'=>2,'status'=>1])->count('id');
        $data['count_react']=$count_react;
        $data['love']=$love;
        return response()->json([$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostReact  $postReact
     * @return \Illuminate\Http\Response
     */
    public function show(PostReact $postReact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostReact  $postReact
     * @return \Illuminate\Http\Response
     */
    public function edit(PostReact $postReact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostReact  $postReact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostReact $postReact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostReact  $postReact
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostReact $postReact)
    {
        //
    }
}
