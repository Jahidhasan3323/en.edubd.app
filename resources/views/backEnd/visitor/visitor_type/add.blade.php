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
        <div class="panel-body col-md-6" style="border:1px solid #ddd;">
            <div class="page-header">
                <h1 class="text-center text-temp">ভিজিটরের ধরন যোগ করুন</h1>
            </div>
            <form id="validate" name="validate" action="{{ route('visitorType.store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{$errors->has('subject') ? 'has-error' : ''}}">
                            <label class="" for="name">ভিজিটরের ধরনের নাম </label>
                            <div class="">
                                <input value="{{old('name')}}" class="form-control" type="text" name="name" id="name">
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
                                <button type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
    </div>
    <div class="panel-body col-md-6" style="border:1px solid #ddd;">
        <div class="page-header">
            <h1 class="text-center text-temp">ভিজিটরের ধরন পরিচালনা</h1>
        </div>
        <div class="table-responsive">
            <table id="visitor_tbl" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ক্রমিক</th>
                        <th class="text-center">নাম</th>
                        <th class="text-center">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                @foreach($visitor_types as $visitor_type)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $visitor_type->name }}</td>
                        <td class="text-center">
                            <form class="action_btn" action="{{ route('visitorType.edit') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $visitor_type->id }}">
                                <button type="submit" class="btn btn-primary btn-sm" title="পরিবর্তন করুন"> <i class="fa fa-edit"></i> </button>
                            </form>
                            <form class="action_btn" action="{{ route('visitorType.delete') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $visitor_type->id }}">
                                <button type="submit" class="btn btn-danger btn-sm" title="মুছে ফেলুন" onclick="return confirm('আপনি কি মুছে ফেলতে চান ?')"> <i class="fa fa-trash-o"></i> </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">ক্রমিক</th>
                        <th class="text-center">নাম</th>
                        <th class="text-center">অ্যাকশন</th>
                    </tr>
                </tfoot>
            </table>
        </div>
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
