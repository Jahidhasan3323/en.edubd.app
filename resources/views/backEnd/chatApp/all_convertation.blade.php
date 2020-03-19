@extends('backEnd.master')

@section('mainTitle', 'All Student List')
@section('all_chat', 'active')
@section('head_section')

@endsection

@section('content')

<style type="text/css">
  .table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: scroll;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd;
  }
  .table-responsive > .table {
    margin-bottom: 0;
  }
  .table-responsive > .table > thead > tr > th,
  .table-responsive > .table > tbody > tr > th,
  .table-responsive > .table > tfoot > tr > th,
  .table-responsive > .table > thead > tr > td,
  .table-responsive > .table > tbody > tr > td,
  .table-responsive > .table > tfoot > tr > td {
    white-space: nowrap;
  }
  .table-responsive > .table-bordered {
    border: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:first-child,
  .table-responsive > .table-bordered > tbody > tr > th:first-child,
  .table-responsive > .table-bordered > tfoot > tr > th:first-child,
  .table-responsive > .table-bordered > thead > tr > td:first-child,
  .table-responsive > .table-bordered > tbody > tr > td:first-child,
  .table-responsive > .table-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:last-child,
  .table-responsive > .table-bordered > tbody > tr > th:last-child,
  .table-responsive > .table-bordered > tfoot > tr > th:last-child,
  .table-responsive > .table-bordered > thead > tr > td:last-child,
  .table-responsive > .table-bordered > tbody > tr > td:last-child,
  .table-responsive > .table-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .table-responsive > .table-bordered > tbody > tr:last-child > th,
  .table-responsive > .table-bordered > tfoot > tr:last-child > th,
  .table-responsive > .table-bordered > tbody > tr:last-child > td,
  .table-responsive > .table-bordered > tfoot > tr:last-child > td {
    border-bottom: 0;
  }
</style>
<div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
    <div class="page-header">
        <h1>All Convertation List</h1>
    </div>

    @if(Session::has('errmgs'))
        @include('backEnd.includes.errors')
    @endif
    @if(Session::has('sccmgs'))
        @include('backEnd.includes.success')
    @endif
    <div class="table-responsive">
       <table id="student_tbl" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>SI</th>
                    <th>Sender Image </th>
                    <th>Sender Name</th>
                    <th>Sender School</th>
                    <th>Recever Image</th>
                    <th>Recever Name</th>
                    <th>Recever School</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @if($convertations)

                    @php($x = Get::serial($convertations))
                    @foreach($convertations as $convertation)
                        <tr>
                            <td>{{$x}}</td>
                              @if($convertation->from_db==1)
                                <td>
                                  @if(($convertation->user->group_id==1))
                                    <img src="{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school='none' ?>
                                    @elseif($convertation->user->group_id==2)
                                        <img src="{{Storage::url($convertation->user->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                        <?php $school=$convertation->user->name ?>
                                    @elseif($convertation->user->group_id==3 || $convertation->user->group_id==5)
                                        <img src="{{Storage::url($convertation->user->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                        <?php $school=$convertation->user->staff->school->user->name ?>
                                    @elseif($convertation->user->group_id==4)
                                        <img src="{{Storage::url($convertation->user->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                        <?php $school=$convertation->user->student->school->user->name ?>
                                    @elseif($convertation->user->group_id==6)
                                        <img src="{{Storage::url($convertation->user->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                        <?php $school=$convertation->user->committee->school->user->name ?>
                                  @endif 
                                </td>
                                <td>
                                  {{$convertation->user->name}}
                                </td>
                                <td>
                                  {{$school}}
                                </td>
                                <td>
                                  @if(($convertation->to_user->group_id==1))
                                    <img src="{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school_to='none' ?>
                                    @elseif($convertation->to_user->group_id==2)
                                        <img src="{{Storage::url($convertation->to_user->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                        <?php $school_to=$convertation->user->name ?>
                                    @elseif($convertation->to_user->group_id==3 || $convertation->to_user->group_id==5)
                                        <img src="{{Storage::url($convertation->to_user->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                        <?php $school_to=$convertation->to_user->staff->school->user->name ?>
                                    @elseif($convertation->to_user->group_id==4)
                                        <img src="{{Storage::url($convertation->to_user->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                        <?php $school_to=$convertation->to_user->student->school->user->name ?>
                                    @elseif($convertation->to_user->group_id==6)
                                        <img src="{{Storage::url($convertation->to_user->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                        <?php $school_to=$convertation->to_user->committee->school->user->name ?>
                                  @endif 
                                </td>
                                <td>
                                  {{$convertation->to_user->name}}
                                </td>
                                <td>
                                  {{$school_to}}
                                </td>
                              @elseif($convertation->from_db==2)
                                <td>
                                  @if(($convertation->user2->group_id==1))
                                    <img src="{{Helpers::db2_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school='none' ?>
                                  @elseif(($convertation->user2->group_id==2))
                                      <img src="{{Helpers::db2_url()}}{{Storage::url($convertation->user2->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user2->name ?> 
                                  @elseif(($convertation->user2->group_id==3 || $convertation->user->group_id==5))
                                      <img src="{{Helpers::db2_url()}}{{Storage::url($convertation->user2->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user2->staff->school->user->name ?>
                                  @elseif(($convertation->user2->group_id==4))
                                      <img src="{{Helpers::db2_url()}}{{Storage::url($convertation->user2->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user2->student->school->user->name ?>
                                  @elseif(($convertation->user2->group_id==6))
                                      <img src="{{Helpers::db2_url()}} {{Storage::url($convertation->user2->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user2->committee->school->user->name ?>
                                  @endif 
                                </td>
                                <td>
                                  {{$convertation->user2->name}}
                                </td>
                                <td>
                                  {{$school}}
                                </td>
                                <td>
                                  @if(($convertation->to_user2->group_id==1))
                                    <img src="{{Helpers::db2_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school_to='none' ?>
                                  @elseif(($convertation->to_user2->group_id==2))
                                      <img src="{{Helpers::db2_url()}}{{Storage::url($convertation->to_user2->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                      <?php $school_to=$convertation->to_user2->name ?>
                                  @elseif(($convertation->to_user2->group_id==3 || $convertation->user->group_id==5))
                                      <img src="{{Helpers::db2_url()}}{{Storage::url($convertation->to_user2->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user2->staff->school->user->name ?>
                                  @elseif(($convertation->to_user2->group_id==4))
                                      <img src="{{Helpers::db2_url()}}{{Storage::url($convertation->to_user2->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user2->student->school->user->name ?>
                                  @elseif(($convertation->to_user2->group_id==6))
                                      <img src="{{Helpers::db2_url()}} {{Storage::url($convertation->to_user2->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user2->committee->school->user->name ?>
                                  @endif 
                                </td>
                                <td>
                                  {{$convertation->to_user2->name}}
                                </td>
                                <td>
                                  {{$school_to}}
                                </td>
                              @elseif($convertation->from_db==3)
                                <td>
                                  @if(($convertation->user3->group_id==1))
                                    <img src="{{Helpers::db3_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school='none' ?>
                                  @elseif(($convertation->user3->group_id==2))
                                      <img src="{{Helpers::db3_url()}}{{Storage::url($convertation->user3->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                      <?php $school=$convertation->user3->name ?>
                                  @elseif(($convertation->user3->group_id==3 || $convertation->user->group_id==5))
                                      <img src="{{Helpers::db3_url()}}{{Storage::url($convertation->user3->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user3->staff->school->user->name ?>
                                  @elseif(($convertation->user3->group_id==4))
                                      <img src="{{Helpers::db3_url()}}{{Storage::url($convertation->user3->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user3->student->school->user->name ?>
                                  @elseif(($convertation->user3->group_id==6))
                                      <img src="{{Helpers::db3_url()}} {{Storage::url($convertation->user3->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user3->committee->school->user->name ?>
                                  @endif
                                </td>
                                <td>
                                  {{$convertation->user3->name}}
                                </td>
                                <td>
                                  {{$school}}
                                </td>
                                 <td>
                                  @if(($convertation->to_user3->group_id==1))
                                    <img src="{{Helpers::db3_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school_to='none' ?>
                                  @elseif(($convertation->to_user3->group_id==2))
                                      <img src="{{Helpers::db3_url()}}{{Storage::url($convertation->to_user3->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                      <?php $school_to=$convertation->to_user3->name ?>
                                  @elseif(($convertation->to_user3->group_id==3 || $convertation->user->group_id==5))
                                      <img src="{{Helpers::db3_url()}}{{Storage::url($convertation->to_user3->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user3->staff->school->user->name ?>
                                  @elseif(($convertation->to_user3->group_id==4))
                                      <img src="{{Helpers::db3_url()}}{{Storage::url($convertation->to_user3->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user3->student->school->user->name ?>
                                  @elseif(($convertation->to_user3->group_id==6))
                                      <img src="{{Helpers::db3_url()}} {{Storage::url($convertation->to_user3->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user3->committee->school->user->name ?>
                                  @endif
                                </td>
                                <td>
                                  {{$convertation->to_user3->name}}
                                </td>
                                <td>
                                  {{$school_to}}
                                </td>
                              @elseif($convertation->from_db==4)
                                <td>
                                  @if(($convertation->user4->group_id==1))
                                    <img src="{{Helpers::db4_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school='none' ?>
                                  @elseif(($convertation->user4->group_id==2))
                                      <img src="{{Helpers::db4_url()}}{{Storage::url($convertation->user4->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user4->name ?>
                                  @elseif(($convertation->user4->group_id==3 || $convertation->user->group_id==5))
                                      <img src="{{Helpers::db4_url()}}{{Storage::url($convertation->user4->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user4->staff->school->user->name ?>
                                  @elseif(($convertation->user4->group_id==4))
                                      <img src="{{Helpers::db4_url()}}{{Storage::url($convertation->user4->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user4->student->school->user->name ?>
                                  @elseif(($convertation->user4->group_id==6))
                                      <img src="{{Helpers::db4_url()}} {{Storage::url($convertation->user4->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school=$convertation->user4->committee->school->user->name ?>
                                  @endif 
                                </td>
                                <td>
                                  {{$convertation->user4->name}}
                                </td>
                                <td>
                                  {{$school}}
                                </td>
                                <td>
                                  @if(($convertation->to_user4->group_id==1))
                                    <img src="{{Helpers::db4_url()}}{{Storage::url('img/ehsan-logo.png')}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                    <?php $school_to='none' ?>
                                  @elseif(($convertation->to_user4->group_id==2))
                                      <img src="{{Helpers::db4_url()}}{{Storage::url($convertation->to_user4->school->logo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;"> 
                                      <?php $school_to=$convertation->to_user4->name ?>
                                  @elseif(($convertation->to_user4->group_id==3 || $convertation->user->group_id==5))
                                      <img src="{{Helpers::db4_url()}}{{Storage::url($convertation->to_user4->staff->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user4->staff->school->user->name ?>
                                  @elseif(($convertation->to_user4->group_id==4))
                                      <img src="{{Helpers::db4_url()}}{{Storage::url($convertation->to_user4->student->photo)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user4->student->school->user->name ?>
                                  @elseif(($convertation->to_user4->group_id==6))
                                      <img src="{{Helpers::db4_url()}} {{Storage::url($convertation->to_user4->committee->image)}}" height="50px" width="50px" style="width: 50px !important; height: 50px; border-radius: 50%;">
                                      <?php $school_to=$convertation->to_user4->committee->school->user->name ?>
                                  @endif 
                                </td>
                                <td>
                                  {{$convertation->to_user4->name}}
                                </td>
                                <td>
                                 {{$school_to}}
                                </td>
                              @endif
                            <td>{{$convertation->messasge}}</td>
                            <td>{{$convertation->created_at}}</td>
                            <td></td>
                        </tr>
                       
                        @php($x++)
                    @endforeach
                @endif
            </tbody>
            
        </table>
    </div>
</div>
@endsection
@section('script')
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#student_tbl').DataTable();
         });
    </script>
@endsection
