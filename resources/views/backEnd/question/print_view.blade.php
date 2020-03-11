@extends('backEnd.master')

@section('mainTitle', 'প্রশংসাপত্র তৈরি করুন')
@section('question', 'active')

@section('content')

    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রশংসাপত্র তৈরি করুন</h1>
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
                        <h3>প্রশংসা পত্র</h3>
                        <span class="pull-right" style="size:16px !important"><b>নিবন্ধন নং : </b> <span class="dowon-mark">{{$student->testimonial_reg_no}}</span></span>
                    </div>
                    <div style="padding: 10px"><hr></div>
                    <div class="content-testimonial">
                        <p>
                            আমি এই মর্মে প্রশংসা পত্র প্রদান করিতেছি যে, <span class="dowon-mark">{{$student->name}}</span> পিতা <span class="dowon-mark">{{$student->father_name}}</span> মাতা <span class="dowon-mark">{{$student->mother_name}}</span> গ্রাম  <span class="dowon-mark">{{$student->village}}</span> ডাকঘর <span class="dowon-mark">{{$student->post_office}}</span> থানা <span class="dowon-mark">{{$student->upazila}}</span> জেলা <span class="dowon-mark">{{$student->district}}</span> অত্র বিদ্যালয় হইতে <span class="dowon-mark">{{$student->exam_session}}</span> ইং সালে <span class="dowon-mark">{{$student->board}}</span> শিক্ষা বোর্ডের অধীনে অনুষ্টিত <span class="dowon-mark">{{$student->exam}}</span>  পরীক্ষায় অংশ গ্রহণ করিয়া জিপিএ  <span class="dowon-mark">{{$student->gpa}}</span> পাইয়া উর্ত্তীন হইয়াছে।  সে <span class="dowon-mark">{{$student->group}}</span> বিভাগের <span class="dowon-mark">{{$student->section}}</span> শাখার  ছাত্র/ছাত্রী ছিল। তাহার উক্ত পরীক্ষার রোল নম্বর <span class="dowon-mark">{{$student->roll}}</span> রেজিস্ট্রেশন নম্বর <span class="dowon-mark">{{$student->reg_no}}</span> শিক্ষাবর্ষ  <span class="dowon-mark">{{$student->session}}</span>। বিদ্যালয়ের  ভর্তিবহি অনুযায়ী তাহার জন্ম তারিখ <span class="dowon-mark">{{str_replace($s,$r,date('d-m-Y',strtotime($student->birth_day)))}}</span> ইং। 
                        </p>

                        <p> 
                            আমার জানা মতে তাহার স্বভাব ও চরিত্র উত্তম। এখানে অধ্যায়নরত অবস্থায় সে কখনো বিদ্যালয়ের আইন শৃঙ্খলা অথবা রাষ্ট্র বিরোধী কার্যকলাপে অংশ গ্রহণ করে নাই। 
                        </p>

                        <p>আমি তাহার জীবনের সর্বাঙ্গীন উন্নতি কামনা করি। </p>
                    </div>
                    <div style="height: 150px"></div>
                     <div class="row1">
                        <div class="column-60 modarator">
                               <p>যাচাইকারী :</p>
                               <p >তারিখ :- <span style="font-size: 14px;">{{date('d-m-Y')}}</span></p>
                        </div>
                        <div class="column-40">
                          <br><br>
                          <p style="width:230px;padding: 0;border-top: 1px solid black;font-size: 14px;">{{'অধ্যক্ষ / প্রধান শিক্ষকের'}} স্বাক্ষর ও সীল :</p>
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