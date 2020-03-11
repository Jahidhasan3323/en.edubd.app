@extends('backEnd.master')

@section('mainTitle', 'Result View')
@section('active_result', 'active')

@section('content')
<div id="forPdf" class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
<div class="page-header text-center">
    <h3>প্রগ্রেস রিপোর্ট কার্ড</h3>
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
            body{color:#0000009e; } .col-25{float: left; width: 25%; }.col-75{float: left; width: 75%; } .col-33{float: left; width: 33.33333333%; } .col-50{float: left; width: 50%; } .col-100{float: left; width: 100%; } .row1:after {content: ""; display: table; clear: both; } .school-info{text-align: center; } .school-info h3, .school-info h4 .school-info h5{padding: 2; margin: 0; } .school-logo{text-align: center; } .school-logo>img{width: 60px; height: 60px; } .table-place{float: right; padding-right: 15px; } .letter-grade tr>td{text-align: center; font-size: 9px; } .letter-grade tr>th{text-align: center; font-size: 9px; } .letter-grade table {border-spacing: 0; border-collapse: collapse; } .letter-grade td, .letter-grade th {padding: 0; } .letter-grade td, .letter-grade th {background-color: #fff !important; } .btn > .caret, .dropup > .btn > .caret {border-top-color: #000 !important; } .label {border: 1px solid #000; } .letter-grade {border-collapse: collapse !important; } .letter-grade-bordered th, .letter-grade-bordered td {border: 1px solid #ddd !important; } .hr-map{padding-left:15px; padding-right:15px; } .table-bordered {border: 1px solid #ddd; } .table {width: 100%; margin-bottom: 20px; } table {max-width: 100%; background-color: transparent; } table {border-spacing: 0; border-collapse: collapse; } * {-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; } table {display: table; border-collapse: collapse; border-spacing: 2px; border-color: grey; } .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {border: 1px solid #ddd; font-size: 12px; } .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {padding: 2px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; text-align: center; font-size: 12px; } .total_mark{float: right; } .student-info-s p{padding: 0; margin: 0; font-size: 12px; } .root-bg{position: relative; border:4px double black; height: 1015px; z-index: 1; } .bg-logo{position: absolute; top: 0; left:0; width: 100%; height: 1015px; background-image: url({{Storage::url($school->logo)}}); background-repeat: no-repeat, repeat; background-size:500px 500px; background-position: center; z-index: -1; opacity: 0.2; } .fainal-result p{padding: 0; margin:0; font-size: 12px; } .pirnt-date p, .s-teacher-s p,.p-teacher-s p{font-size: 12px; } .s-teacher-s p{text-align: center; } .p-teacher-s p{float: right;}
        </style>

    @foreach($all_results as $student_id=>$results)
      @php
        $student=\App\Student::where(['school_id'=>$school->id,'student_id'=>$student_id])->first();
      @endphp
     @if(($school->service_type_id==1 && $student->id_card_exits==1) || $school->service_type_id!=1)
        @php
          $copulsary_results = collect($results)->groupBy(function($element){
           return str_replace(['১ম পত্র','২য় পত্র','প্রথম পত্র','দ্বিতীয় পত্র','১ম','২য়','প্রথম','দ্বিতীয়'], '', $element['subject_name']);
          });
         $i=1;
         foreach ($copulsary_results as $key=>$c_results) {
            $subjects[$i++]=$c_results;
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
        @php
        $total_gpa_otional=[];
         $sub_totals=$copulsary_results->map(function($row){
          return $row->sum('sub_total');
         });
         $total_marks=$copulsary_results->map(function($row){
          return $row->sum('total_mark');
         });
         foreach($copulsary_results as $subject=>$c_result){
          if($ca_mark[$subject]>=$ca_pass_mark[$subject]&&$cr_mark[$subject]>=$cr_pass_mark[$subject]&&$mcq_mark[$subject]>=$mcq_pass_mark[$subject]&&$pr_mark>$pr_pass_mark[$subject]){
            $sub_total=$sub_totals[$subject];
            $total_mark=$total_marks[$subject];
            if($c_result[0]['subject_status']=='আবশ্যিক'){
             $total_gpa_compulsary[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa'];
            }else{
             $total_gpa_otional[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa']; 
            }
          }else{
            if($c_result[0]['subject_status']=='আবশ্যিক'){
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
         
         $grand_total_marks=\App\Result::where([
            'exam_year' => $results[0]->exam_year,
            'exam_type_id' => $results[0]->exam_type_id,
            'master_class_id' => $results[0]->master_class_id,
            'group_class_id' => $results[0]->group_class_id,
            'shift' => $results[0]->shift,
            'section' => $results[0]->section,
            'school_id' => Auth::getSchool(),
         ])->select('grand_total_mark')->groupBy('student_id')->get();
         $grand_total_marks=collect($grand_total_marks)->pluck('grand_total_mark')->toArray();
         $grand_total_marks=array_reverse(\Illuminate\Support\Arr::sort($grand_total_marks));
         $grand_total_marks=array_reverse(\Illuminate\Support\Arr::sort($grand_total_marks));
        @endphp
        <div class="col-md-12 root-bg" style="margin-bottom: 58px;">
          <div class="bg-logo"></div>
            <div class="row1">
                <div class="col-100 school-info">
                   <h3>{{$school->user->name}}</h3> 
                   <h5>{{$school->address}}</h5>
                   <h4>{{$exam->name.'র প্রগ্রেস রিপোর্ট- '.str_replace($s, $r, $request->exam_year).' খ্রি:'}}</h4>
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
                <h3>প্রগ্রেস রিপোর্ট কার্ড</h3>
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
                </div class="col-75 student-info-s">
                <div>
                    <p>: {{App\MasterClass::where(['id'=>$request->master_class_id])->value('name')}}</p>
                    <p>: {{$results[1]['roll']}}</p>
                    <p>: {{App\GroupClass::where(['id'=>$request->group_class_id])->value('name')}}, ({{'শাখা - '.$request->section.', শিফট - '.$request->shift}})</p> 
                    <p>: {{$results[1]['regularity']}}</p>
                </div>
              </div>
            </div>
            <div class="row1">
                <div class="col-100">
                    <div style="padding:15px;padding-top: 0;">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead>
                          <tr>
                            <th width="10%">ক্রমিক নং</th>
                            <th width="30%">বিষয়ের নাম</th>
                            <th width="10%">মোট নম্বর</th>
                            <th width="10%">অবস্থান</th>
                            <th width="13%">প্রথম অবস্থান</th>
                            <th width="28%">শ্রেণী রোল</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php 


                          $serial=1; @endphp
                          @foreach($results as $key=>$result)
                          <tr>
                            <td>{{$serial++}}</td>
                            <td>{{$result->subject_name}}</td>
                            <td>{{$result->sub_total}}</td>
                            @php

                            $query_data=[
                              'subject_name'=>$result->subject_name,
                              'school_id'=>$result->school_id,
                              'exam_year'=>$result->exam_year,
                              'exam_type_id'=>$result->exam_type_id,
                              'master_class_id'=>$result->master_class_id,
                              'group_class_id'=>$result->group_class_id,
                              'shift'=>$result->shift,
                              'section'=>$result->section
                            ];
                            $sub_totals=App\Result::where($query_data)->select('student_id','sub_total')->get();

                            $sub_totals=collect($sub_totals)->pluck('sub_total')->toArray();
                            $sub_totals=array_reverse(\Illuminate\Support\Arr::sort($sub_totals));
                            @endphp
                            <td>{{array_search($result->sub_total, array_unique($sub_totals,true),true)+1}} </td>
                            <td>{{max($sub_totals)}}</td>
                            @php
                            $query_data['sub_total']=max($sub_totals);
                            $student_id=App\Result::where($query_data)->select('student_id')->get();
                            $student_id=collect($student_id)->pluck('student_id')->toArray();
                            $students=App\Student::where('school_id',$result->school_id)->whereIn('student_id',$student_id)->select('roll','student_id')->get();
                            @endphp
                            <td>
                              @foreach($students as $row=>$student)
                               {{$student->roll}}{{(($row+1)==count($students))?'':', '}} 
                              @endforeach
                            </td>
                          </tr>
                          @endforeach
                        </tbody>

                     </table>
                    @php 
                     $fainal_gpa=(array_product($total_gpa_compulsary)>0)?$total_gpa:'0.00';
                    @endphp
                          <p style="padding: 0;margin:0">
                            মোট নম্বর : {{$results[0]['grand_total_mark']}}, প্রাপ্ত জিপিএ : {{$fainal_gpa}}, শ্রেণী অবস্থান : 
                            @php
                             if(in_array($results[0]['student_id'].''.($fainal_gpa+$results[0]['grand_total_mark']),$class_position_numbers['success_numbers']))
                             {
                              $update_roll=array_search($results[0]['student_id'].''.($fainal_gpa+$results[0]['grand_total_mark']),$class_position_numbers['success_numbers'])+1;
                             }
                             else if(in_array($results[0]['student_id'].''.($fainal_gpa+$results[0]['grand_total_mark']),$class_position_numbers['fail_numbers']))
                             {
                              $update_roll=array_search($results[0]['student_id'].''.($fainal_gpa+$results[0]['grand_total_mark']),$class_position_numbers['fail_numbers'])+1;
                             }else
                             {
                              $update_roll=0;
                            }
                            @endphp
                            {{$update_roll}}
                          </p>
                            <p style="padding: 0;margin:0">মন্তব্য : 
                              @if($fainal_gpa==5)
                              অপূর্ব
                              @elseif($fainal_gpa<5&&$fainal_gpa>=4)
                              উত্তম
                              @elseif($fainal_gpa<4.00&&$fainal_gpa>=3.50)
                              ভাল
                              @elseif($fainal_gpa<3.50&&$fainal_gpa>=3.00)
                              ভাল
                              @elseif($fainal_gpa<3.00&&$fainal_gpa>=2.00)
                              মোটামুটি
                              @elseif($fainal_gpa<2.00&&$fainal_gpa>=1.00)
                              সান্তনামূলক
                              @else
                              দুঃখজনক
                              @endif
                            </p>

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
            </div>
        </div>
    @php
     $total_gpa_otional=[];
     $total_gpa_compulsary=[];
    @endphp
    @else
    <div class="text-center">
      <p>{{$student->user->name}} ফলাফলের জন্য</p>
      <h3>সফটওয়্যার সেবা প্রদানকারী প্রতিষ্টানের সাথে যোগাযোগ করুন ।</h3>
    </div>
    @endif
    @endforeach
    </div>
    <div class="row">   
    @if($all_results)
        <a class="btn btn-default col-sm-2 col-sm-offset-4" style="color:#000" href="{{url('/result')}}">Search again</a>
      
        <a onclick="javascript:print_genarator('div-id-name')" class="btn btn-default col-sm-2 col-sm-offset-" style="color: #000" href="javascript:void" target="_blank">Print</a>
    @endif
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

