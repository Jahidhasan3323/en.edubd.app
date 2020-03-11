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
            <h3 class="text-center text-temp">শিক্ষার্থী উপস্থিতি</h3>
            <h4 class="text-center text-temp">শিক্ষার্থী : {{$single_student->user->name}}</h4>
            <h5>শ্রেণী : {{$single_student->master_class->name}}, বিভাগ : {{$single_student->group}} , শিফট : {{$single_student->shift}} ত্ত শাখা : {{$single_student->section}}</h5>
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
                       $atten_students = \App\AttenStudent::where(['student_id'=>$single_student->student_id,'school_id'=>$single_student->school_id])->whereBetween('created_at',[$from,$to])->orderBy('id','desc')->get();
                    }else{
                        $atten_students = \App\AttenStudent::where(['student_id'=>$single_student->student_id,'school_id'=>$single_student->school_id])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', $month->month)->orderBy('id','desc')->get();
                    }

                    $serial = Get::serial($atten_students)
                    @endphp
                    @foreach($atten_students as $atten_student)
                        <tr>
                            <td>{{str_replace($s, $r,$serial++)}}</td>
                            <td>{{str_replace($s, $r,$atten_student->date->format('l d-m-Y'))}}</td>
                            <td><input type="checkbox" {{$atten_student->status=='P'?'checked':''}}></td>
                            <td><input type="checkbox" {{($atten_student->status=='L'||$atten_student->status=='H')?'checked':''}}></td>
                            <td><input type="checkbox" {{$atten_student->status=='A'?'checked':''}}></td>
                            <td>{{str_replace($s, $r,($atten_student->in_time!=NULL)?date('h:i:s A', strtotime($atten_student->in_time)):'_ _ :_ _ :_ _')}}</td>
                            <td>{{str_replace($s, $r,($atten_student->out_time!=NULL)?date('h:i:s A', strtotime($atten_student->out_time)):'_ _ :_ _ :_ _')}}</td>
                            <td>{{str_replace($s, $r,$atten_student->date->format('Y'))}}</td>
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


