@extends('backEnd.master')

@section('mainTitle', 'Search Result')
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
@section('active_result', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রগ্রেস কার্ড দেখুন</h1>
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
            <form id="result_from" action="{{url('/progress/card-show')}}" method="get" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{$errors->has('exam_year') ? 'has-error' : ''}}">
                                <label class="" for="exam_year">বছর <span class="star">*</span></label>
                                <div class="">
                                    <select style="width: 100% !important;" class="form-control" name="exam_year" id="exam_year">
                                        <option>...বছর নির্বাচন করুন...</option>
                                        @if(!$years->count())
                                            <option>No result has given</option>
                                        @endif
                                        @foreach($years as $year)
                                            <option>{{$year->exam_year}}</option>
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
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                                <label class="" for="exam_type_id">পরীক্ষা <span class="star">*</span></label>
                                <div class="">
                                    <select style="width: 100% !important;" class="form-control" name="exam_type_id" id="exam_type_id">
                                        <option>...পরীক্ষা টাইপ নির্বাচন করুন...</option>
                                        @foreach($exams as $exam)
                                            <option value="{{$exam->id}}">{{$exam->name}}</option>
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{$errors->has('student_id') ? 'has-error' : ''}}">
                                <label class="" for="teacher_id">শিক্ষার্থীর আইডি <span class="star">*</span></label>
                                <div class="">
                                    <input autocomplete="off" class="form-control" type="text" name="student_id" id="student_id" placeholder="Student ID">
                                </div>
                                @if ($errors->has('student_id'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('student_id')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">সাবমিট</button>
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
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
    </script>

@endsection
