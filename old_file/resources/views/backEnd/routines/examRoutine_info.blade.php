@extends('backEnd.master')

@section('mainTitle', 'routines')
@section('active_routine', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Exam Routine</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12" style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">

                @if($routines->count())
                    @foreach($routines as $routine)
                        <table class="table table-bordered table-responsive table-hover">
                            <tr>
                                @php($status=$routine->status)
                                <td>
                                    <span class="glyphicon glyphicon-asterisk"></span><a class="{{($status==0) ? 'text-danger':'text-success'}}" target="_blank" href="{{Storage::url($routine->path)}}">&nbsp;{{$routine->master_class->name.' Class-'.$routine->exam_type->name.' '.$routine->name.' ( Published '.$routine->updated_at->format('d-m-Y').' )'}}</a>
                                </td>
                                @if (Auth::is('admin'))
                                <td>
                                        @if($status==0)
                                        <a style="margin-bottom: 10px;" href="{{url('/examRoutine/status/'.$routine->id.'/'.$routine->status)}}" class="btn btn-success">
                                            Published
                                        </a>
                                        @else
                                        <a style="margin-bottom: 10px;" href="{{url('/examRoutine/status/'.$routine->id.'/'.$routine->status)}}" class="btn btn-danger">
                                            Unpublished
                                        </a>
                                        @endif
                                        <a style="margin-bottom: 10px;" href="{{url('/examRoutine/edit/'.$routine->id)}}" class="btn btn-success">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a style="margin-bottom: 10px" href="{{url('/examRoutine/delete/'.$routine->id)}}" class="btn btn-danger" onclick="return confirm('Are rue sure delete this...?');">
                                           <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                </td>
                                @endif
                            </tr>
                        </table>
                    @endforeach
                @else
                    <div>
                        <p class="text-info text-center">Not Published Yet !</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection