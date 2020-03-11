
<!DOCTYPE html>
<html xmlns="">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('mainTitle') | Education Management System</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backEnd/img/icon.png')}}" />
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{mix('css/all.css')}}">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'SolaimanLipi', Arial, sans-serif !important;
        }
    </style>
</head>
<body>
    @if(isset($atten_students)&&$atten_students!=''&&$atten_students!=NULL)
      <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
          <div class="panel-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{Storage::url(Auth::user()->school->logo)}}" width="80">
                    <h3>{{Auth::user()->name}}</h3>
                    <p>{{Auth::user()->school->address}}</p>
                    <h3>শিক্ষার্থীদের হাজিরা {{str_replace($s, $r,date("F", mktime(null, null, null, $search['month']))).'-'.$search['year']}}</h3>
                    <h4>{{
                      'শ্রেণী:'.$atten_students[0]->masterClass->name.', বিভাগ:'
                      .$atten_students[0]->group.', শ্রেণী:'
                      .$atten_students[0]->শিফট.', শাখা:'
                      .$atten_students[0]->section
                    }}</h4>
                </div> 
            </div>
             <div class="table-responsive">
              <table id="subject_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>শিক্ষার্থী</th>
                          @foreach($days as $date)
                           <th>{{date('d',strtotime($date))}}</th>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody>
                  <?php $x = 1; ?>
                      @foreach($atten_students as $student)
                          <tr>
                              <td>{{$x}}</td>
                              <td>{{$student->student->user->name}}</td>
                              @foreach($days as $date)
                               <td>
                                {{
                                 \App\AttenStudent::where([
                                 'school_id'=>$student->school_id,
                                 'student_id'=>$student->student_id,
                                 ])->whereDate('date',$date)->value('status')
                                }}
                               </td>
                              @endforeach
                          </tr>
                          <?php $x++; ?>
                      @endforeach
                  </itbody>
                  </table>
             </div>
          </div>
      </div>
    @endif

    @if(isset($atten_employees)&&$atten_employees!=''&&$atten_employees!=NULL)
      <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
          <div class="panel-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{Storage::url(Auth::user()->school->logo)}}" width="80">
                    <h3>{{Auth::user()->name}}</h3>
                    <p>{{Auth::user()->school->address}}</p>
                    <h3>কর্মকর্তাদের হাজিরা {{str_replace($s, $r,date("F", mktime(null, null, null, $search['month']))).'-'.$search['year']}}</h3>
                </div> 
            </div>
             <div class="table-responsive">
              <table id="subject_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>কর্মকর্তা</th>
                          @foreach($days as $date)
                           <th>{{date('d',strtotime($date))}}</th>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody>
                  <?php $x = 1; ?>
                      @foreach($atten_employees as $employee)
                          <tr>
                              <td>{{$x}}</td>
                              <td>{{$employee->staff->user->name}}</td>
                              @foreach($days as $date)
                               <td>
                                {{
                                 \App\AttenEmployee::where([
                                 'school_id'=>$employee->school_id,
                                 'staff_id'=>$employee->staff_id,
                                 ])->whereDate('date',$date)->value('status')
                                }}
                               </td>
                              @endforeach
                          </tr>
                          <?php $x++; ?>
                      @endforeach
                  </itbody>
                  </table>
             </div>
          </div>
      </div>
    @endif

    <script>
       window.print();
    </script>
</body>
</html>