@extends('web.layouts.app', [
	'title' => 'Live Zoom Courses',
])

@section('content')
<!-- Topics Courses -->
<section class="topics-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="auto-container mt-5">
        <div class="sec-title centered">
            <h2>Choose Zoom Live Course</h2>
            <div class="text">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two <br> waters own morning gathered greater shall had behold had seed.</div>
        </div>
        <div class="row clearfix">
            
            @foreach($zoomCourses as $zoomCourse)
            <!-- Topic Block -->
            <div class="cource-block-two col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a href="{{ route('zoom-live-course.show', $zoomCourse->slug) }}"><img src="{{ $zoomCourse->image }}" style="width: 270px;height: 150px;" alt="{{ $zoomCourse->title }}" /></a>
                    </div>
                    <div class="lower-content">
                        <h5>
                            <a style="color: #18a674;" href="{{ route('zoom-live-course.show', $zoomCourse->slug) }}">{{ $zoomCourse->title }}</a>
                        </h5>
                        <div class="clearfix mt-3">
                            <div class="pull-left">
                                <div class="students" style="color: #1E284B;">{{  $zoomCourse->levels->count() }} {{  $zoomCourse->levels->count() == 1 ? 'Level' : 'Levels' }}</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Topics Courses -->
@endsection