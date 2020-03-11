@extends('backEnd.master')

@section('mainTitle', 'বেতন-ভাতা পরিচালনা')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center text-temp">বেতন-ভাতা পরিচালনা করুন</h2>
    </div>
    <div class="col-md-6">
      <h2 class="text-center text-temp">বেতন-ভাতা যোগ করুন</h2>
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
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
      <div class="panel-body">
          <div class="table-responsive">
              <table id="salary_fund" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">ক্রমিক</th>
                          <th class="text-center">নাম</th>
                          <th class="text-center">পরিমান</th>
                          <th class="text-center">অবস্থা</th>
                          <th class="text-center">একশন</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                  @foreach($salary_funds as $salary_fund)
                      <tr>
                          <td class="text-center">{{$i++}}</td>
                          <td class="text-center">{{$salary_fund->name}}</td>
                          <td class="text-center">{{$salary_fund->amount}} %</td>
                          <td class="text-center">{{$salary_fund->status=="Addition"?'বৃদ্ধি': 'হ্রাস'}}</td>
                          <td class="text-center">
                            <a href="{{ route('salary_fund_edit', $salary_fund->id) }}"> <button type="button" class="btn btn-info btn-sm" style="margin: 5px;"><i class="fa fa-pencil-square-o"></i></button> </a>
                            <form class="" action="{{ route('salary_fund_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $salary_fund->id }}">
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('আপনি কি ফি ক্যাটাগরি মুছে ফেলতে চান ?')"><i class="fa fa-trash-o"></i></button>
                            </form>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="panel col-md-6 col-sm-12" style="margin-top: 15px; margin-bottom: 15px; border: 1px solid #ddd;">
        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{ route('salary_fund_store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="name">বেতন-ভাতার নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="" for="amount">বেতন-ভাতার হার (%) <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('amount')}}" type="number" name="amount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">বেতন-ভাতার অবস্থা <span class="star">*</span></label>
                            <div class="">
                              <select class="form-control" name="status">
                                <option selected value="Addition">বৃদ্ধি</option>
                                <option value="Deduction">হ্রাস</option>
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
                                <button id="save" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#salary_fund').DataTable();
} );
</script>


@endsection
