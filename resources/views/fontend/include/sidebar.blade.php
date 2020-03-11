<div class="col-md-3 right_con"><!-- Right Content Start-->
    
        <div class="panel panel-info" style="height:320px"> <!-- Notice Board Start-->
        <div class="panel-heading" style="background-color: #800040; color: #fff"><i class="fa fa-spinner fa-spin"></i> &nbsp; <strong>নোটিশ বোর্ড</strong></div>
        <div id="notice_slide_design">   
        <div class="owl-carousel owl-theme" id="notice_slide">
          <div class="item">
            <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                         <iframe src="https://bdjokers.com/school_alpha/storage/app/notice//file58050.pdf" width="200px" height="250px">
                        </iframe>
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="item">
            <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-success ">
                    
                    <div class="panel-body" style="padding: 15px 0 0 15px;">
                         <iframe src="https://bdjokers.com/school_alpha/storage/app/notice//file58050.pdf" width="200px" height="250px">
                        </iframe>
                        
                    </div>
                </div>
            </div>
          </div>
           
             

        </div>
    </div>
    </div>

            {{-- <iframe src="https://bdjokers.com/school_alpha/storage/app/notice//file58050.pdf" width="100%" height="250px">
                </iframe> --}}
      <div class="panel panel-info" style="height:320px"> <!-- Notice Board Start-->
        <div class="panel-heading" style="background-color: #800040; color: #fff"><i class="fa fa-spinner fa-spin"></i> &nbsp; <strong>নোটিশ বোর্ড</strong></div>
         <div class="panel-body">
            <marquee style="text-align: center;height:250px;" behavior="scroll" direction="up" scrollamount="4" onMouseOver="this.stop()" onMouseOut="this.start()"></marquee>
        </div>    </div>
    <div class="panel panel-info"><!-- Form Download Start-->
        <div class="panel-heading" style="background-color:#800040; color:#FFFFFF"><i class="fa fa-user"></i> &nbsp;<strong>লগিন</strong></div>
        <div class="panel-body">
        <div class="form-box" id="login-box">
            <form action="http://gphs1972.edu.bd/erp/?app=login" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="loginid" class="form-control" placeholder="ইউসার নেম"/>
                        <input type="hidden" name="login_type" class="form-control" value="student"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="পাসওয়ার্ড"/>
                    </div>          
              </div>
              <div>          <input name="submit" type="submit" value="লগিন"> <span style="color:#CC0000"></span><br>
                    </div>
            </form>

    </div></div>
    </div>
   
    
    <!--Public Result Start-->
        <div class="panel panel-info" id="pRes">
        <div class="panel-heading" style="background-color:#800040; color:#FFFFFF">
        <i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;<strong> ফলাফল</strong></div>
            <div class="panel-body">
                <div class="form-box" id="login-box" >
                    <form action="http://gphs1972.edu.bd/?app=home&amp;cmd=PulicResult" method="post">
                        <div class="body bg-gray">
                            <div class="form-group">
                                <select name='exam_list_id' id='exam_list_id'class="form-control" ><option value=''>select exam</option></select>                           </div>
                            <div class="form-group">
                                <select name='eduyear' id='eduyear' class="form-control"><option value=''>Year</option><option value='2019'>2019</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option></select>                            </div>          
                      </div>
                      <div>          <input name="submit" type="submit" value="সার্চ"><span style="color:#CC0000"></span> <br>
                            </div>
                    </form>
        
            </div>
        </div>
    </div>
    <!--Public Result End-->
    <div class="panel panel-info">
            <div class="panel-heading"  style="background-color:#800040; color:#FFFFFF"> <i class="fa fa-users"></i> <strong>স্টুডেন্ট সামারি</strong> </div>
             <div class="panel-body">
            <table width="100%" id="customers"><tr height=27>
        </tr><tr height=27>
           <td></td>
           <td width="14%" nowrap="nowrap"><i class="fa fa-user"></i> ছাত্র: </td>
           <td width="84%">1727</td>
        </tr><tr height=27>
           <td></td>
           <td width="14%" nowrap="nowrap"><i class="fa fa-user"></i> ছাত্রী : </td>
           <td width="84%">1372</td>
        </tr></table>           </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading"  style="background-color:#800040; color:#FFFFFF"> <i class="fa fa-image"></i> <strong>গ্যালারি</strong> </div>
            <div class="panel-body">
                  
              <div class="home-img">
                @for ($i=1; $i <=15 ; $i++)  
                <img src="{{ asset('/public/fontend/images/photo1.jpg')}}">
              @endfor
              </div>
            </div>
        </div>
   <!--Students Summary End-->
    
    
    <!--    <div class="panel panel-primary"><!-- Form Download Start-->
    <!--        <div class="panel-heading"><i class="fa fa-map-marker"></i> &nbsp Find Us With Google Map</div>-->
    <!--        <div class="panel-body">--><!--            <p>--><!--            --><!--            </p>-->
    <!--        </div>--><!--        --><!--    </div>-->
    
        <div class="panel panel-info" id="Class">
            <div class="panel-heading"  style="background-color:#800040; color:#FFFFFF"><i class="fa fa-clock-o"></i> &nbsp;<strong> শিক্ষা কার্যক্রম ও সময়সূচী</strong> </div>
             <div class="panel-body">
            <table width="100%" id="customers"><tr height=27>
         <td>দিবা শাখা ৬ষ্ট শ্রেণি হতে ১০ম শ্রেণি পর্যন্ত ।</td>
         <td>ক্লাস শুরু সকাল ১০: টা থেকে- 4:০০পর্যন্ত ।</td>
         </tr></table>          </div>
        </div>
            <div class="panel panel-info"><!-- IMPORTANT Link Start-->
        <div class="panel-heading"  style="background-color:#800040; color:#FFFFFF"><i class="fa fa-link"></i> &nbsp; <strong>গুরুত্বপূর্ণ লিঙ্ক</strong></div>
        <div class="panel-body">
        <span><i class="fa fa-external-link"></i> &nbsp;<a href="http://dhakaeducationboard.gov.bd/" target="black">Dhaka Board</a></span><br>
        <span><i class="fa fa-external-link"></i> &nbsp;<a href="http://jscresult.dinajpurboard.gov.bd/" target="black">JSC Result 2016</a> </span><br> 
        <span><i class="fa fa-external-link"></i> &nbsp;<a href="http://dperesult.teletalk.com.bd/dpe.php" target="black">PSC Result 2016</a> </span><br> 
        <span><i class="fa fa-external-link"></i> &nbsp;<a href="http://dhakaeducationboard.gov.bd/index.php/site/center_info" target="black">SSC Exam Center</a> </span><br> 
        <span><i class="fa fa-external-link"></i> &nbsp;<a href="#" target="black">Ministry of Education</a></span><br> 
        <span><i class="fa fa-external-link"></i> &nbsp;<a href="http://www.dshe.gov.bd/" target="black">Directorate Of Secondary and Higher Education</a> </span><br>
        <span><i class="fa fa-external-link"></i> &nbsp;<a href="#" target="black">Directorate Of Primary Education</a> </span><br> 
        <span><i class="fa fa-external-link"></i> &nbsp; <a href="http://www.bteb.gov.bd/" target="black">Technical Education Board</a> </span></div>
    </div>
     <!-- IMPORTANT Link End-->
    
</div>