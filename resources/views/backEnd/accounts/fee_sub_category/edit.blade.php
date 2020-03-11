@extends('backEnd.master')

@section('mainTitle', 'ফি সাব ক্যাটাগরি পরিবর্তন')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">সাব ক্যাটাগরি পরিবর্তন করুন</h2>
    </div>
    <div class="col-md-12">
      @if(session('success_msg'))
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{session('success_msg')}}
        </div>
      @endif
      @if($errors->any())
          @foreach($errors->all() as $error)
          <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{$error}}
          </div>
        @endforeach
      @endif
    </div>
  </div>
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px; min-height: 500px;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('fee_sub_category_update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $fee_sub_category->id }}">
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="name">সাব ক্যাটাগরির নাম <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $fee_sub_category->name??'' }}" type="text" name="name" class="form-control" placeholder="সাব ক্যাটাগরির নাম লিখুন">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="amount">ফি এর পরিমান </label>
                          <div class="">
                              <input value="{{ $fee_sub_category->amount??'' }}" type="text" name="amount" class="form-control" placeholder="ফি এর পরিমান লিখুন">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                          <label class="">ক্যাটাগরি নির্বাচন করুন <span class="star">*</span></label>
                          <div class="">
                            <select class="form-control" name="fee_category_id">
                              <option selected value="{{ $fee_sub_category->fee_category_id }}">{{ $fee_sub_category->fee_category->name??'' }}</option>
                              @foreach ($fee_categories as $key => $fee_category)
                                <option value="{{ $fee_category->id }}">{{ $fee_category->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="master_class_id">শ্রেণী <span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="master_class_id" id="master_class_id">
                                  <option selected value="{{ $fee_sub_category->master_class_id }}">{{ $fee_sub_category->master_class->name??'' }}</option>
                                  @foreach($classes as $class)
                                      <option value="{{$class->id}}">{{$class->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="group_class_id">গ্রুপ / বিভাগ <span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="group_class_id" id="group_class_id">
                                  <option selected value="{{ $fee_sub_category->group_class_id }}">{{ $fee_sub_category->group_class->name??'' }}</option>
                                  @foreach($groups as $group)
                                      <option value="{{$group->id}}">{{$group->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="shift">শিফট <span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" style="width: 100% !important;" name="shift" id="shift">
                                  <option selected value="{{ $fee_sub_category->shift }}">{{ $fee_sub_category->shift??'' }}</option>
                                  <option value="সকাল">সকাল</option>
                                  <option value="দিন">দিন</option>
                                  <option value="সন্ধ্যা">সন্ধ্যা</option>
                                  <option value="রাত">রাত</option>
                              </select>
                          </div>
                      </div>
                  </div>
                </div>

                  <hr>

                  <div class="">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <button id="save" type="submit" class="btn btn-block btn-info">আপডেট করুন</button>
                              </div>
                          </div>
                      </div>
                  </div>

                <hr>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection
