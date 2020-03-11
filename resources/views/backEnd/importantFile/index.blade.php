
@extends('backEnd.master')

@section('mainTitle', 'Important File')
@section('active_class1', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">গুরুত্বপূর্ণ ফাইল </h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body" style="margin-top: 10px; padding-bottom: 50px">
            <div class="col-sm-12 " style="font-size: 18px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12); padding: 30px">
        <div class="row">
            <div class="col-md-7">
               
                <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>টাইটেল</th>
                            <th>টাইপ</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($important_forms)
                        <?php $i=1?>
                        @foreach($important_forms as $important_form)
                            <tr>
                                <td>{{$i++}}</td>
                                
                                <td>{{$important_form->tittle}}</td>
                                <td>{{$important_form->type==1 ? 'ফর্ম' : 'সফটওয়্যার'}}</td>
                                <td>
                                    <a style="margin-bottom: 10px;" href="{{url(Storage::url($important_form->file))}}" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-eye-open" ></span></a>

                                   <a style="margin-bottom: 10px" href=""  onclick="event.preventDefault(); clickFunction{{$important_form->id}}()"
                                           class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    <form style="display: none;" id="delete-form{{$important_form->id}}" method="post" action="{{url('/important_file/delete/'.$important_form->id)}}" style="padding: 0; margin: 0; outline: 0;">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    </form>
                                    <script>
                                        function clickFunction{{$important_form->id}}() {
                                            if (confirm("Are you sure to delete this?")){
                                                document.getElementById("delete-form{{$important_form->id}}").submit();
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                            
                        @endforeach
                    @endif
                        </tbody>
                        
                </table>
            </div>
            <div class="col-md-5" style="border-left: 1px solid #eee">
                <form action="{{url('/important_file/create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group {{$errors->has('tittle') ? 'has-error' : ''}}">
                          <label class="" for="tittle">টাইটেল <span class="star">*</span></label>
                          <div class="">
                            <input type="text" class="form-control" name="tittle" id="tittle" placeholder="টাইটেল" data-validation="required length " data-validation-length="max100" value="{{old('tittle')}}">
                          </div>
                          @if ($errors->has('tittle'))
                              <span class="help-block">
                                  <strong>{{$errors->first('tittle')}}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="col-md-12 {{$errors->has('type') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label class="" for="type">ফাইলের ধরণ <span class="star">*</span></label>
                            <div class="">
                                <select class="form-control" name="type" id="type" data-validation="required " required >
                                    <option value="">ধরণ নির্বাচন</option>
                                    <option value="1">ফর্ম</option>
                                    <option value="2">সফটওয়্যার</option>
                                    
                                </select>
                            </div>
                        </div>
                        @if($errors->has('type'))
                            <span class="help-block">
                                <strong>{{$errors->first('type')}}</strong>
                            </span>
                        @endif
                    </div>
                      <div class="col-md-12">
                       <div class="form-group {{$errors->has('file') ? 'has-error' : ''}}">
                           <label for="photo">ফাইল <span class="star">*</span></label>
                           <input id="file" type="file" name="file" onchange="openFile(event)"   data-validation="required size"
                              data-validation-max-size="200mb"
                              data-validation-error-msg-size="You can not upload images larger than 200mb">
                           @if ($errors->has('file'))
                               <span class="help-block">
                                   <strong>{{$errors->first('file')}}</strong>
                               </span>
                           @endif
                       </div>
                   </div>
                    </div>
                </div>
                
                <hr>

                <div class="">
                    <div class="row">
                        <div class="form-group">
                            <button id="save" type="submit" class="btn btn-block btn-info">সংরক্ষণ করুন</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
       var openFile = function(event) {
       var input = event.target;
       var reader = new FileReader();
       reader.onload = function(){
       var dataURL = reader.result;
       var output = document.getElementById('file');
       output.src = dataURL;
       };
       reader.readAsDataURL(input.files[0]);
       };
   </script>
   @if($errors->any())
    <script type="text/javascript">
        document.getElementById('type').value="{{old('type')}}";
    </script>
    @endif
@endsection
@section('script')
 
    <script src="{{asset('backEnd')}}/DataTables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backEnd')}}/DataTables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#commitee_tbl').DataTable();
} );
</script>


@endsection
