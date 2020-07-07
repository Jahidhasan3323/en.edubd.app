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
                <a class="active-menu" href="{{url('/home')}}"><i class="fa fa-angle-double-up fa-3x"></i> Admin Panel</a>
            </li>


            @if(Auth::is('admin'))
                @if(isset($bg))
                @else
                 @php $bg=''; @endphp
                @endif

                <li class="@yield('language')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Language Date<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">


                        <li>
                            <a href="{{url('/date_language/create')}}">Add language date</a>
                        </li>
                        <li>
                            <a href="{{url('/date_language')}}">Language date list</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('slider')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Sliders<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">


                        <li>
                            <a href="{{url('/slider/create')}}">Add Slider</a>
                        </li>
                         <li>
                            <a href="{{url('/slider')}}">Slider List</a>
                        </li>
                    </ul>
                </li>
                 <li class="@yield('information')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Information<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">


                         <li>
                            <a href="{{url('/speech/create')}}">Add Speech</a>
                        </li>
                        <li>
                            <a href="{{url('/speech')}}">Speech list</a>
                        </li>
                        <li>
                            <a href="{{url('/general_text/create')}}">Add others information</a>
                        </li>
                        <li>
                            <a href="{{url('/general_text')}}">Other information list</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('gallery')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Gallery<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/gallery_category/create')}}">Add Gallery category</a>
                        </li>
                        <li>
                            <a href="{{url('/gallery_category')}}">Gallery category list</a>
                        </li>
                        <li>
                            <a href="{{url('/image_gallery/create')}}">Add Photo</a>
                        </li>
                        <li>
                            <a href="{{url('/image_gallery')}}">Photo list</a>
                        </li>
                        <li>
                            <a href="{{url('/video_gallery/create')}}">Add Video</a>
                        </li>
                        <li>
                            <a href="{{url('/video_gallery')}}">Video list</a>
                        </li>

                    </ul>
                </li>
                <li class="@yield('important_link')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Important links<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                      <li>
                            <a href="{{url('/important_links_category/create')}}">Add important link category</a>
                        </li>
                        <li>
                            <a href="{{url('/important_links_category')}}">Important link category liist</a>
                        </li>

                        <li>
                            <a href="{{url('/important_link/create')}}">Add important link</a>
                        </li>
                         <li>
                            <a href="{{url('/important_link')}}">Important link list</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('social_link') ">
                    <a href="{{url('social_link')}}" ><i class="fa fa-share-square-o fa-2x"></i>Social Media</span></a>
                    
                </li>
                 <li class="@yield('school_settings') ">
                    <a href="{{url('school_settings')}}" style="background:<?=$bg== 'active' ? '#4D4D4D' : ''?>"><i class="fa fa-gears fa-2x"></i>Settings</span></a>

                </li>
            @endif



        </ul>

    </div>

</nav>
