@extends('layouts.app', [
    'active' => 'courses',
	'title' => $course->name,
    'scripts' => 'pages.ietls-course.show',
    'breadcrumb' => [
        'Home' => 'index',
        'Online Courses' => 'courses',
        $course->name => 'active'
    ]
])

@section('content')

<!-- Intro Courses -->
<section class="intro-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-1.png') }})"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-2.png') }})"></div>
    <div class="circle-one"></div>
    <div class="auto-container mt-5">
        <div class="sec-title">
            <h2>{{ $course->name }}</h2>
        </div>
        
        <div class="inner-container">
            <div class="row clearfix">
                
                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Intro Info Tabs-->
                        <div class="intro-info-tabs">
                            <!-- Intro Tabs-->
                            <div class="intro-tabs tabs-box">
                            
                                <!--Tab Btns-->
                                <ul class="tab-btns tab-buttons clearfix">
                                    <li data-tab="#prod-overview" class="tab-btn active-btn" style="font-size: 20px;">Course Description</li>
                                    <li data-tab="#prod-curriculum" class="tab-btn" style="font-size: 20px;">Start Course</li>
                                    {{-- <li data-tab="#prod-reviews" class="tab-btn">Reviews</li> --}}
                                </ul>
                                
                                <!--Tabs Container-->
                                <div class="tabs-content">
                                    
                                    <!--Tab / Active Tab-->
                                    <div class="tab active-tab" id="prod-overview">
                                        <div class="content">
                                            <!-- Cource Overview -->
                                            <div class="course-overview">
                                                <div class="course-overview">
                                                    <div class="inner-box">
                                                        {!! $course->description !!}

                                                        <div class="row clearfix">
                                                            @foreach($course->instructors as $eachInstructor)
															<!-- Student Block -->
															<div class="student-block col-lg-6 col-md-6 col-sm-12 mb-3">
																<div class="block-inner">
																	<div class="image">
                                                                        @if(isset($eachInstructor->belongsToInstructor->info) && $eachInstructor->belongsToInstructor->info->image !== null)
																		<img src="{{ asset('public/images/coaches/'.$eachInstructor->belongsToInstructor->id.'/'.$eachInstructor->belongsToInstructor->info->image) }}" style="width: 278px;height: 319px;" alt="" />
                                                                        @else
																		<img src="{{ asset('public/assets/images/avatars/avatar2.png') }}" style="width: 278px;height: 319px;" alt="" />
                                                                        @endif
																	</div>
																	<h2 class="mb-2">{{ $eachInstructor->belongsToInstructor->name }}</h2>
																	{{-- <div class="text">Certified instructor Architecture& Developer</div> --}}
																	<div class="social-box">
																		<a href="{{ isset($eachInstructor->belongsToInstructor->info) && $eachInstructor->belongsToInstructor->info->facebook !== null ? $eachInstructor->belongsToInstructor->info->facebook : 'javascript:void(0);' }}" class="fa fa-facebook-square"></a>
																		<a href="{{ isset($eachInstructor->belongsToInstructor->info) && $eachInstructor->belongsToInstructor->info->twitter !== null ? $eachInstructor->belongsToInstructor->info->twitter : 'javascript:void(0);' }}" class="fa fa-twitter-square"></a>
																		<a href="{{ isset($eachInstructor->belongsToInstructor->info) && $eachInstructor->belongsToInstructor->info->linkedIn !== null ? $eachInstructor->belongsToInstructor->info->linkedIn : 'javascript:void(0);' }}" class="fa fa-linkedin-square"></a>
																	</div>
																	<a href="{{ route('instructor.show', $eachInstructor->belongsToInstructor->id) }}" class="more">Know More <span class="fa fa-angle-right"></span></a>
																</div>
															</div>
                                                            @endforeach
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Tab -->
                                    <div class="tab" id="prod-curriculum">
                                        <div class="content">
                                            
                                            <!-- Accordion Box -->
                                            <ul class="accordion-box">
                                                @for ($i = 0; $i < $course->contents->count(); $i++)
                                                <!-- Block -->
                                                <li class="accordion block">
                                                    <div class="acc-btn {{ $i == 0 ? 'active' : null }}"><div class="icon-outer"><span class="icon icon-plus flaticon-angle-arrow-down"></span></div>{{ $course->contents[$i]->title }}</div>
                                                    <div class="acc-content {{ $i == 0 ? 'current' : null }}">
                                                        @foreach($course->contents[$i]->lessons as $lesson)
                                                        <div class="content">
                                                            <div class="clearfix">
                                                                @if($lesson->isLocked)
                                                                <div class="pull-left">
                                                                    <a href="javascript:void(0);" class="play-icon"><span class="fa fa-lock"></span>{{ $lesson->title }}</a>
                                                                </div>
                                                                @else
                                                                <div class="pull-left">
                                                                    <a href="javascript:void(0);" class="preview-lesson play-icon" data-lesson-id="{{ $lesson->id }}"><span class="fa fa-play"></span>{{ $lesson->title }}</a>
                                                                </div>
                                                                @endif
                                                                {{-- <div class="pull-right">
                                                                    <div class="minutes">35 Minutes</div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                                @endfor
                                            </ul>
                                            
                                        </div>
                                    </div>
                                    
                                    {{-- <!-- Tab -->
                                    <div class="tab" id="prod-reviews">
                                        <div class="content">
                                            
                                            <div class="cource-review-box">
                                                <h4>Stephane Smith</h4>
                                                <div class="rating">
                                                    <span class="total-rating">4.5</span> <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>&ensp; 256 Reviews
                                                </div>
                                                <div class="text">Phasellus enim magna, varius et commodo ut, ultricies vitae velit. Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo. In libero urna, venenatis sit amet ornare non, suscipit nec risus.</div>
                                                <div class="helpful">Was this review helpful?</div>
                                                <ul class="like-option">
                                                    <li><span class="icon fa fa-thumbs-o-up"></span></li>
                                                    <li><span class="icon fa fa-thumbs-o-down"></span></li>
                                                    <span class="report">Report</span>
                                                </ul>
                                            </div>
                                            
                                            <div class="cource-review-box">
                                                <h4>Anna Sthesia</h4>
                                                <div class="rating">
                                                    <span class="total-rating">4.5</span> <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>&ensp; 256 Reviews
                                                </div>
                                                <div class="text">Phasellus enim magna, varius et commodo ut, ultricies vitae velit. Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo. In libero urna, venenatis sit amet ornare non, suscipit nec risus.</div>
                                                <div class="helpful">Was this review helpful?</div>
                                                <ul class="like-option">
                                                    <li><span class="icon fa fa-thumbs-o-up"></span></li>
                                                    <li><span class="icon fa fa-thumbs-o-down"></span></li>
                                                    <span class="report">Report</span>
                                                </ul>
                                            </div>
                                            
                                            <div class="cource-review-box">
                                                <h4>Petey Cruiser</h4>
                                                <div class="rating">
                                                    <span class="total-rating">4.5</span> <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>&ensp; 256 Reviews
                                                </div>
                                                <div class="text">Phasellus enim magna, varius et commodo ut, ultricies vitae velit. Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo. In libero urna, venenatis sit amet ornare non, suscipit nec risus.</div>
                                                <div class="helpful">Was this review helpful?</div>
                                                <ul class="like-option">
                                                    <li><span class="icon fa fa-thumbs-o-up"></span></li>
                                                    <li><span class="icon fa fa-thumbs-o-down"></span></li>
                                                    <span class="report">Report</span>
                                                </ul>
                                            </div>
                                            
                                            <div class="cource-review-box">
                                                <h4>Rick O'Shea</h4>
                                                <div class="rating">
                                                    <span class="total-rating">4.5</span> <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>&ensp; 256 Reviews
                                                </div>
                                                <div class="text">Phasellus enim magna, varius et commodo ut, ultricies vitae velit. Ut nulla tellus, eleifend euismod pellentesque vel, sagittis vel justo. In libero urna, venenatis sit amet ornare non, suscipit nec risus.</div>
                                                <div class="helpful">Was this review helpful?</div>
                                                <ul class="like-option">
                                                    <li><span class="icon fa fa-thumbs-o-up"></span></li>
                                                    <li><span class="icon fa fa-thumbs-o-down"></span></li>
                                                    <span class="report">Report</span>
                                                </ul>
                                                
                                                <a href="#" class="more">View More</a>
                                            </div>
                                            
                                        </div>
                                    </div> --}}
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Video Column -->
                <div class="video-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column sticky-top">
                        
                        @if($course->media_intro == 'image')
                        <img src="{{ asset('public/images/ietls-courses/'.$course->id.'/'.$course->image) }}" class="img-fluid" alt="">
                        @else
                        <!-- Video Box -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$course->video_url}}?rel=0" allowfullscreen></iframe>
                        </div>
                        <!-- End Video Box -->
                        @endif
                        
                        @if(Auth::check() && Auth::user()->course($course->id) != null)
                            @php
                                $lessons = $course->lessons;
                                $firstLesson = $lessons[0];
                            @endphp
                            <a  href="{{ route('student.my-course.lesson', [$course->slug, $firstLesson->slug]) }}" class="theme-btn btn-style-three mt-3"><span class="txt">Complete this course</span></a>
                        @elseif(Auth::check() && Auth::user()->course($course->id) == null)
                            <div class="price mb-3">{{$course->price}} EGP</div>
                            {{-- <div class="time-left">23 hours left at this price!</div> --}}
                            <a href="javascript:void(0);" class="theme-btn btn-style-two" data-toggle="modal" data-target="#buyCourseModal"><span class="txt">Buy Now <i class="fa fa-angle-right"></i></span></a>
                        @else
                            <div class="price mb-3">
                            @if($course->discount != null)
                                {{ $course->discount->price }}
                                <small><del>{{ $course->discount->discount }} EGP</del></small>
                            @else
                                {{ $course->price }}
                            @endif
                            </div>
                            {{-- <div class="time-left">23 hours left at this price!</div> --}}
                            <a href="javascript:void(0);" class="theme-btn btn-style-two" data-toggle="modal" data-target="#loginToBuyCourseModal"><span class="txt">Buy Now <i class="fa fa-angle-right"></i></span></a>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    
    </div>
</section>
<!-- End intro Courses -->

<!-- Call To Action Section Two -->
<section class="call-to-action-section-two" style="background-image: url({{ asset('public/assets/images/background/3.png') }})">
    <div class="auto-container">
        <div class="content">
            <h2>Ready to get started?</h2>
            <div class="text">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two <br> waters own morning gathered greater shall had behold had seed.</div>
            <div class="buttons-box">
                <a href="course.html" class="theme-btn btn-style-one"><span class="txt">Get Stared <i class="fa fa-angle-right"></i></span></a>
                <a href="course.html" class="theme-btn btn-style-two"><span class="txt">All Courses <i class="fa fa-angle-right"></i></span></a>
            </div>
        </div>
    </div>
</section>
<!-- End Call To Action Section Two -->

<!-- Login to Buy Course Modal -->
<div class="modal fade" id="loginToBuyCourseModal" tabindex="-1" role="dialog" aria-labelledby="loginToBuyCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginToBuyCourseModalLabel">Buy  - {{ $course->name }}</h5>
                <div class="float-right">
                    <h5><span class="font-weight-bold text-success">${{ $course->price }}</span></h5>
                </div>
            </div>
            <form id="loginToBuyCourse">
                {{ csrf_field() }}
                
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-body">
                    <div class="my-3 text-center">
                        <h5>You need to login first</h5>
                        <small>Don't have an account don't worry <a href="{{ route('register') }}">Click here to create new account</a></small>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-merge">
                            <input id="email" type="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your Email" required autocomplete="email" autofocus>
                
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-envelope"></span>
                                </div>
                            </div>
                
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group ">
                        <div class="input-group input-group-merge">
                            <input id="password" type="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-key"></span>
                                </div>
                            </div>
                
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Buy Course Modal -->
@if(Auth::check())
<div class="modal fade" id="buyCourseModal" tabindex="-1" role="dialog" aria-labelledby="buyCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyCourseModalLabel">Buy  - {{ $course->name }}</h5>
                <div class="float-right">
                    <h5><span class="font-weight-bold text-success">${{ $course->price }}</span></h5>
                </div>
            </div>
            <form id="buyCourse">
                {{ csrf_field() }}
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="modal-body">
                    <div class="jumbotron text-center">
                        <h3>By clicking <small class="bg-success text-light p-2 font-weight-bold">Buy - ${{$course->price}}</small> you will have this course in your dashboard</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Buy - ${{$course->price}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Preview Lesson Modal -->
<div class="modal fade" id="previewLessonModal" tabindex="-1" role="dialog" aria-labelledby="previewLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div id="preview_lessons_res"></div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <p class="p-3">
                    {!! errorMsg('Error Occured') !!}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection