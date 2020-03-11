
<!DOCTYPE html>
<!--Head Start-->
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="images/logo.png">
	
<link rel="stylesheet" href="{{ asset('/fontend/css/font-awesome.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('/fontend/css/css.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('/fontend/css/bootstrap_002.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('/fontend/css/bootstrap.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('/fontend/css/owl.carousel.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('/fontend/css/owl.theme.default.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{ asset('/fontend/css/style.css')}}" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" type="text/css">

<script language="JavaScript" src="{{ asset('/fontend/js/bootstrap.js')}}"></script>
<script language="JavaScript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script language="JavaScript" src="{{ asset('/fontend/js/owl.carousel.min.js')}}"></script>

  <style >
      #notice_slide_design .owl-carousel .owl-nav button.owl-next, #notice_slide_design .owl-carousel .owl-nav button.owl-prev, #notice_slide_design .owl-carousel button.owl-dot {
    background: rgba(0,0,0,.5);
    color: inherit;
    border: none;
    padding: 0 12px 12px 12px !important;
    font: inherit;
    font-size: 44px;
    color: #fff;
    position: relative;
    top: -200PX;
}
#notice_slide_design .owl-prev {
    left: -95px;
}
#notice_slide_design .owl-next {
    left: 95px;
}
#notice_slide_design .owl-theme .owl-nav {
    margin-top: 0;
    padding: 0;
    margin-bottom: -80px;
}
.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 100;
}
#customers
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#customers td, #customers th 
{
font-size:14px;
border:1px solid #98bf21;
padding:3px 7px 2px 7px;
}
#customers th 
{
font-size:14px;
text-align:center;
padding-top:5px;
padding-bottom:4px;
background-color:#A7C942;
color:#fff;
}
#customers tr.alt td 
{

background-color:#EAF2D3;
}
  </style>

@yield('css')
	
	
	

</head>
<!--Head End-->


<body class="sticky" style="background: url('{{asset("fontend/images/background.jpg")}}')" >
<div class="main ">
<!-- Main Start-->
<!-- Header Start-->
@include('fontend.include.header')

<!-- Slide Show End-->
<!-- Scrool News End-->
<div class="main_con "><!--Content Start-->
    <div class="row">
        @yield('mainContent')
	<!-- Right Content Start-->

        @include('fontend.include.sidebar')
		<!-- Right Content End-->  
  
</div>
</div><!--Content End--><style>
    .modal-dialog {}
    .thumbnail {margin-bottom:6px;}

    .carousel-control.left,.carousel-control.right{
        background-image:none;
    }
</style>
<script>
    /* copy loaded thumbnails into carousel */
    $('.row .thumbnail').on('load', function() {

    }).each(function(i) {
        if(this.complete) {
            var item = $('<div class="item"></div>');
            var itemDiv = $(this).parents('div');
            var title = $(this).parent('a').attr("title");

            item.attr("title",title);
            $(itemDiv.html()).appendTo(item);
            item.appendTo('.carousel-inner');
            if (i==0){ // set first item active
                item.addClass('active');
            }
        }
    });

    /* activate the carousel */
    $('#modalCarousel').carousel({interval:false});

    /* change modal title when slide changes */
    $('#modalCarousel').on('slid.bs.carousel', function () {
        $('.modal-title').html($(this).find('.active').attr("title"));
    })

    /* when clicking a thumbnail */
    $('.row .thumbnail').click(function(){
        var idx = $(this).parents('div').index();
        var id = parseInt(idx);
        $('#myModal').modal('show'); // show the modal
        $('#modalCarousel').carousel(id); // slide carousel to selected

    });

</script>
@include('fontend.include.footer')
@yield('js')
<script type="text/javascript">
var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:1e3,fadeduration:[500,100]},controlHTML:'<img src="https://i1155.photobucket.com/albums/p559/scrolltotop/arrow8.png" />',controlattrs:{offsetx:5,offsety:5},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();</script>

<script >
    $(document).ready(function() {
      var owl = $('#notice_slide');
      owl.owlCarousel({
       loop:true,
           margin:10,
           nav:true,
           dots:false,
           autoplay:false,
           responsive:{
               0:{
                   items:1
               },
               600:{
                   items:1
               },
               1000:{
                   items:1
               }
           }
      })
    })
  </script>

<!--Footer End -->
</div><!-- Main Stop-->

</body>

</html>