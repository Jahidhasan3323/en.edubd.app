@extends('backEnd.master')

@section('mainTitle', 'Bank Account Type Management')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center text-temp">Bank Account Type Management</h2>
    </div>
    <div class="col-md-6">
      <h2 class="text-center text-temp">Add Bank Account Type</h2>
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
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
      <div class="panel-body">
          <div class="table-responsive">
              <table id="bank_account_type" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">Serial</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Edit</th>
                          <th class="text-center">Delete</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                  @foreach($bank_aacount_types as $bank_aacount_type)
                      <tr>
                          <td class="text-center">{{$i++}}</td>
                          <td class="text-center">{{$bank_aacount_type->name}}</td>
                          <td class="text-center">{{$bank_aacount_type->status==1?'Enable': 'Disable'}}</td>
                          <td class="text-center">
                            <a href="{{ route('bank_aacount_type_edit', $bank_aacount_type->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button> </a>
                          </td>
                          <td class="text-center">
                            <form class="" action="{{ route('bank_aacount_type_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $bank_aacount_type->id }}">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash-o"></i></button>
                            </form>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('bank_aacount_type_store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="name">Bank Account Type Name <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" type="text" name="name" class="form-control" placeholder="Bank Account Type Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="">Status</label>
                            <div class="">
                              <select class="form-control" name="status">
                                <option selected value="1">Enable</option>
                                <option value="0">Disable</option>
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
    $('#bank_account_type').DataTable();
} );
</script>


@endsection
