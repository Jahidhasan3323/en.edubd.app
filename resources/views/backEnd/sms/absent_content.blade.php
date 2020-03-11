@extends('backEnd.master')

@section('mainTitle', 'SMS')

@section('active_sms', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">শিক্ষার্থীদের জন্য বিজ্ঞপ্তি কন্টেন্ট</h1>
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
                    <form action="{{url('/sms/contentStore')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
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
                                    <div class="form-group">
                                        <label for="student_absent_content">অনুপস্থিত শিক্ষার্থীদের জন্য বিজ্ঞপ্তি কন্টেন্ট</label>
                                        <textarea onkeyup="msgCount()" class="form-control" name="student_absent_content" id="student_absent_content" rows="10">{{isset($content->student_absent_content)?$content->student_absent_content:''}}</textarea>
                                        <p>বর্ণ : <span id="char_show"></span>, বার্তাঃ <span id="msg_count_show"></span></p>
                                    </div>
                                      {{-- <label class="control-label">আপনার টেক্সট বার্তা, রেগুলার <mark> টেক্সট=146 </mark> ক্যারেক্টার প্রতি এসএমএস এবং <mark> ইউনিকোড=56 </mark> ক্যারেক্টার প্রতি এসএমএস ।</label><br> --}}
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="" for="text_status">বার্তার ধরণ</label>
                                        <div class="">
                                            <input type="radio" checked="checked" name="p_text_status" value="Unicode (Bangla)">
                                            <span id="p_unicode" style="display:none;">
                                                 ইউনিকোড (বাংলা)
                                            </span>
                                            <span id="p_regular" style="display:none;"> রিগুলার টেক্সট</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_present_content">উপস্থিত শিক্ষার্থীদের জন্য বিজ্ঞপ্তি কন্টেন্ট</label>
                                        <textarea class="form-control" onkeyup="pMsgCount()" name="student_present_content" id="student_present_content" rows="10">{{isset($content->student_present_content)?$content->student_present_content:''}}</textarea>
                                        <p>বর্ণ : <span id="p_char_show"></span>, বার্তাঃ <span id="p_msg_count_show"></span></p>
                                    </div>
                                    {{-- <label class="control-label">আপনার টেক্সট বার্তা, রেগুলার <mark> টেক্সট=146 </mark> ক্যারেক্টার প্রতি এসএমএস এবং <mark> ইউনিকোড=56 </mark> ক্যারেক্টার প্রতি এসএমএস ।</label><br> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button id="save_btn" type="submit" class="btn btn-block btn-info">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
            var message = $('#student_absent_content').val();
            var school_id = {{ Auth::getSchool() }};
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
                      $('#school_name_char').html(obj['school_name']);

                  }
              }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#p_char_show').text(0);
            $('#p_msg_count_show').text(0);
        });
        function pMsgCount(){
            var message = $('#student_present_content').val();
            var school_id = {{ Auth::getSchool() }};
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
                      if (obj['p_char_count'] < 17) {
                          $('#p_char_show').html(0);
                      }else {
                          $('#p_char_show').html(obj['char_count']);
                      }
                      if (obj['text_status']=='unicode') {
                          $('#p_unicode').show();
                          $('#p_regular').hide();
                      }else {
                          $('#p_regular').show();
                          $('#p_unicode').hide();
                      }
                      $('#p_msg_count_show').html(obj['msg_count']);
                      $('#p_school_name_char').html(obj['school_name']);

                  }
              }
            });
        }
    </script>
@endsection
