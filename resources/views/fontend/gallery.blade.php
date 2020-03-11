@extends('fontend.master')
@section('title')
ছবি 
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('mainContent')
<div class="col-md-9 left_con"><!-- left Content Start-->
<div class="panel panel-info">
    <div class="panel-heading" style="font-weight: bold; font-size: 18px; background-color:#5BC0DE; color:#FFFFFF">ছবি </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-4" style="text-align: center;border: 1px solid #eee;">
                <img src="{{ asset('/public/fontend/images/logo.png')}}" style="width: 100%">
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection