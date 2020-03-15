@extends('backEnd.master')

@section('mainTitle', 'Edit Holiday')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Holiday</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body">

            <form id="validate" name="validate" action="{{url('holiday/update',[$month,$year])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="month" value="{{$month}}">
                        <input type="hidden" name="year" value="{{$year}}">
                        <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                            <label for="date">Day<font color="red" size="4">*</font></label>
                            <div class="">
                                    <select name="date[]" id="date" class="form-control" multiple="true">
                                        <option value="">Select Day</option>
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
                                <button type="submit" class="btn btn-block btn-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
        var date = {!!json_encode($date)!!};
        var multipleValues = $( "#date" ).val(date);
    </script>
@endsection
