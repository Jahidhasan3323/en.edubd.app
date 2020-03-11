@extends('backEnd.master')

@section('mainTitle', 'প্রশ্নপত্র')
@section('question', 'active')

@section('content')

    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">প্রশ্নপত্র</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

<div class="row pull-left">
    <div class="col-md-12">
      @if($exam->type==1)
        <a href="{{url('exam/question',$exam->id)}}" class="btn btn-success"><i class="fa fa-plus"></i> প্রশ্নযোগ করুন</a>
      @endif
      @if($exam->type==2)
        <a href="{{url('exam/question/written',$exam->id)}}" class="btn btn-success"><i class="fa fa-plus"></i> প্রশ্নযোগ করুন</a>
      @endif
    </div>
</div>
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
                   .col-md-3 {
                    width: 22%;
                   }
                   .col-md-12 {
                    width: 100%;
                   }
                   .col-md-3, .col-md-12{
                    float: left;
                   }
                   .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-md-12,{
                    position: relative;
                    min-height: 1px;
                    padding-right: 15px;
                    padding-left: 15px;
                   }
                  
               </style>
                <div class="col-md-12" style=" height: 1015px;z-index:1; width: 100%">
                  <div class="bg-logo"></div>
                    <div class="header-testimonial">
                        <h3 style="margin-bottom: 0">{{Auth::user()->name}} </h3>

                        <p>{{Auth::user()->school->address}}</p>
                        <p>{{$exam->name}}</p>
                        <p>শিফটঃ {{$exam->shift}}, গ্রুপঃ {{$exam->group_class->name}}</p>
                        <p>শ্রেনিঃ {{$exam->masterClass->name}}, শাখাঃ {{$exam->section}}</p>
                        <p>বিষয়ঃ {{$exam->subject->subject_name}}</p>
                        <span style="size:16px !important;float:left"><b>সময়ঃ </b> <span class="dowon-mark">{{$exam->time}}</span>মিনিট</span>
                        <span  style="size:16px !important; float:right"><b>পূর্ণমানঃ </b> <span class="dowon-mark">{{$exam->full_mark}}</span></span>
                    </div>
                    <div style="padding: 10px"><hr></div>
                    <div class="content-testimonial">
                      @if($questions)
                      <?php $o=1; ?>
                        @foreach($questions as $question)
                        <div class="row">
                          <div class="col-md-12">

                          {{$o}}. {!!$question->questions->question!!} <span style="float: right;">{{$question->questions->mark}}</span>
                            <div class="row">
                            @foreach($question->questions->options as $option)
                              <div class="col-md-3">
                                <p style="margin-left: 20px; line-height: 0">{{$option->serial}}. {{$option->option}}</p>
                              </div>
                            @endforeach
                            
                            </div>
                          <?php $o++; ?>
                        </div>
                      </div>
                        @endforeach
                      @endif
                        
                    </div>
                    <div style="height: 150px"></div>
                     
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