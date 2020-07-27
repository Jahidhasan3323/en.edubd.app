@extends('backEnd.master')

@section('mainTitle', 'Setup SMS Limit')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_sms_login_info', 'active')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">Setup SMS Limit</h2>
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
  <div class="col-md-12" style="border: 1px solid #ddd;">
      <h4 style="margin-bottom: 20px;" class="text-center">Select Institute</h4>
      <div class="row col-md-8 col-md-offset-2">
          <form action="{{route('smsLimit.search')}}" method="post">
              {{csrf_field()}}
              <div class="col-sm-8 {{$errors->has('school_id') ? 'has-error' : ''}}">
                  <div class="form-group">
                      <select class="form-control" name="school_id" id="school_id">
                            @isset($school_info)
                                <option value="{{$school_info->id}}" >{{$school_info->user->name}}</option>
                            @endisset
                            @foreach($schools as $school)
                                <option value="{{$school->id}}" >{{$school->user->name}}</option>
                            @endforeach
                      </select>
                  </div>
                  @if($errors->has('school_id'))
                  <span class="help-block">
                      <strong>{{$errors->first('school_id')}}</strong>
                  </span>
                  @endif
              </div>

              <div class="col-sm-4">
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Search</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
  @isset($school_info)
      <div class="panel col-md-8 col-md-offset-2" style="border: 1px solid #ddd;">
            <h3 class="text-center">{{ $school_info->user->name }}</h3>
            <div class="panel-body">
                <form action="{{ route('smsLimit.store') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                     <input type="hidden" name="school_id" value="{{ $school_info->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="notification">Notification Limit</label>
                                <div class="">
                                    <input value="{{ old('notification', $sms_limit?$sms_limit->notification:'') }}" type="number" name="notification" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="result">Result SMS Limit</label>
                                <div class="">
                                    <input value="{{ old('result', $sms_limit?$sms_limit->result:'') }}" type="number" name="result" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="due_sms">Due SMS Limit</label>
                                <div class="">
                                    <input value="{{ old('due_sms', $sms_limit?$sms_limit->due_sms:'') }}" type="number" name="due_sms" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="fee_collection">Fee Collection SMS Limit</label>
                                <div class="">
                                    <input value="{{ old('fee_collection', $sms_limit?$sms_limit->fee_collection:'') }}" type="number" name="fee_collection" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="fine_collection">Fine Collection SMS lImit</label>
                                <div class="">
                                    <input value="{{ old('fine_collection', $sms_limit?$sms_limit->fine_collection:'') }}" type="number" name="fine_collection" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="income">Income SMS Limit</label>
                                <div class="">
                                    <input value="{{ old('income', $sms_limit?$sms_limit->income:'') }}" type="number" name="income" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="" for="expense">Expense SMS Limit</label>
                                <div class="">
                                    <input value="{{ old('expense', $sms_limit?$sms_limit->expense:'') }}" type="number" name="expense" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button id="save" type="submit" class="btn btn-info">@if($sms_limit) Update @else Save  @endif</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
  @endisset

@endsection
@section('script')



@endsection
