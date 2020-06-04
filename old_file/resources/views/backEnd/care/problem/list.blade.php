@extends('backEnd.master')

@section('mainTitle', 'Problem List')
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
                <h1 class="text-center text-temp">Problem List</h1>
            </div>
            <div class="table-responsive">
                <table id="pending_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Subject</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pending_problems as $problem)
                        <tr>
                            <td>{{ $problem->token }}</td>
                            <td>{{ $problem->subject }}</td>
                            <td class="text-center">
                                <a href="{{Storage::url($problem->image ??'#')}}" target="_blank">
                                    <img class="img-responsive img-thumbnail" src="{{Storage::url($problem->image ??'')}}" width="80px" height="60px" alt="Image">
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="action_btn">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#unseen{{ $problem->id }}" title="Click for details"> <i class="fa fa-eye"></i> </button>
                                </div>
                                <form class="action_btn" action="{{ route('problem.edit') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $problem->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm" title="Click for edit"> <i class="fa fa-edit"></i> </button>
                                </form>
                                <form class="action_btn" action="{{ route('problem.delete') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $problem->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm" title="Click for delete" onclick="return confirm('Do you want to delete ?')"> <i class="fa fa-trash-o"></i> </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Start Modal -->
                        <div id="unseen{{ $problem->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title text-center">{{ $problem->subject }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $problem->description }}</p>
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
                            <th>Token</th>
                            <th>Subject</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="panel-body col-md-6" style="border:1px solid #ddd;">
            <div class="page-header">
                <h1 class="text-center text-temp">Solved Problem</h1>
            </div>
            <div class="table-responsive">
                <table id="success_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Subject</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($success_problems as $problem)
                        <tr>
                            <td>{{ $problem->token }}</td>
                            <td>{{ $problem->subject }}</td>
                            <td class="text-center">
                                <a href="{{Storage::url($problem->image ??'#')}}" target="_blank">
                                    <img class="img-responsive img-thumbnail" src="{{Storage::url($problem->image ??'')}}" width="80px" height="60px" alt="Image">
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="action_btn">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#seen{{ $problem->id }}" title="Click for details"> <i class="fa fa-eye"></i> </button>
                                </div>
                                {{-- <form class="action_btn" action="{{ route('problem.delete') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $problem->id }}">
                                    <button type="submit" class="btn btn-danger" title="মুছে ফেলুন" onclick="return confirm('আপনি কি মুছে ফেলতে চান ?')"> <i class="fa fa-trash-o"></i> </button>
                                </form> --}}
                            </td>
                        </tr>
                        <!-- Start Modal -->
                        <div id="seen{{ $problem->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title text-center">{{ $problem->subject }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $problem->description }}</p>
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
                            <th>Token</th>
                            <th>Subject</th>
                            <th>Picture</th>
                            <th>Action</th>
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
        $('#pending_tbl').DataTable();
    } );
    $(document).ready(function() {
        $('#success_tbl').DataTable();
    } );
</script>


@endsection
