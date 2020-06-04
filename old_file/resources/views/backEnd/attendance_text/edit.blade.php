@extends('backEnd.master')

@section('mainTitle', 'Edit Attendance SMS Text')
@section('active_attendance_text', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Attendance SMS Text</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-8 col-md-offset-2" style="border: 1px solid #ddd;">
            <form action="{{ route('attendanceText.update', $attendance->id) }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="type" value="{{ $attendance->type }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="school_id">Select Institute</label>
                            <select class="form-control" name="school_id" id="school_id">
                                 <option value="{{$attendance->school->id}}" >{{$attendance->school->user->name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="type">Attendance Type</label>
                            <select class="form-control" name="type" id="type">
                                <option selected value="{{ $attendance->type }}">
                                    @if ($attendance->type==1) Present SMS Text
                                    @elseif ($attendance->type==2) Absent SMS Text
                                    @elseif ($attendance->type==3) Institute Leave SMS Text
                                    @endif
                                </option>
                                <option value="1">Present SMS Text</option>
                                <option value="2">Absent SMS Text</option>
                                <option value="3">Institute Leave SMS Text</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="text_status">Text Type</label>
                            <div class="">
                                <input type="radio" checked="checked">
                                <span id="unicode" style="display:none;">
                                     Unicode (Bangla)
                                </span>
                                <span id="regular" style="display:none;"> Regular Text</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="content">Attendance SMS Text</label>
                            <div class="">
                                <textarea onkeyup="msgCount()" id="content" name="content" rows="3" class="form-control">{{ $attendance->content }}</textarea>
                                <p>Character : <span id="char_show"></span>, Message : <span id="msg_count_show"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#char_show').text(0);
            $('#msg_count_show').text(0);
        });
        function msgCount(){
            var message = $('#content').val();
            var school_id = $("#school_id option:selected").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              url : "{{route('rootSms.msg_count')}}",
              type: 'post',
              data: {'message' : message,'school_id':school_id},
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
                          $('#regular').show();
                          $('#unicode').hide();
                      }
                      $('#msg_count_show').html(obj['msg_count']);

                  }
              }
            });
        }
    </script>
@endsection
