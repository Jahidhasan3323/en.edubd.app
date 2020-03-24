@extends('backEnd.master')

@section('mainTitle', 'Edit Question')
@section('question', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Edit Question</h1>
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
            <form action="{{url('mcq/question/edit',$question->id)}}" method="post" enctype="multipart/form-data">
              {{method_field('put')}}
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{$errors->has('question') ? 'has-error' : ''}}">
                            <label class="" for="question">Question <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('question',$question->question)}}" class="form-control" type="text" name="question" id="question" placeholder="Question" data-validation="required length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('question'))
                                <span class="help-block">
                                    <strong>{{$errors->first('question')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                          <div class="form-group {{$errors->has('answer') ? 'has-error' : ''}}">
                              <label class="" for="answer">Answer <span class="star">*</span></label>
                              <div class="">
                                  <input value="{{old('answer',$question->answer)}}" class="form-control" type="text" name="answer" id="answer" placeholder="Answer" data-validation="required length number" data-validation-length="max10">
                              </div>
                              @if ($errors->has('answer'))
                                  <span class="help-block">
                                      <strong>{{$errors->first('answer')}}</strong>
                                  </span>
                              @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('mark') ? 'has-error' : ''}}">
                            <label class="" for="mark">Mark <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('mark',$question->mark)}}" class="form-control" type="text" name="mark" id="mark" placeholder="Mark" data-validation="required length number" data-validation-length="max100" data-validation-allowing="float">
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
                   <div class="col-sm-4">
                      <div>
                          <img id="image" width="100px" height="120px" src="@if($question->file){{Storage::url($question->file)}}@endif">
                      </div>
                   </div>
               </div>
                    
                    
                  </div>
                 
                <hr>

                <h1>Option</h1>
                @foreach($question->options as $option)
                <?php $i=1; ?>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('option') ? 'has-error' : ''}}">
                            <label class="" for="option">Option {{str_replace($s,$r,$i)}}</label>
                            <div class="">
                                <input value="{{old('option',$option->option)}}" class="form-control" type="text" name="option[]" id="option" placeholder="Option" data-validation="length" data-validation-length="max100">
                            </div>
                            @if ($errors->has('option'))
                                <span class="help-block">
                                    <strong>{{$errors->first('option')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <?php $i++ ?>
                @endforeach
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

    <script>
        document.getElementById('master_class_id').value="{{old('master_class_id',$question->master_class_id)}}";
        document.getElementById('subject_id').value="{{old('subject_id',$question->subject_id)}}";
    </script>

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
@endsection