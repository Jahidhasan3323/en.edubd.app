@extends('backEnd.master')

@section('mainTitle', 'বিষয় তথ্য')
@section('active_subject', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">বিষয় তথ্য</h1>
        </div>


        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
    </div>
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="panel-body">
           <div class="table-responsive">
            <table id="subject_tbl" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th># ক্রমিক নং</th>
                        <th>শ্রেণী</th>
                        <th>বিভাগ</th>
                        <th>মোট বিষয়</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @if($subjects->count())
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{{$subject->masterClass->name}}</td>
                            <td>{{$subject->groupClass->name}}</td>
                            <td>{{$subject->total_subject}}</td>
                            <td>
                                <a style="" href="{{url('/subjects/show',[$subject->master_class_id,
                                $subject->group_class_id])}}" class="btn btn-info">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </td>
                           
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                @endif
                
                </tbody>
                        <tfoot>
                           <tr>
                               <th># ক্রমিক নং</th>
                               <th>শ্রেণী</th>
                               <th>বিভাগ</th>
                               <th>মোট বিষয়</th>
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
    $('#subject_tbl').DataTable();
} );
</script>
@endsection
