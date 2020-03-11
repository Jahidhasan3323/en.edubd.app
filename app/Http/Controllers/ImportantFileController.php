<?php

namespace App\Http\Controllers;

use App\ImportantFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
class ImportantFileController extends Controller
{
    
    public function index()
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
        $important_forms=ImportantFile::orderBy('id','DESC')->get();
        return view('backEnd.importantFile.index', compact('important_forms'));
    }


    public function store(Request $request)
    {
        if(!Auth::is('root')){
            return redirect('/home');
        }
         $data=$request->all();

        $this->validate($request, [
            'tittle' => 'required',
            'file' => 'required',
            'type' => 'required',
        ]);

       if($request->file){
            $file=$_FILES["file"]["name"];
                $file_tmp=$_FILES["file"]["tmp_name"];
               $ext=pathinfo($file,PATHINFO_EXTENSION);
        $data['file'] = $request->file('file')->storeAs('public/importantfile/', 'file'.rand(10,100000).'.'.$ext);
        }
        ImportantFile::create($data);
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');

    }

    public function show($id)
    {
        
    }

    
    public function destroy($id)
    {
        if (!Auth::is('root')){
            return redirect('/home');
        }
        $important_file=ImportantFile::where(['id'=>$id])->first();
        $important_file->delete();
        if (isset($important_file->file)&&file_exists(public_path(Storage::url($important_file->file)))){
                Storage::delete($important_file->file);
            }
        return $this->returnWithSuccess('আপনার তথ্য মুছে দেওয়া হয়েছে ');
    }


    public function important_form()
    {
        if(!Auth::is('admin')){
            return redirect('/home');
        }
        $important_forms=ImportantFile::where('type',1)->orderBy('id','DESC')->get();
        return view('backEnd.importantFile.important_form', compact('important_forms'));
    }

    
}
