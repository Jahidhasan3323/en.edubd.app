@extends('backEnd.master')

@section('mainTitle', 'Result List')

@section('active_latter', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ফলাফলের তালিকা তৈরি করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
          <ul class="nav nav-pills nav-justified">
              <li class="{{$active_path=='all'? 'active':''}}"><a data-toggle="tab" href="#all">সব</a></li>
              <li class="{{$active_path=='class_based'? 'active':''}}"><a data-toggle="tab" href="#class_based">শ্রেণী ভিত্তিক</a></li>
              <li class="{{$active_path=='section_based'? 'active':''}}"><a data-toggle="tab" href="#section_based">শাখা ভিত্তিক</a></li>
              <li class="{{$active_path=='group_based'? 'active':''}}"><a data-toggle="tab" href="#group_based">গ্রুপ/বিভাগ ভিত্তিক</a></li>
            </ul>

            <div class="tab-content">
              <div id="all" class="tab-pane fade {{$active_path=='all'? 'in active':''}}">
                <h4 style="margin-bottom: 20px;" class="text-center">নিচের সব নির্বাচন করুন</h4>
                <form action="{{url('result-list/search')}}" method="get">
                    {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-2 col-sm-12 {{$errors->has('exam_year') ? 'has-error' : ''}}">
                          <div class="form-group">
                              <select class="form-control" style="width:100%" name="exam_year" id="exam_year">
                                  <option value="">...পরীক্ষার বছর...</option>
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
                        <div class="col-md-2 col-sm-12 {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select class="form-control" style="width:100%" name="master_class_id" id="master_class_id">
                                    <option value="">...শ্রেণী নির্বাচন করুন...</option>
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
                        <div class="col-md-2 col-sm-12 {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select class="form-control" style="width:100%" name="group_class_id" id="group_class_id">
                                    <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
                                    @foreach($class_groups as $class_group)
                                        <option value="{{$class_group->id}}" >{{$class_group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('group_class_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('group_class_id')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-2 col-sm-12 {{$errors->has('shift') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select class="form-control" style="width:100%" name="shift" id="shift">
                                    <option value="">শিফট নির্বাচন করুন</option>
                                    <option value="সকাল">সকাল</option>
                                    <option value="দিন">দিন</option>
                                    <option value="সন্ধ্যা">সন্ধ্যা</option>
                                    <option value="রাত">রাত</option>
                                </select>
                            </div>
                            @if($errors->has('shift'))
                            <span class="help-block">
                                <strong>{{$errors->first('shift')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-2 col-sm-12 {{$errors->has('section') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select name="section" id="section" class="form-control" style="width:100%" required="">
                                    <option value="">...শাখা নির্বাচন করুন...</option>
                                    <option value="ক">ক</option>
                                    <option value="খ">খ</option>
                                    <option value="গ">গ</option>
                                    <option value="ঘ">ঘ</option>
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
                        <div class="col-md-2 col-sm-12 {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                               <select name="exam_type_id" id="exam_type_id" class="form-control" style="width:100%" required="">
                                   <option value="">...পরীক্ষার ধরন...</option>
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
                        <div class="col-md-2 col-sm-12 col-md-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">অনুসন্ধান</button>
                            </div>
                        </div>
                      </div>
                </form>
              </div>
              <div id="class_based" class="tab-pane fade {{$active_path=='class_based'? 'in active':''}}">
                <h4 style="margin-bottom: 20px;" class="text-center">নিচের সব নির্বাচন করুন</h4>
                <form action="{{url('result-list/search')}}" method="get">
                    {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-4 col-sm-12 {{$errors->has('exam_year') ? 'has-error' : ''}}">
                          <div class="form-group">
                              <select class="form-control" style="width:100%" name="exam_year" id="exam_year_1">
                                  <option value="">...পরীক্ষার বছর...</option>
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
                        <div class="col-md-4 col-sm-12 {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select class="form-control" style="width:100%" name="master_class_id" id="master_class_id_1">
                                    <option value="">...শ্রেণী নির্বাচন করুন...</option>
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
                        
                        <div class="col-md-4 col-sm-12 {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                               <select name="exam_type_id" id="exam_type_id_1" class="form-control" style="width:100%" required="">
                                   <option value="">...পরীক্ষার ধরন...</option>
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
                        <div class="col-md-2 col-sm-12 col-md-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">অনুসন্ধান</button>
                            </div>
                        </div>
                      </div>
                </form>
              </div>
              <div id="section_based" class="tab-pane fade {{$active_path=='section_based'? 'in active':''}}">
                <h4 style="margin-bottom: 20px;" class="text-center">নিচের সব নির্বাচন করুন</h4>
                <form action="{{url('result-list/search')}}" method="get">
                    {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-3 col-sm-12 {{$errors->has('exam_year') ? 'has-error' : ''}}">
                          <div class="form-group">
                              <select class="form-control" style="width:100%" name="exam_year" id="exam_year_3">
                                  <option value="">...পরীক্ষার বছর...</option>
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
                        <div class="col-md-3 col-sm-12 {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select class="form-control" style="width:100%" name="master_class_id" id="master_class_id_3">
                                    <option value="">...শ্রেণী নির্বাচন করুন...</option>
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

                        <div class="col-md-3 col-sm-12 {{$errors->has('section') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select name="section" id="section_3" class="form-control" style="width: 100%" required="">
                                    <option value="">...শাখা নির্বাচন করুন...</option>
                                    <option value="ক">ক</option>
                                    <option value="খ">খ</option>
                                    <option value="গ">গ</option>
                                    <option value="ঘ">ঘ</option>
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
                        
                        <div class="col-md-3 col-sm-12 {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                               <select name="exam_type_id" id="exam_type_id_3" class="form-control" style="width:100%" required="">
                                   <option value="">...পরীক্ষার ধরন...</option>
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
                        <div class="col-md-2 col-sm-12 col-md-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">অনুসন্ধান</button>
                            </div>
                        </div>
                      </div>
                </form>
              </div>
              <div id="group_based" class="tab-pane fade {{$active_path=='group_based'? 'in active':''}}">
                
                <h4 style="margin-bottom: 20px;" class="text-center">নিচের সব নির্বাচন করুন</h4>
                <form action="{{url('result-list/search')}}" method="get">
                    {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-3 col-sm-12 {{$errors->has('exam_year') ? 'has-error' : ''}}">
                          <div class="form-group">
                              <select class="form-control" style="width:100%" name="exam_year" id="exam_year_4">
                                  <option value="">...পরীক্ষার বছর...</option>
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
                        <div class="col-md-3 col-sm-12 {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select class="form-control" style="width:100%" name="master_class_id" id="master_class_id_4">
                                    <option value="">...শ্রেণী নির্বাচন করুন...</option>
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

                        <div class="col-md-3 col-sm-12 {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <select class="form-control" style="width: 100%" name="group_class_id" id="group_class_id_4">
                                    <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
                                    @foreach($class_groups as $class_group)
                                        <option value="{{$class_group->id}}" >{{$class_group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('group_class_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('group_class_id')}}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-3 col-sm-12 {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <div class="form-group">
                               <select name="exam_type_id" id="exam_type_id_4" class="form-control" style="width:100%" required="">
                                   <option value="">...পরীক্ষার ধরন...</option>
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
                        <div class="col-md-2 col-sm-12 col-md-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">অনুসন্ধান</button>
                            </div>
                        </div>
                      </div>
                </form>
              </div>
            </div>
        </div>
        
        
        @if(isset($results) && count($results)>0)
        <div class="col-sm-12 text-center">
        <h5 style="margin-bottom: 10px;" class="text-center">মোট শিক্ষার্থী : {{count($results)}}</h5>
        <br><hr>
        <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('student-list-print').submit();"><i class="glyphicon glyphicon-print"></i> প্রিন্ট করুন</a>
        <form id="student-list-print" action="{{ url('result-list/print') }}" method="POST" style="display: none;" target="_blank">
          {{ csrf_field() }}
          <input type="hidden" value="{{count($results)}}" name="students">
          <input type="hidden" value="{{json_encode($results,TRUE)}}" name="results">
          <input type="hidden" value="{{json_encode($class_position_numbers,TRUE)}}" name="class_position_numbers">
          <input type="hidden" value="{{$request->exam_type_id}}" name="exam_type_id">
        </form>
        <div class="row">
            <div class="panel-body" style="margin-top: 10px;">
                    @php $i=1; @endphp
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-body table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:5%">ক্র নং</th>
                                    <th class="text-center">শিক্ষার্থীর নাম </th>
                                    <th class="text-center">শিক্ষার্থীর আইডি</th>
                                    <th class="text-center">শ্রেণী রোল</th>
                                    <th class="text-center">শ্রেণীতে অবস্থান</th>
                                    <th class="text-center">মোট নম্বর</th>
                                    <th>প্রাপ্ত জিপিএ</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if($request->exam_type_id==1||$request->exam_type_id==4)
                               
                                @php $s=1; $fail_results=$results; @endphp
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
                                @if(($school->service_type_id==1 && $res->student->id_card_exits==1) || $school->service_type_id!=1)
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
                                @else
                                <tr>
                                  <td colspan="7">{{$res->student->user->name}} ফলাফলের জন্য সফটওয়্যার সেবা প্রদানকারী প্রতিষ্টানের সাথে যোগাযোগ করুন ।</td>
                                </tr>
                                @endif
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
                                @if(($school->service_type_id==1 && $res->student->id_card_exits==1) || $school->service_type_id!=1)
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
                                @else
                                <tr>
                                  <td colspan="7">{{$res->student->user->name}} ফলাফলের জন্য সফটওয়্যার সেবা প্রদানকারী প্রতিষ্টানের সাথে যোগাযোগ করুন ।</td>
                                </tr>
                                @endif
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
    @if(isset($results)&&$active_path=="all")
    <script type="text/javascript">
        document.getElementById("exam_year").value="{{$request->exam_year}}"
        document.getElementById("master_class_id").value="{{$request->master_class_id}}"
        document.getElementById("group_class_id").value="{{$request->group_class_id}}"
        document.getElementById("section").value="{{$request->section}}" 
        document.getElementById("shift").value="{{$request->shift}}" 
        document.getElementById("exam_type_id").value="{{$request->exam_type_id}}" 
    </script>
    @endif

    @if(isset($results)&&$active_path=="class_based")
    <script type="text/javascript">
        document.getElementById("exam_year_1").value="{{$request->exam_year}}"
        document.getElementById("master_class_id_1").value="{{$request->master_class_id}}" 
        document.getElementById("exam_type_id_1").value="{{$request->exam_type_id}}" 
    </script>
    @endif

    @if(isset($results)&&$active_path=="group_based")
    <script type="text/javascript">
        document.getElementById("exam_year_4").value="{{$request->exam_year}}"
        document.getElementById("master_class_id_4").value="{{$request->master_class_id}}"
        document.getElementById("group_class_id_4").value="{{$request->group_class_id}}"
        document.getElementById("exam_type_id_4").value="{{$request->exam_type_id}}" 
    </script>
    @endif

    @if(isset($results)&&$active_path=="section_based")
    <script type="text/javascript">
        document.getElementById("exam_year_3").value="{{$request->exam_year}}"
        document.getElementById("master_class_id_3").value="{{$request->master_class_id}}"
        document.getElementById("section_3").value="{{$request->section}}"  
        document.getElementById("exam_type_id_3").value="{{$request->exam_type_id}}" 
    </script>
    @endif

    @if($errors->has('*'))
    <script type="text/javascript">
        document.getElementById("exam_year").value="{{old('exam_year')}}"
        document.getElementById("master_class_id").value="{{old('master_class_id')}}"
        document.getElementById("group_class_id").value="{{old('group_class_id')}}"
        document.getElementById("shift").value="{{old('shift')}}" 
        document.getElementById("section").value="{{old('section')}}" 
        document.getElementById("exam_type_id").value="{{old('exam_type_id')}}" 
    </script>
    @endif

@endsection