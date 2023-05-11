<div class="header-top">
    <div class="auto-container">
        <div class="clearfix">
        
            <!-- Top Left -->
            <div class="top-left pull-left clearfix">
            
                <!-- Info List -->
                <ul class="info-list">
                    <li class="mx-0 px-0"><a href="https://wa.me/00201142875788" target="_blank"><img src="{{ asset('public/assets/images/social-media/whatsapp.svg') }}" alt=""></a></li>
                    <li class="mx-0 px-0"><a href="https://www.facebook.com/Street.English.Academy" target="_blank"><img src="{{ asset('public/assets/images/social-media/facebook.svg') }}" alt=""></a></li>
                    <li class="mx-0 px-0"><a href="https://www.youtube.com/c/StreetEnglishAcademy" target="_blank"><img src="{{ asset('public/assets/images/social-media/youtube.svg') }}" alt=""></a></li>
                    <li class="mx-0 px-0"><a href="https://www.tiktok.com/@ismailarafa0?lang=en" target="_blank"><img src="{{ asset('public/assets/images/social-media/tiktok.svg') }}" alt=""></a></li>
                    <li class="mx-0 px-0"><a href="https://www.instagram.com/ismail_arafa999" target="_blank"><img src="{{ asset('public/assets/images/social-media/insta.svg') }}" alt=""></a></li>
                    <li class="mx-0 px-0"><a href="https://www.linkedin.com/company/street-english-academy" target="_blank"><img src="{{ asset('public/assets/images/social-media/linked-in.svg') }}" alt=""></a></li>
                    <li class="mx-0 px-0"><a href="#"><img src="{{ asset('public/assets/images/social-media/website.svg') }}" alt=""></a></li>
                    <li class="mx-0 px-0"><img src="{{ asset('public/assets/images/social-media/call-us.svg') }}" alt=""><span style="color: #1E284B;" class="font-weight-bold">01142875788</span></li>
                </ul>
                
            </div>
            
            <!-- Top Right -->
            <div class="top-right pull-right clearfix">
                <!-- Login Nav -->
                <ul class="login-nav">
                    @if(Auth::check())
                    <li><a href="{{ route('student.home') }}">Welcome, {{ Auth::user()->name }}</a></li>
                    <li>
                        <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ft-power"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @elseif(Auth::guard('coach')->check())
                    <li><a href="{{ route('coach.home') }}">Welcome, {{ Auth::guard('coach')->user()->name }}</a></li>
                    @elseif(Auth::guard('ielts_user')->check())
                    <li><a href="{{ route('ielts-user.home') }}">Welcome, {{ Auth::guard('ielts_user')->user()->name }}</a></li>
                    <li>
                        <a href="{{ route('ielts-user.logout') }}"
                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('ielts-user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @elseif(Auth::guard('live_course_user')->check())
                    <li><a href="{{ route('live-course-user.home') }}">Welcome, {{ Auth::guard('live_course_user')->user()->name }}</a></li>
                    <li>
                        <a href="{{ route('live-course-user.logout') }}"
                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('live-course-user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @else
                    <li><a class="register" href="{{ route('register') }}">Sign Up</a></li>
                    <li><a class="login" href="{{ route('login') }}">Login</a></li>
                    <li><a class="login" href="{{ route('live-course-user.login') }}">Zoom Login</a></li>
                    <li><a class="login" href="{{ route('ielts-user.login') }}">IELTS Login</a></li>
                    <li><a href="{{ route('work-with-us') }}">Work With Us</a></li>
                    @endif
                </ul>
            </div>
            
        </div>
    </div>
</div>