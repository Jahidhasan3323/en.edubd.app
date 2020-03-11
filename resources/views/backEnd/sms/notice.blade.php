@extends('backEnd.master')

@section('mainTitle', 'SMS')

@section('active_sms', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিজ্ঞপ্তি সেবা</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="panel-body" style="margin-top: 10px;">
                    <form action="{{url('/sms/send')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="">
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label class="" for="text_status">বার্তার ধরণ</label>
                                        <div class="">
                                            <input type="radio" checked="checked" name="text_status" value="Unicode (Bangla)">
                                            <span id="unicode" style="display:none;">
                                                 ইউনিকোড (বাংলা)
                                            </span>
                                            <span id="regular" style="display:none;"> রিগুলার টেক্সট</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                      <div class="form-group {{$errors->has('message') ? 'has-error' : ''}}">
                                           <label for="message">বার্তা <strong class="text-danger">*</strong></label> <strong class="text-danger"> {{ $errors->has('message')?$errors->first('message'):''}}</strong>
                                           <textarea onkeyup="msgCount()" id="message" name="message" rows="6" maxlength="{{ $max_len }}" class="form-control">{{old('message')}} {{isset($request->message)?$request->message:''}}</textarea>
                                      </div>
                                      <p>বর্ণ : <span id="char_show"></span>, বার্তাঃ <span id="msg_count_show"></span></p><br><br>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                      <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                @if(!old('to_teacher'))
                                                <div class="col-md-12 col-sm-12" id="student_part">
                                                    <label class="control-label">To  ( শিক্ষার্থীদের  জন্য শ্রেণী নির্বাচন করুন ) <strong class="text-danger">*</strong></label>
                                                    <div class="form-group">
                                                        <select class="form-control" multiple="" name="to_class[]" id="class" onchange="rmoveTeacher()">
                                                            <option value="all">সকল শ্রেণী</option>
                                                            @foreach($classes as $class)
                                                             <option value="{{$class->id}}">{{$class->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    <strong class="text-danger"> {{ $errors->has('to_class')?$errors->first('to_class'):''}}</strong>
                                                    </div>
                                                    <label class="control-label">কোন এক বা সব চেক করুন</label><br>
                                                    <input class="form-check-input" onclick="checkClassSelect()" name="sub_to[]" type="checkbox" value="Guardian" id="guardian_mobile">
                                                    <label class="form-check-label" for="guardian_mobile">
                                                      অভিভাবক
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <input class="form-check-input" onclick="checkClassSelect()" name="sub_to[]" type="checkbox" value="Student" id="student_mobile">
                                                    <label class="form-check-label" for="student_mobile">
                                                      শিক্ষার্থী
                                                    </label><br>
                                                    <strong class="text-danger"> {{ $errors->has('sub_to')?$errors->first('sub_to'):''}}</strong>
                                                </div>
                                                @endif()
                                            </div>
                                        </div>
                                        @if(!$errors->has('sub_to'))
                                        <div class="card-body" id="teacher_part">
                                            <hr>
                                            <label for="notice_subject">To  ( স্টাফদের জন্য চেক করুন ) <strong class="text-danger">*</strong></label>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <input class="form-check-input number" {{old('to_teacher')?'checked':''}} onclick="removeStudent()" name="to_teacher[]" type="checkbox" value="Teacher" id="teacher_mobile">
                                                    <label class="form-check-label" for="teacher_mobile">
                                                      স্টাফ
                                                    </label>
                                                </div>
                                            </div>
                                            <strong class="text-danger"> {{ $errors->has('to_teacher')?$errors->first('to_teacher'):''}}</strong>
                                        </div>
                                        @endif
                                      </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button id="save_btn" type="submit" class="btn btn-block btn-info">এসএমএস প্রেরণ করুন </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<style type="text/css">
    mark {
        background-color: red;
        color: white;
    }
</style>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#char_show').text(0);
            $('#msg_count_show').text(0);
        });
        function msgCount(){
            var message = $('#message').val();
            var school_id = $("#school_id option:selected").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              url : "{{route('rootSms.msg_count')}}",
              type: 'post',
              data: {'message' : message,'school_id':{{ Auth::getSchool() }}},
              success: function (data) {
                  obj = JSON.parse(data);
                  if (data.length){
                      if (obj['char_count'] < 17) {
                          $('#char_show').html(0);
                      }else {
                          $('#char_show').html(obj['char_count']);
                      }
                      if (obj['text_status']=='unicode') {
                          $('#unicode').show();
                          $('#regular').hide();
                      }else {
                          $('#unicode').hide();
                          $('#regular').show();
                      }
                      $('#msg_count_show').html(obj['msg_count']);
                      $('#school_name_char').html(obj['school_name']);

                  }
              }
            });
        }
    </script>

    <script type="text/javascript">

        function checkClassSelect(){
           if(($('#class').val().length)==0){
            $('#class').focus();
            confirm('Please select class first !');
            $('#guardian_mobile').prop( "checked", false );
            $('#student_mobile').prop( "checked", false );
           }
        }

        function rmoveTeacher(){
           if(($('#class').val().length)==0){
            $("#teacher_part").show();
           }else{
                $("#teacher_part").hide();
           }
        }
        function removeStudent(){
            if($("#teacher_mobile").prop('checked') == true){
               $("#student_part").hide();
            }else{
                $("#student_part").show();
            }
        }
    </script>

@endsection
