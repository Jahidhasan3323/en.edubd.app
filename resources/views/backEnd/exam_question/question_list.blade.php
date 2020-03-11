@extends('backEnd.master')

@section('mainTitle', 'Question')
@section('question', 'active')
@section('head_section')

@endsection

@section('content')
<?php 
  use App\ExamQuestion;
?>
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
        <h1 class="text-center text-temp">প্রশ্নের তালিকা</h1>
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
      <form action="{{url('/exam/question',$id)}}" method="post" enctype="multipart/form-data">
       {{csrf_field()}}
       <table id="question_tbl" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>প্রশ্ন</th>
                     <th>মার্ক</th>
                     <th>উত্তর</th>
                    <th>প্রস্তুতকারী</th>
                    <th>প্রস্তুতকারীর ধরণ</th>
                    <th>বিদ্যালয়</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($questions))

                    @php($x = Get::serial($questions))
                    @foreach($questions as $question)
                    <?php 
                      $exam_question=ExamQuestion::where(['question_id'=>$question->id,'exam_id'=>$id])->first();
                      //dd($exam_question);
                    ?>

                        <tr>
                            <td>
                              <input class="form-check-input number" type="checkbox" name="question_id[]" value="{{$question->id}}" id="defaultCheck{{$question->id}}" <?php if($exam_question){?>{{$exam_question->question_id==$question->id ? 'checked' : ''}}  <?php } ?>>
                              {{$x}}
                            </td>
                            <td>
                              {!!$question->question!!} <span style="float: right;">{{$question->mark}}</span><br>
                              @if($question->options)
                                @foreach($question->options as $option)
                                  {{$option->serial}}. {{$option->option}}<br>
                                @endforeach
                              @endif
                            </td>
                            <td>{{$question->mark}}</td>
                            <td>@if($question->answer!=0){{$question->answer}}@endif</td>
                            <td>{{$question->user->name}}</td>
                            <td>{{$question->user->group->name}}</td>
                            <td>{{$question->school->user->name}}</td>
                            
                        </tr>
                       
                        @php($x++)
                    @endforeach
                @endif
            </tbody>
        </table>

            <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">সব চেক / আনচেক</label><br>
            <button id="save_btn" type="submit" class="btn  btn-info">যোগ করুন</button>
      </form>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        function checkNumber(){
            if($("#all_check").prop('checked') == true){
                $(".number").prop( "checked", true );
            }else{
                $(".number").prop( "checked", false );
            }
        }
    </script>
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#question_tbl').DataTable();
         });
    </script>
@endsection
