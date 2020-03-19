@extends('backEnd.master')

@section('mainTitle', 'Timeline')
@section('post', 'active')
@section('head_section')
<link rel="stylesheet" type="text/css" href="{{asset('css/lightbox.css')}}">
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.4-rc1/css/foundation.css'>
 <link href="{{asset('/css/components.min.css')}}" rel="stylesheet" type="text/css">
 <!-- Core JS files -->
	
@endsection

@section('content')
		<div class="page-header">
        	@if(Session::has('errmgs'))
                @include('backEnd.includes.errors')
            @endif
            @if(Session::has('sccmgs'))
                @include('backEnd.includes.success')
            @endif
        </div>
	<div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">

        <div class="page-header">

            <h1 class="text-center text-temp">টাইম লাইন</h1>
            
        </div>

        
        <div class="panel-body">
        	<div class="row" style="background: #eee; padding: 3px 13px; margin-bottom: 24px;">
        		<form class="" action="{{url('post/create')}}" method="post" enctype="multipart/form-data">
        			{{csrf_field()}}
        		  <div class="form-group">
        		    <textarea name="message"></textarea>
        		  </div>
        		 	<input type="file" name="file" onchange="openFile(event)" accept="image/*">
        		 	<input type="file" name="file" onchange="openFile1(event)" accept="image/*">


        		 	<div class="col-sm-4">
                          <div>
                              <img id="header_background_logo" width="100px" height="120px" src="">
                          </div>
                       </div>
                       <div class="col-sm-4">
                          <div>
                              <img id="header_background_logo1" width="100px" height="120px" src="">
                          </div>
                       </div>
                       <p class="a">This is a paragraph.</p>
<p>This is another paragraph.</p>

<h1 class="abc">Clone all p elements, and append them to the body element</h1>
                       <script type="text/javascript">
                       	
                              var openFile = function(event) {
                              var input = event.target;
                              var reader = new FileReader();
                              reader.onload = function(){
                              var dataURL = reader.result;
                              var output = document.getElementById('header_background_logo');
                              output.src = dataURL;
                              };
                              reader.readAsDataURL(input.files[0]);
                              };
                              var openFile1 = function(event) {
                              var input = event.target;
                              var reader = new FileReader();
                              reader.onload = function(){
                              var dataURL = reader.result;
                              var output = document.getElementById('header_background_logo1');
                              output.src = dataURL;
                              };
                              reader.readAsDataURL(input.files[0]);
                              };
                          </script>
				  {{-- <div class="form-group row">
				  	<label class="col-lg-2 col-form-label font-weight-semibold">AJAX upload:</label>
				  	<div class="col-lg-10">
				  		<input type="file" class="file-input-ajax" multiple="multiple" data-fouc name="file[]">
				  		<span class="form-text text-muted">This scenario uses asynchronous/parallel uploads. Uploading itself is turned off in live preview.</span>
				  	</div>
				  </div> --}}
        		  
        		  <div>
        		  	
        		  	<button type="submit" class="btn btn-primary pull-right">POST</button>
        		  </div>
        		</form>
        	</div>
        	<div class="row">
        		<div class="user-section">
	        		<div class="col-md-12">
	        			<div class="col-md-8">
	        				<div class="image">
	        					<img src="https://upload.wikimedia.org/wikipedia/commons/6/67/User_Avatar.png" height="50px" width="50px" style="width: 50px !important">
	        				</div>
	        				<div class="text">
	        					<h6><b>Jhon Doe</b> , <span>সাঘাটা পাইলট উচ্চ বিদ্যালয়</span></h6>
	        					<p><span>ছাত্র </span> 2:10 am , 02-03-2020</p>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-md-12">
	        			<div class="post">
		        			<hr>
			        			<p >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			        			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			        			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			        			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			        			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			        			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			        			 {{-- <div class="post-image">
			        				<img src="{{Storage::url('social/s1.jpg')}}">
			        			</div> --}}
			        			{{-- <div class="post-image">
			        				<div class="row">
				        				<div class="col-md-6">
				        					<img width="100%" src="{{Storage::url('social/s1.jpg')}}">
				        				</div>
				        				<div class="col-md-6">
				        					<img  width="100%" src="{{Storage::url('social/s1.jpg')}}">
				        				</div>
				        			</div>
			        			</div> --}}
			        			{{-- <div class="post-image">
			        				<div class="row">
				        				<div class="col-md-12">
				        					<img style="margin-bottom: 20px" width="100%" height="300px" src="{{Storage::url('social/s1.jpg')}}">
				        				</div>
				        				<div class="col-md-6">
				        					<img width="100%" src="{{Storage::url('social/s1.jpg')}}">
				        				</div>
				        				<div class="col-md-6">
				        					<img  width="100%" src="{{Storage::url('social/s1.jpg')}}">
				        				</div>
				        			</div>
			        			</div> --}} 
			        			<div class="post-image" style="padding-top: 20px">
			        				<div class="row">
				        				<div class="col-md-6">
				        					{{-- <img width="100%" style="padding-bottom: 20px" src="{{Storage::url('social/s1.jpg')}}"> --}}
				        					<a class="example-image-link" href="{{Storage::url('social/s1.jpg')}}" data-lightbox="example-set" ><img style="width: 100%; margin-bottom: 20px" class="example-image" src="{{Storage::url('social/s1.jpg')}}" alt=""/></a>
				        				</div>
				        				<div class="col-md-6">
				        					<a class="example-image-link" href="{{Storage::url('social/s2.jpg')}}" data-lightbox="example-set" ><img style="width: 100%; margin-bottom: 20px" class="example-image" src="{{Storage::url('social/s2.jpg')}}" alt=""/></a>
				        				</div>
				        				<div class="col-md-6">
				        					<a class="example-image-link" href="{{Storage::url('social/s3.jpg')}}" data-lightbox="example-set" ><img style="width: 100%" class="example-image" src="{{Storage::url('social/s3.jpg')}}" alt=""/></a>
				        				</div>
				        				<div class="col-md-6">
				        					<a class="example-image-link" href="{{Storage::url('social/s4.jpg')}}" data-lightbox="example-set" ><img style="width: 100%" class="example-image" src="{{Storage::url('social/s4.jpg')}}" alt=""/></a>
				        				</div>
				        			</div>
				        		</div>
		        			<div  class="react-box" >
		        			<hr>
		        				<div class="col-md-4">
		        					<a href="#"><i class="fa fa-thumbs-o-up"></i> Like <span>100</span></a>
		        				</div>
		        				<div class="col-md-4">
		        					<a href="#"><i class="fa fa-heart-o"></i> Love <span>100</span></a>
		        				</div>
		        				<div class="col-md-4">
		        					<a href="#"><i class="fa fa-comment-o"></i> Comment <span>100</span></a>
		        				</div>
		        			<hr>
		        			</div>
		        		</div>
	        		</div>
        		</div>
        	</div>
        </div>
    </div>


@endsection
@section('script')

	<script src="{{asset('js/lightbox-plus-jquery.js')}}"></script>
    
	<script type="text/javascript">var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:1e3,fadeduration:[500,100]},controlHTML:'<img src="https://i1155.photobucket.com/albums/p559/scrolltotop/arrow23.png" />',controlattrs:{offsetx:5,offsety:5},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();</script>


	<script src="//cdn.ckeditor.com/4.14.0/basic/ckeditor.js"></script>
	<script>
        CKEDITOR.replace( 'message' );
    </script>
<script src="{{asset('js/jquery.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('js/uploaders/fileinput/plugins/purify.min.js')}}"></script>
	<script src="{{asset('js/uploaders/fileinput/plugins/sortable.min.js')}}"></script>
	<script src="{{asset('js/uploaders/fileinput/fileinput.min.js')}}"></script>

	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/uploader_bootstrap.js')}}"> </script>
	<script >
		$(document).ready(function(){
		  $("h1").click(function(){
		    $(".a").clone().appendTo("body");
		  });
		});
	</script>
@endsection
