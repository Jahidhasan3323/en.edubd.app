<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdvancedPaid;
use App\Staff;
use Auth;

class AdvancedPaidController extends Controller
{
    public function advanced_paid_add(){
      $employees = Staff::where('school_id', Auth::getSchool())->get();
      $advanced_paids =  AdvancedPaid::orderBy('id', 'desc')->where('school_id', Auth::getSchool())->get();
      return view('backEnd.accounts.advanced_paid.add', compact('advanced_paids', 'employees'));
    }

    public function advanced_paid_store(Request $request){
      $this->validate($request, [
        'employee_id' => 'required',
        'amount' => 'required',
        'month' => 'required',
        'year' => 'required',
        'payment_date' => 'required',
      ]);
      $advanced_paid = new AdvancedPaid;
      $data = $request->except(['payment_date']);
      $data['school_id'] = Auth::getSchool();
      $data['payment_date'] = date('Y-m-d', strtotime($request->payment_date));
      $advanced_paid->create($data);
      return redirect()->route('advanced_paid_add')->with('success_msg', 'অগ্রিম বেতন সফলভাবে যোগ করা হয়েছে ।');
    }

    public function advanced_paid_delete(Request $request){
      $advanced_paid = AdvancedPaid::find($request->id);
      $advanced_paid->delete();
      return redirect()->route('advanced_paid_add')->with('success_msg', 'অগ্রিম বেতন সফলভাবে মুছে ফেলা হয়েছে ।');
    }


}
