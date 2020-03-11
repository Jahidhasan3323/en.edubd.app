<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fund;

class FundController extends Controller
{
    public function fund_create(){
      $funds = Fund::orderBy('id', 'desc')->get();
      return view('backEnd.accounts.fund.add', compact('funds'));
    }

    public function fund_store(Request $request){
      $fund = new Fund;
      $data = $request->all();
      $fund->create($data);
      return redirect()->back()->with('success_msg', 'ফান্ড সফলভাবে যোগ করা হয়েছে ।');
    }

    public function fund_edit($id){
      $fund = Fund::find($id);
      return view('backEnd.accounts.fund.edit', compact('fund'));
    }

    public function fund_update(Request $request){
      $fund = Fund::find($request->id);
      $data = $request->all();
      $fund->update($data);
      return redirect()->route('fund_create')->with('success_msg', 'ফান্ড সফলভাবে আপডেট করা হয়েছে ।');
    }

    public function fund_delete(Request $request){
      $fund = Fund::find($request->id);
      $fund->delete();
      return redirect()->route('fund_create')->with('success_msg', 'ফান্ড সফলভাবে মুছে ফেলা হয়েছে ।');
    }




}
