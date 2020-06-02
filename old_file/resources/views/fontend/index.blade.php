@extends('fontend.master')

@section('title')
হোম
@endsection

@section('css')
    <style >

       h1 {
    position: absolute;
    top: 83%;
    left: 36%;
    transform: translate(-50%, -50%);
    color: #fff;
    font-family: "Source Sans Pro";
    font-size: 12px;
    font-weight: 900;
    -webkit-user-select: none;
    user-select: none;
}
.birthday-img {
    width: 100%;
    height: 200px;
}
.panel-success > .panel-heading {
    color: #fff;
    background-color: #1e5225;
    border-color: #d6e9c6;
    text-align: center;
}
        canvas{display:block; height: 100%; width: 100%}

        #peresent_success_student_design .owl-carousel .owl-nav button.owl-next, #peresent_success_student_design .owl-carousel .owl-nav button.owl-prev, #peresent_success_student_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -160px;
}
#peresent_success_student_design .owl-prev {
    left: -170px;
}
#peresent_success_student_design .owl-next {
    left: 170px;
}
#peresent_success_student_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
#old_success_student_design .owl-carousel .owl-nav button.owl-next, #old_success_student_design .owl-carousel .owl-nav button.owl-prev, #old_success_student_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -160px;
}
#old_success_student_design .owl-prev {
    left: -170px;
}
#old_success_student_design .owl-next {
    left: 170px;
}
#old_success_student_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
#present_teacher_design .owl-carousel .owl-nav button.owl-next, #present_teacher_design .owl-carousel .owl-nav button.owl-prev, #present_teacher_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -160px;
}
#present_teacher_design .owl-prev {
    left: -170px;
}
#present_teacher_design .owl-next {
    left: 170px;
}
#present_teacher_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
#old_teacher_design .owl-carousel .owl-nav button.owl-next, #old_teacher_design .owl-carousel .owl-nav button.owl-prev, #old_teacher_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -160px;
}
#old_teacher_design .owl-prev {
    left: -170px;
}
#old_teacher_design .owl-next {
    left: 170px;
}
#old_teacher_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
#old_student_design .owl-carousel .owl-nav button.owl-next, #old_student_design .owl-carousel .owl-nav button.owl-prev, #old_student_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -160px;
}
#old_student_design .owl-prev {
    left: -400px;
}
#old_student_design .owl-next {
    left: 400px;
}
#old_student_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
#present_committee_design .owl-carousel .owl-nav button.owl-next, #present_committee_design .owl-carousel .owl-nav button.owl-prev, #present_committee_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -160px;
}
#present_committee_design .owl-prev {
    left: -170px;
}
#present_committee_design .owl-next {
    left: 170px;
}
#present_committee_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
#old_committee_design .owl-carousel .owl-nav button.owl-next, #old_committee_design .owl-carousel .owl-nav button.owl-prev, #old_committee_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -160px;
}
#old_committee_design .owl-prev {
    left: -170px;
}
#old_committee_design .owl-next {
    left: 170px;
}
#old_committee_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
    </style>
@endsection

@section('js')
<script >
    $(document).ready(function() {
      var owl = $('#present_success_student');
      owl.owlCarousel({
        stagePadding: 50,
        margin: 10,
        nav: true,
        autoplay:false,
        autoplayTimeout:1500,
        loop: true,
        dots:false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      })
    })
    $(document).ready(function() {
      var owl = $('#old_success_student');
      owl.owlCarousel({
        stagePadding: 50,
        margin: 10,
        nav: true,
        autoplay:false,
        autoplayTimeout:1500,
        loop: true,
        dots:false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      })
    })
    $(document).ready(function() {
      var owl = $('#present_teacher');
      owl.owlCarousel({
        stagePadding: 50,
        margin: 10,
        nav: true,
        autoplay:false,
        autoplayTimeout:1500,
        loop: true,
        dots:false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      })
    })
    $(document).ready(function() {
      var owl = $('#old_teacher');
      owl.owlCarousel({
        stagePadding: 50,
        margin: 10,
        nav: true,
        autoplay:false,
        autoplayTimeout:1500,
        loop: true,
        dots:false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      })
    })
    $(document).ready(function() {
      var owl = $('#old_student');
      owl.owlCarousel({
        stagePadding: 50,
        margin: 10,
        nav: true,
        autoplay:false,
        autoplayTimeout:1500,
        loop: true,
        dots:false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 3
          }
        }
      })
    })
    $(document).ready(function() {
      var owl = $('#old_committee');
      owl.owlCarousel({
        stagePadding: 50,
        margin: 10,
        nav: true,
        autoplay:false,
        autoplayTimeout:1500,
        loop: true,
        dots:false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      })
    })
    $(document).ready(function() {
      var owl = $('#present_committee');
      owl.owlCarousel({
        stagePadding: 50,
        margin: 10,
        nav: true,
        autoplay:false,
        autoplayTimeout:1500,
        loop: true,
        dots:false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      })
    })
</script>
<script >
    
    $(window).load(function() {
        // $("#myModal").css("display","block")
    });

    $( ".close-modal" ).click(function() {
        $("#myModal").css("display","none")
    });


       

function myFunction(event) {
        // helper functions
    const PI2 = Math.PI * 2
    const random = (min, max) => Math.random() * (max - min + 1) + min | 0
    const timestamp = _ => new Date().getTime()

    // container
    class Birthday {
      constructor() {
        this.resize()

        // create a lovely place to store the firework
        this.fireworks = []
        this.counter = 0

      }
      
      resize() {
        this.width = 300
        let center = this.width / 2 | 0
        this.spawnA = center - center / 4 | 0
        this.spawnB = center + center / 4 | 0
        
        this.height = 300
        this.spawnC = this.height * .1
        this.spawnD = this.height * .5
        
      }
      
      onClick(evt) {
         let x = evt.clientX || evt.touches && evt.touches[0].pageX
         let y = evt.clientY || evt.touches && evt.touches[0].pageY
         
         let count = random(3,5)
         for(let i = 0; i < count; i++) this.fireworks.push(new Firework(
            random(this.spawnA, this.spawnB),
            this.height,
            x,
            y,
            random(0, 20),
            random(30, 110)))
              
         this.counter = -1
         
      }
      
      update(delta) {
        ctx.globalCompositeOperation = 'hard-light'
        ctx.fillStyle = `rgba(20,20,20,${ 7 * delta })`
        ctx.fillRect(0, 0, this.width, this.height)

        ctx.globalCompositeOperation = 'lighter'
        for (let firework of this.fireworks) firework.update(delta)

        // if enough time passed... create new new firework
        this.counter += delta * 3 // each second
        if (this.counter >= 1) {
          this.fireworks.push(new Firework(
            random(this.spawnA, this.spawnB),
            this.height,
            random(0, this.width),
            random(this.spawnC, this.spawnD),
            random(0, 360),
            random(30, 110)))
          this.counter = 0
        }

        // remove the dead fireworks
        if (this.fireworks.length > 1000) this.fireworks = this.fireworks.filter(firework => !firework.dead)

      }
    }

    class Firework {
      constructor(x, y, targetX, targetY, shade, offsprings) {
        this.dead = false
        this.offsprings = offsprings

        this.x = x
        this.y = y
        this.targetX = targetX
        this.targetY = targetY

        this.shade = shade
        this.history = []
      }
      update(delta) {
        if (this.dead) return

        let xDiff = this.targetX - this.x
        let yDiff = this.targetY - this.y
        if (Math.abs(xDiff) > 3 || Math.abs(yDiff) > 3) { // is still moving
          this.x += xDiff * 2 * delta
          this.y += yDiff * 2 * delta

          this.history.push({
            x: this.x,
            y: this.y
          })

          if (this.history.length > 20) this.history.shift()

        } else {
          if (this.offsprings && !this.madeChilds) {
            
            let babies = this.offsprings / 2
            for (let i = 0; i < babies; i++) {
              let targetX = this.x + this.offsprings * Math.cos(PI2 * i / babies) | 0
              let targetY = this.y + this.offsprings * Math.sin(PI2 * i / babies) | 0

              birthday.fireworks.push(new Firework(this.x, this.y, targetX, targetY, this.shade, 0))

            }

          }
          this.madeChilds = true
          this.history.shift()
        }
        
        if (this.history.length === 0) this.dead = true
        else if (this.offsprings) { 
            for (let i = 0; this.history.length > i; i++) {
              let point = this.history[i]
              ctx.beginPath()
              ctx.fillStyle = 'hsl(' + this.shade + ',100%,' + i + '%)'
              ctx.arc(point.x, point.y, 1, 0, PI2, false)
              ctx.fill()
            } 
          } else {
          ctx.beginPath()
          ctx.fillStyle = 'hsl(' + this.shade + ',100%,50%)'
          ctx.arc(this.x, this.y, 1, 0, PI2, false)
          ctx.fill()
        }

      }
    }

    let d_id=event.target.id;
    let canvas = document.getElementById('birthday'+d_id)

    let ctx = canvas.getContext('2d')

    let then = timestamp()

    let birthday = new Birthday
    window.onresize = () => birthday.resize()
    document.onclick = evt => birthday.onClick(evt)
    document.ontouchstart = evt => birthday.onClick(evt)

      ;(function loop(){
        requestAnimationFrame(loop)

        let now = timestamp()
        let delta = now - then

        then = now
        birthday.update(delta / 1000)
        

      })()
}



</script>
@endsection

@section('mainContent')
@include('fontend.include.slider')
<div class="col-md-9 left_con" ><!-- left Content Start-->
<div class="row">
    <div class="col-md-12"><!-- Welcome Massage Start-->
    <div class="panel panel-success ">
        <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099; color:#FFFFFF">প্রতিষ্ঠানের ইতিহাস</div>
        <div class="panel-body"  >
            <img style="width: 100%; height: 200px;  border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="{{ asset('/fontend/images/photo1.jpg')}}" alt="Welcome to">
            <p style="text-align: justify; line-height:25px; color:#003366; font-size:14px">অন্ধকার দূর করে মানব জীবনকে আলোকিত করাই শিক্ষা। শিক্ষার্থীদের মেধা বিকাশ সাধনের মাধ্যমে আধুনিক বিজ্ঞান শিক্ষার প্রতি গুরুত্বসহ শ্রেণিকক্ষে মাল্টিমিডিয়া পদ্ধতিতে প্রজেক্টরের মাধ্যমে </p>
            <a href="indexa7d7.html?app=home&amp;cmd=more_cultur" class=""> ... Read More</a>
            <p></p>
        </div>
    </div>
    </div><!-- Welcome Massage End-->
</div>
<div class="row">
    <div class="col-md-6"><!-- Welcome Massage Start-->
    <div class="panel panel-success ">
        <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
        <div class="panel-body">
            <p style="text-align: justify; line-height: 1.6;">
                <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
            </p>
            <p style="text-align: justify; line-height:25px;">
            গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে ওযেবসাইড প্রকাশ করতে যাচ্ছে শুনে আমি অত্যন্ত আনন্দিত। বাংলাদেশ সরকারের মাননীয় প্রধানমন্ত্রী বঙ্গ বন্ধু কন্যা জননেত্রী শেখ হাসিনার নেতৃতে সারা বাংলাদেশকে ডিজিটাল দেশ গড়ার মধ্যে দিয়ে পৃথিবীর বুকে একটি সুন্দর দেশ গড়ার অভিযাত্রা শুরু করেছিলেন ২০০৮ সালে ১ শে ডিসেম্বর জাতিসংঘের ঘোষণার মধ্যে দিয়ে । </p>
            <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
            
        </div>
    </div>
</div>
<div class="col-md-6"><!-- Welcome Massage Start-->
<div class="panel panel-success ">
    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">প্রধান শিক্ষকের বাণী</div>
    <div class="panel-body">
        <p style="text-align: justify; line-height: 1.6;">
            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="{{ asset('/fontend/images/photo1.jpg')}}" alt="Welcome to">
        </p>
        <p style="text-align: justify; line-height:25px;">
        দেশ,জাতি তথা বিশ্ব মানবতার মুক্তির মশাল নিয়ে যে শিক্ষা প্রতিষ্ঠানটি ১৯৭২ সাল হতে আজ অবদি অনবরত আলো ছরিয়ে আসছে , সেই গোয়ালনাদ প্রপার হাই স্কুলের বর্তমান শিক্ষার গুনগত মান উন্নয়ন তথ্য প্রযুক্তি ও আধুনিক যুগোপযোগী শিক্ষার সৎ দক্ষ ও মেধাবী মানুষ তৈরির লক্ষ্যে আমাদের পথ চলা। প্রধানমন্ত্রী তথা শিক্ষাবিদ,মনীষি ও জ্ঞান তাপস মানুষের আকাঙ্খা পূরনে</p>
        <a href="indexbc70.html?app=home&amp;cmd=more_princi" class=""> ... Read More</a>
        
    </div>
</div>
</div><!-- Welcome Massage End-->
</div>
<div class="row principal_msg">
    <div class="col-md-6">
        <div class="panel panel-success ">
            <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">বর্তমান কৃতি শিক্ষার্থী</div>
        <div id="peresent_success_student_design">   
        <div class="owl-carousel owl-theme" id="present_success_student">
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে ওযেবসাইড প্রকাশ করতে যাচ্ছে শুনে  </p>
                        <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে ওযেবসাইড প্রকাশ করতে যাচ্ছে শুনে  </p>
                        <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে ওযেবসাইড প্রকাশ করতে যাচ্ছে শুনে  </p>
                        <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                        
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    </div>
<div class="col-md-6">
    <div class="panel panel-success ">
        <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">প্রাক্তন কৃতি শিক্ষার্থী</div>
        <div id="old_success_student_design">
            <div class="owl-carousel owl-theme" id="old_success_student">
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                                গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে ওযেবসাইড প্রকাশ করতে যাচ্ছে শুনে  </p>
                                <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                                গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে ওযেবসাইড প্রকাশ করতে যাচ্ছে শুনে  </p>
                                <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                                গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে ওযেবসাইড প্রকাশ করতে যাচ্ছে শুনে  </p>
                                <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

    
    
</div>
<div class="row principal_msg">
    <div class="col-md-6">
        <div class="panel panel-success ">
            <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">বর্তমান শিক্ষকমণ্ডলী</div>
        <div id="present_teacher_design">   
        <div class="owl-carousel owl-theme" id="present_teacher">
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        <b>নামঃ</b> জন </p>
                        <b>পদবিঃ</b>শিক্ষক </p>
                        
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        <b>নামঃ</b> জন </p>
                        <b>পদবিঃ</b>শিক্ষক </p>
                        
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        <b>নামঃ</b> জন </p>
                        <b>পদবিঃ</b>শিক্ষক </p>
                        
                        
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    </div>
<div class="col-md-6">
    <div class="panel panel-success ">
        <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">প্রাক্তন শিক্ষকমণ্ডলী</div>
        <div id="old_teacher_design">
            <div class="owl-carousel owl-theme" id="old_teacher">
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;"><b>নামঃ </b> জন </p><br>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>যোগদানের তারিখঃ </b> ১-১-১৯৯০</p><br>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>অবসরের তারিখঃ </b> ১-১-১৯৯০</p>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;"><b>নামঃ </b> জন </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>যোগদানের তারিখঃ </b> ১-১-১৯৯০</p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>অবসরের তারিখঃ </b> ১-১-১৯৯০</p>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;"><b>নামঃ </b> জন </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>যোগদানের তারিখঃ </b> ১-১-১৯৯০</p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>অবসরের তারিখঃ </b> ১-১-১৯৯০</p>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<div class="row principal_msg">
    <div class="col-md-6">
        <div class="panel panel-success ">
            <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">বর্তমান কমিটি</div>
        <div id="present_committee_design">   
        <div class="owl-carousel owl-theme" id="present_committee">
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        <b>নামঃ</b> জন </p>
                        <b>পদবিঃ</b>শিক্ষক </p>
                        
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        <b>নামঃ</b> জন </p>
                        <b>পদবিঃ</b>শিক্ষক </p>
                        
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        <b>নামঃ</b> জন </p>
                        <b>পদবিঃ</b>শিক্ষক </p>
                        
                        
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    </div>
<div class="col-md-6">
    <div class="panel panel-success ">
        <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">প্রাক্তন কমিটি</div>
        <div id="old_committee_design">
            <div class="owl-carousel owl-theme" id="old_committee">
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;"><b>নামঃ </b> জন </p><br>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>যোগদানের তারিখঃ </b> ১-১-১৯৯০</p><br>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>অবসরের তারিখঃ </b> ১-১-১৯৯০</p>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;"><b>নামঃ </b> জন </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>যোগদানের তারিখঃ </b> ১-১-১৯৯০</p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>অবসরের তারিখঃ </b> ১-১-১৯৯০</p>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="col-md-12"><!-- Welcome Massage Start-->
                        <div class="panel panel-success ">
                            
                            <div class="panel-body" style="padding: 15px 0 0 15px;">
                                <p style="text-align: justify; line-height: 1.6;">
                                    <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                                </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;"><b>নামঃ </b> জন </p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>যোগদানের তারিখঃ </b> ১-১-১৯৯০</p>
                                <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0; text-align: center;"><b>অবসরের তারিখঃ </b> ১-১-১৯৯০</p>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<div class="row principal_msg">
    <div class="col-md-12">
        <div class="panel panel-success ">
            <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#000099;color:#FFFFFF">প্রাক্তন শিক্ষার্থী সংঘ </div>
        <div id="old_student_design">   
        <div class="owl-carousel owl-theme" id="old_student">
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে</p>
                        <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে   </p>
                        <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে   </p>
                        <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
             <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    <div class="panel-heading" style="font-weight: bold; font-size: 18px;background-color:#5BC0DE;color:#FFFFFF">সভাপতি মহদয়ের বাণীঃ</div>
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                        <p style="text-align: justify; line-height: 1.6;">
                            <img style="width: 140px; height: 150px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -15px 10px 0px -15px;" class="img-responsive" src="{{ asset('/fontend/images/chair.jpg')}}" alt="Welcome to">
                        </p>
                        <p style="text-align: justify; line-height:25px; margin: -25px 0 0px 0;">
                        গোয়ালন্দ উপজেলা সংলগ্ন গোয়ালন্দ প্রপার হাই স্কুলে   </p>
                        <a href="indexdc07.html?app=home&amp;cmd=more_chair" class=""> ... Read More</a>
                        
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    </div>

</div>

<p onload="myFunction()" src="/default.asp"></p>

</div>
<!-- Modal -->
<div class="modal bs-example-modal-lg fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background: rgba(0,0,0,.8);">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">শুভ জন্মদিন...</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                    <img class="birthday-img"  id="1" onload="myFunction(event)" src="{{ asset('/fontend/images/photo1.jpg')}}">
                    <h1>
                    <p>Name: Jhone </p>
                    <p>Designation: Student </p>
                    <p>Class: six </p>
                    <p>ID: 12345 </p>
                    </h1>
                    <canvas id="birthday1"  width: 200px;height: 200px"></canvas>
                </div>
                <div class="col-md-3">
                    <img class="birthday-img"  id="2" onload="myFunction(event)" src="{{ asset('/fontend/images/photo1.jpg')}}">
                    <h1>
                    <p>Name: Jhone </p>
                    <p>Designation: Student </p>
                    <p>Class: six </p>
                    <p>ID: 12345 </p>
                    </h1>
                    <canvas id="birthday2"  width: 200px;height: 200px"></canvas>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection