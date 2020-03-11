@extends('fontend.master')
@section('title')
ভিডিও 
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('mainContent')
<div class="col-md-9 left_con"><!-- left Content Start-->
<div class="panel panel-info">
    <div class="panel-heading" style="font-weight: bold; font-size: 18px; background-color:#5BC0DE; color:#FFFFFF">ভিডিও </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-4" style="text-align: center;border: 1px solid #eee;">
                <iframe width="250" height="250" src="https://www.youtube.com/embed/QNUSIOMb6vI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-4" style="text-align: center;border: 1px solid #eee;">
                <iframe width="250" height="250" src="https://www.youtube.com/embed/QNUSIOMb6vI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection