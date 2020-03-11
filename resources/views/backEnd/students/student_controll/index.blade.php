@extends('backEnd.master')

@section('mainTitle', 'All Student List')
@section('active_student', 'active')
@section('head_section')
@endsection
@section('content')
<div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
    <div class="page-header">
        <h1 class="text-center text-temp">{{$school->user->name}}</h1>
        <h1 class="text-center text-temp">শিক্ষার্থীদের তালিকা</h1>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">

        <h4>শ্রেণী : {{$BanglaNumberToWord->engToBn($students[0]->masterClass->name)}}, বিভাগ : {{$students[0]->group}}, শাখা : {{$students[0]->section}}, শিক্ষাবর্ষ :{{$BanglaNumberToWord->engToBn($students[0]->session)}} </h4>
      </div>

      @if(Session::has('errmgs'))
          @include('backEnd.includes.errors')
      @endif
      @if(Session::has('sccmgs'))
          @include('backEnd.includes.success')
      @endif
    </div>

   @if(isset($print))
    <form method="get" target="_blank" action="{{url('studentCard/search')}}" id="print_from">
    <input type="hidden" name="master_class_id" value="{{$students[0]->master_class_id}}">
    <input type="hidden" name="group" value="{{$students[0]->group}}">
    <input type="hidden" name="section" value="{{$students[0]->section}}">
    <input type="hidden" name="shift" value="{{$students[0]->shift}}">
    <input type="hidden" name="session" value="{{$students[0]->session}}">
    <input type="hidden" name="school_id" value="{{$school->id}}">
   @else
    <form method="post" action="{{url('student_list_controll/active',[$students[0]->master_class_id, $students[0]->group, $students[0]->section, $students[0]->shift, $students[0]->session,$school->id])}}">
   @endif
      @csrf
    <div class="table-responsive">
       <table id="student_tbl" class="table table-striped table-bordered" style="width:100%">
            <thead>
              @if(isset($print))
                <tr>
                  <td colspan="4">
                  <div class="row">
                    <div class="col-md-2 col-sm-2"></div>
                    <div class="col-md-4 col-sm-4">
                      <input type="text" name="issue_date" class="form-control date" placeholder="Issue date here" id="issue_date">
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <input type="text" name="end_date" class="form-control date" placeholder="Expiry date here" id="end_date">
                    </div>
                    <div class="col-md-2 col-sm-2"></div>
                   </div>
                   </td>
                </tr>
              @endif
                <tr>
                    <th>নাম</th>
                    <th>আইডি নং</th>
                    <th>রোল</th>
                    <th>ছবি</th>
                </tr>
            </thead>
            <tbody>
              @php $i=1 @endphp
                @foreach($students as $student)
                    <tr>
                        <td>
                          <input class="form-check-input number" name="student_id[{{$i}}]" type="checkbox" value="{{$student->student_id}}" id="student_id{{$i}}" {{($student->id_card_exits==1)?'checked':''}}>
                          <label class="form-check-label" for="student_id{{$i++}}">
                            {{$student->user->name}}
                          </label>
                        </td>
                        <td>{{$student->student_id}}</td>
                        <td>{{$student->roll}}</td>
                        <td><img src="{{Storage::url($student->photo)}}" width="25px" height="25px"></td>
                    </tr>
                @endforeach
                @if(count($students)>0)
                <tr>
                    <td colspan="3">
                        <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">সব চেক / আনচেক</label>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" id="student_list_print" onclick="checkFromAction()" type="checkbox"> <label for="student_list_print">শিক্ষার্থীদের তালিকা প্রিন্টের জন্য এখানে টিক দিন </label>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
          <div class="col-sm-12 text-center">
            <input type="submit" value="{{isset($print)?'আইডি কার্ড প্রিন্ট':'পরিবর্তন সংরক্ষণ'}} করুন" class="btn btn-info" id="card_print" style="display: inline;">
            @if(isset($print))
             <input type="submit" value="প্রিন্ট করুন" id="printed_student_list" class="btn btn-info" style="display: none;">
            @endif
          </div>
    </form>
</div>
@endsection
@section('script')
   <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
   <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script type="text/javascript">
        function checkNumber(){
            if($("#all_check").prop('checked') == true){
                $(".number").prop( "checked", true );
            }else{
                $(".number").prop( "checked", false );
            }
        }

        function checkFromAction(){
          if($("#student_list_print").prop('checked') == true){
              $('#print_from').attr('action', '{{url('studentCard/print-list')}}');
              $('#printed_student_list').css('display', 'inline');
              $('#card_print').css('display', 'none');
          }else{
              $('#print_from').attr('action', '{{url('studentCard/search')}}');
              $('#card_print').css('display', 'inline');
              $('#printed_student_list').css('display', 'none');
          }
        }
    </script>
    <script>
        $( function() {
            $( ".date" ).datepicker({ 
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true 
            }).val();
        } );
    </script>
@endsection
