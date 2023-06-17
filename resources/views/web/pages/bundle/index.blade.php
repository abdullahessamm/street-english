@extends('web.layouts.app', [
    'title' => config('app.links.bundles.page'),
])

@section('content')

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
	<div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-1.png') }})"></div>
	<div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-2.png') }})"></div>
	<div class="circle-one"></div>
	<div class="circle-two"></div>
	<div class="auto-container">
		<div class="row clearfix justify-content-center">
			<!-- Content Side -->
			<div class="content-side col-lg-9 col-md-12 col-sm-12">
				<div class="our-courses">
					<!-- Options View -->
					<div class="options-view">
						<div class="clearfix">
							<div class="pull-left">
								<h3>Browse Bundles</h3>
							</div>
						</div>
					</div>
					
					<div class="row clearfix">
					@if($bundles->count() > 0)
						@foreach ($bundles as $bundle)
						<!-- Cource Block Two -->
						<div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
							<div class="inner-box">
								<div class="image">
									<a href="{{ route('bundle.show', $bundle->slug) }}"><img src="{{ asset('images/bundles/'.$bundle->id.'/'.$bundle->thumbnail) }}" style="width: 270px;height: 150px;" alt="" /></a>
								</div>
								<div class="lower-content">
									<h5><a href="{{ route('bundle.show', $bundle->slug) }}">{{ $bundle->name }}</a></h5>
									{{-- <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div> --}}
									<div class="clearfix">
										<div class="pull-left">
											<div class="students">{{  $bundle->bundleCourses->count() }} {{  $bundle->bundleCourses->count() == 1 ? 'course' : 'courses' }}</div>
										</div>
										<div class="pull-right">
											<div class="hours">{{ $bundle->price }} EGP</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					@else
						<div class="col-12">
							<div class="jumbotron text-center">
								<h2>No Bundles found</h2>
							</div>
						</div>
					@endif
					</div>
					
				</div>
				
			</div>
		</div>
		
		{{-- <!-- Post Share Options -->
		<div class="styled-pagination">
			<ul class="clearfix">
				<li class="prev"><a href="#"><span class="fa fa-angle-left"></span> </a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li class="active"><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li class="next"><a href="#"><span class="fa fa-angle-right"></span> </a></li>
			</ul>
		</div> --}}
		
	</div>
</div>

{{-- <!-- Popular Courses -->
<section class="popular-courses-section">
	<div class="auto-container">
		<div class="sec-title">
			<h2>Most Popular Courses</h2>
		</div>
		
		<div class="row clearfix">
			
			<!-- Cource Block Two -->
			<div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="image">
						<a href="{{ route('bundle.show', $bundle->slug) }}"><img src="https://via.placeholder.com/370x253" alt="" /></a>
					</div>
					<div class="lower-content">
						<h5><a href="{{ route('bundle.show', $bundle->slug) }}">Color Theory</a></h5>
						<div class="text">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters.</div>
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
				<div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="image">
						<a href="{{ route('bundle.show', $bundle->slug) }}"><img src="https://via.placeholder.com/370x253" alt="" /></a>
					</div>
					<div class="lower-content">
						<h5><a href="{{ route('bundle.show', $bundle->slug) }}">Typography</a></h5>
						<div class="text">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters.</div>
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
				<div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="image">
						<a href="{{ route('bundle.show', $bundle->slug) }}"><img src="https://via.placeholder.com/370x253" alt="" /></a>
					</div>
					<div class="lower-content">
						<h5><a href="{{ route('bundle.show', $bundle->slug) }}">Wireframe & Prototyping</a></h5>
						<div class="text">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters.</div>
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
</section>
<!-- End Popular Courses -->

<!-- Call To Action Section Two -->
<section class="call-to-action-section-two" style="background-image: url({{ asset('public/assets/images/background/3.png') }})">
	<div class="auto-container">
		<div class="content">
			<h2>Ready to get started?</h2>
			<div class="text">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two <br> waters own morning gathered greater shall had behold had seed.</div>
			<div class="buttons-box">
				<a href="course.html" class="theme-btn btn-style-one"><span class="txt">Get Stared <i class="fa fa-angle-right"></i></span></a>
				<a href="course.html" class="theme-btn btn-style-two"><span class="txt">All Courses <i class="fa fa-angle-right"></i></span></a>
			</div>
		</div>
	</div>
</section>
<!-- End Call To Action Section Two --> --}}
@endsection