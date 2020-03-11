@extends('backEnd.master')

@section('mainTitle', 'ফি কালেকশন পরিচালনা')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">ফি কালেকশন পরিচালনা করুন</h2>
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
          <div class="table-responsive">
              <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">ক্রমিক</th>
                          <th class="text-center">সিরিয়াল</th>
                          <th class="text-center">নাম</th>
                          <th class="text-center">ফি ক্যাটাগরি</th>
                          <th class="text-center">ফান্ড</th>
                          <th class="text-center">পরিমান</th>
                          <th class="text-center">পেইড</th>
                          <th class="text-center">বাকি</th>
                          <th class="text-center">একশন</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($fee_collections as $fee_collection)
                      <tr>
                          <td class="text-center">{{ $i++ }}</td>
                          <td class="text-center">{{ $fee_collection->serial }}</td>
                          <td class="text-center">{{$fee_collection->student->user->name??''}}</td>
                          <td class="text-center">
                            @foreach (json_decode($fee_collection['fee_category']) as $key => $category)
                              {{ App\FeeCategory::find($category)->name??'' }},
                            @endforeach
                          </td>
                          <td class="text-center">{{$fee_collection->fund->name??''}}</td>
                          <td class="text-center">{{ $fee_collection->amount }}</td>
                          <td class="text-center">{{ $fee_collection->paid }}</td>
                          <td class="text-center">{{ $fee_collection->due }}</td>
                          <td class="text-center">
                            <a href="{{ route('fee_collection_view', $fee_collection->id) }}" title="প্রিন্ট করুন"> <button type="button" class="btn btn-info btn-sm" style="margin: 5px;"><i class="fa fa-print"></i></button> </a>
                            <form class="" action="{{ route('fee_collection_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $fee_collection->id }}">
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('আপনি কি কালেকশনটি মুছে ফেলতে চান ?')" title="মুছে ফেলুন"><i class="fa fa-trash-o"></i></button>
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

    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection
