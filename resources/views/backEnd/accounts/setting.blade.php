@extends('backEnd.master')

@section('mainTitle', 'একাউন্ট সেটিংস পরিচালনা')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">একাউন্ট সেটিংস পরিচালনা করুন</h2>
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
                            <label class="" for="provident_fund_rate">প্রভিডেন্ট ফান্ড রেট (%)</label>
                            <div class="">
                                <input value="@isset($account_setting) {{ $account_setting->provident_fund_rate }} @else {{ '0' }} @endisset" type="text" name="provident_fund_rate" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="voucher_title">ভাউচার টাইটেল </label>
                            <div class="">
                                <input value="@isset($account_setting) {{ $account_setting->voucher_title }} @else {{ 'মেমো' }} @endisset" type="text" name="voucher_title" class="form-control" placeholder="ভাউচার টাইটেল">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">সাব-ক্যাটাগরি ভিউ</label>
                            <div class="">
                              <select class="form-control" name="subcategory_view">
                                @isset($account_setting)
                                  <option selected value="{{ $account_setting->subcategory_view }}">@if ($account_setting->subcategory_view=="0") সাধারণ @else লিস্ট ভিঊ @endif</option>
                                @endisset
                                <option value="0">সাধারণ</option>
                                <option value="1">লিস্ট ভিঊ</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">ফি কালেকশন এস,এম,এস</label>
                            <div class="">
                              <select class="form-control" name="fee_coolection_sms">
                                @isset($account_setting)
                                  <option selected value="{{ $account_setting->fee_coolection_sms }}">@if ($account_setting->fee_coolection_sms=="0") নিষ্ক্রিয় @else সক্রিয়  @endif</option>
                                @endisset
                                <option value="0">নিষ্ক্রিয়</option>
                                <option value="1">সক্রিয়</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">আয় বা ইনকাম এস,এম,এস</label>
                            <div class="">
                              <select class="form-control" name="income_sms">
                                @isset($account_setting)
                                  <option selected value="{{ $account_setting->income_sms }}">@if ($account_setting->income_sms=="0") নিষ্ক্রিয় @else সক্রিয়  @endif</option>
                                @endisset
                                <option value="0">নিষ্ক্রিয়</option>
                                <option value="1">সক্রিয়</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">ব্যয় এস,এম,এস</label>
                            <div class="">
                              <select class="form-control" name="expense_sms">
                                @isset($account_setting)
                                  <option value="{{ $account_setting->expense_sms }}">@if ($account_setting->expense_sms=="0") নিষ্ক্রিয় @else সক্রিয় @endif</option>
                                @endisset
                                <option value="0">নিষ্ক্রিয়</option>
                                <option value="1">সক্রিয়</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">জরিমানা কালেকশন এস,এম,এস</label>
                            <div class="">
                              <select class="form-control" name="fine_collection_sms">
                                @isset($account_setting)
                                  <option value="{{ $account_setting->fine_collection_sms }}">@if ($account_setting->fine_collection_sms=="0") নিষ্ক্রিয় @else সক্রিয় @endif</option>
                                @endisset
                                <option value="0">নিষ্ক্রিয়</option>
                                <option value="1">সক্রিয়</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">অনুপস্থিতি জরিমানা</label>
                            <div class="">
                              <select class="form-control" name="absence_fine">
                                @isset($account_setting)
                                  <option value="{{ $account_setting->absence_fine }}">@if ($account_setting->absence_fine=="0") নিষ্ক্রিয় @else সক্রিয় @endif</option>
                                @endisset
                                <option value="0">নিষ্ক্রিয়</option>
                                <option value="1">সক্রিয়</option>
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
                                <button id="save" type="submit" class="btn btn-block btn-info">@isset($account_setting) আপডেট করুন @else সংরক্ষণ করুন  @endisset</button>
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
