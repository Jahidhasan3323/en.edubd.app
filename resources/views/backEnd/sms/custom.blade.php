@extends('backEnd.master')
@section('mainTitle', 'SMS')
@section('active_sms', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Custom Number SMS Service</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2"">
                <div class="panel-body" style="margin-top: 10px;">
                    <form action="{{url('/sms/custom_sms')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="text_status">Mobile Numbers <small>(each number separate by comma)</small></label>
                                        <div class="">
                                            <textarea name="numbers" id="numbers" rows="3" class="form-control" placeholder="88017xxxxxxxx,88018xxxxxxxx">{{ old('numbers') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="">
                                            <b>Message Type : </b>
                                            <input type="radio" checked="checked" name="text_status" value="Unicode (Bangla)">
                                            <span id="unicode" style="display:none;">
                                                Unicode (Bangla)
                                            </span>
                                            <span id="regular" style="display:none;"> Regular Text</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{$errors->has('message') ? 'has-error' : ''}}">
                                        <label for="message">Message <strong class="text-danger">*</strong></label> <strong class="text-danger"> {{ $errors->has('message')?$errors->first('message'):''}}</strong>
                                        <textarea onkeyup="msgCount()" id="message" name="message" rows="6" class="form-control">{{ old('message') }}</textarea>
                                    </div>
                                    <p>Character : <span id="char_show"></span>, Message : <span id="msg_count_show"></span></p><br><br>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button id="save_btn" type="submit" class="btn btn-info">Send SMS</button>
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
              url : "{{route('msg_count')}}",
              type: 'get',
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
