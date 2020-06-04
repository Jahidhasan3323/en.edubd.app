@extends('backEnd.master')

@section('mainTitle', 'Elective Subject Counting')
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
            <h1 class="text-center text-temp">Elective Subject Counting Setting</h1>
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
            <form id="result_from" action="{{url('elective/store')}}" method="post" enctype="multipart/form-data">
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
                            @if ($errors->has('master_class_id'))
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
                               <input type="text" name="compulsary_elective" placeholder="Count number" class="form-control">
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
                               <input type="text" name="optional_elective" placeholder="Count number" class="form-control">
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
                                <button id="save" type="submit" class="btn btn-block btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        

        @if($elective_settings)
        <div class="row">
           <div class="col-sm-12">
                <div class="panel-body table-responsive">
                    <table class="table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Ssrial No.</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Group/Division</th>
                                <th class="text-center">Compulsary Elective</th>
                                <th class="text-center">Optional Elective</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       @php($i=1)
                        @foreach($elective_settings as $elective_setting)
                         <tr>
                             <td>{{$i++}}</td>
                             <td>{{$elective_setting->master_class->name}}</td>
                             <td>{{$elective_setting->group_class->name}}</td>
                             <td>{{$elective_setting->compulsary_elective}}</td>
                             <td>{{$elective_setting->optional_elective}}</td>
                             <td>
                                 <a href="{{url('elective/edit',$elective_setting->id)}}" class="btn btn-default"><i class="glyphicon glyphicon-edit"></i></a>
                                 <a href="{{url('elective/delete',$elective_setting->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                             </td>
                         </tr>
                        @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });
    </script>

@endsection
