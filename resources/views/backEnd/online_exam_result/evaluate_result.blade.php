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
        <h1 class="text-center text-temp">পেন্ডিং ফলাফল</h1>
    </div>
    <div class="row">
      

      @if(Session::has('errmgs'))
          @include('backEnd.includes.errors')
      @endif
      @if(Session::has('sccmgs'))
          @include('backEnd.includes.success')
      @endif
    </div>
    @if($results)
      <form class="form-inline" action="{{url('online-exam/evaluate')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="online_exam_result_id" value="{{$id}}">
        {{csrf_field()}}
        @php $i=1; @endphp
        @foreach($results as $result)
          <p><b>প্রশ্নঃ </b>{{ $i }}.{!! $result->question->question !!}</p>
          <p><b>উত্তরঃ </b>{!! $result->answer !!}</p>
          <p>
            <b>পূর্ণমানঃ </b>{{ $result->full_mark }} 
            <label style="padding-left:20px">প্রাপ্ত মার্কঃ </label> 
            <input type="text" name="mark_{{$result->id}}" class="form-control" data-validation="required length number" data-validation-length="max10" data-validation-allowing="float">
          </p>
          <?php $i++ ?>
        @endforeach
        <div class="form-group">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    @endif
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
