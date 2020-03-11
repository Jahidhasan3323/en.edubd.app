@extends('backEnd.master')

@section('mainTitle', 'উপস্থিতি ব্যাবস্থাপনা')
@section('active_attendance', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">শিক্ষার্থী উপস্থিতি</h1>

            <h3 class="text-center text-temp">শিক্ষার্থী : {{$single_student->user->name}}, শ্রেণী : {{$single_student->masterClass->name}}, বিভাগ : {{$single_student->group}} , শিফট : {{$single_student->shift}} ত্ত শাখা : {{$single_student->section}}</h3>
       
        </div>
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('student-list-print').submit();"><i class="glyphicon glyphicon-print"></i> প্রিন্ট করুন</a>
                <form id="student-list-print" action="{{ url('attendence/print') }}" method="POST" style="display: none;" target="_blank">
                  {{ csrf_field() }}
                  <input type="hidden" value="{{json_encode($months,TRUE)}}" name="months">
                  <input type="hidden" value="{{json_encode($single_student)}}" name="single_student">
                  @if($request->from&&$request->to)
                     <input type="hidden" value="{{$from}}" name="from">
                     <input type="hidden" value="{{$to}}" name="to">
                  @endif
                  
                </form>
                <hr>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-body">
                    <form id="result_from" action="{{url('/attendence/details',[$single_student->student_id])}}" method="get" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group {{$errors->has('from') ? 'has-error' : ''}}">
                                    <div class="">
                                        <input autocomplete="off" class="form-control date" type="text" name="from" value="{{$request->from}}" id="from" placeholder="From">
                                    </div>
                                    @if ($errors->has('from'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('from')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group {{$errors->has('to') ? 'has-error' : ''}}">
                                    <div class="">
                                        <input autocomplete="off" value="{{$request->to}}" class="form-control date" type="text" name="to" id="to" placeholder="To">
                                    </div>
                                    @if ($errors->has('to'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('to')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <button id="save" type="submit" class="btn btn-block btn-success">ফিল্টারিং</button>
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
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
                    @php $serial = 1; @endphp
                    @foreach($months->atten_students($month->month,$single_student->student_id) as $atten_student)
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

@endsection

@section('script')
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( ".date" ).datepicker({ 
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true 
            }).val();
        } );
    </script>
@endsection

