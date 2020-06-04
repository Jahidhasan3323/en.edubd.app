@extends('backEnd.master')

@section('mainTitle', 'Chat')
@section('chat', 'active')
@section('style')
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backEnd')}}/chatapp/themify-icons.css">

<link rel="stylesheet" href="{{asset('backEnd')}}/chatapp/main.min.css" type='text/css'/>
@endsection
@section('head_section')

@endsection

@section('content')
<style>
	#page-wrapper{
		background: #1A2236;
	}
	p{
		padding-top: 0;
	}
	.chat-bttn{
		margin-top: -9px;
	}
	.list-inline > li {
	display: contents;

	}
	#chats {
		max-height: 1000px;
		overflow: scroll;
		width: 100%;
	}
</style>
	<div class="dark">
	<!-- page tour modal -->

	<!-- page tour modal -->







	<!-- main wrapper -->
	<div class="main-wrapper" id="app">
		<chat-app :user="{{auth()->user()}}"></chat-app>
	</div>
	<!-- main wrapper -->


@endsection
@section('script')

	<script src="{{asset('backEnd')}}/chatapp/plugin.js"></script>
	<script src="{{asset('backEnd')}}/chatapp/main.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
	<script >
		$(document).ready(function(){
		$('#action_menu_btn').click(function(){
			$('.action_menu').toggle();
		});
			});
	</script>

@endsection