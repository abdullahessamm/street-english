@extends('layouts.app',[
    'title' => $myBundle->belongsToBundle->name,
    'active' => 'student.home'
])

@section('content')
<!-- Student Profile Section -->
<section class="student-profile-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="circle-one"></div>
    <div class="circle-two"></div>
    <div class="auto-container">
        
        <div class="row clearfix mt-5">
            
            <!-- Image Section -->
            @include('student.layouts.settings')
            
            <!-- Content Section -->
            <div class="content-column col-lg-9 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>{{ $myBundle->belongsToBundle->name }}</h2>
                        </div>
                        
                        <div class="row clearfix">
                        @if($myBundle->belongsToBundle->bundleCourses->count() > 0)
                            @foreach($myBundle->belongsToBundle->bundleCourses as $eachCourse)
                            <!-- Cource Block Two -->
                            <div class="cource-block-two col-lg-3 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="image">
                                        {{-- <a href="course-detail.html">
                                            <img src="https://via.placeholder.com/270x150" alt="" />
                                        </a> --}}
									    <a href="{{ route('student.my-course.show', $eachCourse->belongsToCourse->slug) }}"><img src="{{ asset('public/images/courses/'.$eachCourse->belongsToCourse->id.'/'.$eachCourse->belongsToCourse->thumbnail) }}" style="width: 270px;height: 150px;" alt="" /></a>
                                    </div>
                                    <div class="lower-content">
                                        <h5><a href="{{ route('student.my-course.show', [$eachCourse->belongsToCourse->slug]) }}">{{ $eachCourse->belongsToCourse->name }}</a></h5>
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <div class="students">{{ $eachCourse->belongsToCourse->lessons->count() }} Lessons</div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="hours">{{ $eachCourse->belongsToCourse->duration }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="jumbotron text-center">
                                    <h3>You don't have any bundles</h3>
                                    <a href="{{ route('courses') }}" class="btn btn-success mt-3" style="background-color: #18a674;">Browse Courses</a>
                                </div>
                            </div>
                        @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Profile Section -->
@endsection