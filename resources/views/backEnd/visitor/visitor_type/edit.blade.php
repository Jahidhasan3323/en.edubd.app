@extends('backEnd.master')

@section('mainTitle', 'ভিজিটরের ধরন যোগ করুন')
@section('active_visitor', 'active')
@section('style')
<style type="text/css">
    .form-group {
        margin-bottom: 0;
    }
    .action_btn{display: inline-block;margin:1px;}
</style>
@endsection
@section('content')
    <div class="panel" style="margin-top: 15px; margin-bottom: 15px;">
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="panel-body col-md-8 col-md-offset-2" style="border:1px solid #ddd;">
            <div class="page-header">
                <h1 class="text-center text-temp">ভিজিটরের ধরন পরিবর্তন করুন</h1>
            </div>
            <form id="validate" name="validate" action="{{ route('visitorType.update') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('put')
                <input type="hidden" name="id" value="{{ $visitor_type->id }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('subject') ? 'has-error' : ''}}">
                            <label class="" for="name">ভিজিটরের ধরনের নাম </label>
                            <div class="">
                                <input value="{{old('name',$visitor_type->name)}}" class="form-control" type="text" name="name" id="name">
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
                                <button type="submit" class="btn btn-block btn-info">আপডেট করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
@endsection

@section('script')
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#visitor_tbl').DataTable();
        } );
    </script>
@endsection
