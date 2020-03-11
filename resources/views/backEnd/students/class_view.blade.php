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
      <div class="col-sm-12 text-center">
        <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('student-list-print').submit();"><i class="glyphicon glyphicon-print"></i> প্রিন্ট করুন</a>
        <form id="student-list-print" action="{{ url('students/print') }}" method="POST" style="display: none;" target="_blank">
          {{ csrf_field() }}
          <input type="hidden" value="{{$students}}" name="students">
        </form>

        <h4>শ্রেণী : {{$BanglaNumberToWord->engToBn($students[0]->masterClass->name)}}, বিভাগ : {{$students[0]->group}}, শাখা : {{$students[0]->section}}, শিক্ষাবর্ষ :{{$BanglaNumberToWord->engToBn($students[0]->session)}} </h4>
      </div>

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
                    <th>ছবি</th>
                    <th>নাম</th>
                    <th>রোল</th>
                    <th>ইমেইল</th>
                    <th>আইডি নং</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($students) && ($students->count() > 0))

                    @php($x = Get::serial($students))
                    @foreach($students as $student)
                        <tr>
                            <td>{{$x}}</td>
                            <td><img src="{{Storage::url($student->photo)}}" width="50px" height="50px"></td>
                            <td>{{$student->user->name}}</td>
                            <td>{{$student->roll}}</td>
                            <td>{{$student->user->email}}</td>
                            <td>{{$student->student_id}}</td>
                            <td>
                                <a style="margin-bottom: 10px;" href="{{url('/students/'.$student->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>

                                @if (Auth::is('admin'))
                                    <a style="margin-bottom: 10px;" href="{{url('/students/'.$student->id.'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                                    @if(Auth::is('admin'))
                                        @if($student->deleted_at==Null)
                                        <a style="margin-bottom: 10px" href="#"  onclick="event.preventDefault(); clickFunction{{$student->id}}()"
                                           class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        @else
                                        <a style="margin-bottom: 10px" href="{{url('student/delete',[$student->id])}}"  onclick="return confirm('Are you sure delete this, permanently..?');"
                                           class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <a style="margin-bottom: 10px" href="#"  onclick="event.preventDefault(); clickRestoreFunction{{$student->id}}()" class="btn btn-primary" title="Restore this..!"><span class="glyphicon glyphicon-retweet"></span>
                                        </a>
                                        @endif
                                    @endif
                                @endif
                                <form style="display: none;" id="delete-form{{$student->id}}" method="post" action="{{url('/students/'.$student->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                </form>

                                <form style="display: none;" id="restore-form{{$student->id}}" method="post" action="{{url('/students/restore/'.$student->id)}}" style="padding: 0; margin: 0; outline: 0;">  
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
                                </form>
                            </td>
                        </tr>
                        <script>
                            function clickFunction{{$student->id}}() {
                                if (confirm("Are you sure to delete this?")){
                                    document.getElementById("delete-form{{$student->id}}").submit();
                                }else {
                                    event.preventDefault();
                                }
                            }

                            function clickRestoreFunction{{$student->id}}() {
                                if (confirm("Are you sure to restore this?")){
                                    document.getElementById("restore-form{{$student->id}}").submit();
                                }else {
                                    event.preventDefault();
                                }
                            }
                        </script>
                        @php($x++)
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>ছবি</th>
                    <th>নাম</th>
                    <th>রোল</th>
                    <th>ইমেইল</th>
                    <th>আইডি নং</th>
                    <th>অ্যাকশন</th>
                </tr>
            </tfoot>
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
