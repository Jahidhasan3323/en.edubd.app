@extends('backEnd.master')

@section('mainTitle', 'Publish Result')
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
            <h1 class="text-center text-temp">ফলাফল প্রকাশ করুন</h1>
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
            <form id="edit-result-form" action="{{url('/result/publish')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('exam_year') ? 'has-error' : ''}}">
                            <label class="" for="exam_year">বছর <span class="star">*</span></label>
                            <select style="" name="exam_year" id="exam_year" class="form-control">
                                <option >...বছর নির্বাচন করুন...</option>
                                @foreach($years as $year)
                                    <option >{{$year->exam_year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('exam_type_id') ? 'has-error' : ''}}">
                            <label class="" for="exam_type_id">পরীক্ষা  <span class="star">*</span></label>
                            <select style="" name="exam_type_id" id="show_exam_input" class="form-control">
                                <option value="">...পরীক্ষা টাইপ নির্বাচন করুন...</option>
                                @foreach($exams as $exam)
                                    <option value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="class">শ্রেণী <span class="star">*</span></label>
                            <select style="" name="master_class_id" id="class" class="form-control">
                                <option value="">...শ্রেণী নির্বাচন করুন...</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-success">প্রকাশিত</button>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <button name="unpublish" value="unpublish" type="submit" class="btn btn-block btn-primary">অপ্রকাশিত</button>
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
