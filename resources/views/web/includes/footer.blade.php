<footer class="main-footer style-two">
		
    <!-- Pattern Layer Four -->
    <div class="pattern-layer-four" style="background-image:url({{ asset('public/images/icons/icon-7.png') }})"></div>
    <div class="pattern-layer-five" style="background-image:url({{ asset('public/images/icons/icon-8.png') }})"></div>
    <div class="pattern-layer-six" style="background-image:url({{ asset('public/images/icons/icon-9.png') }})"></div>
    <div class="auto-container">
    
        <!-- Widgets Section -->
        <div class="widgets-section">
            <div class="row clearfix">
                
                <!-- Big Column -->
                <div class="big-column col-lg-12 col-md-12 col-sm-12">
                    <div class="row clearfix">
                        
                        <!--Footer Column-->
                        <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <div class="logo">
                                    <a href="{{ route('index') }}"><img src="{{ asset('public/assets/images/logo.svg') }}" alt="" /></a>
                                </div>
                                <div class="text">Established in 2017, Street English Academy is a leading educational institution that provides English-language courses with reasonable prices and high-quality services</div>
                                <div class="social-box">
                                    <a href="https://wa.me/00201142875788" target="_blank"><img src="{{ asset('public/assets/images/social-media/whatsapp.svg') }}" alt=""></a>
                                    <a href="https://www.facebook.com/Street.English.Academy" target="_blank"><img src="{{ asset('public/assets/images/social-media/facebook.svg') }}" alt=""></a>
                                    <a href="https://www.youtube.com/c/StreetEnglishAcademy" target="_blank"><img src="{{ asset('public/assets/images/social-media/youtube.svg') }}" alt=""></a>
                                    <a href="https://www.tiktok.com/@ismailarafa0?lang=en" target="_blank"><img src="{{ asset('public/assets/images/social-media/tiktok.svg') }}" alt=""></a>
                                    <a href="https://www.instagram.com/ismail_arafa999" target="_blank"><img src="{{ asset('public/assets/images/social-media/insta.svg') }}" alt=""></a>
                                    <a href="https://www.linkedin.com/company/street-english-academy" target="_blank"><img src="{{ asset('public/assets/images/social-media/linked-in.svg') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        
                        <!--Footer Column-->
                        <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4>Pages</h4>
                                <ul class="links-widget">
                                    <li><a href="{{ route('courses') }}">Recorded Courses</a></li>
                                    <li><a href="{{ route('free-ebooks') }}">Materials</a></li>
                                    <li><a href="{{ route('blogs') }}">Blogs</a></li>
                                    <li><a href="{{ route('certificates') }}">Certificates</a></li>
                                </ul>
                            </div>
                        </div>
                        
                         <!--Footer Column-->   
                         <div class="footer-column col-lg-4 col-md-12 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4>Resource</h4>
                                <ul class="links-widget">
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
               
                
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom text-center">
            <div class="copyright">Copyright &copy; {{ date("Y") }} {{ config('app.name') }}</div>
            <div> By <a href="https://github.com/abdullahessamm" target="__blank"> Abdullah Essam </a> </div>
        </div>
        
    </div>
</footer>