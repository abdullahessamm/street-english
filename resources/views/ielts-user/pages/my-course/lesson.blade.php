@extends('layouts.app',[
    'title' => $lesson->title,
    'active' => 'ielts-user.my-course',
    'assets' => 'pages.my-courses.lesson',
])

@section('content')
<!-- Intro Section -->
<section class="intro-section-two">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="circle-one"></div>
    <div class="auto-container">
        
        <div class="inner-container">
            <div class="row clearfix mt-5">
                <div class="content col-8">
                    <div class="sec-title">
                    @if($lesson->type == 'exercise')
                        @php

                            $my_scores = 0;
                            $exercise_score = [];

                            if(isset($lesson->exercise->courseLessonExerciseUser)){
                            
                                $my_scores =  $lesson->exercise->courseLessonExerciseUser->exerciseAnswers->sum('score');

                                foreach($lesson->exercise->courseLessonExerciseUser->exerciseAnswers as $eachQuestionAndAnswer){
                                    $exercise_score[] = $eachQuestionAndAnswer->belongsToExamQuestion->score;
                                }
                            }
                        @endphp
                        @if(isset($lesson->exercise->courseLessonExerciseUser))
                        <h2 class="float-left">{{ $lesson->title }}</h2>
                        <h2 class="float-right">{{ $my_scores.' / '.array_sum($exercise_score) }}</h2>
                        @endif
                    @else
                        <h2>{{ $lesson->title }}</h2>
                    @endif
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="course-video-box">
                            @switch($lesson->type)
                                @case('video')
                                    @include('ielts-user.pages.my-course.preview-lesson.video',[
                                        'lesson' => $lesson
                                    ])
                                @break
                                    
                                @case('audio')
                                    @include('ielts-user.pages.my-course.preview-lesson.audio',[
                                        'lesson' => $lesson
                                    ])
                                @break
                            
                                @case('doc')
                                    @include('ielts-user.pages.my-course.preview-lesson.doc',[
                                        'lesson' => $lesson
                                    ])
                                @break
                            
                                @case('frame')
                                    @include('ielts-user.pages.my-course.preview-lesson.iframe',[
                                        'lesson' => $lesson
                                    ])
                                @break
                            
                                @case('exercise')
                                    @include('ielts-user.pages.my-course.preview-lesson.exercise',[
                                        'lesson' => $lesson
                                    ])
                                @break
                                
                            @endswitch
                        </div>
                        
                        @if($lesson->type == 'context' || $lesson->description != null)
                        <!-- Intro Info Tabs-->
                        <div class="intro-info-tabs">
                            <!-- Intro Tabs-->
                            <div class="intro-tabs tabs-box">
                            
                                <!--Tab Btns-->
                                <ul class="tab-btns tab-buttons clearfix">
                                    <li data-tab="#prod-overview" class="tab-btn active-btn">Description</li>
                                </ul>
                                
                                <!--Tabs Container-->
                                <div class="tabs-content">
                                    <!--Tab / Active Tab-->
                                    <div class="tab active-tab" id="prod-overview">
                                        <div class="content">
                                            
                                            <!-- Cource Overview -->
                                            <div class="course-overview">
                                                <div class="inner-box">
                                                @if($lesson->type == 'context')
                                                    <h4>Lesson Description</h4>
                                                    {!! $lesson->context->content !!}
                                                @else
                                                    <h4>Lesson Description</h4>
                                                    {!! $lesson->description !!}
                                                @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Accordian Column -->
                <div class="accordian-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column ">
                        <h4>Table of contents</h4>
                        <!-- Accordion Box -->
                        <ul class="accordion-box style-two">
                            @for ($i = 0; $i < $myCourse->contents->count(); $i++)
                            <!-- Block -->
                            <li class="accordion block">
                                <div class="acc-btn active"><div class="icon-outer"><span class="icon icon-plus flaticon-angle-arrow-down"></span></div>{{ $myCourse->contents[$i]->title }}</div>
                                <div class="acc-content {{ $lesson->belongsToContent->id == $myCourse->contents[$i]->id ? 'current' : null }}">
                                    @foreach($myCourse->contents[$i]->lessons as $eachLesson)
                                    @if(isset($eachLesson->info) && $eachLesson->info->isPublished == 1)
                                    <div class="content">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <a href="{{ route('ielts-user.my-course.lesson', [$myCourse->slug, $eachLesson->slug]) }}" class="play-icon">
                                                @switch($eachLesson->type)
                                                    @case('video')
                                                    <span class="fa fa-video-camera">
                                                        {!! $lesson->id == $eachLesson->id ? '<i class="ripple"></i>' : null !!}
                                                    </span>
                                                    @break

                                                    @case('context')
                                                    <span class="fa fa-file-text">
                                                        {!! $lesson->id == $eachLesson->id ? '<i class="ripple"></i>' : null !!}
                                                    </span>
                                                    @break

                                                    @case('doc')
                                                    <span class="fa fa-file-pdf-o">
                                                        {!! $lesson->id == $eachLesson->id ? '<i class="ripple"></i>' : null !!}
                                                    </span>
                                                    @break

                                                    @case('frame')
                                                    <span class="fa fa-external-link">
                                                        {!! $lesson->id == $eachLesson->id ? '<i class="ripple"></i>' : null !!}
                                                    </span>
                                                    @break
                                                    
                                                    @case('exercise')
                                                    <span class="fa fa-pencil-square-o">
                                                        {!! $lesson->id == $eachLesson->id ? '<i class="ripple"></i>' : null !!}
                                                    </span>
                                                    @break
                                                @endswitch
                                                    {{ \Illuminate\Support\Str::limit($eachLesson->title, 24, '...') }}
                                                    
                                                </a>
                                            </div>
                                            {{-- <div class="pull-right">
                                                <div class="minutes">2 Min 45 Sec</div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    {{-- <div class="content">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="play-icon"><span class="fa fa-play"><i class="ripple"></i></span>What is UI/ UX Design?</a>
                                            </div>
                                            <div class="pull-right">
                                                <div class="minutes">2 Min 35 Sec</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image play-icon"><span class="fa fa-play"></span>What is UI/ UX Design?</a>
                                            </div>
                                            <div class="pull-right">
                                                <div class="minutes">2 Min 45 Sec</div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </li>
                            @endfor
                        </ul>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- End intro Courses -->
@endsection