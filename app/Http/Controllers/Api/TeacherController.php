<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\User;
use App\Staff;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $school=School::where('serial_no',$request->serial_no)->select('id')->first();
       $teachers = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->join('designations', 'staff.designation_id','=','designations.id')
                        ->where(['users.group_id'=> 3,'staff.school_id'=>$school->id])
                        ->select('users.name','users.email','users.mobile','staff.photo','designations.name as designation')
                        ->get();
        return Response()->json($teachers); 
    }

    
}
