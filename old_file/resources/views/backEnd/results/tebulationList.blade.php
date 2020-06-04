<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ehsan Software-Tabulation Sheet</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('backEnd/img/icon.png')}}" />
  <link href="{{asset('backEnd/css/bootstrap.css')}}" rel="stylesheet"/>
  <style>
    body{width: 100%; padding: 0; margin: 0; } .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {float: left; } .col-md-12 {width: 100%; } .col-md-11 {width: 91.66666667%; } .col-md-10 {width: 83.33333333%; } .col-md-9 {width: 75%; } .col-md-8 {width: 66.66666667%; } .col-md-7 {width: 58.33333333%; } .col-md-6 {width: 50%; } .col-md-5 {width: 41.66666667%; } .col-md-4 {width: 33.33333333%; } .col-md-3 {width: 25%; } .col-md-2 {width: 16.66666667%; } .col-md-1 {width: 8.33333333%; } .row1:after {content: ""; display: table; clear: both; } tr>td{text-align: center; } tr>td>p{margin-top: 18px; } .extra p{margin-top: 0px; } .extrasbj hr{padding: 0; margin: 0; } .student-info{text-align: left; } .student-info>p{font-size: 10px; padding: 0; line-height: 5px; margin-top:0; } .student-info>p:last-child{margin-bottom:0; } tr>th{font-size: 10px; } .grade-sheet>tbody>tr>td, .grade-sheet>tbody>tr>th{font-size: 12px; padding: 0; margin: 0; }
    .bg-logo {width: 100%; height: auto; display: block; position: relative; } .bg-logo::after {content: ""; background: url({{Storage::url($school->logo)}}); background-repeat: repeat-y; background-position: center; background-size:500px 500px; opacity: 0.2; top: 100px; left: 0; bottom: 0; right: 0; position: absolute; z-index: 222;
    }
  </style> 
</head>
<body>
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-6">
              <h3 style="font-size: 14px;">EIIN : {{$school->code}}</h3>
            </div>
            <div class="col-md-6">
              <img style="float:right;margin-top:25px;width:100px;height: 100px;" src="{{Storage::url($school->logo)}}" alt="logo">
            </div>
          </div>
        </div>
      	<div class="col-md-4 text-center">
      		<h3>{{$school->user->name}}</h3>
      		<p>Established: {{date('Y', strtotime($school->established_date))}}</p>
      		<h5>{{$school->address}}</h5>
      		<h3>{{$exam->name}} - {{$data['exam_year']}}</h3>
      		<h3>Tabulation Sheet</h3>
      	</div>
        <div class="col-md-4">
          <div class="pull-right" style="margin-top:25px;">
            <table class="table table-bordered grade-sheet">
              <thead>
                <tr>
                  <th>Letter Grade</th>
                  <th>Class Interval</th>
                  <th>Grade Point</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>A+</td> <td>80-100</td> <td>5</td>
                </tr>
                <tr>
                  <td>A</td> <td>70-79</td> <td>4</td>
                </tr>
                <tr>
                  <td>A-</td> <td>60-69</td> <td>3.5</td>
                </tr>
                <tr>
                  <td>B</td> <td>50-59</td> <td>3</td>
                </tr>
                <tr>
                  <td>C</td> <td>40-49</td> <td>2</td>
                </tr>
                <tr>
                  <td>D</td> <td>33-39</td> <td>1</td>
                </tr>
                <tr>
                  <td>F</td> <td>00-32</td> <td>0</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="bg-logo">
          <div class="row">
          	<div class="col-md-12 text-center">
          		<p> {{$class->name}} Class, Section - {{$data['section']}}, Division - {{DB::table('group_classes')->where('id',$data['group_class_id'])->select('name')->first()->name}}, Shift - {{$data['shift']}} </p>
          	</div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Roll No.</th>
                    <th style="width:280px;">Student Information</th>
                    @php $item=0; @endphp
                    @if(in_array('Religion Education',$subject_type))
                      <th>Religion or Moral Education</th>
                    @endif

                    @foreach($copulsary_subject as $key=>$subject)
                     @if($subject[0]->subject_type!=='Religion Education'&&$subject[0]->subject_type!='Elective')
                     <th>{{str_replace(['-'],'',$key)}}</th>
                     @endif
                    @endforeach

                    @if(in_array('Elective',$subject_type))
                      @for($x = 0; $x < $elective_count; $x++)
                       <th>Elective Subject</th>
                      @endfor
                    @endif
                    @if(in_array('Optional',$subject_status))
                     <th>Extra Subject</th>
                    @endif

                    <th>The Total Number</th>
                    <th style="width:100px;">Except for the extra subject (GPA)</th>
                    <th style="width:100px;">Grade Point Average (GPA)</th>
                  </tr>
                </thead>
                <tbody>
                  @php 
                   $index=1; 
                   $fail_results=$results; 
                  @endphp
                  @foreach($results as $key => $student_results)
                  @php
                  $student_results=$student_results->sortBy("subject_id");
                  $copulsary_results = collect($student_results)->where('subject_status','Compulsory')->groupBy(function($element){
                   return str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $element['subject_name']);
                  });
                  $copulsary_sub_totals=$copulsary_results->map(function($row){
                    return $row->sum('sub_total');
                  });
                  $copulsary_total_marks=$copulsary_results->map(function($row){
                    return $row->sum('total_mark');
                  });
                  $optional_results = collect($student_results)->where('subject_status','Optional')->groupBy(function($element){
                   return str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $element['subject_name']);
                  });
                  $optional_sub_totals=$optional_results->map(function($row){
                    return $row->sum('sub_total');
                  });
                  $optional_total_marks=$optional_results->map(function($row){
                    return $row->sum('total_mark');
                  });

                  $student = App\Student::with('user')->where(['school_id'=>Auth::getSchool(),'student_id'=>$key])->first();
                  @endphp
                  @php
                   $i=1;
                   foreach ($copulsary_results as $key=>$results) {

                      $subjects[$i++]=$results;
                   }
                   foreach ($subjects as $key => $subject){
                       if(count($subject)>1){
                       $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
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
                        $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
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

                  @php
                   $i=1;
                   $subjectss=[];
                   if(count($optional_results)>0){
                   foreach ($optional_results as $key=>$results) {
                      $subjectss[$i++]=$results;
                   }
                   foreach ($subjectss as $key => $subject){
                       if(count($subject)>1){
                       $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
                       $op_ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark)+
                               ($subject[1]->ca_mark=='--'?0:$subject[1]->ca_mark);
                       $op_cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark)+
                               ($subject[1]->cr_mark=='--'?0:$subject[1]->cr_mark);
                       $op_mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark)+
                               ($subject[1]->mcq_mark=='--'?0:$subject[1]->mcq_mark);
                       $op_pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark)+
                               ($subject[1]->pr_mark=='--'?0:$subject[1]->pr_mark);

                       $op_ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark)+
                               ($subject[1]->ca_pass_mark=='--'?0:$subject[1]->ca_pass_mark);
                       $op_cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark)+
                               ($subject[1]->cr_pass_mark=='--'?0:$subject[1]->cr_pass_mark);
                       $op_mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark)+
                               ($subject[1]->mcq_pass_mark=='--'?0:$subject[1]->mcq_pass_mark);
                       $op_pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark)+
                               ($subject[1]->pr_pass_mark=='--'?0:$subject[1]->pr_pass_mark);
                       }else{
                        $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
                        $op_ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark);
                        $op_cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark);
                        $op_mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark);
                        $op_pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark);

                        $op_ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark);
                        $op_cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark);
                        $op_mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark);
                        $op_pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark);
                       }
                    }
                  }
                  @endphp
                  @if($position['gpa'][$student->student_id]!="0.00")
                  <tr>
                    <td>#{{$index++}}</td>
                    <td class="student-info" style="width:280px;">
                      <p>Name : {{$student->user->name}}</p>
                      <p>Father's Name : {{$student->father_name}}</p>
                      <p>Mother's Name : {{$student->mother_name}}</p>
                      <p>Mobile No.- {{$student->user->mobile}}</p>
                      <p>Class Roll- {{$student->roll}}</p>
                      <p>ID No.- {{$student->student_id}}</p>
                    </td>
                    @php $in_key=1; @endphp
                    @foreach($copulsary_sub_totals as $com_ke=> $copulsary_sub_total)
                    @php
                    if($ca_mark[$com_ke]>=$ca_pass_mark[$com_ke]&&$cr_mark[$com_ke]>=$cr_pass_mark[$com_ke]&&$mcq_mark[$com_ke]>=$mcq_pass_mark[$com_ke]&&$pr_mark[$com_ke]>=$pr_pass_mark[$com_ke]){
                     $grade = Auth::grade(Auth::calculateResult($copulsary_sub_total,$copulsary_total_marks[$com_ke])['gpa']);
                     $gpa[$key][$in_key++]=Auth::calculateResult($copulsary_sub_total,$copulsary_total_marks[$com_ke])['gpa'];
                    }else{
                      $grade = "F";
                      $gpa[$key][$in_key++]="0.00";
                    }
                    @endphp
                      @if($copulsary_results[$com_ke][0]->subject_type=='Religion Education')
                      <td>{{str_replace('-','',$com_ke)}}<hr>{{$grade}}<br>{{$copulsary_sub_total}}</td>
                      @else
                        @if($copulsary_results[$com_ke][0]->subject_type!='Elective')
                        <td>{{$grade}}<br>{{$copulsary_sub_total}}</td>
                        @else
                         <td>{{str_replace('-','',$com_ke)}} {{$grade}}<br>{{$copulsary_sub_total}}</td>
                        @endif
                      @endif
                    @endforeach
                    @if(!in_array('Optional',$subject_status))
                     @php $op_grade = "F";
                     $op_gpa[$key][$in_key++]="0.00";
                     @endphp
                    @endif
                    @if(in_array('Optional',$subject_status))
                     @php $in_key=1;  @endphp
                     @foreach($optional_sub_totals as $op_ke=> $optional_sub_total)
                     @php
                     if($op_ca_mark[$op_ke]>=$op_ca_pass_mark[$op_ke]&&$op_cr_mark[$op_ke]>=$op_cr_pass_mark[$op_ke]&&$op_mcq_mark[$op_ke]>=$op_mcq_pass_mark[$op_ke]&&$op_pr_mark[$op_ke]>=$op_pr_pass_mark[$op_ke]){
                      $op_grade = Auth::grade(Auth::calculateResult($optional_sub_total,$optional_total_marks[$op_ke])['gpa']);
                      $op_gpa[$key][$in_key++]=Auth::calculateResult($optional_sub_total,$optional_total_marks[$op_ke])['gpa'];
                     }else{
                       $op_grade = "F";
                       $op_gpa[$key][$in_key++]="0.00";
                     }
                     @endphp
                     <td>{{str_replace('-','',$op_ke)}}<hr>{{$op_grade}} | {{$optional_sub_total}}</td>
                     @endforeach
                    @endif
                    <td>{{$student_results[0]->grand_total_mark}}</td>
                    <td>
                      @if(array_product($gpa[$key])>0)
                      @php 
                      $without_4j__gpa = array_sum($gpa[$key])/count($copulsary_sub_totals);
                      $without_4j__gpa=number_format($without_4j__gpa,2,'.','')>5?'5.00':number_format($without_4j__gpa,2,'.',''); 
                      @endphp
                      {{$without_4j__gpa}} 
                      @else 0.00 @endif
                    </td>
                    <td>
                      @if(array_product($op_gpa[$key])>0)
                       @php $j4j__gpa = array_sum($op_gpa[$key])/count($optional_sub_totals);
                       $gpa_4j=number_format($j4j__gpa,2,'.','')>5?'5.00':number_format($j4j__gpa,2,'.','');
                       $gpa_4j=($gpa_4j>2)?($gpa_4j-2):0;
                       @endphp
                      @else 
                       @php $gpa_4j=0.00 @endphp 
                      @endif
                      

                      @if(array_product($gpa[$key])>0)
                      @php 
                      $av_gpa =(array_sum($gpa[$key])+$gpa_4j)/count($copulsary_sub_totals); 
                      @endphp
                      {{number_format($av_gpa,2,'.','')>5?'5.00':number_format($av_gpa,2,'.','')}} 
                      @else 0.00 @endif
                    </td>
                  </tr>
                  @endif
                  @endforeach

                  @foreach($fail_results as $key => $student_results)
                  @php
                  $student_results=$student_results->sortBy("subject_id");
                  $copulsary_results = collect($student_results)->where('subject_status','Compulsory')->groupBy(function($element){
                   return str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $element['subject_name']);
                  });
                  $copulsary_sub_totals=$copulsary_results->map(function($row){
                    return $row->sum('sub_total');
                  });
                  $copulsary_total_marks=$copulsary_results->map(function($row){
                    return $row->sum('total_mark');
                  });
                  $optional_results = collect($student_results)->where('subject_status','Optional')->groupBy(function($element){
                   return str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $element['subject_name']);
                  });
                  $optional_sub_totals=$optional_results->map(function($row){
                    return $row->sum('sub_total');
                  });
                  $optional_total_marks=$optional_results->map(function($row){
                    return $row->sum('total_mark');
                  });

                  $student = App\Student::with('user')->where(['school_id'=>Auth::getSchool(),'student_id'=>$key])->first();
                  @endphp
                  @php
                   $i=1;
                   foreach ($copulsary_results as $key=>$results) {

                      $subjects[$i++]=$results;
                   }
                   foreach ($subjects as $key => $subject){
                       if(count($subject)>1){
                       $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
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
                        $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
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

                  @php
                   $i=1;
                   $subjectss=[];
                   if(count($optional_results)>0){
                   foreach ($optional_results as $key=>$results) {
                      $subjectss[$i++]=$results;
                   }
                   foreach ($subjectss as $key => $subject){
                       if(count($subject)>1){
                       $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
                       $op_ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark)+
                               ($subject[1]->ca_mark=='--'?0:$subject[1]->ca_mark);
                       $op_cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark)+
                               ($subject[1]->cr_mark=='--'?0:$subject[1]->cr_mark);
                       $op_mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark)+
                               ($subject[1]->mcq_mark=='--'?0:$subject[1]->mcq_mark);
                       $op_pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark)+
                               ($subject[1]->pr_mark=='--'?0:$subject[1]->pr_mark);

                       $op_ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark)+
                               ($subject[1]->ca_pass_mark=='--'?0:$subject[1]->ca_pass_mark);
                       $op_cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark)+
                               ($subject[1]->cr_pass_mark=='--'?0:$subject[1]->cr_pass_mark);
                       $op_mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark)+
                               ($subject[1]->mcq_pass_mark=='--'?0:$subject[1]->mcq_pass_mark);
                       $op_pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark)+
                               ($subject[1]->pr_pass_mark=='--'?0:$subject[1]->pr_pass_mark);
                       }else{
                        $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper'], '', $subject[0]->subject_name);
                        $op_ca_mark[$name]=($subject[0]->ca_mark=='--'?0:$subject[0]->ca_mark);
                        $op_cr_mark[$name]=($subject[0]->cr_mark=='--'?0:$subject[0]->cr_mark);
                        $op_mcq_mark[$name]=($subject[0]->mcq_mark=='--'?0:$subject[0]->mcq_mark);
                        $op_pr_mark[$name]=($subject[0]->pr_mark=='--'?0:$subject[0]->pr_mark);

                        $op_ca_pass_mark[$name]=($subject[0]->ca_pass_mark=='--'?0:$subject[0]->ca_pass_mark);
                        $op_cr_pass_mark[$name]=($subject[0]->cr_pass_mark=='--'?0:$subject[0]->cr_pass_mark);
                        $op_mcq_pass_mark[$name]=($subject[0]->mcq_pass_mark=='--'?0:$subject[0]->mcq_pass_mark);
                        $op_pr_pass_mark[$name]=($subject[0]->pr_pass_mark=='--'?0:$subject[0]->pr_pass_mark);
                       }
                    }
                  }
                  @endphp
                  @if($position['gpa'][$student->student_id]=="0.00")
                  <tr>
                    <td>#{{$index++}}</td>
                    <td class="student-info" style="width:280px;">
                      <p>Name : {{$student->user->name}}</p>
                      <p>Father's Name : {{$student->father_name}}</p>
                      <p>Mother's Name : {{$student->mother_name}}</p>
                      <p>Mobile No.- {{$student->user->mobile}}</p>
                      <p>Class Roll- {{$student->roll}}</p>
                      <p>ID No.- {{$student->student_id}}</p>
                    </td>
                    @php $in_key=1; @endphp
                    @foreach($copulsary_sub_totals as $com_ke=> $copulsary_sub_total)
                    @php
                    if($ca_mark[$com_ke]>=$ca_pass_mark[$com_ke]&&$cr_mark[$com_ke]>=$cr_pass_mark[$com_ke]&&$mcq_mark[$com_ke]>=$mcq_pass_mark[$com_ke]&&$pr_mark[$com_ke]>=$pr_pass_mark[$com_ke]){
                     $grade = Auth::grade(Auth::calculateResult($copulsary_sub_total,$copulsary_total_marks[$com_ke])['gpa']);
                     $gpa[$key][$in_key++]=Auth::calculateResult($copulsary_sub_total,$copulsary_total_marks[$com_ke])['gpa'];
                    }else{
                      $grade = "F";
                      $gpa[$key][$in_key++]="0.00";
                    }
                    @endphp
                      @if($copulsary_results[$com_ke][0]->subject_type=='Religion Education')
                      <td>{{str_replace('-','',$com_ke)}}<hr>{{$grade}}<br>{{$copulsary_sub_total}}</td>
                      @else
                        @if($copulsary_results[$com_ke][0]->subject_type!='Elective')
                        <td>{{$grade}}<br>{{$copulsary_sub_total}}</td>
                        @else
                         <td>{{str_replace('-','',$com_ke)}} {{$grade}}<br>{{$copulsary_sub_total}}</td>
                        @endif
                      @endif
                    @endforeach
                    @if(!in_array('Optional',$subject_status))
                     @php $op_grade = "F";
                     $op_gpa[$key][$in_key++]="0.00";
                     @endphp
                    @endif
                    @if(in_array('Optional',$subject_status))
                     @php $in_key=1;  @endphp
                     @foreach($optional_sub_totals as $op_ke=> $optional_sub_total)
                     @php
                     if($op_ca_mark[$op_ke]>=$op_ca_pass_mark[$op_ke]&&$op_cr_mark[$op_ke]>=$op_cr_pass_mark[$op_ke]&&$op_mcq_mark[$op_ke]>=$op_mcq_pass_mark[$op_ke]&&$op_pr_mark[$op_ke]>=$op_pr_pass_mark[$op_ke]){
                      $op_grade = Auth::grade(Auth::calculateResult($optional_sub_total,$optional_total_marks[$op_ke])['gpa']);
                      $op_gpa[$key][$in_key++]=Auth::calculateResult($optional_sub_total,$optional_total_marks[$op_ke])['gpa'];
                     }else{
                       $op_grade = "F";
                       $op_gpa[$key][$in_key++]="0.00";
                     }
                     @endphp
                     <td>{{str_replace('-','',$op_ke)}}<hr>{{$op_grade}} | {{$optional_sub_total}}</td>
                     @endforeach
                    @endif
                    <td>{{$student_results[0]->grand_total_mark}}</td>
                    <td>
                      @if(array_product($gpa[$key])>0)
                      @php 
                      $without_4j__gpa = array_sum($gpa[$key])/count($copulsary_sub_totals);
                      $without_4j__gpa=number_format($without_4j__gpa,2,'.','')>5?'5.00':number_format($without_4j__gpa,2,'.',''); 
                      @endphp
                      {{$without_4j__gpa}} 
                      @else 0.00 @endif
                    </td>
                    <td>
                      @if(array_product($op_gpa[$key])>0)
                       @php $j4j__gpa = array_sum($op_gpa[$key])/count($optional_sub_totals);
                       $gpa_4j=number_format($j4j__gpa,2,'.','')>5?'5.00':number_format($j4j__gpa,2,'.','');
                       $gpa_4j=($gpa_4j>2)?($gpa_4j-2):0;
                       @endphp
                      @else 
                       @php $gpa_4j=0.00 @endphp 
                      @endif
                      

                      @if(array_product($gpa[$key])>0)
                      @php 
                      $av_gpa =(array_sum($gpa[$key])+$gpa_4j)/count($copulsary_sub_totals); 
                      @endphp
                      {{number_format($av_gpa,2,'.','')>5?'5.00':number_format($av_gpa,2,'.','')}} 
                      @else 0.00 @endif
                    </td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
</body>
</html>
