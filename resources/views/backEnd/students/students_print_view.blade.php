<!DOCTYPE html>
<html>
<head>
	<title>Student lists Print</title>
	<link href="{{asset('backEnd/css/bootstrap.css')}}" rel="stylesheet"/>
</head>
<body>
    <div class="panel col-sm-12" style="margin-bottom: 15px;">
        <div class="page-header text-center">
            <h2 class="text-center text-temp">{{$school->user->name}}</h2>
            <h4 class="text-center text-temp">{{$school->address}}</h4>
            <p><img src="{{Storage::url($school->logo)}}" alt="Schoo Logo" width="80px;" height="80px;"></p>
            <h3 class="text-center text-temp">শিক্ষার্থীদের তালিকা</h3>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center">

            <h4>শ্রেণী : {{$BanglaNumberToWord->engToBn($students[0]->master_class->name)}}, বিভাগ : {{$students[0]->group}}, শাখা : {{$students[0]->section}}, শিক্ষাবর্ষ :{{$BanglaNumberToWord->engToBn($students[0]->session)}} </h4>
          </div>

          @if(Session::has('errmgs'))
              @include('backEnd.includes.errors')
          @endif
          @if(Session::has('sccmgs'))
              @include('backEnd.includes.success')
          @endif
        </div>

        <div class="table-responsive">
           <table id="student_tbl" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ক্র.নং</th>
                        <th>ছবি</th>
                        <th>শিক্ষার্থীর তথ্য</th>
                        <th>ইমেইল এবং মোবাইল নং</th>
                    </tr>
                </thead>
                <tbody>
                        @php($x = Get::serial($students))
                        @foreach($students as $student)
                            <tr>
                                <td>{{$x}}</td>
                                <td><img src="{{Storage::url($student->photo)}}" width="64px" height="85px"></td>
                                <td>
                                    নাম : {{$student->user->name}}<br>
                                    পিতা : {{$student->father_name}}<br>
                                    মাতা : {{$student->mother_name}}<br>
                                    রোল নং- {{$student->roll}}<br>
                                    আইডি নং- {{$student->student_id}}<br>
                                </td>
                                <td>
                                    ইমেইল : {{$student->user->email}}<br>
                                    শিক্ষার্থীর : {{$student->user->mobile}}<br>
                                    অবিভাবক : {{$student->f_mobile_no}}, {{$student->m_mobile_no}} 
                                </td>
                            </tr>
                            @php($x++)
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>


