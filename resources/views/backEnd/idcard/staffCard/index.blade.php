@extends('backEnd.master')

@section('mainTitle', 'Staff ID Card Genarator')
@section('active_card1', 'active')

@section('content')
       <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
       
           @if(Session::has('errmgs'))
               @include('backEnd.includes.errors')
           @endif
           @if(Session::has('sccmgs'))
               @include('backEnd.includes.success')
           @endif

           <div class="panel-body">
               <form action="{{url('/stafCard/search')}}" target="__blank" method="get">
                   {{csrf_field()}}
                    <div class="row">
                       <div class="col-sm-12 text-center">
                           <h3>কর্মীদের আইডি তৈরি করুন</h3><hr> 
                       </div>
                           <div class="col-sm-6">
                               <div class="form-group {{$errors->has('school_id') ? 'has-error' : ''}}">
                                   <label class="" for="school_id">প্রতিষ্ঠান <span class="star">*</span></label>
                                   <div class="">
                                       <select class="form-control" name="school_id" id="school_id">
                                           <option value="">প্রতিষ্ঠান নির্বাচন করুন</option>
                                           @foreach($schools as $school)
                                           <option value="{{$school->id}}">{{$school->user->name}}</option>
                                           @endforeach
                                       </select>
                                   </div>
                                   @if ($errors->has('school_id'))
                                       <span class="help-block">
                                           <strong>{{$errors->first('school_id')}}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group {{$errors->has('staff') ? 'has-error' : ''}}">
                                   <label class="" for="staff">কর্মী <span class="star">*</span></label>
                                   <div class="">
                                       <select class="form-control" name="staff" id="staff" onchange="chechSelect();">
                                           <option value="">কর্মী নির্বাচন করুন</option>
                                           <option value="all">সকল কর্মী</option>
                                           <option value="id">সিঙ্গেল কর্মী</option>
                                           
                                       </select>
                                   </div>
                                   @if ($errors->has('staff'))
                                       <span class="help-block">
                                           <strong>{{$errors->first('staff')}}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="col-sm-6" id="staff_id_se">
                               
                           </div>
                          
                    </div>
                    <div class="row">
                           <div class="col-sm-12">
                               <hr>
                               <input type="submit" class="btn btn-default btn-info" value="তৈরী করুন">
                           </div>
                    </div>
                </form>
            </div>                
      <script type="text/javascript">
        function chechSelect() {
            var staff=document.getElementById('staff').value;
            if(staff=='id'){
                document.getElementById("staff_id_se").innerHTML = '<div class="form-group {{$errors->has('staff_id') ? 'has-error' : ''}}"><label class="" for="staff_id">কর্মীর আইডি নং <span class="star">*</span></label><div class=""><input type="text" class="form-control"  id="staff_id" name="staff_id" placeholder="Enter Staff ID Number"></div>@if ($errors->has('staff_id'))<span class="help-block"><strong>{{$errors->first('staff_id')}}</strong></span>@endif </div>';
            }
            if(staff=='all'){
               document.getElementById("staff_id_se").innerHTML=" ";
            }
        }
      </script>             
@endsection
