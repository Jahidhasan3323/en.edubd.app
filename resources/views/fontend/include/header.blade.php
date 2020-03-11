<style type="text/css">
  .goog-logo-link {
   display:none !important;
}

.goog-te-gadget {
   color: transparent !important;
}

.goog-te-gadget .goog-te-combo {
   color: blue !important;
}
</style>

        <div class="header_top" style="background-color:#F2184F !important;">
          <div class="header_top_left">
            <ul class="top_nav">
              <li><a href="http://www.worldehsan.org" target="_blank">ইহসান সফটওয়্যার</a></li>
              <!-- <li><a href="javascript:void(0);">About</a></li> -->
              
              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> বোর্ডের ফলাফল </a>
                <ul class="dropdown-menu" role="menu" style="background-color:#000;font-family:'',sans-serif;">
                   <li><a href="http://eboardresults.com/app/" target="_blank"> ফলাফল প্রকাশনা পদ্ধতি </a></li>
                   <li><a href="javascript:void(0)"> এসএসসি বোর্ড ফলাফল </a></li>
                   <li><a href="javascript:void(0)"> প্রাইমারি ফলাফল </a></li>
                </ul>
              </li>
              <li style="color:#fff;">
                <div class="lantra">  

          <div id="google_translate_element"> </div>
            <script type="text/javascript">
            function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div> 
              </li>
            </ul>
          </div>
          <div class="header_top_right">
            <div class="pull-right date-dropdown">
                <select>
                    <option value="">Date Language</option>
                    <option value="">English</option>
                    <option value="">Bangla</option>
                </select>
            </div>

           <p > <?php $str = date('m-d-Y');
                //$dateObj = DateTime::createFromFormat('m-d-Y', $str);
                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
echo $dt->format('F j, Y, g:i a'); ?> </p>
          </div>
        </div>
      
<div class="header" style="background:url('{{ asset("/fontend/images/header-background.jpg")}}')">
    <div class="row">
	<div class="col-md-1">
       <img src="{{ asset('/fontend/images/logo.png')}}"  alt="" style="height:120px;padding: 8px 8px;">
	   </div>
	<div class="col-md-9" align="center">
       {{-- <img src="{{ asset('/public/fontend/images/logo2.png')}}" class="" style="margin: auto;"> --}}
       <h1 class="header-title" style="color: #006622;">Goalondo Proper High Shool</h1>
       <p style="color: #006622;"><b>Est: 01-01-1904</b> </p>
	   <!--<p align="center"><img src="images/tit.png" class="img-responsive" alt="Goalundo Proper High School" align="middle">&nbsp;</p>-->
	   </div>
	    <div class="col-md-2" align="right">
       <video src="{{asset('/fontend/images/video.mp4')}}"  controls loop width="120px" height="102px"></video>


	   </div> <!-- /.header-right -->
    </div>
</div><!-- Header End-->
<!-- news start-->
<div class="scroll_news" style="background-color:#fff; color:#FFFFFF;border: 5px solid #000099;" ><!-- Scrool News Start-->
    <div class="row">
        <div class="col-md-2"><p class="text-left" style="font-size:15px; font-weight:bold; color:#000099">
                <!--<i class="fa fa-newspaper-o"></i> -->&nbsp; সর্বশেষ নোটিশসমূহ &nbsp; <i class="fa fa-chevron-right"></i></p>

        </div>
        <div class="col-md-10 " style="color:#000099">
            <marquee behavior="scroll" align="middle" direction="left" scrollamount="4" onMouseOver="this.stop()" onMouseOut="this.start()" ><b>jhjfghgfjhfh ..  ** ,.mgfl,mf,... ** kjfkjgkj</b></marquee>        </div>
    </div>
</div>
<!-- news end-->
<div class="menu sticky"> <!-- Menu Start-->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav nav">
                    <li class=""><a href="{{url('/')}}"><i class="fa fa-home fa-lg"></i>&nbsp; হোম</a></li>
                    

                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">প্রতিষ্ঠানের তথ্য<b class="caret"></b></a>
                        <ul class="dropdown-menu" style="min-width: 470px;padding: 5px 0 0 10px;">
                          <div class="row">
                             <div class="col-md-4">
                              <li><a><b style="font-size: 16px;">অন্যান্য</b></a></li>
                              <li class="divider"></li>
                              <li><a href="{{url('/aboutus')}}">প্রতিষ্ঠানের তথ্য</a></li>
                              <li class="divider"></li>
                              <li><a href="{{url('committee')}}">কমিটি</a></li>
                              <li class="divider"></li>
                              <li><a href="#">কর্মচারী</a></li>
                              <li class="divider"></li>
                            </div>
                            <div class="col-md-4">
                              <li><a><b style="font-size: 16px;">শিক্ষক</b></a></li>
                              <li class="divider"></li>
                              <li><a href="{{url('/principal')}}">প্রধান শিক্ষক</a></li>
                              <li class="divider"></li>
                              <li><a href="{{url('/vice_principal')}}">সহকারী
                               প্রধান শিক্ষক</a></li>
                              <li class="divider"></li>
                              <li><a href="{{url('teacher')}}">সহকারী শিক্ষক</a></li>
                              <li class="divider"></li>
                            </div>
                            <div class="col-md-4">
                              <li><a><b style="font-size: 16px;">একাডেমিক</b></a></li>
                              <li class="divider"></li>
                              <li><a href="#">ভর্তি তথ্য</a></li>
                              <li class="divider"></li>
                              <li><a href="#">ফি </a></li>
                              <li class="divider"></li>
                              <li><a href="#">পরীক্ষা রুটিন</a></li>
                              <li class="divider"></li>
                              <li><a href="#">ক্লাস রুটিন</a></li>
                              <li class="divider"></li>
                              <li><a href="#">পোশাক  </a></li>
                            </div>
                           
                          </div>
                            
                            <!--<li class="divider"></li>
                            <li><a href="#">Attendance Position</a></li>-->
                        </ul>
                    </li>
                    <li><a href="{{url('/class')}}">ছাত্র / ছাত্রী</a></li>
					
					
					
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">অনলাইন ভর্তি<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">ভর্তি নোটিশ</a></li>
                            <li class="divider"></li>
                            <li><a href="#">ভর্তি ফর্ম</a></li>
                            <li class="divider"></li>
                            <li><a href="#">এডমিট ডাউনলোড</a></li>
                            <li class="divider"></li>
                            <li><a href="#">মেরিট লিস্ট</a></li>
                            <li class="divider"></li>
                            <li><a href="#">ওয়েটিং লিস্ট</a></li>
                            <li class="divider"></li>
                            
                     </ul>
                 </li>
                 <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">গ্যালারি<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/image/category')}}">ছবি</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('/video/category')}}">ভিডিও</a></li>
                            <li class="divider"></li>
                            
                            
                     </ul>
                 </li>

<!--                    <li class=""><a href="#">Notice</a></li>
                    <li class=""><a href="#">Events</a></li>
                    <li class=""><a href="#">Result</a></li>
			<li class=""><a href="#">ফলাফল</a></li>
            <li class=""><a href="{{url('birthday')}}">জন্মদিন</a></li>
						<!--<li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Archive<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Ex. Teacher List</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Ex. Student List</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Magazine</a></li>
                        </ul>
                    </li>-->
                    <li class="dropdown ">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">ছুটি<b class="caret"></b></a>
                           <ul class="dropdown-menu">
                               <li><a href="#">প্রতিষ্ঠানের ছুটির তালিকা</a></li>
                               <li class="divider"></li>
                               <li><a href="#">ছুটির জন্য আবেদন</a></li>
                               <li class="divider"></li>
                               
                               
                        </ul>
                    </li>
                    <li class=""><a href="{{url('#Conta')}}">যোগাযোগ</a></li>
                    <li class=""><a href="#">লগিন</a></li>
                </ul>
            </div>
        </div>
    </div>
	
<script language="JavaScript" src="{{ asset('/fontend/js/bootstrap_002.js')}}"></script>
</div>