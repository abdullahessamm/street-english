@extends('layouts.app', [
	'title' => config('app.links.courses.courses.page'),
	'breadcrumb' => [
        'Home' => 'index',
        'Online Courses' => 'active',
    ]
])

@section('content')
{{-- <!-- Page Title -->
<section class="page-title">
	<div class="auto-container">
		<h1>{{ config('app.links.courses.courses.page') }}</h1>
		
		<!-- Search Boxed -->
		<div class="search-boxed">
			<div class="search-box">
				<form method="post" action="contact.html">
					<div class="form-group">
						<input type="search" name="search-field" value="" placeholder="What do you want to learn?" required>
						<button type="submit"><span class="icon fa fa-search"></span></button>
					</div>
				</form>
			</div>
		</div>
		
	</div>
</section>
<!--End Page Title--> --}}

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
	<div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-1.png') }})"></div>
	<div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url({{ asset('public/assets/images/icons/icon-2.png') }})"></div>
	<div class="circle-one"></div>
	<div class="circle-two"></div>
	<div class="auto-container">
		<div class="row clearfix mt-5">
			
			<!-- Content Side -->
			<div class="content-side col-lg-9 col-md-12 col-sm-12">
				<div class="our-courses">
					<!-- Options View -->
					<div class="options-view">
						<div class="clearfix">
							<div class="pull-left">
								<h3>Browse Courses ({{ $courses->count() }})</h3>
							</div>
						</div>
					</div>
					
					<div class="row clearfix">
					@if($courses->count() > 0)
						@foreach ($courses as $course)
						<!-- Cource Block Two -->
						@if($course->isPublished)
						<div class="cource-block-two col-lg-4 col-md-6 col-sm-12">
							<div class="inner-box">
								<div class="image">
									<a href="{{ route('course.show', $course->slug) }}"><img src="{{ asset('public/images/courses/'.$course->id.'/'.$course->thumbnail) }}" style="width: 270px;height: 150px;" alt="" /></a>
								</div>
								<div class="lower-content">
									<h5>
										<a style="color: #18a674;" href="{{ route('course.show', $course->slug) }}">{{ $course->name }}</a>
									</h5>
									{{-- <div class="text">Replenish of  third creature and meat blessed void a fruit gathered waters.</div> --}}
									<div class="clearfix mt-3">
										<div class="pull-left">
											<div class="students" style="color: #1E284B;">{{  $course->lessons->count() }} {{  $course->lessons->count() == 1 ? 'lesson' : 'lessons' }}</div>
											<small style="color: #1E284B;" class="font-weight-bold">{{ $course->duration }}</small>
										</div>
										<div class="pull-right">
										@if(isset($course->discount) && $course->discount != null)
											<div class="hours">
												{{ $course->discount }} EGP
												<br>
												<small><del class="text-danger">{{ $course->price }} EGP</del></small>
											</div>
										@else
											<div class="hours">{{ $course->price }} EGP</div>
										@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
						@endforeach
					@else
						<div class="col-lg-12 jumbotron text-center">
							<h3>No Course Found</h3>
						</div>
					@endif
					</div>
					
				</div>
				
			</div>
			
			<!-- Sidebar Side -->
			<div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
				<div class="sidebar-inner">
					<aside class="sidebar">
						
						<!-- Filter Widget -->
						<div class="filter-widget">
							<div class="skills-box">
								<!-- Skills Form -->
								<div class="skills-form">
									<form method="post" action="index.html">
										<span>Categories</span>
										
										<!-- Radio Box -->
										<div class="radio-box">
											<input type="radio" name="remember-password" checked id="all"> 
											<label for="all">All</label>
										</div>

										@foreach($coursesCategories as $courseCategory)
										<!-- Radio Box -->
										<div class="radio-box">
											<input type="radio" name="remember-password" id="{{ $courseCategory->id }}"> 
											<label for="{{ $courseCategory->id }}">{{ $courseCategory->category_name }}</label>
										</div>
										@endforeach
										
									</form>
								</div>
								
							</div>
						</div>
						
					</aside>
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
@endsection