@extends('web.layouts.app', [
    'scripts' => 'index',
])

@section('content')
<!-- Slider Section Two -->
<section class="slider-section-two">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-1.png') }})"></div>
	<div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-2.png') }})"></div>
    <!-- Pattern Layer -->
    <div class="main-slider-carousel owl-carousel owl-theme" style="margin-top: -80px;">
        <div class="slide">
            <div class="auto-container">
                <div class="row clearfix">
                    <!-- Content Column -->
                    <div class="content-column col-lg-7 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <h1>Get your Online English Course Now</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li class="text font-weight-bold mb-0 pb-0" style="color: #1E284B;">
                                            <img src="{{ asset('public/assets/images/main-slider/hero-icons/watch-the-videos-anytime.svg') }}" style="width: 10%" class="img-fluid float-left mr-1" alt="">
                                            Watch the videos anytime
                                        </li>
                                        <li class="text font-weight-bold mb-0 pb-0" style="color: #1E284B;">
                                            <img src="{{ asset('public/assets/images/main-slider/hero-icons/learn-from-your-comfort-zone.svg') }}" style="width: 10%" class="img-fluid float-left mr-1" alt="">
                                            Learn from your comfort zone
                                        </li>
                                        <li class="text font-weight-bold mb-0 pb-0" style="color: #1E284B;">
                                            <img src="{{ asset('public/assets/images/main-slider/hero-icons/money-back.svg') }}" style="width: 10%" class="img-fluid float-left mr-1" alt="">
                                            Money-back guarantee
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li class="text font-weight-bold mb-0 pb-0" style="color: #1E284B;">
                                            <img src="{{ asset('public/assets/images/main-slider/hero-icons/create-your-schedule.svg') }}" style="width: 10%" class="img-fluid float-left mr-1" alt="">
                                            Create your own schedule
                                        </li>
                                        
                                        <li class="text font-weight-bold mb-0 pb-0" style="color: #1E284B;">
                                            <img src="{{ asset('public/assets/images/main-slider/hero-icons/private-1to1.svg') }}" style="width: 10%" class="img-fluid float-left mr-1" alt="">
                                            Private 1-to-1 instructor
                                        </li>
                                        <li class="text font-weight-bold mb-0 pb-0" style="color: #1E284B;">
                                            <img src="{{ asset('public/assets/images/main-slider/hero-icons/group-of-5-learners.svg') }}" style="width: 10%" class="img-fluid float-left mr-1" alt="">
                                            Groups of ONLY 5 learners
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="text font-weight-bold" style="color: #1E284B;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour or randomisedable.</div> --}}
                            <div class="btns-box mt-5">
                                <a href="{{ route('courses') }}" class="theme-btn btn-style-four"><span class="txt">Recored Courses</span></a>
                                <a href="{{ route('zoom-live-courses') }}" class="theme-btn btn-style-five"><span class="txt">Live Zoom Courses</span></a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Column -->
                    <div class="image-column col-lg-5 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="image">
                                {{-- <video controls>
                                    <source src="{{ asset('public/intro.mp4') }}" type="video/mp4">
                                  Your browser does not support the video tag.
                                </video> --}}
                                {{-- <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                                </div> --}}
                                <img src="{{ asset('public/assets/images/main-slider/content-image-2.svg') }}" class="mt-5" alt="" />
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        {{-- <div class="slide">
            <div class="auto-container">
                <div class="row clearfix">
                            
                    <!-- Content Column -->
                    <div class="content-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <h1>To keep a customer demands as much skill as to win one.</h1>
                            <div class="text font-weight-bold" style="color: #1E284B;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour or randomisedable.</div>
                            <div class="btns-box">
                                <a href="course.html" class="theme-btn btn-style-four"><span class="txt">Get Stared</span></a>
                                <a href="course.html" class="theme-btn btn-style-five"><span class="txt">All Courses</span></a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Column -->
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="image">
                                <img src="{{ asset('public/assets/images/main-slider/content-image-2.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="slide">
            <div class="auto-container">
                <div class="row clearfix">
                            
                    <!-- Content Column -->
                    <div class="content-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <h1>To keep a customer demands as much skill as to win one.</h1>
                            <div class="text font-weight-bold" style="color: #1E284B;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour or randomisedable.</div>
                            <div class="btns-box">
                                <a href="course.html" class="theme-btn btn-style-four"><span class="txt">Get Stared</span></a>
                                <a href="course.html" class="theme-btn btn-style-five"><span class="txt">All Courses</span></a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Column -->
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="image">
                                <img src="{{ asset('public/assets/images/main-slider/content-image-2.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> --}}
    </div>
</section>
<!-- End Banner Section -->

<!-- Title Section -->
<section class="title-section mt-0 pt-0">
    <div class="pattern-layer" style="background-image:url({{ asset('public/assets/images/icons/icon-4.png') }})"></div>
    <div class="auto-container">
        <div class="row justify-content-center">
            
            <!-- Title Column -->
            <div class="title-column col-lg-8 col-md-12 col-sm-12 text-center">
                <!-- Sec Title -->
                <div class="sec-title style-two">
                    <h2>Welcome to Street English Academy</h2>
                    <div class="text font-weight-bold" style="color: #1E284B;">Our Community will help you develop your English-language skills as quickly as possible. Thanks to our uniquely designed courses, we guarantee that your English level will progress with us. Your success is our responsibility our courses.</div>
                    {{-- <h2>Our quality curriculum is designed with top-tier industry partners, not academics, so you learn the high-impact skills that top companies want.</h2>
                    <div class="text font-weight-bold" style="color: #1E284B;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour or randomisedable. There are many variations of passages of Lorem Ipsum.</div> --}}
                </div>
                <div class="btns-box mt-5">
                    <a href="{{ route('about') }}" class="theme-btn btn-style-four"><span class="txt">About Us</span></a>
                    <a href="#" class="theme-btn btn-style-five"><span class="txt">Placement Test</span></a>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- End Title Section -->

<!-- Education Section Three -->
<section class="education-section-three mb-0 pb-0">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Image Column -->
            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column text-center">
                    <video playsinline autoplay style="width: 100%; height: auto;">
                        <source src="{{ asset('public/intro.mp4') }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    {{-- <div class="image title" data-tilt data-tilt-max="4">
                        <a href="{{ asset('public/assets/images/resource/education-2.jpg') }}" data-fancybox="education-2" data-caption="" class="">
                            <img src="{{ asset('public/assets/images/resource/education-2.jpg') }}" alt="" />
                        </a>
                    </div> --}}
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                
                <h2 style="color: #18a674;" class="mt-5">Get to know how this <br> website works</h2>
            </div>
            
        </div>
    </div>
</section>
<!-- End Education Section Three -->

<!-- Project Section -->
<section class="project-section mt-5 pt-0">
    <!-- Pattern Layer -->
    <div class="pattern-layer" style="background-image:url({{ asset('public/assets/images/icons/icon-5.png') }})"></div>
    <div class="pattern-layer-two" style="background-image:url({{ asset('public/assets/images/icons/dotted-layer-1.png') }})"></div>
    <div class="auto-container">
        
        <!-- Sec Title -->
        <div class="sec-title style-two centered">
			<h2>Most Popular Courses</h2>
        </div>
        
        <div class="auto-container">
            <div class="sec-title style-two centered">
            </div>
            
            <div class="row clearfix">
            @if($popularCourses->count() > 0)
                @foreach ($popularCourses as $popularCourse)
                <!-- Cource Block Two -->
                <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="{{ route('course.show', $popularCourse->belongsToCourse->slug) }}">
                                <img src="{{ asset('public/assets/images/courses/'.$popularCourse->course_id.'/'.$popularCourse->belongsToCourse->thumbnail) }}" alt="" />
                            </a>
                        </div>
                        <div class="lower-content">
                            <h5><a href="{{ route('course.show', $popularCourse->belongsToCourse->slug) }}">{{ $popularCourse->belongsToCourse->name }}</a></h5>
                            {{-- <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div> --}}
                            <div class="clearfix">
                                <div class="pull-left">
                                    <div class="students">{{ $popularCourse->belongsToCourse->lessons->count() }} {{ $popularCourse->belongsToCourse->lessons->count() == 1 ? 'Lesson' : 'Lessons' }}</div>
                                </div>
                                <div class="pull-right">
                                    <div class="students">{{ $popularCourse->belongsToCourse->price }} EGP</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="jumbotron text-center">
                        <h3>No Online Course Found</h3>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</section>
<!-- End Project Section -->

<!-- Education Section Four -->
{{-- <section class="education-section-four">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- Content Column -->
            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                    <h2 style="color: #18a674;">Learn anywhere, anytime</h2>
                    <div class="text">
                        <p class="font-weight-bold" style="color: #1E284B;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour or randomisedable.</p>
                        <p class="font-weight-bold" style="color: #1E284B;">There are many variations of passages of Lorem Ipsum available, but the majority</p>
                    </div>
                    <a href="course.html" class="theme-btn btn-style-six"><span class="txt">Discover Now</span></a>
                </div>
            </div>
            
            <!-- Image Column -->
            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="image titlt" data-tilt data-tilt-max="2">
                        <a href="{{ asset('public/assets/images/resource/education-3.jpg') }}" data-fancybox="education-2" data-caption="" class="">
                            <img src="{{ asset('public/assets/images/resource/education-3.jpg') }}" alt="" />
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section> --}}
<!-- End Education Section Four -->

<!-- Achievement Section Three -->
<section class="achievements-section-three">
    <!-- Pattern Layer -->
    <div class="pattern-layer" style="background-image:url({{ asset('public/assets/images/icons/dotted-layer-2.png') }})"></div>
    <div class="pattern-layer-two" style="background-image:url({{ asset('public/assets/images/icons/icon-6.png') }})"></div>
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title style-two centered">
            <h2>Our achievements</h2>
            <div class="text font-weight-bold" style="color: #1E284B;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re <br> two waters own morning gathered greater shall had behold had seed.</div>
        </div>
        
        <!-- Fact Counter -->
        <div class="fact-counter-three">
            <div class="row clearfix">

                <!-- Column -->
                <div class="column counter-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="icon-box">
                                <span style="color: #1E284B;" class="icon flaticon-course"></span>
                            </div>
                            <h4 class="counter-title">Total Courses</h4>
                            <div class="count-outer count-box" style="color: #18a674;">
                                <span class="count-text" data-speed="2000" data-stop="{{ App\Models\Courses\Course::count() }}">0</span>+
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column -->
                <div class="column counter-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="icon-box">
                                <span style="color: #1E284B;" class="icon flaticon-course-1"></span>
                            </div>
                            <h4 class="counter-title">Total Student</h4>
                            <div class="count-outer count-box alternate" style="color: #18a674;">
                                <span class="count-text" data-speed="3000" data-stop="{{ App\Models\User::count() }}">0</span>K+
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column -->
                <div class="column counter-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="icon-box">
                                <span style="color: #1E284B;" class="icon flaticon-world"></span>
                            </div>
                            <h4 class="counter-title">Global Position</h4>
                            <div class="count-outer count-box" style="color: #18a674;">
                                <span class="count-text" data-speed="4000" data-stop="115">0</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</section>
<!-- End Achievement Section -->

<!-- Testimonial Section Two -->
<section class="testimonial-section-two">
    <!-- Pattern Layer -->
    <div class="pattern-layer" style="background-image:url({{ asset('public/assets/images/icons/dotted-layer-3.png') }})"></div>
    <div class="pattern-layer-two" style="background-image:url({{ asset('public/assets/images/icons/icon-5.png') }})"></div>
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title style-two centered">
            <h2>We are changing lives</h2>
            <div class="text font-weight-bold" style="color: #1E284B;">See how we made a difference!</div>
        </div>
        @php
            $testimonials = [
                [
                    'image' => asset('public/assets/images/avatars/avatar2.png'),
                    'name' => 'Omar El-Mansy',
                    'testimonial' => 'دا الكورس الي حببني في الإنجليزى فعلا .. انا كسرت الحواجز الي بيني وبين اللغة وقدرت اطور مستوايا واوصل لمستوي مكنتش متوقع اوصله.. تدرج المستوى ممتاز و الماتريال كويسه جداااا... انا اخدت كورسات في اماكن تانيه بس دا اكتر كورس استفدت منه بجد! I LOVE STREET ENGLISH ACADEMY'
                ],
                [
                    'image' => asset('public/assets/images/avatars/avatar5.png'),
                    'name' => 'Amira Farouk',
                    'testimonial' => 'عن تجربتى انهارده فى الاون لاين مع مس/شيماء وكنت متردده بردو زى اى حد وبقول ممكن مستوعبش لقيت الموضوع لذيذ ومبسوطة بالتجربه ومكمله    و على فكرة من بيتك بتقدر تسأل وتتكلم وتتفاعل براحتك جدا وكانت سيشن مختلفه بجد ميرسى ليكى '
                ],
                [
                    'image' => asset('public/assets/images/avatars/avatar2.png'),
                    'name' => 'Hassan Khairy',
                    'testimonial' => "Thank you, Mr. Ismail for all the efforts you've exerted with me during IELTS course. I must get Band 7 in my IELTS for immigration purposes and Alhamdulillah I got it. Thanks a bunch! "
                ],
                [
                    'image' => asset('public/assets/images/avatars/avatar2.png'),
                    'name' => 'Ahmed Medhat',
                    'testimonial' => "These guys are really professional and well-organized in everything they do. Here, you'll not only learn English, Mr. Ismail is a true professional life coach and has great mentoring abilities. May Allah reward his efforts. Wishing you guys all the best!"
                ],
            ];
        @endphp
        
        <div class="testimonial-carousel owl-carousel owl-theme">

            @for ($i = 0; $i < count($testimonials); $i++)
            <!-- Testimonial Block Two -->
            <div class="testimonial-block-two">
                <div class="inner-box">
                    <div class="author-image">
                        <img src="{{ $testimonials[$i]['image'] }}" alt="" />
                    </div>
                    <h4>{{ $testimonials[$i]['name'] }}</h4>
                    <div class="text font-weight-bold" style="color: #1E284B;">{{ $testimonials[$i]['testimonial'] }}</div>
                    <div class="category">Student</div>
                </div>
            </div>
            @endfor
            
        </div>
        
    </div>
</section>
<!-- End Testimonial Section Two -->

<!-- FAQs Section Two -->
<section class="testimonial-section-two">
    <!-- Pattern Layer -->
    <div class="pattern-layer" style="background-image:url({{ asset('public/assets/images/icons/dotted-layer-3.png') }})"></div>
    <div class="pattern-layer-two" style="background-image:url({{ asset('public/assets/images/icons/icon-5.png') }})"></div>
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title style-two centered mb-0 pb-0">
            <h2>frequently asked question</h2>
        </div>
        
        <div class="row mt-0 pt-0">
            <div class="col-sm-6 accordion_one">
                <div class="panel-group" id="accordionFourLeft">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion_oneLeft" href="#collapseFiveLeftone" aria-expanded="false" class="collapsed"> Why Font Awesome used </a> </h4>
                        </div>
                        <div id="collapseFiveLeftone" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                            <div class="panel-body">
                                <div class="img-accordion"> <img src="https://img.icons8.com/color/81/000000/person-female.png" alt=""> </div>
                                <div class="text-accordion font-weight-bold" style="color: #1E284B;">
                                    <p> Why Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome used </p>
                                </div>
                            </div> <!-- end of panel-body -->
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion_oneLeft" href="#collapseFiveLeftTwo" aria-expanded="false"> Why Font Awesome used and its benefits </a> </h4>
                        </div>
                        <div id="collapseFiveLeftTwo" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                            <div class="panel-body">
                                <div class="img-accordion"> <img src="https://img.icons8.com/color/81/000000/person-female.png" alt=""> </div>
                                <div class="text-accordion font-weight-bold" style="color: #1E284B;">
                                    <p> Why Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome used </p>
                                </div>
                            </div> <!-- end of panel-body -->
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion_oneLeft" href="#collapseFiveLeftThree" aria-expanded="false"> Why Font Awesome used for its own </a> </h4>
                        </div>
                        <div id="collapseFiveLeftThree" class="panel-collapse collapse" aria-expanded="false" role="tablist">
                            <div class="panel-body">
                                <div class="img-accordion"> <img src="https://img.icons8.com/color/81/000000/person-female.png" alt=""> </div>
                                <div class="text-accordion font-weight-bold" style="color: #1E284B;">
                                    <p> Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own </p>
                                </div>
                            </div> <!-- end of panel-body -->
                        </div>
                    </div> <!-- /.panel-default -->
                </div>
                <!--end of /.panel-group-->
            </div>
            <div class="col-sm-6 accordion_one">
                <div class="panel-group" id="accordionFourLeft">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion_oneLeft" href="#collapseFiveRightone" aria-expanded="false" class="collapsed"> Why Font Awesome used </a> </h4>
                        </div>
                        <div id="collapseFiveRightone" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                            <div class="panel-body">
                                <div class="img-accordion"> <img src="https://img.icons8.com/color/81/000000/person-female.png" alt=""> </div>
                                <div class="text-accordion font-weight-bold" style="color: #1E284B;">
                                    <p> Why Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome used </p>
                                </div>
                            </div> <!-- end of panel-body -->
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion_oneLeft" href="#collapseFiveRightTwo" aria-expanded="false"> Why Font Awesome used and its benefits </a> </h4>
                        </div>
                        <div id="collapseFiveRightTwo" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                            <div class="panel-body">
                                <div class="img-accordion"> <img src="https://img.icons8.com/color/81/000000/person-female.png" alt=""> </div>
                                <div class="text-accordion font-weight-bold" style="color: #1E284B;">
                                    <p> Why Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome usedWhy Font Awesome used </p>
                                </div>
                            </div> <!-- end of panel-body -->
                        </div>
                    </div> <!-- /.panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion_oneLeft" href="#collapseFiveRightThree" aria-expanded="false"> Why Font Awesome used for its own </a> </h4>
                        </div>
                        <div id="collapseFiveRightThree" class="panel-collapse collapse" aria-expanded="false" role="tablist">
                            <div class="panel-body">
                                <div class="img-accordion"> <img src="https://img.icons8.com/color/81/000000/person-female.png" alt=""> </div>
                                <div class="text-accordion font-weight-bold" style="color: #1E284B;">
                                    <p> Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own Why Font Awesome used for its own </p>
                                </div>
                            </div> <!-- end of panel-body -->
                        </div>
                    </div> <!-- /.panel-default -->
                </div>
                <!--end of /.panel-group-->
            </div>
        </div>
    </div>
</section>
<!-- End FAQs Section Two -->

<!-- Subscribe Section -->
<section class="subscribe-section">
    <!-- Pattern Layer -->
    <div class="pattern-layer" style="background-image:url({{ asset('public/assets/images/icons/icon-4.png') }})"></div>
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title style-two centered">
            <h2>Subscribe to know our <br> every single updates</h2>
            <div class="text font-weight-bold" style="color: #1E284B;">There are many variations of passages of Lorem Ipsum available,</div>
        </div>
        
        <!-- Subscribe Form -->
        <div class="subscribe-form-two">
            <form id="subscribe">
                {{ csrf_field() }}
                <div class="form-group clearfix">
                    <span class="icon flaticon-mail"></span>
                    <input type="email" name="email" placeholder="Please Enter Your Email" required>
                    <button type="submit" class="theme-btn btn-style-six"><span class="txt">Subscribe Now</span></button>
                </div>
            </form>
            <div id="subscribe_hint"></div>
        </div>
        
    </div>
</section>
@endsection