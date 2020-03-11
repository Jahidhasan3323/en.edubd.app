@extends('backEnd.master')

@section('mainTitle', 'Manage Schools Class Unit Info')
@section('active_exam', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">স্কুল পরীক্ষার ধরন তথ্য</h1>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="class">{{$school->name}}</label>
            </div>
        </div>
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <table class="table table-bordered table-responsive table-hover">
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>পরীক্ষার নাম</th>
                </tr>
                @if($exams->count())
                    @foreach($exams as $exam)
                        <tr>
                            <td>{{$exam->id}}</td>
                            <td>{{$exam->name}}</td>
                        </tr>
                        
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection