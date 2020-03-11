@extends('backEnd.master')

@section('mainTitle', 'Section Management')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">শাখার তালিকা </h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <table style="border: 1" class="table table-bordered table-responsive table-hover table-striped">
                <tr>
                    <th>ক্রমিক নং</th>
                    <th class="text-center" width="70%">শাখা</th>
                    <th class="text-center">অ্যাকশন</th>
                </tr>
                @if($units->count())
                    @php($serial = Get::serial($units))
                    @foreach($units as $unit)
                        <tr>
                            <td>{{$serial}}</td>
                            <td class="text-center">{{$unit->name}}</td>
                            <td class="text-center">
                                <a href="{{url('/unit/edit/'.$unit->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                                <a onclick="return confirm('Are you sure delete this???');" href="{{url('/unit/delete/'.$unit->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                       
                        @php($serial++)
                    @endforeach
                @endif

            </table>
            <div class="text-center">
                <span class="col-sm-12">{{$units->links()}}</span>
            </div>
        </div>
    </div>
@endsection
