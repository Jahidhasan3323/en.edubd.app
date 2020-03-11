@extends('backEnd.master')

@section('mainTitle', 'খরচ পরিচালনা করুন')
@section('head_section')
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">খরচ পরিচালনা করুন</h2>
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
                          <th class="text-center">ফান্ড</th>
                          <th class="text-center">তারিখ</th>
                          <th class="text-center">পরিমান</th>
                          <th class="text-center">প্রিন্ট</th>
                          <th class="text-center">একশন</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                  @foreach($expenses as $expense)
                      <tr>
                          <td class="text-center">{{ $i++ }}</td>
                          <td class="text-center">{{ $expense->serial }}</td>
                          <td class="text-center">{{$expense->received_by??''}}</td>
                          <td class="text-center">{{$expense->fund->name??''}}</td>
                          <td class="text-center">{{ date('d-m-Y', strtotime($expense->created_at)) }}</td>
                          <td class="text-center">{{ $expense->amount }}</td>
                          <td class="text-center">
                            <a href="{{ route('expense_view', $expense->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-print"></i></button> </a>
                          </td>
                          <td class="text-center">
                            <a href="{{ route('expense_edit', $expense->id) }}"> <button type="button" class="btn btn-info btn-sm" style="margin: 5px;"><i class="fa fa-pencil-square-o"></i></button> </a>
                            <form class="" action="{{ route('expense_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $expense->id }}">
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('আপনি কি জমা করা আয়টি মুছে ফেলতে চান ?')"><i class="fa fa-trash-o"></i></button>
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
