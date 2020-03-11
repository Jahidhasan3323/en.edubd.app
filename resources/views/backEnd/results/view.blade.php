@extends('backEnd.master')

@section('mainTitle', 'Result View')
@section('active_result', 'active')

@section('content')
<div id="forPdf" class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
<div class="page-header text-center">
    <h3>{{$student->user->name.' এর মার্কশীট '}}</h3>
</div>

@if(Session::has('errmgs'))
    @include('backEnd.includes.errors')
@endif
@if(Session::has('sccmgs'))
    @include('backEnd.includes.success')
@endif

<div class="panel-body">
    <div class="row" id="div-id-name">
        <style>
            body{color:#0000009e; } .col-25{float: left; width: 25%; }.col-75{float: left; width: 75%; } .col-33{float: left; width: 33.33333333%; } .col-50{float: left; width: 50%; } .col-100{float: left; width: 100%; } .row1:after {content: ""; display: table; clear: both; } .school-info{text-align: center; } .school-info h3, .school-info h4 .school-info h5{padding: 2; margin: 0; } .school-logo{text-align: center; } .school-logo>img{width: 60px; height: 60px; } .table-place{float: right; padding-right: 15px; } .letter-grade tr>td{text-align: center; font-size: 9px; } .letter-grade tr>th{text-align: center; font-size: 9px; } .letter-grade table {border-spacing: 0; border-collapse: collapse; } .letter-grade td, .letter-grade th {padding: 0; } .letter-grade td, .letter-grade th {background-color: #fff !important; } .btn > .caret, .dropup > .btn > .caret {border-top-color: #000 !important; } .label {border: 1px solid #000; } .letter-grade {border-collapse: collapse !important; } .letter-grade-bordered th, .letter-grade-bordered td {border: 1px solid #ddd !important; } .hr-map{padding-left:15px; padding-right:15px; } .table-bordered {border: 1px solid #ddd; } .table {width: 100%; margin-bottom: 20px; } table {max-width: 100%; background-color: transparent; } table {border-spacing: 0; border-collapse: collapse; } * {-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; } table {display: table; border-collapse: collapse; border-spacing: 2px; border-color: grey; } .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {border: 1px solid #ddd; font-size: 12px; } .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {padding: 2px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center; font-size: 12px; } .total_mark{float: right; } .student-info-s p{padding: 0; margin: 0; font-size: 12px; } .root-bg{position: relative; border:4px double black; height: 1015px; z-index: 1; } .bg-logo{position: absolute; top: 0; left:0; width: 100%; height: 1015px; background-image: url({{Storage::url($school->logo)}}); background-repeat: no-repeat, repeat; background-size:500px 500px; background-position: center; z-index: -1; opacity: 0.2; } .fainal-result p{padding: 0; margin:0; font-size: 12px; } .pirnt-date p, .s-teacher-s p,.p-teacher-s p{font-size: 12px; } .s-teacher-s p{text-align: center; } .p-teacher-s p{float: right; }
        </style>
      @if(($school->service_type_id==1 && $student->id_card_exits==1) || $school->service_type_id!=1)
        <div class="col-md-12 root-bg">
          <div class="bg-logo"></div>
            <div class="row1">
                <div class="col-100 school-info">
                   <h3>{{$school->user->name}}</h3> 
                   <h5>{{$school->address}}</h5>
                   <h4>{{$exam->name.'র ফলাফল - '.str_replace($s, $r, $request->exam_year).' খ্রি:'}}</h4>
                </div>
            </div>
            <div class="row1">
              <div class="col-33" style="height:100px;padding-left:15px;">
                @if($school->important_setting!=NULL&&$school->important_setting->result_photo_permission=='yes')
                <div style="width:48%;padding:3px;border:1px solid gray">
                  <img src="{{Storage::url($student->photo)}}" alt="শিক্ষার্থীর ছবি" width="100%" height="100px;">
                </div>
                @endif
              </div>
                <div class="col-33 school-logo">
                <img src="{{Storage::url($school->logo)}}" alt="School Logo">
                <h3>মার্কশীট</h3>
                </div>
                <div class="col-33">
                    <div class="table-place">
                        <table class="letter-grade letter-grade-bordered">
                          <thead>
                            <tr>
                              <th>লেটার গ্রেড</th>
                              <th>ক্লাস ইন্টারভ্যাল</th>
                              <th>গ্রেড পয়েন্ট</th>
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
                <!-- <div class="col-100"><div class="hr-map"><hr></div></div> -->
            </div>
            <div class="row1">
              <div class="col-50 student-info-s" style="padding:15px;padding-top: 0;">
                <div class="col-25 student-info-s">
                    <p>শিক্ষার্থীর নাম</p>
                    <p>পিতার নাম</p>
                    <p>মাতার নাম</p>
                    <p>আইডি</p>
                </div class="col-75 student-info-s">
                <div>
                    <p>: {{$student->user->name}}</p>
                    <p>: {{$student->father_name}}</p>
                    <p>: {{$student->mother_name}}</p>
                    <p>: {{$student->student_id}}</p>
                </div>
              </div>
              <div class="col-50 student-info-s" style="padding:15px;padding-top: 0;">
                <div class="col-25 student-info-s">
                    <p>শ্রেণী</p>
                    <p>শ্রেণী রোল</p>
                    <p>গ্রুপ</p>
                    <p>শিক্ষার্থীর ধরণ</p>
                </div>
                <div>
                    <p>: {{App\MasterClass::where(['id'=>$results[1]->master_class_id])->value('name')}}</p>
                    <p>: {{$results[1]->roll}}</p>
                    <p>: {{App\GroupClass::where(['id'=>$results[1]->group_class_id])->value('name')}}, ({{'শাখা - '.$results[1]->section.', শিফট - '.$results[1]->shift}})</p> 
                    <p>: {{$results[1]->regularity}}</p>
                </div>
              </div>
            </div>
            <div class="row1">
                <div class="col-100">
                    <div style="padding:15px;padding-top: 0;">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead>
                          <tr>
                            <th rowspan="2">ক্রমিক নং</th>
                            <th rowspan="2" style="width:34%">বিষয়ের নাম</th>
                            <th colspan="{{in_array($student->master_class_id,['8','9','10','11','12'])?'4':'3'}}" style="text-align: center">নম্বর বন্টন</th>
                            <th rowspan="2">মোট নম্বর</th>
                            <th rowspan="2">লেটার গ্রেড</th>
                            <th rowspan="2">প্রাপ্ত জিপিএ</th>
                          </tr>
                          <tr>
                @if(in_array($student->master_class_id,['8','9','10','11','12']))
                            <th>সিএ</th>
                @endif
                            <th>{{in_array($student->master_class_id,['8','9','10','11','12'])?'সিআর':'তত্ত্বীয়'}}</th>
                            <th>এমসিকিউ</th>
                            <th>পিআর</th>
                          </tr>
                        </thead>
                        <tbody>
            @php
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
             $sub_totals=$copulsary_results->map(function($row){
              return $row->sum('sub_total');
             });
             $total_marks=$copulsary_results->map(function($row){
              return $row->sum('total_mark');
             });
             $total_gpa=[];
            @endphp
            @foreach($copulsary_results as $ke=>$result)
             
              @foreach($result as $key => $res)
                @if($res->subject_status=='আবশ্যিক')
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$res->subject_name}}</td>
                    @if(in_array($student->master_class_id,['8','9','10','11','12']))
                    <td>{{$res->ca_mark}}</td>
                    @endif
                    <td>{{$res->cr_mark}}</td>
                    <td>{{$res->mcq_mark}}</td>
                    <td>{{$res->pr_mark}}</td>
                  @if($key==0)
                    @php
                     $name= str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $res->subject_name);
                     $sub_total=$sub_totals[$name];

                     $total_mark=$total_marks[$name];
                     $grade = Auth::grade(Auth::calculateResult($sub_total,$total_mark)['gpa']);
                     $gpa = Auth::calculateResult($sub_total,$total_mark)['gpa'];
                    @endphp
                    @if(count($result)>1)
                    <td rowspan="2">{{$sub_total}}</td>
                    <td rowspan="2">
                    @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
                    {{$grade}}
                    @else
                    F
                    @endif
                    </td>
                    <td rowspan="2">
                    @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
                    @php $total_gpa[]=$gpa; @endphp {{number_format($gpa, 2, '.', '')}}
                    @else
                    @php $total_gpa[]=0; @endphp {{'0.00'}}
                    @endif
                  </td>
                    @else
                    <td>{{($sub_total)}}</td>
                    <td>
                    @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
                    {{$grade}}
                    @else  
                    F
                    @endif
                  </td>
                    <td>
                    @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
                    @php $total_gpa[]=$gpa; @endphp {{number_format($gpa, 2, '.', '')}}
                    @else
                    @php $total_gpa[]=0; @endphp {{'0.00'}}
                    @endif
                  </td>
                    @endif
                  @endif
                  </tr>
                @endif
              @endforeach
            @endforeach
                          <tr>
                            <td colspan="{{in_array($student->master_class_id,['8','9','10','11','12'])?'6':'5'}}"><span class="total_mark">সর্বমোট = </span>
                            </td>
                            <td>
                              @php $grand_total=array_sum($sub_totals->toArray()) @endphp {{$grand_total}}
                            </td>
                          <td>
      @php
      if(array_product($total_gpa)>0){
         $full_gpa =array_sum($total_gpa)/count($copulsary_results);
      }else{
         $full_gpa=0;
      }
      $fainal_gpa=number_format(($full_gpa>5?5:$full_gpa), 2, '.', ''); 
      @endphp
                              {{Auth::grade($fainal_gpa)}}
                            </td>
                            <td>
                              {{$fainal_gpa}}
                            </td>
                          </tr>
                        </tbody>

                      </table>

                      
                       @if(count($optional_results)>0)
                          <h4 style="font-size: 14px;">অতিরিক্ত বিষয়</h4>
                          <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>ক্রমিক নং</th>
                                  <th>বিষয়ের নাম</th>
                            @if(in_array($student->master_class_id,['8','9','10','11','12']))
                                  <th>সিএ</th>
                            @endif
                                  <th>{{in_array($student->master_class_id,['8','9','10','11','12'])?'সিআর':'তত্ত্বীয়'}}</th>
                                  <th>এমসিকিউ</th>
                                  <th>পিআর</th>
                                  <th>মোট নম্বর</th>
                                  <th>লেটার গ্রেড</th>
                                  <th>জিপিএ</th>
                                </tr>
                              </thead>
                              <tbody>

                @php
                 $i=1;
                 foreach ($optional_results as $key=>$results) {
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
                                 $sub_totals=$optional_results->map(function($row){
                                  return $row->sum('sub_total');
                                 });
                                 $total_marks=$optional_results->map(function($row){
                                  return $row->sum('total_mark');
                                 });
                                 $total_4j_gpa=[];
                                @endphp
                                @foreach($optional_results as $result)
                                  @php 
                                  @endphp
                                  @foreach($result as $key => $res)
                                  
                                    @if($res->subject_status=='ঐচ্ছিক')
                                      <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$res->subject_name}}</td>
                                        @if(in_array($student->master_class_id,['8','9','10','11','12']))
                                        <td>{{$res->ca_mark}}</td>
                                        @endif
                                        <td>{{$res->cr_mark}}</td>
                                        <td>{{$res->mcq_mark}}</td>
                                        <td>{{$res->pr_mark}}</td>
        @if($key==0)
          @php
           $name= str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $res->subject_name); 
           $sub_total=$sub_totals[$name];

           $total_mark=$total_marks[$name];
           $grade = Auth::grade(Auth::calculateResult($sub_total,$total_mark)['gpa']);
           $gpa = Auth::calculateResult($sub_total,$total_mark)['gpa'];
          @endphp
          @if(count($result)>1)
            <td rowspan="2">{{$sub_total}}</td>
            <td rowspan="2">
            @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
            {{$grade}}
            @else
            F
            @endif
            </td>
            <td rowspan="2">
              @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
            @php $total_4j_gpa[]=$gpa; @endphp {{number_format($gpa, 2, '.', '')}}
            @else
            @php $total_4j_gpa[]=0; @endphp {{'0.00'}}
            @endif
          </td>
          @else
            <td>{{($sub_total)}}</td>
            <td>
            @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
            {{$mcq_pass_mark[$name]}}
            @else  
            F
            @endif
          </td>
            <td>
            @if($ca_mark[$name]>=$ca_pass_mark[$name]&&$cr_mark[$name]>=$cr_pass_mark[$name]&&$mcq_mark[$name]>=$mcq_pass_mark[$name]&&$pr_mark>$pr_pass_mark[$name])
            @php $total_4j_gpa[]=$gpa; @endphp {{number_format($gpa, 2, '.', '')}}
            @else
            @php $total_4j_gpa[]=0; @endphp {{'0.00'}}
            @endif
          </td>
          @endif
        @endif
                                      </tr>
                                    @endif
                                  @endforeach
                                @endforeach
                              </tbody>
                            </table>
                            <span class="fainal-result">
                @php
                if(array_product($total_gpa)>0){
                $total_gpa_with_4j=(array_sum($total_4j_gpa)>2)?(array_sum($total_4j_gpa)-2):0;
                $fainal_4j_gpa = (array_sum($total_gpa)+$total_gpa_with_4j)/count($copulsary_results);
                }else{
                $total_gpa_with_4j = 0;
                $fainal_4j_gpa = 0.00;
                }
                $fainal_4j_gpa=number_format(($fainal_4j_gpa>5?5:$fainal_4j_gpa), 2, '.', '');
                @endphp
                            <p>সবেমাট নম্বর ( অতিরিক্ত বিষয় সহ ) &nbsp; &nbsp; &nbsp; &nbsp; : {{$grand_total+array_sum($sub_totals->toArray())}}</p>
                            </span>
                            <p>প্রাপ্ত জিপিএ ( অতিরিক্ত বিষয় সহ ) &nbsp; &nbsp; &nbsp; &nbsp; : {{$fainal_4j_gpa}}</p>
                            </span>
                         @endif
                    @if(count($ca_results)>0)
                        <div class="col-100">
                          <h4>কন্টিনুয়াস এটাচমেন্ট</h4>
                          <table class="table table-bordered table-hover table-striped text-center">
                              <thead>
                                <tr>
                                  <th style="width:10%">ক্রমিক নং</th>
                                  <th>বিষয়</th>
                                  <th>নম্বর</th>
                                  <th>লেটার গ্রেড</th>
                                  <th>প্রাপ্ত জিপিএ</th>                                
                                </tr>
                              </thead>
                              <tbody>
                                @php $i=1; @endphp
                                @foreach($ca_results as $ca_result)
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{{$ca_result->subject_name}}</td>
                                  <td>{{$ca_result->marks}}</td>
                                  <td>{{$ca_result->grade_latter}}</td>
                                  <td>{{$ca_result->gpa}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                          </table>
                        </div>
                    @endif
                        <div class="col-100" style="text-align: right;margin-top:15px;padding-right:2.5%;"><img src="{{Storage::url($school->signature_p)}}" height="30px;"></div>
                        <div class="col-33 pirnt-date">
                          <p>ফলাফল প্রিন্ট করার তারিখ : {{date('Y-m-d')}} <br>Email: infoehsansoftware@gmail.com  <br>@Ehsan Software</p>
                        </div>
                        <div class="col-33 s-teacher-s">
                          <p>শ্রেণী শিক্ষকের স্বাক্ষর : </p>
                        </div>
                        <div class="col-33 p-teacher-s">
                          <p>প্রধান শিক্ষকের স্বাক্ষর :</p>
                        </div>
                     </div>
                </div>
                @else
                <div class="text-center">
                  <p>{{$student->user->name}} ফলাফলের জন্য</p>
                  <h3>সফটওয়্যার সেবা প্রদানকারী প্রতিষ্টানের সাথে যোগাযোগ করুন ।</h3>
                </div>
                @endif
            </div>
        </div>
        <div class="row">   
        @if($results)
            <a class="btn btn-default col-sm-2 col-sm-offset-4" style="color:#000" href="{{url('/result')}}">Search again</a>
          
            <a onclick="javascript:print_genarator('div-id-name')" class="btn btn-default col-sm-2 col-sm-offset-" style="color: #000" href="javascript:void" target="_blank">Print</a>
        @endif
    </div>

    </div>
</div>
@endsection

@section('script')
<script>
function print_genarator(lyear){
var genaretor = window.open();
var layeartext = document.getElementById(lyear);
 genaretor.document.write(layeartext.innerHTML.replace("Print Me"));
 genaretor.document.close();
 genaretor.print();
 genaretor.close();
}
</script>
<script src="{{asset('backEnd/js/pdf/jquery-2.1.3.js')}}"></script>
<script charset="UTF-8" type="text/javascript"  src="{{asset('backEnd/js/pdf/jspdf.js')}}"></script>
<script charset="UTF-8" type="text/javascript"  src="{{asset('backEnd/js/pdf/printArea.js')}}"></script>
@endsection

