<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\MasterClass;
use App\Unit;
use Session;
use App\School;
use App\Student;
use App\Result;
use App\GroupClass;
use App\ExamType;
use App\AutoSmsSetup;
use App\AutoSms;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function returnWithSuccess($message){
         Session::flash('sccmgs', $message);
         return redirect()->back();
    }

    protected function returnWithError($message){
    	  Session::flash('errmgs', $message);
    	  return redirect()->back();
    }
    protected function returnWithSuccessRedirect($message,$page){
         Session::flash('sccmgs', $message);
         return redirect($page);
    }

    protected function returnWithErrorRedirect($message,$page){
        Session::flash('errmgs', $message);
        return redirect($page);
    }

    protected function getClasses()
    {
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        return $classes;
    }
    protected function groupClasses()
    {
        return GroupClass::all();
    }
    protected function getUnits()
    {
        $units=Unit::where('school_id',Auth::getSchool())->get();
        return $units;
    }

    protected function student_session(){
      return Student::where('school_id',Auth::getSchool())->groupBy('session')->select('session')->get();
    }

    public function school(){
      return School::with('user')->where('id', Auth::getSchool())->first();
    }

    protected function exam_year()
    {
        return Result::where('school_id',Auth::getSchool())->select(array('exam_year'))->groupBy('exam_year')->orderBy('exam_year')->get();
    }
    protected function getExams()
    {
        return ExamType::select(array('exam_types.id', 'exam_types.name'))
                ->get();
    }

    protected function imagesProcessing1($imageFile,$path,$width,$height)
    {
       if ($imageFile){
           $extension = $imageFile->getClientOriginalExtension();
           $filenametostore =$path.'/-'.Str::random(30).'.'.$extension;
           $url=$imageFile->storeAs('public/uploadedImages/',$filenametostore);
           $public_path = public_path('storage/uploadedImages/'.$filenametostore);
           $img = Image::make($public_path)->resize($width, $height);
           $img->save($public_path);
           return $url;
       }
    }

    protected function get_balance($api_key, $sender_id){
         $url = "http://sms.worldehsan.org/api/sms_balance?api_key=".$api_key."&sender_id=".$sender_id;
         $ch_banpage = curl_init($url);
         curl_setopt($ch_banpage, CURLOPT_URL, $url);
         curl_setopt($ch_banpage, CURLOPT_HEADER, 0);
         curl_setopt($ch_banpage, CURLOPT_RETURNTRANSFER, true);
         $curl_scraped_page = curl_exec($ch_banpage);
         curl_close($ch_banpage);
         return $curl_scraped_page;
    }

    protected function sms_send_by_api($school,$mobile_number,$message){
            $url_AllNumber = "http://sms.worldehsan.org/api/send_sms?api_key=".$school->api_key."&sender_id=".$school->sender_id."&number=".$mobile_number."&message=".$message;
            return $this->send_sms_by_curl($url_AllNumber);
    }

    protected function send_sms_by_curl($url_AllNumber){
           $ch_banpage = curl_init($url_AllNumber);
           curl_setopt($ch_banpage, CURLOPT_URL, $url_AllNumber);
           curl_setopt($ch_banpage, CURLOPT_HEADER, 0);
           curl_setopt($ch_banpage, CURLOPT_RETURNTRANSFER, true);
           $curl_scraped_page = curl_exec($ch_banpage);
           curl_close($ch_banpage);
           return $curl_scraped_page;
    }

    /**
        * success response method.
        *
        * @return \Illuminate\Http\Response
        */
       public function sendResponse($result, $message)
       {
        $response = [
               'success' => true,
               'data'    => $result,
               'message' => $message,
           ];


           return response()->json($response, 201);
       }


       /**
        * return error response.
        *
        * @return \Illuminate\Http\Response
        */
       public function sendError($error, $errorMessages = [], $code = 404)
       {
        $response = [
               'success' => false,
               'message' => $error,
           ];


           if(!empty($errorMessages)){
               $response['data'] = $errorMessages;
           }


           return response()->json($response, $code);
       }
}
