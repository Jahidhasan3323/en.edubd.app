@extends('backEnd.master')

@section('mainTitle', 'Student ID Card Genarator')
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
               <div class="row">
                   <div class="col-sm-12 text-center">
                     <h3>Create Student ID Card</h3><hr> 
                   </div>
                   <form action="{{url('/studentCard/school')}}" method="get">
                    
                        <div class="col-sm-6">
                            <div class="form-group {{$errors->has('school_id') ? 'has-error' : ''}}">
                                <div class="">
                                    <select name="school_id" class="form-control" id="school_id1">
                                      <option value="">... Select Institute ...</option>
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
                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-info" value="Search">
                        </div>
                   </form>
               </div>
               <hr>

               @if($school_id)
               <form action="{{url('/studentCard/search')}}" target="__blank" method="get">
                   {{csrf_field()}}
                    <div class="row">
                           <div class="col-sm-6">
                               <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                                   <label class="" for="master_class_id">Class <span class="star">*</span></label>
                                   <div class="">
                                       <select class="form-control" name="master_class_id" id="master_class_id" onchange="chechSelect();">
                                           <option value="">Select Class</option>
                                           @foreach($classes as $class)
                                           <option value="{{$class->id}}">{{$class->name}}</option>
                                           @endforeach
                                           <option value="all">All Class</option>
                                           <option value="id">Single Student</option>
                                           
                                       </select>
                                   </div>
                                   @if ($errors->has('master_class_id'))
                                       <span class="help-block">
                                           <strong>{{$errors->first('master_class_id')}}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="col-sm-6" id="student_id_se">
                               
                           </div>
                           <input type="hidden" name="school_id" value="{{$school_id}}">
                          
                    </div>
                    <div class="row">
                           <div class="col-sm-12">
                               <hr>
                               <input type="submit" class="btn btn-default btn-info" value="Create">
                           </div>
                    </div>
                </form>
               @endif
            </div>                
      <script type="text/javascript">
        function chechSelect() {
            var master_class_id=document.getElementById('master_class_id').value;
            if(master_class_id=='id'){
                document.getElementById("student_id_se").innerHTML = '<div class="form-group {{$errors->has('student_id') ? 'has-error' : ''}}"><label class="" for="student_id">Student ID No. <span class="star">*</span></label><div class=""><input type="text" class="form-control"  id="student_id" name="student_id" placeholder="Enter Student ID Number"></div>@if ($errors->has('student_id'))<span class="help-block"><strong>{{$errors->first('student_id')}}</strong></span>@endif </div>';
            }

            if(master_class_id=='all'){
               document.getElementById("student_id_se").innerHTML=" ";
            }

            if(master_class_id!='all'&&master_class_id!='id'){
               document.getElementById("student_id_se").innerHTML = '<div class="form-group {{$errors->has('group') ? 'has-error' : ''}}"> <label class="" for="group">Group <span class="star">*</span></label> <div class=""> <select class="form-control" name="group" id="group"> <option value="">Select Trade</option> @foreach($groups as $group) <option value="{{$group->name}}">{{$group->name}}</option> @endforeach </select> </div> @if ($errors->has('group')) <span class="help-block"> <strong>{{$errors->first('group')}}</strong> </span> @endif<div class="form-group {{$errors->has('section') ? 'has-error' : ''}}"><label class="" for="section">Section <span class="star">*</span></label><div class=""><select class="form-control" name="section" id="section"><option value="">Select Section</option><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option> @foreach($units as $unit) <option value="{{$unit->name}}">{{$unit->name}}</option> @endforeach </select> </div> @if ($errors->has('section')) <span class="help-block"> <strong>{{$errors->first('section')}}</strong> </span> @endif </div>';
            }
          }
      </script> 
      @if($school_id)
       <script type="text/javascript">
            document.getElementById('school_id1').value = "{{$school_id}}";
       </script>
      @endif            
@endsection
