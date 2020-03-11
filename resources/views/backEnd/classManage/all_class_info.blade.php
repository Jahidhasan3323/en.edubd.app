@extends('backEnd.master')

@section('mainTitle', 'Manage Schools Class Info')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ক্লাস তথ্য</h1>
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
                    <th class="text-center">শ্রেণির নাম</th>
                    <th class="text-center">স্কুল টাইপ</th>
                    <th class="text-center">অ্যাকশন</th>
                </tr>
                @if($classes->count())
                    @php($serial = Get::serial($classes))
                    @foreach($classes as $class)
                        <tr>
                            <td>{{'# '.$serial}}</td>
                            <td class="text-center">{{$class->name}}</td>
                            <td class="text-center">{{$class->schoolType->type}}</td>
                            <td class="text-center">
                                <a href="{{url('/class/edit/'.$class->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                                <a onclick="return confirm('Are you sure delete this???');" href="{{url('/class/delete/'.$class->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                       
                        @php($serial++)
                    @endforeach
                @endif

            </table>
        </div>
    </div>
@endsection
