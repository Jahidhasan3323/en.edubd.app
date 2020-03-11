@extends('backEnd.master')

@section('mainTitle', 'প্রতিষ্ঠান ভিত্তিক বার্তা')
@section('active_sms_login_info', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রতিষ্ঠান ভিত্তিক বার্তা</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-8 col-md-offset-2">
            <form action="{{ route('rootSms.send') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="type" value="1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="content">প্রতিষ্ঠান </label>
                            <select class="form-control" name="school_id" id="school_id">
                                {{-- <option selected value="">প্রতিষ্ঠান নির্বাচন করুন</option> --}}
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}" >{{$school->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="content">বার্তা লিখুন</label>
                            <div class="">
                                <textarea onkeyup="msgCount()" id="content" name="content" rows="3" class="form-control"></textarea>
                                <p>বর্ণ : <span id="char_show"></span>, বার্তাঃ <span id="msg_count_show"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">সেন্ড এস,এম,এস</button>
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
                      $('#school_name_char').html(obj['school_name']);

                  }
              }
            });
        }
    </script>
@endsection
