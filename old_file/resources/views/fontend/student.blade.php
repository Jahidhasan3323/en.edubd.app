@extends('fontend.master')
@section('title')
ছাত্র / ছাত্রী  
@endsection
@section('css')
@endsection
@section('js')
<script language="JavaScript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script >

    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection
@section('mainContent')
<div class="col-md-9 left_con"><!-- left Content Start-->
<div class="panel panel-info">
    <div class="panel-heading" style="font-weight: bold; font-size: 18px; background-color:#5BC0DE; color:#FFFFFF">ছাত্র / ছাত্রী </div>
    <div class="panel-body">
        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>নং</th>
                        <th>নাম</th>
                        <th>শ্রেণী</th>
                        <th>শাখা</th>
                        <th>রোল</th>
                        <th>লিঙ্গ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>১</td>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>2011/04/25</td>
                        <td>Edinburgh</td>
                    </tr>
                </tbody>
            </table>
        
    </div>
</div>
</div>
@endsection
