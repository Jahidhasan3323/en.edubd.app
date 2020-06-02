@extends('backEnd.master')

@section('mainTitle', 'Result list')
@section('active_result', 'active')
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
        <h1 class="text-center text-temp">Result</h1>
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
       <table id="result_tbl" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Name </th>
                    <th>Exam </th>
                    <th>Subject </th>
                    <th>Marks </th>
                    <th>Full marks </th>
                    <th>Spend Time </th>
                    <th>Exam Type </th>
                    <th>Result Type </th>
                    <th>Garde </th>
                    <th>Grade Point </th>
                    <th>Status & Date</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                @if(isset($results))

                    @php($x = Get::serial($results))
                    @foreach($results as $result)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{{$result->user->name}}<br>{{$result->user->student->student_id}}</td>
                            <td>{{$result->exam->name}}</td>
                            <td>{{$result->subject->subject_name}}</td>
                            <td>{{$result->mark}}</td>
                            <td>{{$result->exam->full_mark}}</td>
                            <td>{{$result->time_stay}}</td>
                            <td>{{$result->exam->type==1 ? 'MCQ' : 'Written'}}</td>
                            <td>{{$result->result_type==1 ? 'Grade' : 'General'}}</td>
                            <td>{{$result->grade}}</td>
                            <td>{{$result->grade_point}}</td>
                            <td> <label class="label label-success">{{$result->status==1 ? 'Accepted' : 'Pending'}}</label><br>{{date('d-m-Y',strtotime($result->created_at))}}</td>
                              <td>
                              @if($result->status==1 && $result->exam->type==2)
                                <a style="margin-bottom: 10px;" href="{{url('/online-exam/result/view/'.$result->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a style="margin-bottom: 10px;" href="{{url('/online-exam/result/edit/'.$result->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                              @endif
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
        $('#result_tbl').DataTable();
         });
    </script>
@endsection
