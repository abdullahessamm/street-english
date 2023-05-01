@extends('layouts.app',[
    'title' => $myCourse->name,
    'active' => 'student.my-courses',
])

@section('content')
<!-- Intro Courses -->
<section class="intro-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-1.png') }})"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-2.png') }})"></div>
    <div class="circle-one"></div>
    <div class="auto-container mt-5">
        <div class="sec-title">
            <h2>{{ $myCourse->name }}</h2>
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
                                    {{-- <li data-tab="#prod-overview" class="tab-btn" style="font-size: 20px;">Course Description</li> --}}
                                    <li data-tab="#prod-curriculum" class="tab-btn active-btn" style="font-size: 20px;">Start Course</li>
                                    {{-- <li data-tab="#prod-reviews" class="tab-btn">Reviews</li> --}}
                                </ul>
                                
                                <!--Tabs Container-->
                                <div class="tabs-content">
                                    
                                    <!--Tab / Active Tab-->
                                    {{-- <div class="tab active-tab" id="prod-overview">
                                        <div class="content">
                                            <!-- Cource Overview -->
                                            <div class="course-overview">
                                                <div class="course-overview">
                                                    <div class="inner-box">
                                                        {!! $myCourse->description !!}

                                                        <div class="row clearfix">
                                                            @foreach($myCourse->instructors as $eachInstructor)
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
                                    </div> --}}
                                    
                                    <!-- Tab -->
                                    <div class="tab active-tab" id="prod-curriculum">
                                        <div class="content">
                                            
                                            <!-- Accordion Box -->
                                            <ul class="accordion-box">
                                                @for ($i = 0; $i < $myCourse->contents->count(); $i++)
                                                <!-- Block -->
                                                <li class="accordion block">
                                                    <div class="acc-btn {{ $i == 0 ? 'active' : null }}"><div class="icon-outer"><span class="icon icon-plus flaticon-angle-arrow-down"></span></div>{{ $myCourse->contents[$i]->title }}</div>
                                                    <div class="acc-content {{ $i == 0 ? 'current' : null }}">
                                                    @foreach($myCourse->contents[$i]->lessons as $lesson)
                                                        <div class="content">
                                                            <div class="clearfix">
                                                                <div class="pull-left">
                                                                    <a href="javascript:void(0);" class="play-icon">
                                                                    @switch($lesson->type)
                                                                        @case('video')
                                                                        
                                                                        <div class="pull-left">
                                                                        @if($lesson->info->isPublished)
                                                                        <a href="{{ route('student.my-course.lesson', [$lesson->belongsToContent->belongsToCourse->slug, $lesson->slug]) }}" class="preview-lesson play-icon" data-lesson-id="{{ $lesson->id }}"><span class="fa fa-video-camera"></span>{{ $lesson->title }}</a>
                                                                        @else
                                                                        <a href="{{ route('student.my-course.lesson', [$lesson->belongsToContent->belongsToCourse->slug, $lesson->slug]) }}" class="play-icon" ><span class="fa fa-lock"></span>{{ $lesson->title }}</a>
                                                                        @endif
                                                                        </div>
                                                                        @break

                                                                        @case('context')
                                                                        <span class="fa fa-file-text"></span>
                                                                        {{ $lesson->title }}
                                                                        @break

                                                                        @case('doc')
                                                                        <span class="fa fa-file-pdf-o"></span>
                                                                        {{ $lesson->title }}
                                                                        @break

                                                                        @case('frame')
                                                                        <span class="fa fa-external-link"></span>
                                                                        {{ $lesson->title }}
                                                                        @break
                                                                        
                                                                        @case('exercise')
                                                                        <span class="fa fa-pencil-square-o"></span>
                                                                        {{ $lesson->title }}
                                                                        @break
                                                                    @endswitch
                                                                    </a>
                                                                </div>
                                                                {{-- @else
                                                                <div class="pull-left">
                                                                    <a href="javascript:void(0);" class="preview-lesson play-icon" data-lesson-id="{{ $lesson->id }}"><span class="fa fa-play"></span>{{ $lesson->title }}</a>
                                                                </div> --}}
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
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Video Column -->
                <div class="video-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column sticky-top">
                        
                        @if($myCourse->media_intro == 'image')
                        <img src="{{ asset('public/images/courses/'.$myCourse->id.'/'.$myCourse->image) }}" class="img-fluid" alt="">
                        @else
                        <!-- Video Box -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$myCourse->video_url}}?rel=0" allowfullscreen></iframe>
                        </div>
                        <!-- End Video Box -->
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    
    </div>
</section>
<!-- End intro Courses -->
@endsection