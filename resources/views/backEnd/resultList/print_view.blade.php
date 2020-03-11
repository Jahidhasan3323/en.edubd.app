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
            <h3 class="text-center text-temp">ফলাফলের তালিকা</h3>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center">
            
            <h4>শ্রেণী : {{$BanglaNumberToWord->engToBn($results[0]->student->master_class->name)}}, বিভাগ : {{$results[0]->student->group}}, শিফট : {{$results[0]->student->shift}}, শাখা : {{$results[0]->section}}, {{$BanglaNumberToWord->engToBn($results[0]->exam_type->name.'-'.$results[0]->exam_year)}} </h4>
            <p id="student_result_count"></p>
          </div>
        </div>

           <div class="panel-body">
               <table class="table table-hover table-striped text-center">
                   <thead>
                       <tr>
                           <th class="text-center">ক্র নং</th>
                           <th class="text-center">শিক্ষার্থীর নাম</th>
                           <th class="text-center">শিক্ষার্থীর আইডি</th>
                           <th class="text-center">শ্রেণী রোল</th>
                           <th class="text-center">শ্রেণীতে অবস্থান</th>
                           <th class="text-center">মোট নম্বর</th>
                           <th class="text-center">প্রাপ্ত জিপিএ</th>
                       </tr>
                   </thead>
                   <tbody>
                       @if($request->exam_type_id==1||$request->exam_type_id==4)
                               
                                @php $s=1; $fail_results=$results; $total_student=$results; @endphp
                                @foreach($results->sortBy('grand_total_mark')->reverse() as $res)
                                @php
                                $student_results=\App\Result::where([
                                                    'school_id'=>Auth::getSchool(),
                                                    'student_id'=>$res->student_id,
                                                    'exam_year'=>$res->exam_year,
                                                    'exam_type_id'=>$res->exam_type_id,
                                                  ])->get();

                                $copulsary_results = collect($student_results)->groupBy(function($element){
                                 return str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $element['subject_name']);
                                });
                                 $i=1;
                                 foreach ($copulsary_results as $key=>$results) {
                                    $subjects[$i++]=$results;
                                 }
                                 foreach ($subjects as $key => $subject){
                                     if(count($subject)>1){
                                     $name=str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $subject[0]->subject_name);
                                     $ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark)+
                                             ($subject[1]->ca_mark=='--'?0:$subject[1]->ca_mark);
                                     $cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark)+
                                             ($subject[1]->cr_mark=='--'?0:$subject[1]->cr_mark);
                                     $mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark)+
                                             ($subject[1]->mcq_mark=='--'?0:$subject[1]->mcq_mark);
                                     $pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark)+
                                             ($subject[1]->pr_mark=='--'?0:$subject[1]->pr_mark);

                                     $ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark)+
                                             ($subject[1]->ca_pass_mark=='--'?0:$subject[1]->ca_pass_mark);
                                     $cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark)+
                                             ($subject[1]->cr_pass_mark=='--'?0:$subject[1]->cr_pass_mark);
                                     $mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark)+
                                             ($subject[1]->mcq_pass_mark=='--'?0:$subject[1]->mcq_pass_mark);
                                     $pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark)+
                                             ($subject[1]->pr_pass_mark=='--'?0:$subject[1]->pr_pass_mark);
                                     }else{
                                      $name=str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $subject[0]->subject_name);
                                      $ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark);
                                      $cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark);
                                      $mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark);
                                      $pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark);

                                      $ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark);
                                      $cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark);
                                      $mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark);
                                      $pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark);
                                     }
                                  }
                                @endphp
                                @php $i=1;
                                $total_gpa_otional=[];
                                 $sub_totals=$copulsary_results->map(function($row){
                                  return $row->sum('sub_total');
                                 });
                                 $total_marks=$copulsary_results->map(function($row){
                                  return $row->sum('total_mark');
                                 });
                                 foreach($copulsary_results as $subject=>$result){
                                  if($ca_mark[$subject]>=$ca_pass_mark[$subject]&&$cr_mark[$subject]>=$cr_pass_mark[$subject]&&$mcq_mark[$subject]>=$mcq_pass_mark[$subject]&&$pr_mark>$pr_pass_mark[$subject]){
                                    $sub_total=$sub_totals[$subject];
                                    $total_mark=$total_marks[$subject];
                                    if($result[0]['subject_status']=='আবশ্যিক'){
                                     $total_gpa_compulsary[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa'];
                                    }else{
                                     $total_gpa_otional[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa']; 
                                    }
                                  }else{
                                    if($result[0]['subject_status']=='আবশ্যিক'){
                                     $total_gpa_compulsary[$subject]=0;
                                    }else{
                                     $total_gpa_otional[$subject]=0; 
                                    }
                                  }
                                 }

                                 $op_gpa=(array_sum($total_gpa_otional)>2)?(array_sum($total_gpa_otional)-2):0;
                                 $total_gpa=(array_sum($total_gpa_compulsary)+$op_gpa)/count($total_gpa_compulsary);
                                 $total_gpa=($total_gpa>5)?5:$total_gpa;
                                 $total_gpa=number_format($total_gpa, 2, '.', '');

                                @endphp

                                @if(array_product($total_gpa_compulsary)>0)
                                <tr>
                                  <td>{{$s++}}</td>
                                    <td>
                                        
                                        {{$res->student->user->name}}
                                    </td>
                                    <td>
                                        {{$res->student->student_id}}
                                    </td>
                                    <td>
                                        {{$res->student->roll}}
                                    </td>
                                    <td>
                                      @if($class_position_numbers['multi_base']==true)
                                      {{array_search($res->student->student_id.''.($class_position_numbers['success_position_numbers'][$res->student->student_id]), $class_position_numbers['success_numbers'])+1}}
                                      @else
                                      {{array_search($res->student->student_id.''.($total_gpa+$res->grand_total_mark), $class_position_numbers['success_numbers'])+1}}
                                      @endif
                                    </td>
                                    <td>{{$res->grand_total_mark}}</td>
                                    <td>{{$total_gpa}}</td>
                                </tr>
                                @endif
                                @php 
                                $total_gpa_optional=[]; 
                                $total_gpa_compulsary=[];  
                                @endphp
                                @endforeach
                              @endif
                              
                              @if($request->exam_type_id==1||$request->exam_type_id==4)
                               
                                @foreach($fail_results->sortBy('grand_total_mark')->reverse() as $res)
                                @php
                                $student_results=\App\Result::where([
                                                    'school_id'=>Auth::getSchool(),
                                                    'student_id'=>$res->student_id,
                                                    'exam_year'=>$res->exam_year,
                                                    'exam_type_id'=>$res->exam_type_id,
                                                  ])->get();

                                $copulsary_results = collect($student_results)->groupBy(function($element){
                                 return str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $element['subject_name']);
                                });
                                 $i=1;
                                 foreach ($copulsary_results as $key=>$results) {
                                    $subjects[$i++]=$results;
                                 }
                                 foreach ($subjects as $key => $subject){
                                     if(count($subject)>1){
                                     $name=str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $subject[0]->subject_name);
                                     $ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark)+
                                             ($subject[1]->ca_mark=='--'?0:$subject[1]->ca_mark);
                                     $cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark)+
                                             ($subject[1]->cr_mark=='--'?0:$subject[1]->cr_mark);
                                     $mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark)+
                                             ($subject[1]->mcq_mark=='--'?0:$subject[1]->mcq_mark);
                                     $pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark)+
                                             ($subject[1]->pr_mark=='--'?0:$subject[1]->pr_mark);

                                     $ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark)+
                                             ($subject[1]->ca_pass_mark=='--'?0:$subject[1]->ca_pass_mark);
                                     $cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark)+
                                             ($subject[1]->cr_pass_mark=='--'?0:$subject[1]->cr_pass_mark);
                                     $mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark)+
                                             ($subject[1]->mcq_pass_mark=='--'?0:$subject[1]->mcq_pass_mark);
                                     $pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark)+
                                             ($subject[1]->pr_pass_mark=='--'?0:$subject[1]->pr_pass_mark);
                                     }else{
                                      $name=str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $subject[0]->subject_name);
                                      $ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark);
                                      $cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark);
                                      $mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark);
                                      $pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark);

                                      $ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark);
                                      $cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark);
                                      $mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark);
                                      $pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark);
                                     }
                                  }
                                @endphp
                                @php $i=1;
                                $total_gpa_otional=[];
                                 $sub_totals=$copulsary_results->map(function($row){
                                  return $row->sum('sub_total');
                                 });
                                 $total_marks=$copulsary_results->map(function($row){
                                  return $row->sum('total_mark');
                                 });
                                 foreach($copulsary_results as $subject=>$result){
                                  if($ca_mark[$subject]>=$ca_pass_mark[$subject]&&$cr_mark[$subject]>=$cr_pass_mark[$subject]&&$mcq_mark[$subject]>=$mcq_pass_mark[$subject]&&$pr_mark>$pr_pass_mark[$subject]){
                                    $sub_total=$sub_totals[$subject];
                                    $total_mark=$total_marks[$subject];
                                    if($result[0]['subject_status']=='আবশ্যিক'){
                                     $total_gpa_compulsary[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa'];
                                    }else{
                                     $total_gpa_otional[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa']; 
                                    }
                                  }else{
                                    if($result[0]['subject_status']=='আবশ্যিক'){
                                     $total_gpa_compulsary[$subject]=0;
                                    }else{
                                     $total_gpa_otional[$subject]=0; 
                                    }
                                  }
                                 }

                                 $op_gpa=(array_sum($total_gpa_otional)>2)?(array_sum($total_gpa_otional)-2):0;
                                 $total_gpa=(array_sum($total_gpa_compulsary)+$op_gpa)/count($total_gpa_compulsary);
                                 $total_gpa=($total_gpa>5)?5:$total_gpa;
                                 $total_gpa=number_format($total_gpa, 2, '.', '');

                                @endphp

                                @if(array_product($total_gpa_compulsary)<1)
                                <tr>
                                  <td>{{$s++}}</td>
                                    <td>
                                       
                                       {{$res->student->user->name}}
                                   </td>
                                   <td>
                                       {{$res->student->student_id}}
                                   </td>
                                   <td>
                                       {{$res->student->roll}}
                                   </td>
                                   <td>
                                     {{array_search($res->student->student_id.''.($res->grand_total_mark), $class_position_numbers['fail_numbers'])+1}}
                                   </td>
                                   <td>{{$res->grand_total_mark}}</td>
                                   <td>{{'0.00'}}</td>
                                </tr>
                                @endif
                                @php 
                                $total_gpa_optional=[]; 
                                $total_gpa_compulsary=[];  
                                @endphp
                                @endforeach
                              @endif
                   </tbody>
               </table>
           </div>
    </div>

    <script>
    document.getElementById("student_result_count").innerHTML = "মোট কৃতকার্য : {{$BanglaNumberToWord->engToBn(count($class_position_numbers['success_numbers']))}}, মোট অকৃতকার্য : {{$BanglaNumberToWord->engToBn(count($class_position_numbers['fail_numbers']))}}, মোট শিক্ষার্থী : {{$BanglaNumberToWord->engToBn(count($total_student))}}";
    </script>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>


