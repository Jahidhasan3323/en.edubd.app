@extends('backEnd.master')
 
@section('mainTitle', 'ছুটি এন্ট্রি')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ছুটি বাতিল করুন </h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <form id="validate" name="validate" action="{{url('holiday-cancel/search')}}" method="get" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('year') ? 'has-error' : ''}}">
                            <label for="year">বছর<font color="red" size="4">*</font></label>
                            <div class="">
                                <select name="year" id="year" class="form-control">
                                    <option value="">---বছর নির্বাচন করুন---</option>
                                    <option value="{{date('Y')}}">{{str_replace($s, $r, date('Y'))}}</option>
                                    <option value="{{date('Y')+1}}">{{str_replace($s, $r, date('Y')+1)}}</option>
                                </select>
                            </div>

                            @if ($errors->has('year'))
                                <span class="help-block">
                                    <strong>{{$errors->first('year')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('month') ? 'has-error' : ''}}">
                            <label for="month">মাস<font color="red" size="4">*</font></label>
                            <div class="">
                                <select name="month" id="month" class="form-control">
                                    <option value="">---মাস নির্বাচন করুন---</option>
                                     @php($months = json_decode($months))
                                     @foreach($months as $key=>$month)
                                     <option value="{{(strlen($key+1)==1)?'0'.($key+1): ($key+1)}}">{{str_replace($s, $r, $month)}}</option>
                                     @endforeach()
                                </select>
                            </div>

                            @if ($errors->has('month'))
                                <span class="help-block">
                                    <strong>{{$errors->first('month')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <hr>
            @if(isset($search)&&count($search)>0)
            <form id="validate" name="validate" action="{{url('holiday-cancel/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="year" value="{{$search['year']}}">
                        <input type="hidden" name="month" value="{{$search['month']}}">
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                           <table id="student_tbl" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>নাম</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach($days as $day)
                                        <tr>
                                            <td>
                                              <input class="form-check-input number" name="date[{{$i}}]" type="checkbox" value="{{$day->date->format('Y-m-d')}}" id="date{{$i}}" {{in_array($day->date->format('Y-m-d'),$cancel_holidays)?'checked':''}}>
                                              <label class="form-check-label" for="date{{$i++}}">
                                                {{str_replace($s, $r, $day->date->format('l d-m-Y'))}}
                                              </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($days)>0)
                                    <tr>
                                        <td>
                                            <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">সব চেক / আনচেক</label>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            @endif 
        </div>
    </div>
    <script type="text/javascript">
        function checkNumber(){
            if($("#all_check").prop('checked') == true){
                $(".number").prop( "checked", true );
            }else{
                $(".number").prop( "checked", false );
            }
        }
    </script>
    @if(isset($search)&&count($search)>0)
    <script>
        document.getElementById('year').value = "{{$search['year']}}";
        document.getElementById('month').value = "{{$search['month']}}";
    </script>
    @endif
@endsection


