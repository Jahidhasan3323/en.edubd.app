@extends('backEnd.master')

@section('mainTitle', 'Designations Information')
@section('active_exam', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">পরীক্ষার ধরন তথ্য</h1>
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
                    @if (Auth::is('root'))
                    <th>অ্যাকশন</th>
                    @endif
                </tr>

                @foreach($exams as $exam)
                    <tr>
                        <td>{{$exam->id}}</td>
                        <td>{{$exam->name}}</td>
                        @if (Auth::is('root'))
                        <td>
                            {{--<a style="margin-bottom: 10px;" href="{{url('/designations/'.$designation->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>--}}

                                <a style="margin-bottom: 10px;" href="{{url('/examTypes/'.$exam->id.'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                                <a style="margin-bottom: 10px" href="#"  onclick="clickFunction{{$exam->id}}()"
                                   class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                </a>
                            <form style="display: none;" id="delete-form{{$exam->id}}" method="post" action="{{url('/examTypes/'.$exam->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                            </form>
                        </td>
                        @endif
                    </tr>
                    <script>
                        function clickFunction{{$exam->id}}() {
                            if (confirm("Are you sure to delete this?")){
                                document.getElementById("delete-form{{$exam->id}}").submit();
                            }
                        }
                    </script>
                @endforeach
            </table>
            {{-- <span class="col-sm-2 col-sm-offset-10">{{$designations->links()}}</span> --}}
        </div>
    </div>
@endsection
