@extends('backEnd.master')

@section('mainTitle', 'সম্পত্তি পরিবর্তন করুন')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
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
      <div class="col-md-12">
        <h2 class="text-center text-temp">সম্পত্তি পরিবর্তন করুন</h2>
      </div>
      <div class="panel-body">
          <form action="{{ route('asset_update') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{ $asset->id }}">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="asset_name">সম্পত্তির নাম <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $asset->asset_name }}" type="text" name="asset_name" class="form-control" placeholder="সম্পত্তির নাম">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="qty">সংখ্যা বা পরিমান <span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $asset->qty }}" type="number" name="qty" class="form-control" placeholder="সংখ্যা বা পরিমান">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="unit_price">প্রতিটির মূল্য<span class="star">*</span></label>
                          <div class="">
                              <input value="{{ $asset->unit_price }}" type="number" name="unit_price" class="form-control" placeholder="প্রতিটির মূল্য">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="start_date">জমা করার তারিখ <span class="star">*</span></label>
                          <div class="">
                              <input  value="{{ $asset->start_date }}" class="form-control date" type="text" name="start_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="end_date">মূল্য বৃদ্ধি বা হ্রাসের শেষ তারিখ <span class="star">*</span></label>
                          <div class="">
                              <input  value="{{ $asset->end_date }}" class="form-control date" type="text" name="end_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="asset_valuation_increase">মূল্য বৃদ্ধি ( % ) </label>
                          <div class="">
                              <input value="{{ $asset->asset_valuation_increase }}" type="number" name="asset_valuation_increase" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="asset_valuation_decrease">মূল্য হ্রাস ( % ) </label>
                          <div class="">
                              <input value="{{ $asset->asset_valuation_decrease }}" type="number" name="asset_valuation_decrease" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="description">বিবরণ </label>
                          <div class="">
                              <textarea name="description" rows="3" class="form-control">{{ $asset->description }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12">
                    <button id="save" type="submit" class="btn btn-info">আপডেট করুন</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
@endsection
@section('script')
  <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
  <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
  <script>
      $( function() {
          $( ".date" ).datepicker({
              dateFormat: 'dd-mm-yy',
              changeMonth: true,
              changeYear: true
          }).val();
      } );
  </script>
  <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
  <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
      $('#asset_tbl').DataTable();
  } );
  </script>
@endsection
