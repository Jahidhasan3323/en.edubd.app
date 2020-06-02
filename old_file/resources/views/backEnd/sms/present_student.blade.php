@extends('backEnd.master')

@section('mainTitle', 'SMS')

@section('active_sms', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Send Present Student SMS</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        @if(isset($students))
        <div class="col-sm-12">
        <h4 style="margin-bottom: 10px;" class="text-center">Select the following items </h4>
        <h5 style="margin-bottom: 10px;" class="text-center">Total Present : {{count($students)}}</h5>
        <div class="row">
            <div class="panel-body" style="margin-top: 10px;">
                <form action="{{url('/sms/store-present-student')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @php($i=1)
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-body table-responsive">
                        <table class="table table-hover table-striped">
                            <tr>
                                <th>Student Name </th>
                                <th>Student ID</th>
                                <th>Class roll</th>
                            </tr>
                           @foreach($students as $student)
                           @if(($school->service_type_id==1 && $student->id_card_exits==1) || $school->service_type_id!=1)
                            <tr>
                               <td>
                                    <input class="form-check-input number" name="number[]" type="checkbox" value="{{($student->f_mobile_no==NULL)?$student->m_mobile_no:$student->f_mobile_no}}" id="defaultCheck{{$i}}">
                                    <label class="form-check-label" for="defaultCheck{{$i++}}">
                                      {{$student->user->name}}
                                    </label>
                                </td>
                                <td>
                                    {{$student->student_id}}
                                </td>
                                <td>
                                    {{$student->roll}}
                                </td>
                            </tr>
                            @else
                             <tr><td colspan="3">{{$student->user->name}} Please contact your service provider for this student information view.</td></tr>
                            @endif
                            @endforeach
                            @if(count($students)>0)
                            <tr>
                                <td colspan="3">
                                    <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">All Check / Uncheck</label>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    </div>
                    @if(count($students)>0)
                    <hr>

                    <div class="">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-5">
                                <div class="form-group">
                                    <button id="save_btn" type="submit" class="btn btn-block btn-info">Send SMS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endif
                </form>
            </div>
        </div>
        </div>
        @endif
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function checkNumber(){
            // Check #x
            if($("#all_check").prop('checked') == true){
                $(".number").prop( "checked", true );
            }else{
                $(".number").prop( "checked", false );
            }
        }
    </script>
    <script>
        $( function() {
            $( ".date" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
        } );
    </script>

@endsection