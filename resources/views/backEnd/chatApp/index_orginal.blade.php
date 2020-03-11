@extends('backEnd.master')

@section('mainTitle', 'Chat')
@section('question', 'active')
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
	<div class="main-wrapper">
		
		<div class="right-content">
			<div class="left-sidebar" >

				<div class="chat-header">
	                <div class="chat-header-user">
	                    <figure class="avatar">
	                        <a href="#" class="profile-detail-bttn"><img src="{{asset('backEnd/images/user-7.png')}}" class="rounded-circle" alt="image"></a>
	                    </figure>
	                    <div>
	                        <h5 class="mt-0 mb-0">James Henry</h5>
	                        <small class="text-success">james43@gmail.com</small>
	                    </div>
	                </div>
	                
	            </div>

				<div class="sidebar active" id="chats">
		          
					<div class="form-content">
						<form action="#" class="mb-3 mt-3">
		                    <input type="text" class="form-control" placeholder="Type name to find contact">
		                </form>
	                </div>
	                <div class="text-left mb-1 mt-0">
	                	<div class="chat-header-action nav-content">
	                	    <ul class="list-inline mb-1 mt-3" style=" margin-left: 0px; ">
	                	    	<li class="list-inline-item mr-3 title-text"><b>Contacts</b> </li>
	                	    	
	                	    	<li class="list-inline-item mr-3 title-text text-right" style="margin-right: 0 !important;padding-right: 5px;padding-left: 0px; "><a title="block user" href="#" style="padding-left: 25px" class="nav-content-bttn" data-tab="settings"><i style="color: #fff;" class="fa fa-eye-slash"></i></a></li>
	                	    </ul>
	                	</div>
	                </div>
	                <div class="chat-list-content">
	                	<ul class="chat-list">
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-2.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">Hurin Seary</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <div class="message-count bg-primary">3</div>
	                                    <small class="text-primary">03:41 PM</small>
	                                </div>
	                            </div>
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-6.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">Victor Exrixon</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <div class="message-count bg-primary">3</div>
	                                    <small class="text-primary">03:41 PM</small>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-5.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">Surfiya Zakir</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <div class="message-count bg-primary">1</div>
	                                    <small class="text-primary">Yesterday</small>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-8.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">John Ive</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-9.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">Goria Coast</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                		</li>

	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-3.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">John Ive</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-2.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">Goria Coast</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-8.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">John Ive</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-9.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">Goria Coast</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                		</li>

	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-3.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">John Ive</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-2.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-0 mt-2">Goria Coast</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <small>03:41 PM</small>
	                                </div>
	                            </div>
	                		</li>
	                	</ul>
	                </div>
				</div>
				
				<div class="sidebar" id="settings">
					<div class="form-content">
						<form action="#" class="mb-3 mt-1">
				            <input type="text" class="form-control" placeholder="Type name to find contact">
				        </form>
				    </div>
					<div class="text-left mb-2 mt-3">
						<ul class="list-inline mb-1 mt-3" style=" margin-left: 0px; ">
							<li class="list-inline-item mr-3 title-text"><b>Block</b> User</li>
							
							<li class="list-inline-item mr-3 title-text text-right" style="margin-right: 0 !important;padding-right: 5px;padding-left: 0px; "><a title="block user" href="#" style="padding-left: 25px" class="nav-content-bttn" data-tab="chats"><i style="color: #fff;" class="fa fa-comment"></i></a></li>
						</ul>
					</div>
					
				     <div class="chat-list-content">
	                	<ul class="chat-list">
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-2.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Hurin Seary</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item" id="addfriend-bttn">Add friend</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <span class="avatar-title bg-primary rounded-circle">M</span>
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Victor Exrixon</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-3.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Surfiya Zakir</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <span class="avatar-title bg-info rounded-circle">J</span>
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">John Ive</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <span class="avatar-title bg-warning rounded-circle">G</span>
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Goria Coast</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-4.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Hurin Seary</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-5.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Victor Exrixon</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <span class="avatar-title bg-danger rounded-circle">V</span>
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Surfiya Zakir</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-6.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">John Ive</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                		<li class="chat-list-item">
	                			<figure class="avatar user-online">
	                                <img src="{{asset('backEnd/images/user-8.png')}}" alt="image">
	                            </figure>
	                            <div class="list-body">
	                            	<div class="chat-bttn">
	                                    <h3 class="mb-1 mt-1">Goria Coast</h3>
	                                    <p>What's up, how are you?</p>
	                                </div>
	                                <div class="list-action mt-2 text-right">
	                                    <a href="#" class="btn-plus dropdown-toggle" data-toggle="dropdown"><i class="ti-plus"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="#" class="dropdown-item">Open</a>
											<a href="#" class="dropdown-item">Restore</a>
											<div class="dropdown-divider"></div>
											<a href="#" class="dropdown-item text-danger">Delete</a>
										</div>
	                                </div>
	                            </div>
	                            
	                		</li>
	                	</ul>
	                </div>
				</div>

			</div>

			<div class="chat-content">
				<!-- chat header -->
				<div class="chat-header">
	                <div class="chat-header-user">
	                    <figure class="avatar">
	                        <img src="{{asset('backEnd/images/user-9.png')}}" class="rounded-circle" alt="image">
	                    </figure>
	                    <div>
	                        <h5 class="mt-2 mb-0">Alice Maghyn</h5>
	                        <small class="text-success">Typing....</small>
	                    </div>
	                </div>
	                <div class="chat-header-action">
	                    <ul class="list-inline mb-0 mt-2">
	                        <li class="list-inline-item not-mobile"><a href="#" class="bttn-box-round"><i class="ti-microphone"></i></a></li>
	                        <li class="list-inline-item not-mobile"><a href="#" class="bttn-box-round" id="videocall-bttn"><i class="ti-video-camera"></i></a></li>
	                        <li class="list-inline-item d-xl-none d-lg-none"><a href="#" class="bttn-box-round back-chat-div"><i class="ti-arrow-left"></i></a></li>
	                        <li class="list-inline-item">
		                        <a href="#" class="bttn-box-round" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
		                        <div class="dropdown-menu dropdown-menu-right">
									<a href="#" class="dropdown-item profile-detail-bttn">Profile</a>
									<a href="#" class="dropdown-item">Add to archived</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item text-danger">Block</a>
								</div>
							</li>
	                    </ul>
	                </div>
	            </div>
				<!-- chat header -->
				<!-- chat body -->
				<div class="chat-body" style="overflow: hidden;outline: none;">
					<div class="messages-content">
						<div class="message-item">
	                        <div class="message-user">
	                            <figure class="avatar">
	                                <img src="{{asset('backEnd/images/user-9.png')}}" alt="image">
	                            </figure>
	                            <div>
	                                <h5>Byrom Guittet</h5>
	                                <div class="time">01:35 PM</div>
	                            </div>
	                        </div>
	                        <div class="message-wrap">I'm fine, how are you 😃</div>
	                    </div>

	                    <div class="message-item outgoing-message">
	                        <div class="message-user">
	                            <figure class="avatar">
	                                <img src="{{asset('backEnd/images/user-1.png')}}" alt="image">
	                            </figure>
	                            <div>
	                                <h5>Byrom Guittet</h5>
	                                <div class="time">01:35 PM<i class="ti-double-check text-info"></i></div>
	                            </div>
	                        </div>
	                        <div class="message-wrap">I want those files for you. I want you to send 1 PDF and 1 image file.</div>
	                    </div>

	                    <div class="message-item">
	                        <div class="message-user">
	                            <figure class="avatar">
	                                <img src="{{asset('backEnd/images/user-9.png')}}" alt="image">
	                            </figure>
	                            <div>
	                                <h5>Byrom Guittet</h5>
	                                <div class="time">01:35 PM</div>
	                            </div>
	                        </div>
	                        <div class="message-wrap">I've found some cool photos for our travel app.</div>
	                    </div>

	                    <div class="message-item outgoing-message">
	                        <div class="message-user">
	                            <figure class="avatar">
	                                <img src="{{asset('backEnd/images/user-1.png')}}" alt="image">
	                            </figure>
	                            <div>
	                                <h5>Byrom Guittet</h5>
	                                <div class="time">01:35 PM<i class="ti-double-check text-info"></i></div>
	                            </div>
	                        </div>
	                        <div class="message-wrap">Hey mate! How are things going ?</div>
	                    </div>

	                    <div class="message-item">
	                        <div class="message-user">
	                            <figure class="avatar">
	                                <img src="{{asset('backEnd/images/user-9.png')}}" alt="image">
	                            </figure>
	                            <div>
	                                <h5>Byrom Guittet</h5>
	                                <div class="time">01:35 PM</div>
	                            </div>
	                        </div>
	                        <figure>
	                            <img src="{{asset('backEnd/images/chat-image1.jpg')}}" class="w-75 img-fluid rounded" alt="image">
	                        </figure>
	                        
                        
	                    </div>

	                    <div class="message-item outgoing-message">
	                        <div class="message-user">
	                            <figure class="avatar">
	                                <img src="{{asset('backEnd/images/user-1.png')}}" alt="image">
	                            </figure>
	                            <div>
	                                <h5>Byrom Guittet</h5>
	                                <div class="time">01:35 PM<i class="ti-double-check text-info"></i></div>
	                            </div>
	                        </div>
	                        <div class="message-wrap">Hey mate! How are things going ?</div>
	                    </div>


					</div>
				</div>
				<!-- chat body -->
				<!-- chat footer -->
				<div class="chat-footer">
					<form action="#">
						<input type="text" placeholder="Message Alice Maghyn..">
						<button><img src="{{asset('backEnd/images/send.png')}}" alt="send"></button>
					</form>
				</div>
				<!-- chat footer -->
			</div>	

			<div class="right-sidebar" style="overflow: hidden;outline: none;">
				<div class="profile-content scroll-profile">
					<header>
						<h2 class="title-text">Profile</h2>
						<a href="#" class="close-icon float-right"><i class="ti-close  text-danger"></i></a>
					</header>
					<div class="text-center mt-4">
                        <figure class="avatar avatar-xl mb-4">
                            <img src="{{asset('backEnd/images/user-10.png')}}" class="rounded-circle" alt="image">
                        </figure>
                        <h5 class="mb-0">James Henry</h5>
                        <small class="text-success">james43@gmail.com</small>

                       	<ul class="social-link list-inline mt-3">
                       		<li class="list-inline-item"><a href="#"><i class="ti-facebook bg-facebook"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="ti-twitter-alt bg-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="ti-google bg-google"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="ti-pinterest bg-pinterest"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="ti-linkedin bg-linkedIn"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="ti-github bg-github"></i></a></li>
                       	</ul>

                       	<ul class="profile-detail list-inline pt-5">
                       		<li class="list-block-item text-left">
                       			<h6 class="mb-0">Website</h6>
                       			<small>www.wpvisual.com</small>
                       		</li>
                       		<li class="list-block-item text-left">
                       			<h6 class="mb-0">Phone</h6>
                       			<small>+111 990 332 2223</small>
                       		</li>
                       		<li class="list-block-item text-left">
                       			<h6 class="mb-0">City</h6>
                       			<small>Autria</small>
                       		</li>
                       		<li class="list-block-item text-left">
                       			<h6 class="mb-0">Get notification</h6>
                       			<small>Allow connected contacts</small>
								<div class="switch-box float-right">
									<label class="switch float-right mb-0" for="checkbox5">
									    <input type="checkbox" id="checkbox5">
									    <span class="slider round"></span>
									</label>
								</div>
                       		</li>
                       	</ul>
                    </div>
				</div>
			
			</div>			
		</div>

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