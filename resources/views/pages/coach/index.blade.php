@extends('layouts.app', [
    'active' => 'courses',
	'title' => config('app.links.instructors.page'),
    'assets' => 'pages.coach.index',
    'breadcrumb' => [
        'Home' => 'index',
        'Coaches' => 'active',
    ]
])

@section('content')

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
	<div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-1.png') }})"></div>
	<div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-2.png') }})"></div>
	<div class="circle-one"></div>
	<div class="circle-two"></div>
	<div class="auto-container mt-5">
		<div class="row justify-content-center">
			<!-- Content Side -->
			<div class="col-lg-10 col-md-12 col-sm-12">
                <div class="sec-title">
                    <h2>Our Instructors</h2>
                </div>

				<!-- Cource Overview -->
                <div class="course-overview">
                    <div class="row">
                        @foreach($coaches as $coach)
                        <!-- Student Block -->
                        <div class="student-block col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="block-inner">
                                <div class="image">
                                    @if(isset($coach->info) && $coach->info->image !== null)
                                    <img src="{{ asset('public/images/coaches/'.$coach->id.'/'.$coach->info->image) }}" style="width: 278px;height: 319px;" alt="" />
                                    @else
                                    <img src="{{ asset('public/assets/images/avatars/avatar2.png') }}" style="width: 278px;height: 319px;" alt="" />
                                    @endif
                                </div>
                                <h2 class="mb-2 mt-1 pt-0">
                                    <a href="{{ route('instructor.show', $coach->id) }}">{{ $coach->name }}</a>
                                </h2>
                                {{-- <div class="text">Certified instructor Architecture& Developer</div> --}}
                                <div class="social-box">
                                    <a href="{{ isset($coach->info) && $coach->info->facebook !== null ? $coach->info->facebook : 'javascript:void(0);' }}" class="fa fa-facebook-square"></a>
                                    <a href="{{ isset($coach->info) && $coach->info->twitter !== null ? $coach->info->twitter : 'javascript:void(0);' }}" class="fa fa-twitter-square"></a>
                                    <a href="{{ isset($coach->info) && $coach->info->linkedIn !== null ? $coach->info->linkedIn : 'javascript:void(0);' }}" class="fa fa-linkedin-square"></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
			</div>
		</div>
	</div>

    <div class="auto-container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <!-- Post Share Options -->
                <div class="styled-pagination">
                    <ul class="clearfix">
                        {{ $coaches->links() }}
                        {{-- <li class="prev"><a href="#"><span class="fa fa-angle-left"></span> </a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li class="active"><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li class="next"><a href="#"><span class="fa fa-angle-right"></span> </a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection