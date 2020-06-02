<?php
namespace App\Custom;

use Illuminate\Http\Request;
use App\SalarySheet;
use App\Holiday;
use App\Staff;
use App\AttenEmployee;
use App\SalarySetup;
use App\SalaryFund;
use App\AdvancedPaid;
use Auth;

class SalarySheetInfo{
    public function month_dates($month, $year){
      for($d=1; $d<=31; $d++)
      {
          $time=mktime(12, 0, 0, $month, $d, $year);
          if (date('m', $time)==$month)
              $all_dates[]=date('Y-m-d-D', $time);
      }
      return $all_dates;
    }

    public function salary_sheet_data($employee, $month, $year, $holiday, $basic_salary, $basic_increase_rate, $basic_decrease_rate, $provident_fund_rate){
      // return $employee;
      $data = array();
      $data['school_id'] = Auth::getSchool();
      $data['employee_id'] = $employee->id;
      $data['basic'] = $basic_salary->amount;
      $attend = AttenEmployee::where('school_id', Auth::getSchool())
                            ->where('staff_id', $employee->id)
                            ->whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->where('status', 'P')
                            ->count();
      $total_leave = AttenEmployee::where('school_id', Auth::getSchool())
                                  ->where('staff_id', $employee->staff_id)
                                  ->whereMonth('date', $month)
                                  ->whereYear('date', $year)
                                  ->where('status', 'L')
                                  ->count();
      // return $total_leave;
      $total_absent = count($this->month_dates($month, $year))-($holiday+$attend+$total_leave);
      $data['provident_fund'] = ($basic_salary->amount*$provident_fund_rate)/100;
      $data['basic_increase'] = ($basic_salary->amount*$basic_increase_rate)/100;
      $data['basic_decrease'] = ($basic_salary->amount*$basic_decrease_rate)/100;
      $data['advanced_paid'] = AdvancedPaid::where('school_id', Auth::getSchool())
                                    ->where('employee_id', $employee->id)
                                    ->where('month', $month)
                                    ->where('year', $year)
                                    ->sum('amount');
      // return $provident_fund;
      $total_salary = ($data['basic']+$data['basic_increase'])-($data['provident_fund']+$data['basic_decrease']);
      $per_day = ($total_salary/30);
      $data['absent_fine'] = ($per_day*$total_absent);
      $data['net_salary'] = $total_salary-$data['absent_fine']-$data['advanced_paid'];
      $data['month'] = $month;
      $data['year'] = $year;
      return $data;
    }





}



?>
