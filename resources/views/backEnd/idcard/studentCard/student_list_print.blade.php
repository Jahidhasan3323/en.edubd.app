<!DOCTYPE html>
<html lang="en">
<head>
  <title>Students List Print</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('backEnd/img/icon.png')}}" />
  <link href="{{asset('backEnd/css/bootstrap.css')}}" rel="stylesheet"/>
</head>
<body>
      <div class="row">
        <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
            <div class="page-header text-center">
                <h1 class="text-center text-temp">{{$school->user->name}}</h1>
                <img src="{{Storage::url($school->logo)}}" width="70px">
                <h1 class="text-center text-temp">Student List</h1>
            </div>
            <div class="row">
              <div class="col-sm-12 text-center">
                <h4>Class : {{$BanglaNumberToWord->engToBn($students[0]->masterClass->name)}}, Group : {{$students[0]->group}}, Section : {{$students[0]->section}}, Session :{{$BanglaNumberToWord->engToBn($students[0]->session)}} </h4>
              </div>
        </div>
        <div class="col-sm-12">
          <table id="student_tbl" class="table table-striped table-bordered" style="width:100%">
               <thead>
                   <tr>
                       <th>#</th>
                       <th>Name</th>
                       <th>ID No.</th>
                       <th>Roll</th>
                       <th>Photo</th>
                   </tr>
               </thead>
               <tbody>
                   @php $i=1 @endphp
                   @foreach($students as $student)
                       <tr>
                           <td>{{$i++}}</td>
                           <td>{{$student->user->name}}</td>
                           <td>{{$student->student_id}}</td>
                           <td>{{$student->roll}}</td>
                           <td><img src="{{Storage::url($student->photo)}}" width="25px" height="25px"></td>
                       </tr>
                   @endforeach
               </tbody>
          </table>
        </div>
      </div>

      <script type="text/javascript">
        window.print()
      </script>
</body>
</html>
