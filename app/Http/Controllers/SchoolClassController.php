<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolClass;
use App\MasterClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SchoolClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('admin')){
            return view('backEnd.admin.dashboard');
        }
        $id=Auth::schoolType();
        $school_type_ids=explode('|', $id);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        return view('backEnd.classes.info', compact('classes'));
    }
}
