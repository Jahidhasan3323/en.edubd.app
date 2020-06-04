@extends('backEnd.master')

@section('mainTitle', 'Edit Elective Subject Counting')
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
            <h1 class="text-center text-temp">Edit Elective Subject Counting Setting</h1>
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
            <form id="elective_from" action="{{url('elective/update',$elective_setting->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">Class <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="master_class_id" id="class">
                                    <option value="">...Select Class...</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('class'))
                                <span class="help-block">
                                    <strong>{{$errors->first('master_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('group_class_id') ? 'has-error' : ''}}">
                            <label class="" for="group_class_id">Group / Division <span class="star">*</span></label>
                            <div class="">
                                <select style="width: 100% !important;" class="form-control" name="group_class_id" id="group_class_id">
                                    <option value="">...Select Group / Division...</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('group_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('group_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('compulsary_elective') ? 'has-error' : ''}}">
                            <label class="" for="compulsary_elective">Compulsary Elective <span class="star">*</span></label>
                            <div class="">
                               <input type="text" name="compulsary_elective" value="{{old('compulsary_elective',$elective_setting->compulsary_elective)}}" placeholder="Count number" class="form-control">
                            </div>
                            @if ($errors->has('compulsary_elective'))
                                <span class="help-block">
                                    <strong>{{$errors->first('compulsary_elective')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{$errors->has('optional_elective') ? 'has-error' : ''}}">
                            <label class="" for="optional_elective">Optional Elective <span class="star">*</span></label>
                            <div class="">
                               <input type="text" name="optional_elective" placeholder="Count number" value="{{old('optional_elective',$elective_setting->optional_elective)}}" class="form-control">
                            </div>
                            @if ($errors->has('optional_elective'))
                                <span class="help-block">
                                    <strong>{{$errors->first('optional_elective')}}</strong>
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
                                <button id="save" type="submit" class="btn btn-block btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        document.forms['elective_from'].elements['master_class_id'].value="{{old('master_class_id',$elective_setting->master_class_id)}}";
        document.forms['elective_from'].elements['group_class_id'].value="{{old('group_class_id',$elective_setting->group_class_id)}}";
    </script>
@endsection
