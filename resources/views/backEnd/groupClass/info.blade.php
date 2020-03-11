@extends('backEnd.master')

@section('mainTitle', 'Class Group Information')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিভাগের তথ্য</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <table class="table table-bordered table-responsive table-hover table-striped">
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>নাম</th>
                    <th>অ্যাকশন</th>
                </tr>
                @php($serial = Get::serial($class_groups))
                @foreach($class_groups as $class_group)
                    <tr>
                        <td>{{$serial}}</td>
                        <td>{{$class_group->name}}</td>
                        <td>
                            @if (Auth::is('root'))
                                <a style="margin-bottom: 10px;" href="{{url('/group/edit/'.$class_group->id)}}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>

                                <a style="margin-bottom: 10px" href="{{url('/group/delete/'.$class_group->id)}}"  onclick="return confirm('Are you sure delete this ?')"
                                   class="btn btn-danger">
                                   <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            @endif
                           
                        </td>
                    </tr>
                   
                    @php($serial++)
                @endforeach
            </table>
            
        </div>
    </div>
@endsection
