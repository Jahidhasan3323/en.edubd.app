@extends('backEnd.master')

@section('mainTitle', 'Create questions')
@section('question', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Create questions</h1>
            <hr>
            
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div id="error_div" style="display: none; margin-bottom: 10px;" class="col-md-8 col-md-offset-2 alert-danger">
            <p class="text-center error" style=""></p>
        </div>
        <style type="text/css">
            hr{
                margin:0;
                margin-bottom: 10px;
            }
        </style>
        <div class="panel-body">
            <form action="{{url('written/question/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{$errors->has('question') ? 'has-error' : ''}}">
                            <label class="" for="question">Question <span class="star">*</span></label>
                            <div class="">
                                <textarea  class="form-control" name="question" id="speech" >{{old('question')}}</textarea>
                            </div>
                            @if ($errors->has('question'))
                                <span class="help-block">
                                    <strong>{{$errors->first('question')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('mark') ? 'has-error' : ''}}">
                            <label class="" for="mark">Mark <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('mark')}}" class="form-control" type="text" name="mark" id="mark" placeholder="Mark" data-validation="required length number" data-validation-length="max100" data-validation-allowing="float">
                            </div>
                            @if ($errors->has('mark'))
                                <span class="help-block">
                                    <strong>{{$errors->first('mark')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('master_class_id') ? 'has-error' : ''}}">
                            <label class="" for="master_class_id">Class <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="master_class_id" id="master_class_id" data-validation="required" >
                                    <option value="">Select Class</option>
                                    @if($classes)
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($errors->has('master_class_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('master_class_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group {{$errors->has('subject_id') ? 'has-error' : ''}}">
                            <label class="" for="subject_id">Subject <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="subject_id" id="subject_id" data-validation="required" >
                                    <option value="">Select Subject</option>
                                    @if($subjects)
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($errors->has('subject_id'))
                                <span class="help-block">
                                    <strong>{{$errors->first('subject_id')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group {{$errors->has('file') ? 'has-error' : ''}}">
                           <label for="photo">Photo</label>
                           <input  type="file" name="file" onchange="openFile(event)" accept="image/*"  data-validation=" mime size"
                              data-validation-allowing="jpg, png, gif,jpeg,svg"
                              data-validation-max-size="2mb"
                              data-validation-error-msg-size="You can not upload images larger than 2mb"
                              data-validation-error-msg-mime="You can only upload images"
                              >
                           @if ($errors->has('file'))
                               <span class="help-block">
                                   <strong>{{$errors->first('file')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                   <div class="row">
                   <div class="col-sm-6">
                      <div>
                          <img id="image" width="100px" height="120px" src="">
                      </div>
                   </div>
               </div>
                    
                    
                  </div>
                 
                <hr>

                
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <div class="form-group">
                            <button id="save_btn" type="submit" class="btn btn-block btn-info">Save</button>
                        </div>
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>

@if($errors->any())
    <script>
        document.getElementById('master_class_id').value="{{old('master_class_id')}}";
    </script>
@endif

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
   
@endsection

@section('script')
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

  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'question' );
  </script>
@endsection