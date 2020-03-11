<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu" style="">
            <li class="text-center" style="">
                <a href="
                    @if(Auth::is('admin'))
                    {{url('/schoolProfile')}}

                    @elseif(Auth::is('teacher'))
                    {{url('/teacherProfile')}}

                    @elseif(Auth::is('student'))
                    {{url('/studentProfile')}}
                    @else
                    {{url('/home')}}
                    @endif
                    "><img style="max-width: 100%; " src="{{Storage::url($photo)}}" class="user-image img-responsive"/>
                </a>
            </li>

            <li>
                <a class="active-menu" href="{{url('/home')}}"><i class="fa fa-angle-double-up fa-3x"></i> এডমিন প্যানেল</a>
            </li>
           
            
            @if(Auth::is('admin'))
                @if(isset($bg))
                @else
                 @php $bg=''; @endphp
                @endif
               
                <li class="@yield('language')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>ভাষার তারিখ<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      
                        
                        <li>
                            <a href="{{url('/date_language/create')}}">ভাষার তারিখ যোগ করুন</a>
                        </li>
                        <li>
                            <a href="{{url('/date_language')}}">ভাষার তারিখের তালিকা</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('slider')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>স্লাইডার<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      
                        
                        <li>
                            <a href="{{url('/slider/create')}}">স্লাইডার যোগ করুন</a>
                        </li>
                         <li>
                            <a href="{{url('/slider')}}">স্লাইডার তালিকা</a>
                        </li>
                    </ul>
                </li>
                 <li class="@yield('information')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>তথ্য<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      
                        
                         <li>
                            <a href="{{url('/speech/create')}}">বাণী যোগ করুন</a>
                        </li>
                        <li>
                            <a href="{{url('/speech')}}">বাণীর তালিকা</a>
                        </li>
                        <li>
                            <a href="{{url('/general_text/create')}}">অন্যান্য তথ্য যোগ করুন</a>
                        </li>
                        <li>
                            <a href="{{url('/general_text')}}">অন্যান্য তথ্যর তালিকা</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('gallery')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>গ্যালারি<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/gallery_category/create')}}">গ্যালারি ক্যাটাগরি যোগ করুন</a>
                        </li>
                        <li>
                            <a href="{{url('/gallery_category')}}">গ্যালারি ক্যাটাগরি তালিকা</a>
                        </li>
                        <li>
                            <a href="{{url('/image_gallery/create')}}">ছবি যোগ করুন</a>
                        </li>
                        <li>
                            <a href="{{url('/image_gallery')}}">ছবির তালিকা</a>
                        </li>
                        <li>
                            <a href="{{url('/video_gallery/create')}}">ভিডিও যোগ করুন</a>
                        </li>
                        <li>
                            <a href="{{url('/video_gallery')}}">ভিডিওর তালিকা</a>
                        </li>

                    </ul>
                </li>
                <li class="@yield('important_link')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>গুরুত্বপূর্ণ লিঙ্ক<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      
                      <li>
                            <a href="{{url('/important_links_category/create')}}">গুরুত্বপূর্ণ লিঙ্ক ক্যাটাগরি যোগ করুন</a>
                        </li>
                        <li>
                            <a href="{{url('/important_links_category')}}">গুরুত্বপূর্ণ লিঙ্ক ক্যাটাগরি তালিকা</a>
                        </li>
                        
                        <li>
                            <a href="{{url('/important_link/create')}}">গুরুত্বপূর্ণ লিঙ্ক যোগ করুন</a>
                        </li>
                         <li>
                            <a href="{{url('/important_link')}}">গুরুত্বপূর্ণ লিঙ্কের তালিকা</a>
                        </li>
                    </ul>
                </li>
                 <li class="@yield('school_settings') ">
                    <a href="{{url('school_settings')}}" style="background:<?=$bg== 'active' ? '#4D4D4D' : ''?>"><i class="fa fa-gears fa-2x"></i>সেটিং</span></a>
                    
                </li>
            @endif

        

        </ul>

    </div>

</nav>