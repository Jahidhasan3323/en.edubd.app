<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\SalarySheetInfo;
use App\SalarySheet;
use App\AccountSetting;
use App\Holiday;
use App\Staff;
use App\SalarySetup;
use App\SalaryFund;
use App\School;
use Auth;

class SalarySheetController extends Controller
{
    public function salary_sheet_add(){
      return view('backEnd.accounts.salary_sheet.add');
    }

    public function salary_sheet_store(Request $request, SalarySheetInfo $salary_sheet_info){
      $this->validate($request, [
        'month' => 'required',
        'year' => 'required',
      ]);
      $month = $request->month;
      $year = $request->year;
      $holiday = Holiday::where('school_id', Auth::getSchool())->whereMonth('date', $month)
                                                  ->whereYear('date', $year)
                                                  ->count();
      $employees = Staff::where('school_id', Auth::getSchool())->get();
      $basic_increase_rate = SalaryFund::where('school_id', Auth::getSchool())->where('status', 'Addition')->sum('amount');
      $basic_decrease_rate = SalaryFund::where('school_id', Auth::getSchool())->where('status', 'Deduction')->sum('amount');
      $providentFundRate = AccountSetting::where('school_id', Auth::getSchool())->sum('provident_fund_rate');
      // return $salary_sheet_info->month_dates($month, $year);
      foreach ($employees as $key => $employee) {
        $duplicate = SalarySheet::where('school_id', Auth::getSchool())
                                ->where('employee_id', $employee->id)
                                ->where('month', $month)
                                ->where('year', $year)
                                ->first();
        $basic_salary = SalarySetup::where('school_id', Auth::getSchool())->where('employee_id', $employee->id)->first();
        if (empty($duplicate) && !empty($basic_salary)) {
          $salary_sheet = new SalarySheet;
          // return $salary_sheet_info->salary_sheet_data($employee, $month, $year, $holiday, $basic_salary, $basic_increase_rate, $basic_decrease_rate, $providentFundRate);
          $salary_sheet->create($salary_sheet_info->salary_sheet_data($employee, $month, $year, $holiday, $basic_salary, $basic_increase_rate, $basic_decrease_rate, $providentFundRate));
        }
      }
      $school = School::find(Auth::getSchool());
      $salary_sheets = SalarySheet::where('school_id', Auth::getSchool())
                                  ->where('month', $month)
                                  ->where('year', $year)
                                  ->get();
      return view('backEnd.accounts.salary_sheet.add', compact('salary_sheets', 'month', 'year', 'school'));
    }

    public function salary_sheet_search(){
      return view('backEnd.accounts.salary_sheet.list');
    }

    public function salary_sheet_list(Request $request){
      $this->validate($request, [
        'month' => 'required',
        'year' => 'required',
      ]);
      $month = $request->month;
      $year = $request->year;
      $salary_sheets = SalarySheet::where('school_id', Auth::getSchool())->where('month', $month)->where('year', $year)->get();
      return view('backEnd.accounts.salary_sheet.list', compact('salary_sheets', 'month', 'year'));
    }

    public function salary_sheet_delete(Request $request){
      $salary_sheets = SalarySheet::find($request->id);
      $month = $salary_sheets->month;
      $year = $salary_sheets->year;
      $salary_sheets->delete();
      $salary_sheets = SalarySheet::where('school_id', Auth::getSchool())->where('month', $month)->where('year', $year)->get();
      return view('backEnd.accounts.salary_sheet.list', compact('salary_sheets', 'month', 'year'));
    }


}
