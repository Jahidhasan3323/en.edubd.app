@extends('backEnd.master')

@section('mainTitle', 'ব্যাংক একাউন্টের ধরণ পরিবর্তন')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ব্যাংক একাউন্টের ধরণ পরিবর্তন করুন</h1>
        </div>

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

        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('bank_aacount_type_update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $bank_aacount_type->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="name">ব্যাংক একাউন্টের ধরণের নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{ $bank_aacount_type->name??'' }}" type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="">ব্যাংক একাউন্টের ধরণের অবস্থা </label>
                            <div class="">
                              <select class="form-control" name="status">
                                <option selected value="1">{{ $bank_aacount_type->status==1?'সক্রিয়': 'নিষ্ক্রিয়' }}</option>
                                <option value="1">সক্রিয়</option>
                                <option value="0">নিষ্ক্রিয়</option>
                              </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
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
