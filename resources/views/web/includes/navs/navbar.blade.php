<!-- Header Upper -->
<div class="header-upper">
	<div class="auto-container">
		<div class="clearfix">
			
			<div class="pull-left logo-box">
				{{-- <div class="logo"><a href="index.html"><img src="https://via.placeholder.com/230x60" alt="" title="Bootcamp"></a></div> --}}
				<div class="logo">
					<a style="color: #18a674;font-weight: bold;" href="{{ url('/') }}">
						<img src="{{ asset('public/assets/images/logo.svg') }}" width="65" height="65"  alt="" title="Bootcamp">
					</a>
				</div>
			</div>
			
			<div class="nav-outer clearfix">
				<!--Mobile Navigation Toggler-->
				<div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
				<!-- Main Menu -->
				<nav class="main-menu show navbar-expand-md">
					<div class="navbar-header">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
						<ul class="navigation clearfix">
							<li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url('/') }}">Home</a>
							</li>
				
							<li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url('about') }}">About Us</a>
							</li>

							{{-- <li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url(config('app.links.courses.courses.route')) }}">{{ config('app.links.courses.courses.page') }}</a>
							</li> --}}

							<li class="dropdown">
								<a href="javascript:void(0);" style="color: #18a674;font-weight: bold;">
									Courses
									<i class="fa fa-arrow-down"></i>
								</a>
								<ul>
									<li><a href="{{ url('courses') }}">Recorded Courses</a></li>
									<li><a href="{{ url('zoom-live-courses') }}">Live Zoom Courses</a></li>
									<li><a href="{{ url('ietls-courses') }}">IETLS Courses</a></li>
								</ul>
							</li>
				
							<li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url('bundles') }}">Bundles</a>
							</li>

							<li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url('free-ebooks') }}">Materials</a>
							</li>
				
							<li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url('blogs') }}">Blogs</a>
							</li>

							<li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url('search/certificates') }}">Certificates</a>
							</li>
				
							<li>
								<a style="color: #18a674;font-weight: bold;" href="{{ url('contact') }}">Contact Us</a>
							</li>
						</ul>
					</div>
					
				</nav>
				
			</div>
			
		</div>
	</div>
</div>
<!-- End Header Upper -->