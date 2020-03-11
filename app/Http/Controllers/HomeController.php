<?php

namespace App\Http\Controllers;

use App\School;
use App\Commitee;
use App\Student;
use App\Staff;
use App\User;
use Illuminate\CustomClasses\Get;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::is('root')){
            if (Get::expiry() < 0){
                return view('backEnd.expiry');
            }
        }
        if (Auth::is('root')){
            $schools = School::all()->count();
            $users = User::all()->count();
            return view('backEnd.admin.dashboard', compact('users', 'schools'));
        }

        if (Auth::is('admin') || Auth::is('teacher') || Auth::is('commitee') || Auth::is('student')){
        $students = Student::where('school_id', Auth::getSchool())->current()->count();
        $commitee = Commitee::where(['school_id'=>Auth::getSchool(),'deleted_at'=>NULL])->count();
        $staff = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->where(['school_id'=>Auth::getSchool(),'staff.deleted_at'=>NULL])
                        ->where('users.group_id','!=',3)
                        ->count();

        $teachers = User::join('staff', 'users.id', '=', 'staff.user_id')
                        ->where(['users.group_id'=> 3,'school_id'=>Auth::getSchool(),'staff.deleted_at'=>NULL])
                        ->count();
        return view('backEnd.admin.dashboard', compact('students', 'staff','teachers','commitee'));
        }
        return view('backEnd.admin.dashboard');
    }

    public function changePassword()
    {
       return view('backEnd.changePassword');
    }

    /**
     * @param Request $request
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'new_password_again' => 'required|min:6|same:new_password',
        ]);
        try {
            $user = Auth::user();
            if (Hash::check($request->current_password, $user->password)){
                $user = User::find($user->id);
                $user->password = Hash::make($request->new_password);
                $user->update();
                Session::flash('sccmgs', 'আপনার পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে !');
                return redirect()->back();
            }else{
                Session::flash('errmgs', 'অনুগ্রহ করে সঠিক পাসওয়ার্ড দিন !');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Session::flash('errmgs', 'দুঃখিত, সমস্যা হয়েছে !'.$e->getMessage());
            return redirect()->back();
        }
    }
}
