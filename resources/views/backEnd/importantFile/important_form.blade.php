
@extends('backEnd.master')

@section('mainTitle', 'Important File')
@section('active_latter', 'active')

@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">গুরুত্বপূর্ণ ফর্ম </h1>
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
            <div class="col-md-12">
               
                <table id="commitee_tbl" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>টাইটেল</th>
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
                                <td>
                                    <a style="margin-bottom: 10px;" href="{{url(Storage::url($important_form->file))}}" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-eye-open" ></span></a>
                                    <a style="margin-bottom: 10px;" href="{{url(Storage::url($important_form->file))}}" download class="btn btn-success" target="_blank"><span class="glyphicon glyphicon-download" ></span></a>


                                   
                                </td>
                            </tr>
                            
                        @endforeach
                    @endif
                        </tbody>
                        
                </table>
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
