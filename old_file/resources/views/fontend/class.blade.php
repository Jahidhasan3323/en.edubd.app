@extends('fontend.master')
@section('title')
ক্লাস
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('mainContent')
<div class="col-md-9 left_con"><!-- left Content Start-->
<div class="panel panel-info">
    <div class="panel-heading" style="font-weight: bold; font-size: 18px; background-color:#5BC0DE; color:#FFFFFF">Class Wise Students Summary</div>
    <div class="panel-body">
        
        <table width="100%" id="customers">
            <tr height=27>
                <td  width="30"><strong>SL</strong></td>
                <td><strong>Class</strong></td>
                <td><strong>Total Students</strong></td>
                <td><strong>View</strong></td>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td><a href="{{url('student')}}" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
            </tr>
            
        </table>
        
    </div>
</div>
</div>
@endsection