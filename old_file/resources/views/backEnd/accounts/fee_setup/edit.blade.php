@extends('backEnd.master')

@section('mainTitle', 'Fee Setup')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">Edit Fee Setup</h2>
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
  <div class="panelcol-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('fee_setup_update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $fee_setup->id }}">
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="master_class_id">class <span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="master_class_id" id="master_class_id">
                                  <option selected value="{{ $fee_setup->master_class_id }}">{{ $fee_setup->master_class->name??'' }}</option>
                                  @foreach($classes as $class)
                                      <option value="{{$class->id}}">{{$class->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="group_class_id">Group<span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="group_class_id" id="group_class_id">
                                  <option selected value="{{ $fee_setup->group_class_id }}">{{ $fee_setup->group_class->name??'' }}</option>
                                  @foreach($groups as $group)
                                      <option value="{{$group->id}}">{{$group->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="shift">Shift <span class="star">*</span></label>
                          <div class="">
                              <select class="form-control" style="width: 100% !important;" name="shift" id="shift">
                                  <option selected value="{{ $fee_setup->shift }}">{{ $fee_setup->shift }}</option>
                                  <option value="Morning">Morning</option>
                                  <option value="Day">Day</option>
                                  <option value="Evening">Evening</option>
                                  <option value="Night">Night</option>
                              </select>
                          </div>
                      </div>
                  </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Select Category<span class="star">*</span></label>
                            <div class="">
                              <select class="form-control" name="fee_category_id">
                                <option selected value="{{ $fee_setup->fee_category_id }}">{{ $fee_setup->fee_category->name }}</option>
                                @foreach ($fee_categories as $key => $fee_category)
                                  <option value="{{ $fee_category->id }}">{{ $fee_category->name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="amount">Fee Amount <span class="star">*</span></label>
                            <div class="">
                                <input value="{{ $fee_setup->amount }}" type="number" name="amount" class="form-control" placeholder="ফি এর পরিমান লিখুন">
                            </div>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
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