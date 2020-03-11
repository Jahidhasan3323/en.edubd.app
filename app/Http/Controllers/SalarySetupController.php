<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalarySetup;
use App\Staff;
use Auth;

class SalarySetupController extends Controller
{
    public function salary_setup_add(){
      $salary_setups = SalarySetup::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      $setup_employees = SalarySetup::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->select('employee_id')->get();
      $employees = Staff::where('school_id', Auth::getSchool())->whereNotIn('id', $setup_employees)->get();
      return view('backEnd.accounts.salary_setup.add', compact('salary_setups', 'employees'));
    }

    public function salary_setup_store(Request $request){
      $this->validate($request, [
        "employee_id" => "required",
        "amount" => "numeric",
      ]);
      // return $request->amount;
      $salary_setup = new SalarySetup;
      $data = $request->all();
      $data['school_id'] = Auth::getSchool();
      $salary_setup->create($data);
      return redirect()->back()->with('success_msg', 'বেসিক বেতন সফলভাবে যোগ করা হয়েছে ।');
    }

    public function salary_setup_edit($id){
      $salary_setup = SalarySetup::find($id);
      $salary_setups = SalarySetup::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      $setup_employees = SalarySetup::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->select('employee_id')->get();
      $employees = Staff::where('school_id', Auth::getSchool())->whereNotIn('id', $setup_employees)->get();
      return view('backEnd.accounts.salary_setup.edit', compact('salary_setup', 'salary_setups', 'employees'));
    }

    public function salary_setup_update(Request $request){
      $this->validate($request, [
        "employee_id" => "required",
        "amount" => "numeric",
      ]);
      $salary_setup = SalarySetup::find($request->id);
      $data = $request->all();
      $salary_setup->update($data);
      return redirect()->route('salary_setup_add')->with('success_msg', 'বেসিক বেতন সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function salary_setup_delete(Request $request){
      $salary_setup = SalarySetup::find($request->id);
      $salary_setup->delete();
      return redirect()->route('salary_setup_add')->with('success_msg', 'বেসিক বেতন সফলভাবে মুছে ফেলা হয়েছে ।');
    }



}
