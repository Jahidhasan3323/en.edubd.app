<?php

namespace App\Http\Controllers;

use App\WmSchool;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Storage;
use File;

class WmSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $body_background;
    protected $header_background_logo;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       if(!Auth::is('admin')){
            return redirect('/home');
        }
        $school_details =WmSchool::where('school_id', Auth::getSchool())->first();
        return view('backEnd.webmanagement.school.index',compact('school_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WmSchool  $wmSchool
     * @return \Illuminate\Http\Response
     */
    public function show(WmSchool $wmSchool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WmSchool  $wmSchool
     * @return \Illuminate\Http\Response
     */
    public function edit(WmSchool $wmSchool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WmSchool  $wmSchool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
       $data=$request->except('_token','_method');

        $this->validate($request, [
            'body_background' => 'nullable|image|max:2048',
            'header_background_logo' => 'nullable|image|max:2048',
            'video' => 'mimes:mp4,mov,ogg,mkv,3gp,vga|max:100048',
            'copyright' => 'required',
        ]);
        $wmSchool=WmSchool::where('school_id', Auth::getSchool())->first();
        if($imageFile = $request->file('body_background')){
           $this->body_background=$this->imagesProcessing1($imageFile,'webmanagement/school/background',626,417);
           $data['body_background'] = $this->body_background;
           if (isset($wmSchool->body_background)&&file_exists(public_path(Storage::url($wmSchool->body_background)))){
                Storage::delete($wmSchool->body_background);
            }
        }
        if($imageFile = $request->file('header_background_logo')){
           $this->header_background_logo=$this->imagesProcessing1($imageFile,'webmanagement/school/header',626,417);
           $data['header_background_logo'] = $this->header_background_logo;
           if (isset($wmSchool->body_background)&&file_exists(public_path(Storage::url($wmSchool->header_background_logo)))){
                Storage::delete($wmSchool->header_background_logo);
            }
        }
        if( $request->file('video')){
            $picture=$_FILES["video"]["name"];
            $file_tmp=$_FILES["video"]["tmp_name"];
            $ext=pathinfo($picture,PATHINFO_EXTENSION);
            $data['video'] = $request->file('video')->storeAs('public/video/', 'video'.rand(10,100000).'.'.$ext);
            if (isset($wmSchool->video)&&file_exists(public_path(Storage::url($wmSchool->video)))){
                 Storage::delete($wmSchool->video);
            }
        }
        if(!$wmSchool){
            WmSchool::create($data);
        }else{
            $wmSchool->update($data);
        }
        return $this->returnWithSuccess('আপনার তথ্য পরিবর্তন হয়েছে !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WmSchool  $wmSchool
     * @return \Illuminate\Http\Response
     */
    public function destroy(WmSchool $wmSchool)
    {
        //
    }


    public function is_admin()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
    }


    public function reset_color()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
       
        $data['content_heading_background']='#000099';
        $data['content_heading_color']='#fff';
        $data['sidebar_heading_background']='#800040';
        $data['sidebar_heading_color']='#fff';
        $data['body_background']=NULL;
        $data['header_background_logo']=NULL;
        $data['video']=NULL;
        $wmSchool=WmSchool::where('school_id', Auth::getSchool())->first();
        if ($wmSchool) {
            if (file_exists(public_path(Storage::url($wmSchool->body_background)))){
                Storage::delete($wmSchool->body_background);
            }
            if (file_exists(public_path(Storage::url($wmSchool->header_background_logo)))){
                Storage::delete($wmSchool->header_background_logo);
            }
            if (file_exists(public_path(Storage::url($wmSchool->video)))){
                Storage::delete($wmSchool->video);
            }
            $wmSchool->update($data);

            return $this->returnWithSuccess('আপনার তথ্য পরিবর্তন হয়েছে !');
        }else{
            return $this->returnWithError('আপনি কোন তথ্য যোগ করেন নাই !');
        }
    }

    
}
