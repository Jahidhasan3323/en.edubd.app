@extends('backEnd.master')

@section('mainTitle', 'Fee Category Edit')
@section('head_section')
    <style>

    </style>
@endsection
@section('active_accounts', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Fee Category</h1>
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

        <div class="panel-body col-md-8 col-md-offset-2">
            <form action="{{ route('fee_category_update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $fee_category->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="" for="name">Fee Category Name <span class="star">*</span></label>
                            <div class="">
                                <input value="{{ $fee_category->name??'' }}" type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="">Fee Category Status<span class="star">*</span></label>
                            <div class="">
                              <select class="form-control" name="status">
                                <option selected value="1">{{ $fee_category->status==1?'Enable': 'Disable' }}</option>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
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
                                <button id="save" type="submit" class="btn btn-block btn-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
