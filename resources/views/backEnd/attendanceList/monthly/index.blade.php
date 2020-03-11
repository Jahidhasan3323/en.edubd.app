
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
    @if(isset($students)&&$students!=''&&$students!=NULL)
      <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
          <div class="panel-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{Storage::url(Auth::user()->school->logo)}}" width="80">
                    <h3>{{Auth::user()->name}}</h3>
                    <p>{{Auth::user()->school->address}}</p>
                    <h3>শিক্ষার্থীদের হাজিরা {{str_replace($s, $r,date("F", mktime(null, null, null, $search['month']))).'-'.$search['year']}}</h3>
                    <h4>{{
                      'শ্রেণী:'.$students[0]->group.', বিভাগ:'
                      .$students[0]->group.', শ্রেণী:'
                      .$students[0]->শিফট.', শাখা:'
                      .$students[0]->section
                    }}</h4>
                </div> 
            </div>
             <div class="table-responsive">
              <table id="subject_tbl" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th style="width:5px !important">#</th>
                          <th style="width:50px !important; ">ছবি</th>
                          <th style="width:200px !important;">শিক্ষার্থী</th>
                          <th style="width:10px !important; ">রোল </th>
                          @foreach($days as $date)
                           <th style="width:5px !important; padding: -1px 3px 3px 3px !important;">{{date('d',strtotime($date))}}</th>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody>
                  <?php $x = 1; ?>
                      @foreach($students as $student)
                          <tr>
                              <td>{{$x}}</td>
                              <td style="width:50px !important; padding:0;"><img src="{{Storage::url($student->photo)}}" width="50px" height="50px"></td>
                              <td style="width:200px !important;"> {{$student->user->name}}</td>
                              <td> {{$student->roll}}</td>
                              @foreach($days as $date)
                               <td></td>
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

    @if(isset($employees)&&$employees!=''&&$employees!=NULL)
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
                          <th style="width:5px !important">#</th>
                          <th style="width:50px !important; ">ছবি</th>
                          <th style="width:200px !important;">কর্মকর্তা</th>
                          @foreach($days as $date)
                           <th style="width:5px !important;  padding: -1px 3px 3px 3px !important">{{date('d',strtotime($date))}}</th>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody>
                  <?php $x = 1; ?>
                      @foreach($employees as $employee)
                          <tr>
                              <td>{{$x}}</td>
                              <td style="width:50px !important; padding:0;"><img src="{{Storage::url($employee->photo)}}" width="50px" height="50px"></td>
                              <td >{{$employee->user->name}}</td>
                              @foreach($days as $date)
                               <td></td>
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