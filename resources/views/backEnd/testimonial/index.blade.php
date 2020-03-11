@extends('backEnd.master')

@section('mainTitle', 'All Student List')
@section('active_student', 'active')
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
        <h1 class="text-center text-temp">শিক্ষার্থীদের তালিকা</h1>
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
       <table id="student_tbl" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>আইডি নং</th>
                    <th>নাম</th>
                    <th>রোল</th>
                    <th>শ্রেণী</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($students) && ($students->count() > 0))

                    @php($x = Get::serial($students))
                    @foreach($students as $student)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->student_id}}</td>
                            <td>{{$student->roll}}</td>
                            <td>{{$student->masterClass->name}}</td>
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/testimonial/view/'.$student->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a style="margin-bottom: 10px;" href="{{url('/testimonial/edit/'.$student->id)}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
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
        $('#student_tbl').DataTable();
         });
    </script>
@endsection
