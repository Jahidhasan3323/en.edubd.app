<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceType;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $service_types=ServiceType::all();
        return view('backEnd.service_type.index',compact('service_types'));
    }

    public function status($service_id, $status)
    {
        if($status==1){$status = 0;}else{ $status = 1;}
        ServiceType::where('id',$service_id)->update(['status'=>$status]);
        return $this->returnWithSuccess('স্ট্যাটাস সফলভাবে পরিবর্তন হয়েছে ।');
    }
}
