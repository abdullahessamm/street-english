@extends('layouts.app',[
    'title' => 'My Dashboard',
    'active' => 'ielts-user.home'
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
                        @php
                            $user = App\Models\IETLSCourses\IeltsUser::where('id', Auth::guard('ielts_user')->user()->id)->first();
                        @endphp
                        @if($user->image != null)
                            <img src="{{ asset('public/images/ielts-user/'.$user->id.'/'.$user->image) }}" alt="" />
                        @else
                            <img src="https://via.placeholder.com/278x319" alt="" />
                        @endif
                    </div>
                    <h4>{{ Auth::guard('ielts_user')->user()->name }}</h4>
                    <div class="text">Joined {{ Carbon\Carbon::parse(Auth::guard('ielts_user')->user()->created_at)->diffForHumans() }}</div>
                   
                    <ul class="student-editing">
                        <li ><a href="{{ route('ielts-user.home') }}">My Dashboard</a></li>
                        <li><a href="{{ route('ielts-user.settings') }}">Edit Account</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Content Section -->
            <div class="content-column col-lg-9 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="content">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <h2>My Courses</h2>
                        </div>
                        
                        <div class="row clearfix">
                        @if($myCourses->count() > 0)
                            @foreach($myCourses as $eachCourse)
                            <!-- Cource Block Two -->
                            <div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="image">
                                        {{-- <a href="course-detail.html">
                                            <img src="https://via.placeholder.com/270x150" alt="" />
                                        </a> --}}
									    <a href="{{ route('ielts-user.my-course.show', $eachCourse->belongsToCourse->slug) }}"><img src="{{ asset('public/images/ietls-courses/'.$eachCourse->belongsToCourse->id.'/'.$eachCourse->belongsToCourse->thumbnail) }}" style="width: 270px;height: 150px;" alt="" /></a>
                                    </div>
                                    <div class="lower-content">
                                        @php
                                            $lessons = $eachCourse->belongsToCourse->lessons;
                                            $firstLesson = $lessons[0];
                                        @endphp
                                        <h5><a href="{{ route('ielts-user.my-course.lesson', [$eachCourse->belongsToCourse->slug, $firstLesson->slug]) }}">{{ $eachCourse->belongsToCourse->name }}</a></h5>
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
                                    <h3>You don't have any enrolled courses</h3>
                                    <a href="{{ route('ietls-courses') }}" class="btn btn-success mt-3" style="background-color: #18a674;">Browse Courses</a>
                                </div>
                            </div>
                        @endif
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