@extends('backEnd.master')

@section('mainTitle', 'অভিযোগ করুন')
@section('active_counseling', 'active')
@section('style')
<style type="text/css">
    .form-group {
    margin-bottom: 0;
}
</style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">অভিযোগ করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form id="validate" name="validate" action="{{ route('complaint.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="session">শ্রেণী <span class="star">*</span></label>
                                <select name="session" id="session" class="form-control" required="">
                                    <option value="">...শিক্ষাবর্ষ নির্বাচন করুন...</option>
                                    @foreach($sessions as $session)
                                        <option value="{{$session->id}}">{{$session->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="class">শ্রেণী <span class="star">*</span></label>
                                <select name="master_class_id" id="master_class_id" class="form-control" required="">
                                    <option value="">...শ্রেণী নির্বাচন করুন...</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="group1">গ্রুপ / বিভাগ <span class="star">*</span></label>
                                <select name="group_class_id" id="group_class_id" class="form-control" required="">
                                    <option value="">...গ্রুপ / বিভাগ নির্বাচন করুন...</option>
                                    @foreach($groups as $group_class)
                                      <option value="{{$group_class->name}}">{{$group_class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group {{$errors->has('shift') ? 'has-error' : ''}}">
                                <label class="" for="shift">শিফট <span class="star">*</span></label>
                                <select name="shift" id="shift" class="form-control" required="">
                                    <option value="">...শিফট নির্বাচন করুন...</option>
                                    <option value="সকাল">সকাল</option>
                                    <option value="দিন">দিন</option>
                                    <option value="সন্ধ্যা">সন্ধ্যা</option>
                                    <option value="রাত">রাত</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="section1">শাখা <span class="star">*</span></label>
                                <select name="section" id="section" class="form-control" required="">
                                    <option value="">...শাখা নির্বাচন করুন...</option>
                                    <option value="ক">ক</option>
                                    <option value="খ">খ</option>
                                    <option value="গ">গ</option>
                                    <option value="ঘ">ঘ</option>
                                    @foreach($units as $unit)
                                    <option value="{!!$unit->name!!}">{!!$unit->name!!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="student_id">শ্রেণী রোল <span class="star">*</span></label>
                                <select name="student_id" id="student_id" class="form-control" required="">
                                    <option value="">...শিক্ষার্থী নির্বাচন করুন...</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                                <label class="" for="description">পরামর্শের বিবরণ <span class="star">*</span></label>
                                <div class="">
                                    <textarea name="description" rows="5" class="form-control"></textarea>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                <hr>

                 <div class="">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
      $(document).ready(function() {
        $('#section').on('change', function () {
                var _token = $("input[name=_token]").val();
                var master_class_id = $('#master_class_id').find(":selected").val();
                var group_class_id = $('#group_class_id').find(":selected").val();
                var shift = $('#shift').find(":selected").val();
                var section = $(this).val();
                // alert(master_class_id);
                var option = '<option>আইডি বা রোল নির্বাচন করুন</option>';
                $.ajax({
                    url : "{{route('get_st_id')}}",
                    type: 'POST',
                    data: {_token:_token, master_class_id:master_class_id, group_class_id:group_class_id, shift:shift, section:section},
                    success: function (data) {
                        // alert(data);
                        if (data.length){
                            for (var i = 0; i < data.length; i++){
                                option = option + '<option value="'+ data[i].student_id +'">' + data[i].student_id + '(' + data[i].roll + ')' +'</option>';
                            }
                            $('#roll').html(option);
                        }else {
                            var option1 = '<option>Student Not Found !</option>';
                            $('#roll').html(option1);
                        }
                    }
                });
            });

      });
      </script>
@endsection
