@extends('backEnd.master')

@section('mainTitle', 'সম্পত্তি পরিচালনা')
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
        <h2 class="text-center text-temp">সম্পত্তি জমা করুন</h2>
      </div>
      <div class="panel-body">
          <form action="{{ route('asset_store') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="asset_name">সম্পত্তির নাম <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('asset_name')}}" type="text" name="asset_name" class="form-control" placeholder="সম্পত্তির নাম">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="qty">সংখ্যা বা পরিমান <span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('qty')}}" type="number" name="qty" class="form-control" placeholder="সংখ্যা বা পরিমান">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="unit_price">প্রতিটির মূল্য<span class="star">*</span></label>
                          <div class="">
                              <input value="{{old('unit_price')}}" type="number" name="unit_price" class="form-control" placeholder="প্রতিটির মূল্য">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="start_date">জমা করার তারিখ <span class="star">*</span></label>
                          <div class="">
                              <input  value="{{ date('d-m-Y') }}" class="form-control date" type="text" name="start_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="end_date">মূল্য বৃদ্ধি বা হ্রাসের শেষ তারিখ <span class="star">*</span></label>
                          <div class="">
                              <input  value="{{ date('d-m-Y', strtotime('+1 years')) }}" class="form-control date" type="text" name="end_date">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="asset_valuation_increase">মূল্য বৃদ্ধি ( % ) </label>
                          <div class="">
                              <input value="{{old('asset_valuation_increase')}}" type="number" name="asset_valuation_increase" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="" for="asset_valuation_decrease">মূল্য হ্রাস ( % ) </label>
                          <div class="">
                              <input value="{{old('asset_valuation_decrease')}}" type="number" name="asset_valuation_decrease" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label class="" for="purpose">বিবরণ </label>
                          <div class="">
                              <textarea name="description" rows="3" class="form-control"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12">
                    <button id="save" type="submit" class="btn btn-info">সংরক্ষণ করুন</button>
                  </div>
              </div>
          </form>
  </div>
  <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
    <div class="col-md-12">
      <h2 class="text-center text-temp">সম্পত্তি পরিচালনা করুন</h2>
    </div>
      <div class="panel-body">
          <div class="table-responsive">
              <table id="asset_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">ক্রমিক</th>
                          <th class="text-center">নাম</th>
                          <th class="text-center">পরিমান</th>
                          <th class="text-center">মূল্য</th>
                          <th class="text-center">বৃদ্ধি/হ্রাস</th>
                          <th class="text-center">বর্তমান মূল্য</th>
                          <th class="text-center">শেষ তারিখ</th>
                          <th class="text-center">বিবরন</th>
                          <th class="text-center">একশন</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($assets as $asset)
                      <tr>
                          <td class="text-center">{{ $i++ }}</td>
                          <td class="text-center">{{ $asset->asset_name }}</td>
                          <td class="text-center">{{ $asset->qty }}</td>
                          <td class="text-center">{{ $asset->total_price }}</td>
                          <td class="text-center">
                            @if ($asset->asset_valuation_increase)
                              + {{ $asset->asset_valuation_increase }} %
                            @elseif ($asset->asset_valuation_decrease)
                              - {{ $asset->asset_valuation_decrease }} %
                            @endif
                          </td>
                          <td class="text-center">
                            @if ($asset->asset_valuation_increase > 0)
                              {{ $asset->total_price+(($asset->asset_valuation_increase*$asset->total_price)/100) }}
                            @else
                              {{ $asset->total_price-(($asset->asset_valuation_decrease*$asset->total_price)/100) }}
                            @endif
                          </td>
                          <td class="text-center">{{ date('d-m-Y', strtotime($asset->end_date)) }}</td>
                          <td class="text-center">{{ $asset->description }}</td>
                          <td class="text-center">
                            <a href="{{ route('asset_edit', $asset->id) }}"> <button type="button" class="btn btn-info btn-sm" style="margin:5px;"><i class="fa fa-pencil-square-o"></i></button> </a>
                            <form class="" action="{{ route('asset_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $asset->id }}">
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('আপনি কি সম্পত্তিটি মুছে ফেলতে চান ?')"><i class="fa fa-trash-o"></i></button>
                            </form>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
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
