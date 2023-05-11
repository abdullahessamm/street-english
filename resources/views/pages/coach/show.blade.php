@extends('layouts.app', [
    'active' => 'courses',
	'title' => $coach->name,
    'breadcrumb' => [
        'Home' => 'index',
        'Coaches' => 'coaches',
        $coach->name => 'active',
    ],
    'assets' => 'pages.coach.show',
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
            <div class="image-column col-lg-3 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="image">
                    @if(isset($coach->info) && $coach->info->image != null)
                        <img src="{{ asset('public/images/coaches/'.$coach->id.'/'.$coach->info->image) }}" style="width: 278px;height: 319px;" class="img-fluid" alt="">
                    @else
                        <img src="{{ asset('public/assets/images/avatars/avatar2.png') }}" style="width: 278px;height: 319px;" class="img-fluid" alt="">
                    @endif
                    </div>
                    <h4>{{ $coach->name }}</h4>
                    <div class="text">{{ isset($coach->info) && $coach->info->title != null ? $coach->info->title : null }}</div>
                    <div class="social-box">
                        <a href="{{ isset($coach->info) && $coach->info->facebook !== null ? $coach->info->facebook : 'javascript:void(0);' }}" class="fa fa-facebook-square"></a>
                        <a href="{{ isset($coach->info) && $coach->info->twitter !== null ? $coach->info->twitter : 'javascript:void(0);' }}" class="fa fa-twitter-square"></a>
                        <a href="{{ isset($coach->info) && $coach->info->linkedIn !== null ? $coach->info->linkedIn : 'javascript:void(0);' }}" class="fa fa-linkedin-square"></a>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="content-column col-lg-9 col-md-12 col-sm-12">
                <div class="inner-column">

                    <!-- Profile Info Tabs-->
                    <div class="profile-info-tabs">
                        <!-- Profile Tabs-->
                        <div class="profile-tabs tabs-box">

                            <!--Tab Btns-->
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#prod-overview" class="tab-btn active-btn">My Courses</li>
                                <li data-tab="#bio-overview" class="tab-btn">Bio</li>
                                {{-- <li data-tab="#prod-bookmark" class="tab-btn">My Blogs</li> --}}
                                {{-- <li data-tab="#prod-billing" class="tab-btn disabled">Let's Meet Online</li> --}}
                            </ul>

                            <!--Tabs Container-->
                            <div class="tabs-content">

                                <!--Tab / Active Tab-->
                                <div class="tab active-tab" id="prod-overview">
                                    <div class="content">
                                        <!-- Sec Title -->
                                        <div class="sec-title">
                                            <h2>My courses</h2>
                                        </div>

                                        <div class="row clearfix">
                                            @foreach($coachCourses as $coachCourse)
                                            @php
                                                $course = App\Models\Courses\Course::where('id', $coachCourse->course_id)->first();
                                            @endphp
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="{{ route('course.show', $course->slug) }}"><img src="{{ asset('public/images/courses/'.$course->id.'/'.$course->thumbnail) }}" style="width: 270px;height: 150px;" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="{{ route('course.show', $course->slug) }}">{{ $course->name }}</a></h5>
                                                        {{-- <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div> --}}
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">{{  $course->lessons->count() }} {{  $course->lessons->count() == 1 ? 'lesson' : 'lessons' }}</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">{{ $course->price }} EGP</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab" id="bio-overview">
                                    <div class="content">
                                        <!-- Sec Title -->
                                        <div class="sec-title">
                                            <h2>Bio</h2>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-12">
                                                {!! isset($coach->info) && $coach->info->about != null ? $coach->info->about : null !!}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab" id="prod-bookmark">
                                    <div class="content">

                                        <div class="row clearfix">
                                        @if($coachPosts->count() > 0)
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="blog-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="blog-detail.html">10 amazing web of demos Developers</a></h5>
                                                        <div class="text">And meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">By David Smith</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">11 Jan 20</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="jumbotron text-center">
                                                            <h3>No Blogs Avaliable</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        </div>

                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab" id="prod-billing">
                                    <div class="content">
                                        <div class="row clearfix">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="jumbotron text-center">
                                                            <h1>Coming Soon</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Saved Books Section -->
    <div class="saved-books-section">
        <div class="auto-container">
            <div class="sec-title">
                <h2>Saved Books</h2>
            </div>
            <div class="row clearfix">

                <!-- Book Block -->
                <div class="book-block col-lg-3 col-md-4 col-sm-12">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="https://via.placeholder.com/270x300" alt="">
                            <!-- Overlay Box -->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <a href="books-detail.html" class="link"><span class="icon fa fa-link"></span></a>
                                        <a href="https://via.placeholder.com/270x300" data-fancybox="books" data-caption="" class="link"><span class="icon flaticon-full-screen"></span></a>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="lower-box">
                            <h6><a href="books-detail.html">Don’t make me think</a></h6>
                        </div>
                    </div>
                </div>

                <!-- Book Block -->
                <div class="book-block col-lg-3 col-md-4 col-sm-12">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="https://via.placeholder.com/270x300" alt="">
                            <!-- Overlay Box -->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <a href="books-detail.html" class="link"><span class="icon fa fa-link"></span></a>
                                        <a href="https://via.placeholder.com/270x300" data-fancybox="books" data-caption="" class="link"><span class="icon flaticon-full-screen"></span></a>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="lower-box">
                            <h6><a href="books-detail.html">Design of Everyday</a></h6>
                        </div>
                    </div>
                </div>

                <!-- Book Block -->
                <div class="book-block col-lg-3 col-md-4 col-sm-12">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="https://via.placeholder.com/270x300" alt="">
                            <!-- Overlay Box -->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <a href="books-detail.html" class="link"><span class="icon fa fa-link"></span></a>
                                        <a href="https://via.placeholder.com/270x300" data-fancybox="books" data-caption="" class="link"><span class="icon flaticon-full-screen"></span></a>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="lower-box">
                            <h6><a href="books-detail.html">Undercover UX Design</a></h6>
                        </div>
                    </div>
                </div>

                <!-- Book Block -->
                <div class="book-block col-lg-3 col-md-4 col-sm-12">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="https://via.placeholder.com/270x300" alt="">
                            <!-- Overlay Box -->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <a href="books-detail.html" class="link"><span class="icon fa fa-link"></span></a>
                                        <a href="https://via.placeholder.com/270x300" data-fancybox="books" data-caption="" class="link"><span class="icon flaticon-full-screen"></span></a>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="lower-box">
                            <h6><a href="books-detail.html">Interaction Design</a></h6>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div> --}}

</section>
<!-- End Profile Section -->

<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="appointments"></div>
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
                {!! errorMsg('حدث خطاء ما') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection