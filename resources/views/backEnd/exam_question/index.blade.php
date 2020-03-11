@extends('backEnd.master')

@section('mainTitle', 'Exam list')
@section('question', 'active')
@section('head_section')

@endsection

@section('content')
<style type="text/css">
  .table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: scroll;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd;
  }
  .table-responsive > .table {
    margin-bottom: 0;
  }
  .table-responsive > .table > thead > tr > th,
  .table-responsive > .table > tbody > tr > th,
  .table-responsive > .table > tfoot > tr > th,
  .table-responsive > .table > thead > tr > td,
  .table-responsive > .table > tbody > tr > td,
  .table-responsive > .table > tfoot > tr > td {
    white-space: nowrap;
  }
  .table-responsive > .table-bordered {
    border: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:first-child,
  .table-responsive > .table-bordered > tbody > tr > th:first-child,
  .table-responsive > .table-bordered > tfoot > tr > th:first-child,
  .table-responsive > .table-bordered > thead > tr > td:first-child,
  .table-responsive > .table-bordered > tbody > tr > td:first-child,
  .table-responsive > .table-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:last-child,
  .table-responsive > .table-bordered > tbody > tr > th:last-child,
  .table-responsive > .table-bordered > tfoot > tr > th:last-child,
  .table-responsive > .table-bordered > thead > tr > td:last-child,
  .table-responsive > .table-bordered > tbody > tr > td:last-child,
  .table-responsive > .table-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .table-responsive > .table-bordered > tbody > tr:last-child > th,
  .table-responsive > .table-bordered > tfoot > tr:last-child > th,
  .table-responsive > .table-bordered > tbody > tr:last-child > td,
  .table-responsive > .table-bordered > tfoot > tr:last-child > td {
    border-bottom: 0;
  }
</style>
<div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
    <div class="page-header">
        <h1 class="text-center text-temp">{{$tittle}} পরীক্ষার তালিকা</h1>
    </div>
    <div class="row">
      

      @if(Session::has('errmgs'))
          @include('backEnd.includes.errors')
      @endif
      @if(Session::has('sccmgs'))
          @include('backEnd.includes.success')
      @endif
    </div>
    
    <div class="table-responsive">
       <table id="exam_tbl" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>নাম</th>
                    <th>পরীক্ষার ধরণ </th>
                    <th>পূর্ণমান</th>
                    <th>সময়</th>
                    <th>শ্রেণী</th>
                    <th>বিষয়</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($exams))

                    @php($x = Get::serial($exams))
                    @foreach($exams as $exam)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{{$exam->name}}</td>
                            <td>{{$exam->exam_type==1 ? 'Online' : 'Offline'}}</td>
                            <td>{{$exam->full_mark}}</td>
                            <td>{{$exam->time}}</td>
                            <td>{{$exam->masterClass->name}}</td>
                            <td>{{$exam->subject->subject_name}}</td>
                            <td>
                                
                                <a style="margin-bottom: 10px;" href="{{url('/exam/show/'.$exam->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a style="margin-bottom: 10px;" href="{{url('/exam/edit/'.$exam->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>

                                <a style="margin-bottom: 10px;" href="{{url('online-exam/result/creator/'.$exam->id)}}" class="btn btn-info">Result</a>
                                <a style="margin-bottom: 10px" onclick="event.preventDefault(); clickFunction{{$exam->id}}()"
                                       class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                  </a>
                                <form style="display: none;" id="delete-form{{$exam->id}}" method="post" action="{{url('exam/delete/'.$exam->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>
                                <script>
                                    function clickFunction{{$exam->id}}() {
                                        if (confirm("Are you sure to delete this?")){
                                            document.getElementById("delete-form{{$exam->id}}").submit();
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                       
                        @php($x++)
                    @endforeach
                @endif
            </tbody>
            
        </table>
    </div>
</div>
@endsection
@section('script')
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#exam_tbl').DataTable();
         });
    </script>

    
@endsection
