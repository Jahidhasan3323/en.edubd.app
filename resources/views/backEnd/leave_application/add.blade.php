
@extends('backEnd.master')

@section('mainTitle', 'Leave Application')
@section('leave_application','active')
    
@section('information', 'active')
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Add Leave Application</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>

        <div class="panel-body">
            <form action="{{url('/leave_application/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group {{$errors->has('toward') ? 'has-error' : ''}}">
                           <label for="photo">To <span class="star">*</span></label>
                           <input type="text" name="toward" class="form-control " placeholder="To"  value="{{old('toward')}}" data-validation="required ">
                           @if ($errors->has('toward'))
                               <span class="help-block">
                                   <strong>{{$errors->first('toward')}}</strong>
                               </span>
                           @endif
                       </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group {{$errors->has('form_date') ? 'has-error' : ''}}">
                           <label for="photo">Start Date <span class="star">*</span></label>
                           <input type="text" name="form_date" class="form-control date" placeholder="শুরুর তারিখ"  value="{{old('form_date')}}" data-validation="required ">
                           @if ($errors->has('form_date'))
                               <span class="help-block">
                                   <strong>{{$errors->first('form_date')}}</strong>
                               </span>
                           @endif
                       </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group {{$errors->has('to_date') ? 'has-error' : ''}}">
                           <label for="photo">End Date <span class="star">*</span></label>
                           <input type="text" name="to_date" class="form-control date" placeholder="End date"  value="{{old('to_date')}}" data-validation="required">
                           @if ($errors->has('to_date'))
                               <span class="help-block">
                                   <strong>{{$errors->first('to_date')}}</strong>
                               </span>
                           @endif
                       </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group {{$errors->has('total_day') ? 'has-error' : ''}}">
                           <label for="photo">Total Day <span class="star">*</span></label>
                           <input type="number" name="total_day" class="form-control " placeholder="Total days"  value="{{old('total_day')}}" data-validation="required number" data-validation-length="max10">
                           @if ($errors->has('total_day'))
                               <span class="help-block">
                                   <strong>{{$errors->first('total_day')}}</strong>
                               </span>
                           @endif
                       </div>
                    </div>
                    @if( Auth::is('teacher') || Auth::is('staff') )
                    <div class="col-sm-4">
                      <div class="form-group {{$errors->has('due_leave') ? 'has-error' : ''}}">
                           <label for="photo">Yearly Due leave <span class="star">*</span></label>
                           <input type="number" name="due_leave" class="form-control " placeholder="Yearly due holidays"  value="{{old('due_leave')}}" data-validation="required number" data-validation-length="max10">
                           @if ($errors->has('due_leave'))
                               <span class="help-block">
                                   <strong>{{$errors->first('due_leave')}}</strong>
                               </span>
                           @endif
                       </div>
                    </div>
                    @endif
                   
                   <div class="col-sm-4">
                       <div class="form-group {{$errors->has('purpose') ? 'has-error' : ''}}">
                           <label for="photo">The reason for leaving <span class="star">*</span></label>
                           <input type="text" name="purpose" class="form-control" placeholder="title" data-validation="required length " data-validation-length="max100" value="{{old('purpose')}}">
                           @if ($errors->has('purpose'))
                               <span class="help-block">
                                   <strong>{{$errors->first('purpose')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="col-sm-4">
                       <div class="col-sm-12 {{$errors->has('leave_type') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="leave_type">Leave Type <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="leave_type" id="leave_type" data-validation="required " required>
                                    <option value="">Select Type</option>
                                    <option value="1">Advance</option>
                                    <option value="2">Absent</option>
                                    
                                </select>
                            </div>
                        </div>
                        @if($errors->has('leave_type'))
                            <span class="help-block">
                                <strong>{{$errors->first('leave_type')}}</strong>
                            </span>
                        @endif
                    </div>
                   </div>
               </div>
               
               
                
                <hr>

                <div class="">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button id="save" type="submit" class="btn btn-block btn-info">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script type="text/javascript">
       var openFile = function(event) {
       var input = event.target;
       var reader = new FileReader();
       reader.onload = function(){
       var dataURL = reader.result;
       var output = document.getElementById('image');
       output.src = dataURL;
       };
       reader.readAsDataURL(input.files[0]);
       };
   </script>
   @if($errors->any())
    <script type="text/javascript">
        document.getElementById('leave_type').value="{{old('leave_type')}}";
    </script>
    @endif
@endsection

@section('script')
<script src="{{asset('/backEnd/js/jscolor.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'details' );
  </script>
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( ".date" ).datepicker({ 
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true 
            }).val();
        } );
    </script>
@endsection