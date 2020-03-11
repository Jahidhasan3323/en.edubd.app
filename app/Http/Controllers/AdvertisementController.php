<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertisement;
use Session;
use Illuminate\Support\Str;

class AdvertisementController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $advertisement = Advertisement::first();
        return view('backEnd.advertisement.create',compact('advertisement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation_form($request);
        $data =$request->except([
            'top_banner_advertisement',
            'slider_bottom_advertisement',
            'footer_advertisement',
            'slider_right_advertisement',
            'slider_left_advertisement',
            'sitebar_right_advertisement',
            'sitebar_bottom_advertisement',
        ]);
        if($request->hasFile('top_banner_advertisement')){
            $url=$this->fileUpload($request->file('top_banner_advertisement'));
            $data['top_banner_advertisement']=$url;
        }
        if($request->hasFile('slider_bottom_advertisement')){
            $url=$this->fileUpload($request->file('slider_bottom_advertisement'));
            $data['slider_bottom_advertisement']=$url;
        }
        if($request->hasFile('footer_advertisement')){
            $url=$this->fileUpload($request->file('footer_advertisement'));
            $data['footer_advertisement']=$url;
        }
        if($request->hasFile('slider_right_advertisement')){
            $url=$this->fileUpload($request->file('slider_right_advertisement'));
            $data['slider_right_advertisement']=$url;
        }
        if($request->hasFile('slider_left_advertisement')){
            $url=$this->fileUpload($request->file('slider_left_advertisement'));
            $data['slider_left_advertisement']=$url;
        }
        if($request->hasFile('sitebar_right_advertisement')){
            $url=$this->fileUpload($request->file('sitebar_right_advertisement'));
            $data['sitebar_right_advertisement']=$url;
        }
        if($request->hasFile('sitebar_bottom_advertisement')){
            $url=$this->fileUpload($request->file('sitebar_bottom_advertisement'));
            $data['sitebar_bottom_advertisement']=$url;
        }

        try {
            Advertisement::create($data);
            Session::flash('sccmgs', 'Successfully created !');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('errmgs', 'Opps, Something going wrong !'.$e->getMessage());
             return redirect()->back();
        }
    }

    private function fileUpload($file){
        if($file){
          $name = Str::random(20).'.'.$file->getClientOriginalExtension();
          $destinationPath = 'public/uploadedImages/advertisements';
          $url = $destinationPath . "/" . $name;
          $file->move($destinationPath, $name);
          return $url;
        }
    }

    protected function validation_form($request){
        $this->validate($request,[
            'top_banner_advertisement'=>'nullable|image|dimensions:min_width=1140,max_width=1200',
            'slider_bottom_advertisement'=>'nullable|image|dimensions:min_width=500,max_width=800',
            'footer_advertisement'=>'nullable|image|dimensions:min_width=500,max_width=800',

            'slider_right_advertisement'=>'nullable|image|dimensions:min_width=100,max_width=200',
            'slider_left_advertisement'=>'nullable|image|dimensions:min_width=100,max_width=200',
            'sitebar_right_advertisement'=>'nullable|image|dimensions:min_width=100,max_width=200',
            'sitebar_bottom_advertisement'=>'nullable|image|dimensions:min_width=100,max_width=200',
        ]);
    }
   
    public function update(Request $request, $id)
    {
        $this->validation_form($request);
        $advertisement = Advertisement::where('id',$id)->first();
        $data=array();
        if($request->hasFile('top_banner_advertisement')){
            $url=$this->fileUpload($request->file('top_banner_advertisement'));
            $data['top_banner_advertisement']=$url;
            if(file_exists($advertisement->top_banner_advertisement)){
                unlink($advertisement->top_banner_advertisement);
            }
        }
        if($request->hasFile('slider_bottom_advertisement')){
            $url=$this->fileUpload($request->file('slider_bottom_advertisement'));
            $data['slider_bottom_advertisement']=$url;
            if(file_exists($advertisement->slider_bottom_advertisement)){
                unlink($advertisement->slider_bottom_advertisement);
            }
        }
        if($request->hasFile('footer_advertisement')){
            $url=$this->fileUpload($request->file('footer_advertisement'));
            $data['footer_advertisement']=$url;
            if(file_exists($advertisement->footer_advertisement)){
                unlink($advertisement->footer_advertisement);
            }
        }
        if($request->hasFile('slider_right_advertisement')){
            $url=$this->fileUpload($request->file('slider_right_advertisement'));
            $data['slider_right_advertisement']=$url;
            if(file_exists($advertisement->slider_right_advertisement)){
                unlink($advertisement->slider_right_advertisement);
            }
        }
        if($request->hasFile('slider_left_advertisement')){
            $url=$this->fileUpload($request->file('slider_left_advertisement'));
            $data['slider_left_advertisement']=$url;
            if(file_exists($advertisement->slider_left_advertisement)){
                unlink($advertisement->slider_left_advertisement);
            }
        }
        if($request->hasFile('sitebar_right_advertisement')){
            $url=$this->fileUpload($request->file('sitebar_right_advertisement'));
            $data['sitebar_right_advertisement']=$url;
            if(file_exists($advertisement->sitebar_right_advertisement)){
                unlink($advertisement->sitebar_right_advertisement);
            }
        }
        if($request->hasFile('sitebar_bottom_advertisement')){
            $url=$this->fileUpload($request->file('sitebar_bottom_advertisement'));
            $data['sitebar_bottom_advertisement']=$url;
            if(file_exists($advertisement->sitebar_bottom_advertisement)){
                unlink($advertisement->sitebar_bottom_advertisement);
            }
        }

        try {
            $advertisement->update($data);
            Session::flash('sccmgs', 'Successfully updated !');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('errmgs', 'Opps, Something going wrong !'.$e->getMessage());
             return redirect()->back();
        }
    }


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
