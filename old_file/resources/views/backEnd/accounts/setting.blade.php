@extends('backEnd.master')

@section('mainTitle', 'Account Setting Management')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">Account Setting Management</h2>
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
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="panel-body">
            <form action="@isset($account_setting) {{ route('account_setting_update') }} @else{{ route('account_setting_store') }} @endisset" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                @isset($account_setting)
                  <input type="hidden" name="id" value="{{ $account_setting->id }}">
                @endisset
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="provident_fund_rate">Provident Fund Rate (%)</label>
                            <div class="">
                                <input value="@isset($account_setting) {{ $account_setting->provident_fund_rate }} @else {{ '0' }} @endisset" type="text" name="provident_fund_rate" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="voucher_title">Vouchar Tile </label>
                            <div class="">
                                <input value="@isset($account_setting) {{ $account_setting->voucher_title }} @else {{ 'Memo' }} @endisset" type="text" name="voucher_title" class="form-control" placeholder="ভাউচার টাইটেল">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Sub Category View</label>
                            <div class="">
                              <select class="form-control" name="subcategory_view">
                                @isset($account_setting)
                                  <option selected value="{{ $account_setting->subcategory_view }}">@if ($account_setting->subcategory_view=="0") General @else List View @endif</option>
                                @endisset
                                <option value="0">General</option>
                                <option value="1">List View</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Fee Collection SMS</label>
                            <div class="">
                              <select class="form-control" name="fee_coolection_sms">
                                @isset($account_setting)
                                  <option selected value="{{ $account_setting->fee_coolection_sms }}">@if ($account_setting->fee_coolection_sms=="0") Disable @else Enable  @endif</option>
                                @endisset
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Income SMS</label>
                            <div class="">
                              <select class="form-control" name="income_sms">
                                @isset($account_setting)
                                  <option selected value="{{ $account_setting->income_sms }}">@if ($account_setting->income_sms=="0") Disable @else Enable  @endif</option>
                                @endisset
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Expense sms</label>
                            <div class="">
                              <select class="form-control" name="expense_sms">
                                @isset($account_setting)
                                  <option value="{{ $account_setting->expense_sms }}">@if ($account_setting->expense_sms=="0") Disable @else Enable @endif</option>
                                @endisset
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Fine Collection SMS</label>
                            <div class="">
                              <select class="form-control" name="fine_collection_sms">
                                @isset($account_setting)
                                  <option value="{{ $account_setting->fine_collection_sms }}">@if ($account_setting->fine_collection_sms=="0") Disable @else Enable @endif</option>
                                @endisset
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Absent Fine SMS</label>
                            <div class="">
                              <select class="form-control" name="absence_fine">
                                @isset($account_setting)
                                  <option value="{{ $account_setting->absence_fine }}">@if ($account_setting->absence_fine=="0") Disable @else Enable @endif</option>
                                @endisset
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
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
                                <button id="save" type="submit" class="btn btn-block btn-info">@isset($account_setting) Update @else Save @endisset</button>
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
