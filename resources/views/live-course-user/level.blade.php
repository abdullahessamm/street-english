@extends('layouts.app',[
    'title' => $myZoomCourseLevel->belongsToZoomCourseLevel->belongsToZoomCourse->title.' - '.$myZoomCourseLevel->belongsToZoomCourseLevel->title,
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
                        <li><a href="{{ route('student.settings') }}">Edit Account</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Content Section -->
            <div class="content-column col-lg-9 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>{!! '<a href="'.route('live-course.show', [$myZoomCourseLevel->enrolled_for_zoom_course_id, ]).'">'.$myZoomCourseLevel->belongsToZoomCourseLevel->belongsToZoomCourse->title.'</a>'.' - '.$myZoomCourseLevel->belongsToZoomCourseLevel->title !!} Sessions</h2>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Session Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($myZoomCourseLevel->belongsToZoomCourseLevel->sessions as $eachZoomCourseSessions)
                                        <tr>
                                            <td>
                                                <a href="{{ route('live-course-user.session.show', [$myZoomCourseLevel->enrolled_for_zoom_course_id, $myZoomCourseLevel->zoom_course_level_id, $eachZoomCourseSessions->id]) }}">{{ $eachZoomCourseSessions->title }}</a>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>

                    {{-- <!-- Profile Info Tabs-->
                    <div class="profile-info-tabs">
                        <!-- Profile Tabs-->
                        <div class="profile-tabs tabs-box">
                        
                            <!--Tab Btns-->
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#prod-overview" class="tab-btn active-btn">Overview</li>
                                <li data-tab="#prod-bookmark" class="tab-btn">Bookmarks</li>
                                <li data-tab="#prod-billing" class="tab-btn">Billing</li>
                                <li data-tab="#prod-setting" class="tab-btn">Settings</li>
                            </ul>
                            
                            <!--Tabs Container-->
                            <div class="tabs-content">
                                
                                <!--Tab / Active Tab-->
                                <div class="tab active-tab" id="prod-overview">
                                    <div class="content">
                                        <!-- Sec Title -->
                                        <div class="sec-title">
                                            <h2>Courses In Progress</h2>
                                        </div>
                                        
                                        <div class="row clearfix">
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Interaction Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Visual Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Wireframe Protos</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Color Theory</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Typography</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Picture Selection</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <!-- Tab -->
                                <div class="tab" id="prod-bookmark">
                                    <div class="content">
                                        
                                        <div class="row clearfix">
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Interaction Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Visual Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Wireframe Protos</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Color Theory</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Typography</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Picture Selection</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <!-- Tab -->
                                <div class="tab" id="prod-billing">
                                    <div class="content">
                                        
                                        <div class="row clearfix">
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Interaction Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Visual Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Wireframe Protos</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Color Theory</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Typography</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Picture Selection</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <!-- Tab -->
                                <div class="tab" id="prod-setting">
                                    <div class="content">
                                        
                                        <div class="row clearfix">
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Interaction Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Visual Design</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Wireframe Protos</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Color Theory</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Typography</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Cource Block Two -->
                                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                                <div class="inner-box">
                                                    <div class="image">
                                                        <a href="course-detail.html"><img src="https://via.placeholder.com/270x150" alt="" /></a>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="course-detail.html">Picture Selection</a></h5>
                                                        <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div>
                                                        <div class="clearfix">
                                                            <div class="pull-left">
                                                                <div class="students">12 Lecturer</div>
                                                            </div>
                                                            <div class="pull-right">
                                                                <div class="hours">54 Hours</div>
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
                    
                    <!-- Post Share Options -->
                    <div class="styled-pagination">
                        <ul class="clearfix">
                            <li class="prev"><a href="#"><span class="fa fa-angle-left"></span> </a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li class="active"><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">6</a></li>
                            <li><a href="#">7</a></li>
                            <li><a href="#">8</a></li>
                            <li class="next"><a href="#"><span class="fa fa-angle-right"></span> </a></li>
                        </ul>
                    </div> --}}
                    
                </div>
            </div>
            
        </div>
        
    </div>
</section>
<!-- End Profile Section -->
@endsection