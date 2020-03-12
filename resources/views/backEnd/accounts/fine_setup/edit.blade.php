@extends('backEnd.master')

@section('mainTitle', 'Edit Fine Setup')
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
  <div class="panel col-md-8 col-md-offset-2" style="margin-top: 15px; margin-bottom: 15px;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('fine_setup_update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $fine_setup->id }}">
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="master_class_id">Select Class <span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="master_class_id" id="master_class_id">
                                  <option selected value="{{ $fine_setup->master_class_id }}">{{ $fine_setup->master_class->name??'' }}</option>
                                  @foreach($classes as $class)
                                      <option value="{{$class->id}}">{{$class->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="group_class_id">Select Group<span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="group_class_id" id="group_class_id">
                                  <option selected value="{{ $fine_setup->group_class_id }}">{{ $fine_setup->group_class->name??'' }}</option>
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
                                  <option selected value="{{ $fine_setup->shift }}">{{ $fine_setup->shift }}</option>
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
                          <label class="" for="amount">Fine Amount <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $fine_setup->amount }}" type="number" name="amount" class="form-control" placeholder="Enter Amount">
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
  });
  </script>


@endsection
