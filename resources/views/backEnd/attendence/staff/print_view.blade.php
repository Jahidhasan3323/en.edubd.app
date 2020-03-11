<!DOCTYPE html>
<html>
<head>
	<title>Student lists Print</title>
	<link href="{{asset('backEnd/css/bootstrap.css')}}" rel="stylesheet"/>
</head>
<body>
    <div class="panel col-sm-12" style="margin-bottom: 15px;">
        <div class="page-header text-center">
            <h2 class="text-center text-temp">{{$school->user->name}}</h2>
            <h4 class="text-center text-temp">{{$school->address}}</h4>
            <p><img src="{{Storage::url($school->logo)}}" alt="Schoo Logo" width="80px;" height="80px;"></p>
            <h2 class="text-center text-temp">{{($single_employee->user->group_id==3)?'শিক্ষক':'কর্মচারী'}} উপস্থিতি</h2>
            <h3 class="text-center text-temp">{{($single_employee->user->group_id==3)?'শিক্ষক':'কর্মচারী'}} : {{$single_employee->user->name}}</h3>
        </div>
       

        <div class="panel-body">
            @foreach($months as $month)
            <div class="panel-heading">
                <h3>{{str_replace($s, $r,date("F", mktime(null, null, null, $month->month)))}}</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-responsive table-hover table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">ক্রমিক নং</th>
                            <th class="text-center">তারিখ</th>
                            <th class="text-center">উপস্থিত</th>
                            <th class="text-center">ছুটি</th>
                            <th class="text-center">অনুপস্থিত</th>
                            <th class="text-center">ইন টাইম</th>
                            <th class="text-center">আউট টাইম</th>
                            <th class="text-center">বছর</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    if(isset($from)&&isset($to)){
                       $atten_employees = \App\AttenEmployee::where(['staff_id'=>$single_employee->staff_id,'school_id'=>$single_employee->school_id])->whereBetween('created_at',[$from,$to])->orderBy('id','desc')->get();
                    }else{
                        $atten_employees = \App\AttenEmployee::where(['staff_id'=>$single_employee->staff_id,'school_id'=>$single_employee->school_id])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', $month->month)->orderBy('id','desc')->get();
                    }
                    $serial = 1;
                    @endphp
                    @foreach($atten_employees as $atten_employee)
                        <tr>
                            <td>{{str_replace($s, $r,$serial++)}}</td>
                            <td>{{str_replace($s, $r,$atten_employee->date->format('l d-m-Y'))}}</td>
                            <td><input type="checkbox" {{$atten_employee->status=='P'?'checked':''}}></td>
                            <td><input type="checkbox" {{($atten_employee->status=='L'||$atten_employee->status=='H')?'checked':''}}></td>
                            <td><input type="checkbox" {{$atten_employee->status=='A'?'checked':''}}></td>
                            <td>{{str_replace($s, $r,($atten_employee->in_time!=NULL)?date('h:i:s A', strtotime($atten_employee->in_time)):'_ _ :_ _ :_ _')}}</td>
                            <td>{{str_replace($s, $r,($atten_employee->out_time!=NULL)?date('h:i:s A', strtotime($atten_employee->out_time)):'_ _ :_ _ :_ _')}}</td>
                            <td>{{str_replace($s, $r,$atten_employee->date->format('Y'))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>

 <script type="text/javascript">
 	window.print();
 </script>
</body>
</html>


