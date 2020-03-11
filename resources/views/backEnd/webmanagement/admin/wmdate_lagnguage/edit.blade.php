@extends('backEnd.master',['nav'=>'active'])

@section('mainTitle', 'Edit Language Date')
@section('head_section')
    <style>

    </style>
@endsection
@section('language', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">তারিখের ভাষা যোগ করুন</h1>
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

        <div class="panel-body">
            <form action="{{url('/date_language/edit',$date_language1->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="row">
                    <div class="col-sm-6 {{$errors->has('date_language_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="date_language_id">ভাষা <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="date_language_id" id="date_language_id" required>
                                    <option value="">ভাষা নির্বাচন</option>
                                    @if($date_languages)
                                        @foreach($date_languages as $date_language)
                                            <option value="{{$date_language->id}}">{{$date_language->tittle}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($errors->has('date_language_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('date_language_id')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">পরিবর্তন করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        document.getElementById('date_language_id').value="{{$date_language1->date_language_id}}";
    </script>
@endsection
