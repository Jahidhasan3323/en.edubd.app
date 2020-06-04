@extends('backEnd.master')

@section('mainTitle', 'Class Migration')
@section('active_class_promotion', 'active')
@section('style')

@endsection
@section('content')
   <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
       <div class="page-header">
           <h1 class="text-center text-temp">Students Class Promotion</h1>
       </div>

       <div class="panel-body">
         <div class="row">
           <div class="col-sm-12">
               @if(Session::has('errmgs'))
                   @include('backEnd.includes.errors')
               @endif
               @if(Session::has('sccmgs'))
                   @include('backEnd.includes.success')
               @endif
           </div>
         </div>
       </div>

       <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-md-8 col-md-offset-2 alert-danger">
           <p class="text-center error" style=""></p>
       </div>
       <style type="text/css">
           hr{
               margin:0;
               margin-bottom: 10px;
           }
       </style>
       <div class="panel-body">
           <form action="{{url('promotion/menual/search')}}" method="get" enctype="multipart/form-data">
               {{csrf_field()}}

               <div class="row">
                   <div class="col-md-2 col-sm-12">
                       <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                           <label class="" for="master_class_id">Class <span class="star">*</span></label>
                           <div class="">
                               <select style="width: 100% !important;" class="form-control" name="master_class_id" id="master_class_id">
                                   <option value="">Select Class</option>
                                   @foreach($classes as $class)
                                       <option value="{{$class->id}}">{{$class->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                           @if ($errors->has('master_class_id'))
                               <span class="help-block">
                                   <strong>{{$errors->first('master_class_id')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2 col-sm-12">
                       <div class="form-group {{$errors->has('group') ? 'has-error' : ''}}">
                           <label class="" for="group_class_id">Group<span class="star">*</span></label>
                           <div class="">
                               <select style="width: 100% !important;" class="form-control" name="group_class_id" id="group_class_id">
                                   <option value="">Select Group</option>
                                   @foreach($groups as $group)
                                       <option value="{{$group->id}}">{{$group->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                           @if ($errors->has('group_class_id'))
                               <span class="help-block">
                                   <strong>{{$errors->first('group_class_id')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-md-2 col-sm-12">
                        <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                            <label class="" for="shift">Shift <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="shift" id="shift">
                                    <option value="">Select Shift</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Day">Day</option>
                                    <option value="Evening">Evening</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                            @if ($errors->has('shift'))
                                <span class="help-block">
                                    <strong>{{$errors->first('shift')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group {{$errors->has('section') ? 'has-error' : ''}}">
                            <label class="" for="section">Section <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="section" id="section">
                                    <option value="">Select Section</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->name}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{$errors->first('section')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group {{$errors->has('exam_year') ? 'has-error' : ''}}">
                            <label class="" for="exam_year">Exam Year<span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="exam_year" id="exam_year">
                                    <option value="">Select Exam Year</option>
                                    @if(!$years->count())
                                        <option>No result has given</option>
                                    @endif
                                    @foreach($years as $year)
                                        <option value="{{$year->exam_year}}">{{$year->exam_year}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('exam_year'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_year')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <label class="" for="exam_type_id">Exam <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="exam_type_id" id="exam_type_id">
                                    <option value="">Select Exam Type</option>
                                    @foreach($exams as $exam)
                                        @if($exam->name=='Annual Examination')
                                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('exam_type_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('exam_type_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-md-2 col-md-offset-5">
                       <div class="form-group">
                           <button id="save_btn" type="submit" class="btn btn-block btn-info">Search</button>
                       </div>
                   </div>
               </div>
               <hr>
           </form>
       </div>

       @if(isset($students)&& count($students)>0)
         <h4 style="margin-bottom: 10px;" class="text-center">Select Students </h4>
         <h5 style="margin-bottom: 10px;" class="text-center">Total Student : {{count($students)}}</h5>
          <div class="panel-body" style="margin-top: 10px;">
              <form action="{{url('/promotion/menual')}}" method="post" enctype="multipart/form-data">
                 @method('patch')
                 {{csrf_field()}}
                 @php $i=1 @endphp
                 <input type="hidden" name="all_student" value="{{json_encode($students->pluck('student_id'))}}">
                 <input type="hidden" name="master_class_id" value="{{$request->master_class_id}}">
                 <input type="hidden" name="group_class_id" value="{{$request->group_class_id}}">
                 <input type="hidden" name="shift" value="{{$request->shift}}">
                 <input type="hidden" name="section" value="{{$request->section}}">
                 <input type="hidden" name="exam_year" value="{{$request->exam_year}}">
                 <input type="hidden" name="exam_type_id" value="{{$request->exam_type_id}}">
                 <div class="table-responsive">
                     <table class="table table-hover table-striped">
                          <tr>
                             <th>Student Name </th>
                             <th>Class Roll</th>
                             <th style="width: 10%">Changing Roll</th>
                             <th>Group</th>
                             <th>Section</th>
                             <th>Student ID</th>
                          </tr>
                        @foreach($students as $keys=>$student)

                         <tr>
                             <td>
                                 <input class="form-check-input number" name="number[]" type="checkbox" value="{{$student->student_id}}" id="defaultCheck{{$i}}">
                                 <label class="form-check-label" for="defaultCheck{{$i++}}">
                                   {{$student->user->name}}
                                 </label>
                             </td>
                             <td>
                                 {{$student->roll}}
                             </td>
                             <td>
                              @php
                               if(isset($class_position_numbers['success_position_numbers'][$student->student_id])){
                                $update_roll=array_search($student->student_id.''.$class_position_numbers['success_position_numbers'][$student->student_id],$class_position_numbers['success_numbers'])+1;
                               }else if(isset($class_position_numbers['fail_position_numbers'][$student->student_id])){
                                $update_roll=array_search($student->student_id.''.$class_position_numbers['fail_position_numbers'][$student->student_id],$class_position_numbers['fail_numbers'])+1;
                               }else{
                                $update_roll=0;
                              }

                              @endphp
                              <input type="text" name="roll[{{$student->student_id}}]" class="form-control" value="{{$update_roll}}">
                             </td>
                             <td>
                                   <select style="width: 100% !important;" class="form-control" name="group_name[{{$student->student_id}}]" id="{{'group_name'.$student->student_id}}">
                                       @foreach($groups as $group)
                                           <option value="{{$group->name}}" {{($group->name==$student->group)?'selected':''}}>{{$group->name}}</option>
                                       @endforeach
                                   </select>
                             </td>
                             <td>
                              <select style="width: 100% !important;" class="form-control" name="section_name[{{$student->student_id}}]" id="{{'section_name'.$student->student_id}}">
                                  <option value="A" {{('A'==$student->section)? 'selected':''}}>A</option>
                                  <option value="B" {{('B'==$student->section)? 'selected':''}}>B</option>
                                  <option value="C" {{('C'==$student->section)? 'selected':''}}>C</option>
                                  <option value="D" {{('D'==$student->section)? 'selected':''}}>D</option>
                                  @foreach($units as $unit)
                                      <option value="{{$unit->name}}" {{($unit->name==$student->section)?'selected':''}}>{{$unit->name}}</option>
                                  @endforeach
                              </select>
                             </td>
                             <td>
                                 {{$student->student_id}}
                             </td>
                         </tr>

                         @endforeach
                         @if(count($students)>0)
                         <tr>
                             <td colspan="3">
                                 <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">সব চেক / আনচেক</label>
                             </td>
                         </tr>
                         @endif
                     </table>
                  </div>
                      <div class="col-md-5">
                        Do you want to send SMS ??
                      </div>
                      <div class="col-md-7">
                        Ans : <input type="checkbox" name="sms_service" value="yes"> Yes
                        <input type="checkbox" name="sms_service" value="no"> No
                      </div>
                 @if(count($students)>0)
                 <hr>
                 <hr>
                 <div class="">
                     <div class="row">
                         <div class="col-md-2 col-md-offset-5">
                             <div class="form-group">
                              <br>
                              <br>
                                 <button id="save_btn" type="submit" class="btn btn-block btn-info">Promot</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 @endif
              </form>
          </div>
       @endif
@endsection

@section('script')
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script type="text/javascript">
        function checkNumber(){
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
    @if(isset($students))
    <script type="text/javascript">
        document.getElementById("master_class_id").value="{{$request->master_class_id}}"
        document.getElementById("group_class_id").value="{{$request->group_class_id}}"
        document.getElementById("shift").value="{{$request->shift}}"
        document.getElementById("section").value="{{$request->section}}"
        document.getElementById("exam_year").value="{{$request->exam_year}}"
        document.getElementById("exam_type_id").value="{{$request->exam_type_id}}"
    </script>
    @endif
    @if($errors->has('*'))
    <script type="text/javascript">
        document.getElementById("master_class_id").value="{{old('master_class_id')}}"
        document.getElementById("group_class_id").value="{{old('group_class_id')}}"
        document.getElementById("shift").value="{{old('shift')}}"
        document.getElementById("section").value="{{old('section')}}"
        document.getElementById("exam_year").value="{{old('exam_year')}}"
        document.getElementById("exam_type_id").value="{{old('exam_type_id')}}"
    </script>
    @endif

@endsection
