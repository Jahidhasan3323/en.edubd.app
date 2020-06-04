@extends('backEnd.master')

@section('mainTitle', 'Print Testimonial')
@section('active_student', 'active')

@section('content')

    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Print Testimonial</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

<div class="row pull-right">
    <div class="col-md-12">
        <a href="javascript:void" media="print" onclick="javascript:print_genarator('div-id-name');" class="btn btn-default">Click here to Print</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <hr>
    </div>
</div>
        <div class="panel-body">

            <div class="row" id="div-id-name">
               <style>
                    .column-60{
                     float: left;
                     width: 60%;
                    }
                    .column-40{
                     float: left;
                     width: 40%;
                    }

                   .row1:after {
                     content: "";
                     display: table;
                     clear: both;
                   }
                   .header-testimonial{
                    text-align: center;
                   }
                   .header-testimonial p{
                     padding: 0;
                     margin: 0;
                   }
                   .header-testimonial img{
                     width:50px;
                     height:50px;
                   }
                   .content-testimonial{
                    text-align: justify;
                   }
                   .content-testimonial p{
                    color: black;
                    padding: 10px;
                    font-size: 14px;
                    line-height: 32px;
                   }
                   hr {
                       margin-top: 20px;
                       margin-bottom: 10px;
                       border: 0;
                       border-top: 1px solid #eee;
                   }
                   .dowon-mark{
                    border-bottom: 1px dashed black;
                    padding: 0 30px 0 30px;
                   }

                   .modarator p{
                      padding-top: 0;
                      padding-left: 10px;
                      line-height: 20px;
                      font-size: 14px;
                   }
                   .bg-logo{position: absolute; top: 0; left:0; width: 100%; height: 1015px; background-image: url({{Storage::url($school->logo)}}); background-repeat: no-repeat, repeat; background-size:500px 500px; background-position: center; z-index: -1; opacity: 0.2; }
               </style>
                <div class="col-md-12" style="border:6px double black; height: 1015px;z-index:1">
                  <div class="bg-logo"></div>
                    <div class="header-testimonial">
                        <h3 style="margin-bottom: 0"><img src="{{Storage::url(Auth::user()->school->logo)}}" alt=""> {{Auth::user()->name}} </h3>

                        <p>{{Auth::user()->school->address}}</p>
                        <h3>Testimonial</h3>
                        <span  style="size:16px !important; float:right"><b>Registration No : </b> <span class="dowon-mark">{{$student->testimonial_reg_no}}</span></span>
                    </div>
                    <div style="padding: 10px"><hr></div>
                    <div class="content-testimonial">
                        <p>
                            This is to certify that, <span class="dowon-mark">{{$student->name}}</span> father <span class="dowon-mark">{{$student->father_name}}</span> mother <span class="dowon-mark">{{$student->mother_name}}</span> village  <span class="dowon-mark">{{$student->village}}</span> post office <span class="dowon-mark">{{$student->post_office}}</span> upazila <span class="dowon-mark">{{$student->upazila}}</span> district <span class="dowon-mark">{{$student->district}}</span> got GPA <span class="dowon-mark">{{$student->gpa}}</span> from this institute after taking the <span class="dowon-mark">{{$student->exam}}</span> examination under <span class="dowon-mark">{{$student->board}}</span> Education Board in <span class="dowon-mark">{{$student->exam_session}}</span>. He/She was a student of <span class="dowon-mark">{{$student->section}}</span> section of the <span class="dowon-mark">{{$student->group}}</span>  department. His/Her Exam roll number is <span class="dowon-mark">{{$student->roll}}</span> for registration number <span class="dowon-mark">{{$student->reg_no}}</span> for academic year <span class="dowon-mark">{{$student->session}}</span>. According to the admission of the school, his/her date of birth is <span class="dowon-mark">{{date('d-m-Y',strtotime($student->birth_day))}}</span>.
                        </p>
                       

                        <p>
                            I know his nature and character are good. While studying here, he/she never participated in any school anti-state activities.
                        </p>

                        <p>I Wish him a challeing future and brilliant Life.  </p>
                    </div>
                    <div style="height: 150px"></div>
                     <div class="row1">
                        <div class="column-60 modarator">
                               <p>Verified by :</p>
                               <p >Date :- <span style="font-size: 14px;">{{date('d-m-Y')}}</span></p>
                        </div>
                        <div class="column-40">
                          <br><br>
                          <p style="width:280px;padding: 0;border-top: 1px solid black;font-size: 14px;">{{"Headmaster/ Principal's"}} signature and Seal :</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
     <script>
         function print_genarator(lyear){
            var genaretor = window.open();
            var layeartext = document.getElementById(lyear);
              genaretor.document.write(layeartext.innerHTML.replace("Print Me"));
              genaretor.document.close();
              genaretor.print();
              genaretor.close();
         }
     </script>
@endsection
