@extends('backEnd.master')

@section('mainTitle', 'বেসিক বেতন পরিচালনা')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center text-temp">বেসিক বেতন পরিচালনা করুন</h2>
    </div>
    <div class="col-md-6">
      <h2 class="text-center text-temp">বেসিক বেতন যোগ করুন</h2>
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
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
      <div class="panel-body">
          <div class="table-responsive">
              <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">ক্রমিক</th>
                          <th class="text-center">নাম</th>
                          <th class="text-center">বেতন</th>
                          <th class="text-center">পরিবর্তন</th>
                          <th class="text-center">মুছুন</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                  @foreach($salary_setups as $salary_setup)
                      <tr>
                          <td class="text-center">{{$i++}}</td>
                          <td class="text-center">{{$salary_setup->employee->user->name}}</td>
                          <td class="text-center">{{ $salary_setup->amount }}</td>
                          <td class="text-center">
                            <a href="{{ route('salary_setup_edit', $salary_setup->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button> </a>
                          </td>
                          <td class="text-center">
                            <form class="" action="{{ route('salary_setup_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $salary_setup->id }}">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('আপনি কি বেসিক বেতন মুছে ফেলতে চান ?')"><i class="fa fa-trash-o"></i></button>
                            </form>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('salary_setup_store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="">কর্মকর্তা বা কর্মাচারী নির্বাচন করুন </label>
                            <div class="">
                              <select class="form-control" name="employee_id">
                                @foreach ($employees as $key => $employee)
                                  <option value="{{ $employee->id }}">{{ $employee->user->name??'' }}  ( {{ $employee->staff_id }} )</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="amount">বেসিক বেতনের পরিমান <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('amount')}}" type="text" name="amount" class="form-control" placeholder="বেসিক বেতনের পরিমান">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
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
