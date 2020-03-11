@extends('backEnd.master')

@section('mainTitle', 'বেসিক বেতন পরিচালনা')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">বেসিক বেতন আপডেট করুন</h2>
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
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
        <div class="panel-body" style="width: 500px;margin: 0 auto;">
            <form action="{{ route('salary_setup_update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $salary_setup->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="">কর্মকর্তা বা কর্মাচারী নির্বাচন করুন </label>
                            <div class="">
                              <select class="form-control" name="employee_id">
                                <option value="{{ $salary_setup->employee_id }}">{{ $salary_setup->employee->user->name }}</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="amount">বেসিক বেতনের পরিমান <span class="star">*</span></label>
                            <div class="">
                                <input value="{{ $salary_setup->amount }}" type="text" name="amount" class="form-control" placeholder="বেসিক বেতনের পরিমান">
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
            </form>
        </div>
    </div>
@endsection
@section('script')

@endsection
