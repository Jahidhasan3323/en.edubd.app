@extends('backEnd.master')

@section('mainTitle', 'পরামর্শের তালিকা')
@section('active_care', 'active')
@section('style')
    <style>
        .action_btn{display: inline-block;margin:1px;}
    </style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body col-md-6" style="border:1px solid #ddd;">
            <div class="page-header">
                <h1 class="text-center text-temp">নতুন পরামর্শের তালিকা</h1>
            </div>
            <div class="table-responsive">
                <table id="advice_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>টোকেন</th>
                            <th>বিষয়</th>
                            <th>ছবি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($unseen_advices as $advice)
                        <tr>
                            <td>{{ $advice->token }}</td>
                            <td>{{ $advice->subject }}</td>
                            <td class="text-center">
                                <a href="{{Storage::url($advice->image ??'#')}}" target="_blank">
                                    <img class="img-responsive img-thumbnail" src="{{Storage::url($advice->image ??'')}}" width="80px" height="60px" alt="Image">
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="action_btn">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#unseen{{ $advice->id }}" title="বিস্তারিত দেখুন"> <i class="fa fa-eye"></i> </button>
                                </div>
                                <form class="action_btn" action="{{ route('advice.edit') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $advice->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm" title="পরিবর্তন করুন"> <i class="fa fa-edit"></i> </button>
                                </form>
                                <form class="action_btn" action="{{ route('problem.delete') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $advice->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm" title="মুছে ফেলুন" onclick="return confirm('আপনি কি মুছে ফেলতে চান ?')"> <i class="fa fa-trash-o"></i> </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Start Modal -->
                        <div id="unseen{{ $advice->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title text-center">{{ $advice->subject }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $advice->description }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>টোকেন</th>
                            <th>বিষয়</th>
                            <th>ছবি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="panel-body col-md-6" style="border:1px solid #ddd;">
            <div class="page-header">
                <h1 class="text-center text-temp">দেখা পরামর্শের তালিকা</h1>
            </div>
            <div class="table-responsive">
                <table id="advice_seen" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>টোকেন</th>
                            <th>বিষয়</th>
                            <th>ছবি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($seen_advices as $advice)
                        <tr>
                            <td>{{ $advice->token }}</td>
                            <td>{{ $advice->subject }}</td>
                            <td class="text-center">
                                <a href="{{Storage::url($advice->image ??'#')}}" target="_blank">
                                    <img class="img-responsive img-thumbnail" src="{{Storage::url($advice->image ??'')}}" width="80px" height="60px" alt="Image">
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="action_btn">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#seen{{ $advice->id }}" title="বিস্তারিত দেখুন"> <i class="fa fa-eye"></i> </button>
                                </div>
                                {{-- <form class="action_btn" action="{{ route('problem.delete') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $advice->id }}">
                                    <button type="submit" class="btn btn-danger" title="মুছে ফেলুন" onclick="return confirm('আপনি কি মুছে ফেলতে চান ?')"> <i class="fa fa-trash-o"></i> </button>
                                </form> --}}
                            </td>
                        </tr>
                        <!-- Start Modal -->
                        <div id="seen{{ $advice->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title text-center">{{ $advice->subject }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $advice->description }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>টোকেন</th>
                            <th>বিষয়</th>
                            <th>ছবি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </tfoot>
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
            $('#advice_tbl').DataTable();
        } );
        $(document).ready(function() {
            $('#advice_seen').DataTable();
        } );
    </script>
@endsection
