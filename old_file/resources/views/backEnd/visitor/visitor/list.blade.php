@extends('backEnd.master')

@section('mainTitle', 'Visitor List')
@section('active_visitor', 'active')
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

        <div class="panel-body col-md-12" style="border:1px solid #ddd;">
            <div class="page-header">
                <h1 class="text-center text-temp">Visitor List</h1>
            </div>
            <div class="table-responsive">
                <table id="pending_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Designation</th>
                            <th>Type</th>
                            <th>Enter Time</th>
                            <th>Out Time</th>
                            <th>Purpose</th>
                            <th>Note</th>
                            <th>Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                    @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->mobile }}</td>
                            <td>{{ $visitor->designation }}</td>
                            <td>{{ $visitor->visitor_type->name }}</td>
                            <td>{{ date('h:i a',strtotime($visitor->in_time)) }}</td>
                            <td>{{ date('h:i a',strtotime($visitor->out_time)) }}</td>
                            <td>{{ $visitor->purpose }}</td>
                            <td>{{ $visitor->note }}</td>
                            <td class="text-center">
                                <a href="{{Storage::url($visitor->image ??'#')}}" target="_blank">
                                    <img class="img-responsive img-thumbnail" src="{{Storage::url($visitor->image ??'')}}" width="60px" height="60px" alt="Image">
                                </a>
                            </td>
                            <td class="text-center">
                                {{-- <div class="action_btn">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#unseen{{ $visitor->id }}" title="বিস্তারিত দেখুন"> <i class="fa fa-eye"></i> </button>
                                </div> --}}
                                <form class="action_btn" action="{{ route('visitor.edit') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $visitor->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm" title="Click for Edit"> <i class="fa fa-edit"></i> </button>
                                </form>
                                <form class="action_btn" action="{{ route('visitor.delete') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $visitor->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm" title="Click for delete" onclick="return confirm('Do you want to delete ?')"> <i class="fa fa-trash-o"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Designation</th>
                            <th>Type</th>
                            <th>Enter Time</th>
                            <th>Out Time</th>
                            <th>Purpose</th>
                            <th>Note</th>
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
