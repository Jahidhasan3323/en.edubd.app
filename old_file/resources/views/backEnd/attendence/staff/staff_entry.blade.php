@extends('backEnd.master')

@section('mainTitle', 'Staff Attendence Entry')
@section('active_attendance', 'active')
@section('head_section')
    <style>

        .select2-selection.select2-selection--single {
            height:  35px;
        }
    </style>
@endsection

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Staff Attendence Manually Entry</h1>
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
        @if(isset($staffs)&& count($staffs)>0)
            <form id="result_from" action="{{url('/menual/staff-entry-store')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12"><h4>Select Present Student</h4></div>
                </div>
                <div class="row">
                    @foreach($staffs as $staff)
                    @php $check = \App\AttenEmployee::where([
                    'staff_id'=>$staff->staff_id,
                    'school_id'=>Auth::getSchool()
                    ])->whereDate('date',date('Y-m-d'))->first();
                    @endphp
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="staff_id[]" value="{{$staff->staff_id}}" {{($check)?'checked':''}}>{{$staff->user->name}} "Designation-{{$staff->designation->name}}"
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>


                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        </div>
    </div>
@endsection
