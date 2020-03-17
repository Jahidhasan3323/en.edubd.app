@extends('backEnd.master')

@section('mainTitle', 'Expense Management')
@section('head_section')
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-temp">Expense Management</h2>
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
                          <th class="text-center">SL</th>
                          <th class="text-center">Serial</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">Fund</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Amount</th>
                          <th class="text-center">Print</th>
                          <th class="text-center">Action</th>
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
                            <a href="{{ route('expense_view', $expense->id) }}"> <button type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button> </a>
                          </td>
                          <td class="text-center">
                            <a href="{{ route('expense_edit', $expense->id) }}"> <button type="button" class="btn btn-info btn-sm" style="margin: 5px;"><i class="fa fa-pencil-square-o"></i></button> </a>
                            <form class="" action="{{ route('expense_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $expense->id }}">
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash-o"></i></button>
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
