@extends('backEnd.master')

@section('mainTitle', 'সেন্ড বকেয়া এস,এম,এস')
@section('head_section')
    <style>
      .vouchar1, .vouchar2{position: relative; min-height: 1000px;}
      .vouchar2{display: none;}
      }
    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="page-header">
              <h2 class="text-center text-temp"> সেন্ড বকেয়া এস,এম,এস </h2>
          </div>
        </div>
        <div class="col-md-12">
          @if(session('success_msg'))
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ session('success_msg')[0] }}
              @if (count(session('success_msg')[1]) > 0)
                  @foreach (session('success_msg')[1] as $element)
                      {{ $element }},
                  @endforeach
                  এর নাম্বার খুজে পাওয়া যায়নি । <br>
              @endif
              @if (count(session('success_msg')[2]) > 0)
                  নিচের নির্ধারিত এস,এম,এসের পরিমান শেষ । <br>
                  @foreach (session('success_msg')[2] as $value)
                      {{ $value }},
                  @endforeach
              @endif
            </div>
          @endif
          @if($errors->any())
              @foreach($errors->all() as $error)
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{$error}}
              </div>
            @endforeach
          @endif
        </div>
  </div>
  <div class="panel col-md-8 col-md-offset-2" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
      <div class="panel-body">
          <form name="add-result-form" action="{{route('send_due_sms')}}" method="post" >
              {{csrf_field()}}
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="class">শ্রেণী <span class="star">*</span></label>
                          <select name="master_class_id" id="master_class_id" class="form-control" required="">
                              <option value="">শ্রেণী নির্বাচন করুন</option>
                              @foreach($classes as $class)
                                  <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="group1">গ্রুপ <span class="star">*</span></label>
                          <select name="group_class_id" id="group_class_id" class="form-control" required="">
                              <option value="">গ্রুপ নির্বাচন করুন</option>
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
                                <option value="">শিফট নির্বাচন করুন</option>
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
                                    <option value="{{$unit->name}}">{{$unit->name}}</option>
                                @endforeach
                          </select>
                      </div>
                  </div>

              </div>
              <div class="">
                  <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                          <div class="form-group">
                              <button id="save" type="submit" class="btn btn-block btn-success">সেন্ড এস,এম,এস</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
@endsection
@section('script')
<link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
<script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
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
