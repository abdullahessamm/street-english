@extends('layouts.app',[
    'title' => $myZoomCourseSession->title,
    'assets' => 'live-course-user.pages.session'
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
                    @if(isset($zoomCourseUser->info) && $zoomCourseUser->info->image != null)
                        <img src="{{ asset('public/images/zoom-course-users/'.$zoomCourseUser->id.'/'.$zoomCourseUser->info->image) }}" alt="" />
                    @else
                        <img src="https://via.placeholder.com/278x319" alt="" />
                    @endif
                    </div>
                    <h4>{{ Auth::guard('live_course_user')->user()->name }}</h4>
                    <div class="text">Joined at {{ date("Y-m-d", strtotime(Auth::guard('live_course_user')->user()->created_at)) }}</div>
                   
                    <ul class="student-editing">
                        <li ><a href="{{ route('live-course-user.home') }}">My Dashboard</a></li>
                        <li><a href="{{ route('live-course-user.settings') }}">Edit Account</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Content Section -->
            <div class="content-column col-lg-9 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>{{ $myZoomCourseSession->title }}</h2>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-12">
                            @if($exerciseUser == null)
                                <div class="jumbotron text-center">
                                    <h3>Click on the button below to start the exercise</h3>
                                    <button class="btn btn-success" id="start-exercise" data-live-course-user-id="{{$liveCourseUser->id}}" data-zoom-course-session-id="{{$myZoomCourseSession->id}}">Start Exercise</button>
                                </div>
                            @endif

                            @if(isset($exerciseUser) && $exerciseUser->hasJoined == 1 && isset($exerciseUser) && $exerciseUser->hasFinished == 0)
                            <section class="login-section pt-0">
                                <div class="auto-container">
                                    <div id="surveyContainer">
                                        <div id="surveyElement" style="display:inline-block;width:100%;"></div>
                                    </div>
                                </div>
                            </section>
                            @elseif(isset($exerciseUser) && $exerciseUser->hasJoined == 1 && isset($exerciseUser) && $exerciseUser->hasFinished == 1)
                            <div class="jumbotron text-center">
                                <h3>Waiting for results.</h3>
                            </div>
                            @endif
                            <div id="hint"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</section>
<!-- End Profile Section -->

<div class="modal" tabindex="-1" role="dialog" id="answerAtLeastOneQuestionModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <i class="fa fa-times text-danger" style="font-size: 100px;"></i>
                <h3>You must at least answer 1 question</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection