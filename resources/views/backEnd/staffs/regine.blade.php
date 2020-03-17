@extends('backEnd.master')

@section('mainTitle', 'Employee Regine')
@section('head_section')

    <style>
        .select2-container, .select2-container--default, .select2-container--below, .select2-container--focus{
            /*padding: 5% !important;*/
        }
        .select2-selection.select2-selection--single {
            height:  35px;
        }
    </style>
@endsection
@section('active_staff', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Employee Regine</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div id="success_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-success">
            <p class="text-center success" style=""></p>
        </div>

        <div class="panel-body">
            <form id="edit-result-form" action="{{url('/staff-regine/store')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('staff_id') ? 'has-error' : ''}}">
                            <label class="" for="staff_id">Staff<span class="star">*</span></label>
                            <select style="" name="staff_id" id="staff_id" class="form-control">
                                <option value="null">Select Staff</option>
                                @foreach($all_staff as $staff)
                                    <option value="{{$staff->id}}">{{$staff->user->name.' ('.$staff->staff_id.')'}}</option>
                                @endforeach
                            </select>

                            @if($errors->has('staff_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('staff_id')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('staff_id') ? 'has-error' : ''}}">
                            <label class="" for="date">Date <span class="star">*</span></label>
                            <input type="text" name="date" id="date" class="form-control date" placeholder="Regine Date">

                            @if($errors->has('date'))
                                <span class="help-block">
                                    <strong>{{$errors->first('date')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    @if($errors->any())
    <script type="text/javascript">
        document.getElementById('staff_id').value="{{old('staff_id')}}";
    </script>
    @endif
@endsection
