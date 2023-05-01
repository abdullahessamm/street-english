@extends('layouts.app',[
    'title' => 'My Bundles',
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
            
            <div class="content-side col-lg-9">
                {{-- Student Bundles --}}
                <div class="our-courses">
                    <div class="options-view">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h3>My Bundles ({{ $myBundles->count() }})</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row clearfix">
                    @if($myBundles->count() > 0)
                        @foreach ($myBundles as $myBundle)
                        <!-- Cource Block Two -->
                        <div class="cource-block-two col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{ route('student.my-bundle.show', $myBundle->slug) }}"><img src="{{ asset('images/bundles/'.$myBundle->belongsToBundle->id.'/'.$myBundle->belongsToBundle->thumbnail) }}" style="width: 270px;height: 150px;" alt="" /></a>
                                </div>
                                <div class="lower-content">
                                    <h5>
                                        <a style="color: #18a674;" href="{{ route('student.my-bundle.show', $myBundle->slug) }}">{{ $myBundle->belongsToBundle->name }}</a>
                                    </h5>
                                    {{-- <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div> --}}
                                    <div class="clearfix mt-3">
                                        <div class="pull-left">
                                            <div class="students" style="color: #1E284B;">{{  $myBundle->belongsToBundle->bundleCourses->count() }} {{  $myBundle->belongsToBundle->bundleCourses->count() == 1 ? 'Course' : 'Courses' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 jumbotron text-center">
                            <h3>No Bundles Found</h3>
                        </div>
                    @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Profile Section -->
@endsection