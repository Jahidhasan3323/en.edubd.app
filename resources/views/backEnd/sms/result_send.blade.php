@extends('backEnd.master')

@section('mainTitle', 'SMS')

@section('active_sms', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Send Result SMS</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="col-sm-12">
            <h4 style="margin-bottom: 20px;" class="text-center">Select All from below</h4>
                <form action="{{url('/sms/result/search')}}" method="get">
                    {{csrf_field()}}
                    <div class="col-sm-2 {{$errors->has('exam_year') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="exam_year" id="exam_year">
                                <option value="">Select Exam Year</option>
                                @if(!$exam_years->count())
                                    <option>No result has given</option>
                                @endif
                                @foreach($exam_years as $exam_year)
                                    <option value="{{$exam_year->exam_year}}" >{{$exam_year->exam_year}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('exam_year'))
                        <span class="help-block">
                            <strong>{{$errors->first('exam_year')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-2 {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="master_class_id" id="master_class_id">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" >{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('master_class_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('master_class_id')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-2 {{$errors->has('group') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="group" id="group">
                                <option value="">Select Group</option>
                                @foreach($class_groups as $class_group)
                                    <option value="{{$class_group->name}}" >{{$class_group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('group'))
                        <span class="help-block">
                            <strong>{{$errors->first('group')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-2 {{$errors->has('shift') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="shift" id="shift">
                                <option value="">Select Shift</option>
                                <option value="Morning">Morning</option>
                                <option value="Day">Day</option>
                                <option value="Evening">Evening</option>
                                <option value="Night">Night</option>
                            </select>
                        </div>
                        @if($errors->has('shift'))
                        <span class="help-block">
                            <strong>{{$errors->first('shift')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-2 {{$errors->has('section') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select name="section" id="section" class="form-control" required="">
                                <option value="">Select Section</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                @foreach($units as $unit)
                                <option value="{!!$unit->name!!}">{!!$unit->name!!}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('section'))
                        <span class="help-block">
                            <strong>{{$errors->first('section')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-2 {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                           <select name="exam_type_id" id="exam_type_id" class="form-control" required="">
                               <option value="">Select Exam Type</option>
                               @foreach($exam_types as $exam_type)
                               <option value="{{$exam_type->id}}">{{$exam_type->name}}</option>
                               @endforeach
                           </select>
                        </div>
                        @if($errors->has('exam_type_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('exam_type_id')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-2 col-md-offset-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Search</button>
                        </div>
                    </div>
                </form>
        </div>
        @if(isset($results))
        <div class="col-sm-12">
        <h4 style="margin-bottom: 10px;" class="text-center">Select Students </h4>
        <h5 style="margin-bottom: 10px;" class="text-center">Total Students: {{count($results)}}</h5>
        <div class="row">
            <div class="panel-body" style="margin-top: 10px;">
                <form action="{{url('/sms/result-send')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @php $i=1; @endphp
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-body table-responsive">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>Student Name </th>
                                <th>Student ID</th>
                                <th>Mobile</th>
                                <th>Class Roll</th>
                                <th>Total Marks</th>
                                <th>G.P.A</th>
                            </tr>
                           @foreach($results as $res)
                           @if(($school->service_type_id==1 && $res->student->id_card_exits==1) || $school->service_type_id!=1)
                            <tr>
                                <td>
                                    @php
                                    $student_results=\App\Result::where(['school_id'=>Auth::getSchool(),'student_id'=>$res->student_id])->get();

                                    $copulsary_results = collect($student_results)->groupBy(function($element){
                                     return str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper', '1st', '2nd', 'first', 'second','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper', '1st', '2nd', 'First', 'Second'], '', $element['subject_name']);
                                    });
                                     $i=1;
                                     foreach ($copulsary_results as $key=>$results) {
                                        $subjects[$i++]=$results;
                                     }
                                     foreach ($subjects as $key => $subject){
                                         if(count($subject)>1){
                                         $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper', '1st', '2nd', 'first', 'second','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper', '1st', '2nd', 'First', 'Second'], '', $subject[0]->subject_name);
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
                                          $name=str_replace(['1st letter', '2nd letter', '1st paper', '2nd paper', 'first paper', 'second paper', '1st', '2nd', 'first', 'second','1st Letter', '2nd Letter', '1st Paper', '2nd Paper', 'first Paper', 'second Paper', '1st', '2nd', 'First', 'Second'], '', $subject[0]->subject_name);
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
                                        if($result[0]['subject_status']=='Compulsory'){
                                         $total_gpa_compulsary[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa'];
                                        }else{
                                         $total_gpa_otional[$subject]= Auth::calculateResult($sub_total,$total_mark)['gpa'];
                                        }
                                      }else{
                                        if($result[0]['subject_status']=='Compulsory'){
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

                                    <input class="form-check-input number" name="students[]" type="checkbox" value="{{($res->student->f_mobile_no==NULL)?($res->student->m_mobile_no==NULL?$res->student->guardian_mobile:$res->student->m_mobile_no):$res->student->f_mobile_no}},{{$res->student->user->name}},{{$res->student->masterClass->name}},{{$res->grand_total_mark}},{{(array_product($total_gpa_compulsary)>0)?$total_gpa:'0.00'}},{{$res->student->id}}" id="defaultCheck{{$i}}">
                                    <label class="form-check-label" for="defaultCheck{{$i++}}">
                                      {{$res->student->user->name}}
                                    </label>
                                </td>
                                <td>
                                    {{$res->student->student_id}}
                                </td>
                                <td>
                                    {{($res->student->f_mobile_no!=NULL)?$res->student->f_mobile_no:($res->student->m_mobile_no!=NULL?$res->student->m_mobile_no:($res->student->guardian_mobile!=NULL?$res->student->guardian_mobile:'নম্বর নেই'))}}
                                </td>
                                <td>
                                    {{$res->student->roll}}
                                </td>
                                <td>{{$res->grand_total_mark}}</td>
                                <td>

                                    @if(array_product($total_gpa_compulsary)>0)
                                      {{$total_gpa}}
                                    @else
                                    {{"0.00"}}
                                    @endif
                                </td>
                            </tr>
                           @else
                            <tr><td colspan="6">{{$res->student->user->name}} Please contact your service provider for result.</td></tr>
                           @endif
                            @endforeach
                            @if(count($results)>0)
                            <tr>
                                <td colspan="5">
                                    <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">All Check / Uncheck</label>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    </div>

                    @if(count($results)>0)
                    <hr>

                    <div class="">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-5">
                                <div class="form-group">
                                    <button id="save_btn" type="submit" class="btn btn-block btn-info">Send SMS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endif
                </form>
            </div>
        </div>
        </div>
        @endif
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function checkNumber(){
            // Check #x
            if($("#all_check").prop('checked') == true){
                $(".number").prop( "checked", true );
            }else{
                $(".number").prop( "checked", false );
            }
        }
    </script>
    <script>
        $( function() {
            $( ".date" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
        } );
    </script>
    @if(isset($results))
    <script type="text/javascript">
        document.getElementById("exam_year").value="{{$request->exam_year}}"
        document.getElementById("master_class_id").value="{{$request->master_class_id}}"
        document.getElementById("group").value="{{$request->group}}"
        document.getElementById("section").value="{{$request->section}}"
        document.getElementById("shift").value="{{$request->shift}}"
        document.getElementById("exam_type_id").value="{{$request->exam_type_id}}"
    </script>
    @endif

    @if($errors->has('*'))
    <script type="text/javascript">
        document.getElementById("exam_year").value="{{old('exam_year')}}"
        document.getElementById("master_class_id").value="{{old('master_class_id')}}"
        document.getElementById("group").value="{{old('group')}}"
        document.getElementById("shift").value="{{old('shift')}}"
        document.getElementById("section").value="{{old('section')}}"
        document.getElementById("exam_type_id").value="{{old('exam_type_id')}}"
    </script>
    @endif

@endsection
