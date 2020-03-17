@extends('backEnd.master')

@section('mainTitle', 'Holiday Entry')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Add New Holiday </h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">
            <form id="validate" name="validate" action="{{url('holiday/search')}}" method="get" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('year') ? 'has-error' : ''}}">
                            <label for="year">Year<font color="red" size="4">*</font></label>
                            <div class="">
                                <select name="year" id="year" class="form-control">
                                    <option value="">Select Year</option>
                                    <option value="{{date('Y')}}">{{date('Y')}}</option>
                                    <option value="{{date('Y')+1}}">{{date('Y')+1}}</option>
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
                            <label for="month">Month<font color="red" size="4">*</font></label>
                            <div class="">
                                <select name="month" id="month" class="form-control">
                                    <option value="">Select Month</option>
                                     @php($months = json_decode($months))
                                     @foreach($months as $key=>$month)
                                     <option value="{{(strlen($key+1)==1)?'0'.($key+1): ($key+1)}}">{{$month}}</option>
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
                                <button type="submit" class="btn btn-block btn-info">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <hr>
            @if(isset($search)&&count($search)>0)
            <form id="validate" name="validate" action="{{url('holiday/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="year" value="{{$search['year']}}">
                        <input type="hidden" name="month" value="{{$search['month']}}">
                        <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                            <label for="date">Day<font color="red" size="4">*</font></label>
                            <div class="">
                                    <select name="date[]" id="" class="form-control" multiple="">
                                        <option value="">Select day</option>
                                        @php($days = json_decode($days))
                                        @foreach($days as $day)
                                         <option value="{{date('d-m-Y',strtotime($day))}}">{{$day}}</option>
                                        @endforeach
                                    </select>
                            </div>

                            @if ($errors->has('date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            @endif
        </div>
    </div>
    @if(isset($search)&&count($search)>0)
    <script>
        document.getElementById('year').value = "{{$search['year']}}";
        document.getElementById('month').value = "{{$search['month']}}";
    </script>
    @endif
@endsection
