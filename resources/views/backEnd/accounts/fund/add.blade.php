@extends('backEnd.master')

@section('mainTitle', 'ফান্ড পরিচালনা')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')

  <div class="row">
    <div class="col-md-6">
      <h2 class="text-center text-temp">ফান্ড পরিচালনা করুন</h2>
    </div>
    <div class="col-md-6">
      <h2 class="text-center text-temp">ফান্ড যোগ করুন</h2>
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
              <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th class="text-center">ক্রমিক</th>
                          <th class="text-center">নাম</th>
                          <th class="text-center">অবস্থা</th>
                          <th class="text-center">পরিবর্তন</th>
                          <th class="text-center">মুছুন</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                  @foreach($funds as $fund)
                      <tr>
                          <td class="text-center">{{$i++}}</td>
                          <td class="text-center">{{$fund->name}}</td>
                          <td class="text-center">{{$fund->status==1?'সক্রিয়': 'নিষ্ক্রিয়'}}</td>
                          <td class="text-center">
                            <a href="{{ route('fund_edit', $fund->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button> </a>
                          </td>
                          <td class="text-center">
                            <form class="" action="{{ route('fund_delete') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" name="id" value="{{ $fund->id }}">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('আপনি কি ফান্ড মুছে ফেলতে চান ?')"><i class="fa fa-trash-o"></i></button>
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
        <div class="panel-body">
            <form action="{{ route('fund_store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">ফান্ডের নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name')}}" type="text" name="name" class="form-control" placeholder="ফান্ডের নাম লিখুন">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="">ফান্ডের অবস্থা <span class="star">*</span></label>
                            <div class="">
                              <select class="form-control" name="status">
                                <option selected value="1">সক্রিয়</option>
                                <option value="0">নিষ্ক্রিয়</option>
                              </select>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
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
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection
