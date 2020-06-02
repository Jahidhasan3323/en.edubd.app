@extends('backEnd.master')

@section('mainTitle', 'Question Paper')
@section('online_exam', 'active')

@section('content')
  <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Question Paper</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

<div class="row pull-left">
    <div class="col-md-12">

    </div>
</div>
<div class="row pull-right">

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
                   .bg-logo{position: absolute; top: 0; left:0; width: 100%; height: 1015px;  background-repeat: no-repeat, repeat; background-size:500px 500px; background-position: center; z-index: -1; opacity: 0.2; }
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
                        <h3 style="margin-bottom: 0">{{$school->user->name}} </h3>

                        <p>{{$school->address}}</p>
                        <p>{{$exam->name}}</p>
                        <p>Shift : {{$exam->shift}}, Group : {{$exam->group_class->name}}</p>
                        <p>Class : {{$exam->masterClass->name}}, Section : {{$exam->section}}</p>
                        <p>Subject : {{$exam->subject->subject_name}}</p>
                        <span style="size:16px !important;float:left"><b>Time : </b> <span class="dowon-mark">{{$exam->time}}</span>Minute <span id="demo"></span></span>
                        <span  style="size:16px !important; float:right"><b>Full Marks : </b> <span class="dowon-mark">{{$exam->full_mark}}</span></span>
                    </div>
                    <div style="padding: 10px"><hr></div>
                    <div class="content-testimonial">
                      @if($questions)
                      <form action="{{url('online-exam/written')}}" method="post" enctype="multipart/form-data" id="formId">
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                       {{csrf_field()}}
                      <?php $o=1; ?>
                        @foreach($questions as $question)
                        <div class="row">
                          <div class="col-md-12">

                          {{$o}}.<span style="float: right;">{{$question->questions->mark}}</span> {!!$question->questions->question!!}
                            <textarea class="form-control" id="answer{{$question->id}}" name="{{$question->questions->id}}_answer[]"></textarea>

                          <?php $o++; ?>
                        </div>
                      </div> <br>
                        <script>
                          ClassicEditor
                                  .create( document.querySelector( '#answer{{$question->id}}' ) )
                                  .then( editor => {
                                          console.log( editor );
                                  } )
                                  .catch( error => {
                                          console.error( error );
                                  } );
                      </script>
                        @endforeach
                        <hr>
                        <div class="form-group pull-right">
                          <button class="btn btn-info" id="submit" type="submit">Submit</button>

                        </div>
                      </form>
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
     <script>
      // Set the date we're counting down to
      var countDownDate = <?= strtotime(Session::get('end_time'))?>* 1000;
      console.log(countDownDate);
      // Get today's date and time
        var now = <?php echo time() ?> * 1000;
      // Update the count down every 1 second
      var x = setInterval(function() {
        now = now + 1000;


        // Find the distance between now and the count down date
        var distance = countDownDate - now;


        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);


        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";


        // If the count down is over, write some text
        if (distance < 0) {
          clearInterval(x);
          $("#formId").submit();
        }
      }, 1000);
</script>
  </script>
@endsection
