@extends('backEnd.master')

@section('mainTitle', 'Fee Setup Management')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center text-temp">Fee Seup Management</h2>
    </div>
    <div class="col-md-6">
      <h2 class="text-center text-temp">Fee Seup</h2>
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
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px; min-height: 500px; border: 1px solid #ddd;">
      <div class="panel-body" style="overflow:scroll;">
          <div class="table-responsive">
              <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">SL</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">Class</th>
                          <th class="text-center">Group</th>
                          <th class="text-center">Amount</th>
                          <th class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                  @foreach($fee_amounts as $fee_amount)
                      <tr>
                          <td class="text-center">{{$i++}}</td>
                          <td class="text-center">{{$fee_amount->fee_category->name??''}}</td>
                          <td class="text-center">{{$fee_amount->master_class->name??''}}</td>
                          <td class="text-center">{{$fee_amount->group_class->name??''}}</td>
                          <td class="text-center">{{$fee_amount->amount}}</td>
                          <td class="text-center">
                            <a href="{{ route('fee_setup_edit', $fee_amount->id) }}"> <button type="button" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i></button> </a>
                            <form class="" action="{{ route('fee_setup_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $fee_amount->id }}">
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete ?')" style="margin-top: 5px;"><i class="fa fa-trash-o"></i></button>
                            </form>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px; min-height: 500px; border: 1px solid #ddd;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('fee_setup_store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="master_class_id">Class <span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="master_class_id" id="master_class_id">
                                  <option value="">Select Class</option>
                                  @foreach($classes as $class)
                                      <option value="{{$class->id}}">{{$class->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="group_class_id">Group <span class="star">*</span></label>
                          <div class="">
                              <select style="width: 100% !important;" class="form-control" name="group_class_id" id="group_class_id">
                                  <option value="">Select group</option>
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
                                    <option value="">Select Shift</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Day">Day</option>
                                    <option value="Evening">Evening</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                              <label class="">Select Fee Category <span class="star">*</span></label>
                              <div class="">
                                <select class="form-control" name="fee_category_id">
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
                                  <input value="{{old('amount')}}" type="number" name="amount" class="form-control" placeholder="ফি এর পরিমান লিখুন">
                              </div>
                          </div>
                      </div>

                  </div>

                  <hr>

                  <div class="">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <button id="save" type="submit" class="btn btn-block btn-info">Save</button>
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