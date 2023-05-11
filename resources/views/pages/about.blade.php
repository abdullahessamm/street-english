@extends('layouts.app', [
    'title' => config('app.links.about.page'),
    'styles' => 'pages.about'
])

@section('content')
<!-- Contact Page Section -->
<section class="contact-page-section mb-3 pb-0">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="auto-container mt-5">
        
        <div class='container-fluid mx-auto mt-5 mb-5 col-12 text-center'>
            <h3 style="color: #18a674;">About Us</h3>
            <p class="mb-5" style="font-weight: bold;color: #1E284B;font-size: 15px;">Established in 2017, Street English Academy is a leading educational institution that provides English-language courses with reasonable prices and high-quality services. We aspire to be a leader in developing all English-language learners regardless of their level based on CEFR descriptors to meet the labor market requirements, get the score needed for immigration purposes, generate high-impact education and pursue enlightenment and creativity. </p>
            
            <div class="row">
                <div class="card col-12 mb-2">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 style="color:#18a674;">Our Vision</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12">
                                        <p class="font-weight-bold text-left" style="color: #1E284B;">To create a transformative educational experience for students focused on deeply planned and executed disciplinary language knowledge, problem-solving, leadership, communication, and interpersonal skills.</p>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 text-right" dir="rtl">
                                        <img src="{{ asset('public/assets/images/about/vision.svg') }}" class="img-fluid" style="margin-top: -30px;margin-right: 30px;" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card col-12 mb-2" dir="rtl">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 style="color:#18a674;">Our Mission</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12">
                                        <ol class="text-left" dir="ltr">
                                            <li style="color: #1E284B;" class="font-weight-bold">1. Empower SEA students to become competent participants in the labor market through excellent instruction in language, cultural awareness, and study skills.</li>
                                            <li style="color: #1E284B;" class="font-weight-bold">2. Assist SEA students with their academic and non-academic needs and connect them to the outer world.</li>
                                            <li style="color: #1E284B;" class="font-weight-bold">3. Ensure that SEA students meet their language needs and contribute to a more inclusive community.</li>
                                            <li style="color: #1E284B;" class="font-weight-bold">4. Provide quality courses for learners with specialized English needs and goals.</li>
                                            <li style="color: #1E284B;" class="font-weight-bold">5. Develop and conduct high-quality English language proficiency assessments.</li>
                                            <li style="color: #1E284B;" class="font-weight-bold">6. Prepare our students for international Tests like TOEFL, IELTS, and PTE.</li>
                                        </ol>
                                    </div>
                                    <div class="col-xl-6 col-sm-12">
                                        <img src="{{ asset('public/assets/images/about/mission.svg') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-5 mt-5">
                    <h1 style="color: #18a674;">Our Motto</h1>
                    <p class="mb-5"  style="font-weight: bold;color: #1E284B;font-size: 15px;">Where Dreams Come True</p>
                </div>
             
                {{-- <div class="card col-12 mb-2">
                    <div class="card-content">
                        <div class="card-body"> <img class="img" src="https://i.imgur.com/xUWJuHB.png" />
                            <div class="card-title"> Mission </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> We don't accept ads from anyone. We use actual data to match you who the best person for each job </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-12 ml-2">
                    <div class="card-content">
                        <div class="card-body"> <img class="img" src="https://i.imgur.com/xUWJuHB.png" />
                            <div class="card-title"> Motto </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> We don't accept ads from anyone. We use actual data to match you who the best person for each job </small> </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            
        </div>
    </div>
</section>
<!-- End Contact Page Section -->

<section id="team" class="team_member section-padding mt-3">
	<div class="container">				
		<div class="section-title text-center">
			<h1 style="color: #18a674;" class="mb-5">Team Members</h1>
		</div>				
		<div class="row text-center">
			<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
				<div class="our-team">
					<div class="team_img">
						<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="team-image">
						<ul class="social">
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<div class="team-content">
						<h3 class="title">Stephen Cronin</h3>
						<span class="post">Designer</span>
					</div>
				</div>
			</div><!--- END COL -->														
			<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
				<div class="our-team">
					<div class="team_img">
						<img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="team-image">
						<ul class="social">
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<div class="team-content">
						<h3 class="title">Rachel Park</h3>
						<span class="post">Developer</span>
					</div>
				</div>
			</div><!--- END COL -->
			<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
				<div class="our-team">
					<div class="team_img">
						<img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="team-image">
						<ul class="social">
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<div class="team-content">
						<h3 class="title">Dan Billson</h3>
						<span class="post">Marketer</span>
					</div>
				</div>
			</div><!--- END COL -->
			<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
				<div class="our-team">
					<div class="team_img">
						<img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="team-image">
						<ul class="social">
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<div class="team-content">
						<h3 class="title">Gina Mellow</h3>
						<span class="post">Co-founder</span>
					</div>
				</div>
			</div><!--- END COL -->
			<div class="col-md-3 col-sm-6 col-xs-12">
			</div><!--- END COL -->
			<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
				<div class="our-team">
					<div class="team_img">
						<img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="team-image">
						<ul class="social">
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<div class="team-content">
						<h3 class="title">John Stuart</h3>
						<span class="post">Graphics Expert</span>
					</div>
				</div>
			</div><!--- END COL -->
			<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s" data-wow-offset="0">
				<div class="our-team">
					<div class="team_img">
						<img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="team-image">
						<ul class="social">
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li style="color: #1E284B;" class="font-weight-bold"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<div class="team-content">
						<h3 class="title">Maikel Clark</h3>
						<span class="post">Animator</span>
					</div>
				</div>
			</div><!--- END COL -->				
		</div><!--- END ROW -->
	</div><!--- END CONTAINER -->		
</section>

<section class="mb-5">
    {{-- <div class="container">
        <h3 class="card-title">Timeline Style : Demo-1</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline">
                    <a href="#" class="timeline">
                        <div class="timeline-icon"><i class="fa fa-globe"></i></div>
                        <div class="timeline-content">
                            <h3 class="title">2018</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ducimus officiis quod! Aperiam eveniet nam nostrum odit quasi ullam voluptatum.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="timeline">
                        <div class="timeline-icon"><i class="fa fa-rocket"></i></div>
                        <div class="timeline-content">
                            <h3 class="title">2015</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ducimus officiis quod! Aperiam eveniet nam nostrum odit quasi ullam voluptatum.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="timeline">
                        <div class="timeline-icon"><i class="fa fa-briefcase"></i></div>
                        <div class="timeline-content">
                            <h3 class="title">2012</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ducimus officiis quod! Aperiam eveniet nam nostrum odit quasi ullam voluptatum.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="timeline">
                        <div class="timeline-icon"><i class="fa fa-mobile"></i></div>
                        <div class="timeline-content">
                            <h3 class="title">2009</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate ducimus officiis quod! Aperiam eveniet nam nostrum odit quasi ullam voluptatum.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3 class="card-title">Timeline Style : Demo-2</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline2">
                    <div class="timeline">
                        <a href="#" class="timeline-content">
                            <span class="year">2018</span>
                            <div class="inner-content">
                                <h3 class="title">Web Designer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ex odio, rhoncus sit amet tincidunt eu, suscipit a orci. In suscipit quam eget dui auctor.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="#" class="timeline-content">
                            <span class="year">2017</span>
                            <div class="inner-content">
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ex odio, rhoncus sit amet tincidunt eu, suscipit a orci. In suscipit quam eget dui auctor.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="#" class="timeline-content">
                            <span class="year">2016</span>
                            <div class="inner-content">
                                <h3 class="title">Web Designer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ex odio, rhoncus sit amet tincidunt eu, suscipit a orci. In suscipit quam eget dui auctor.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="#" class="timeline-content">
                            <span class="year">2015</span>
                            <div class="inner-content">
                                <h3 class="title">Web Developer</h3>
                                <p class="description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ex odio, rhoncus sit amet tincidunt eu, suscipit a orci. In suscipit quam eget dui auctor.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3 class="card-title">Timeline Style : Demo-3</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline3">
                    <div class="timeline">
                        <div class="timeline-icon"><span class="year">2018</span></div>
                        <div class="timeline-content">
                            <h3 class="title">Web Desginer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacinia mi ultrices, luctus nunc ut, commodo enim. Vivamus sem erat.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-icon"><span class="year">2017</span></div>
                        <div class="timeline-content">
                            <h3 class="title">Web Developer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacinia mi ultrices, luctus nunc ut, commodo enim. Vivamus sem erat.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-icon"><span class="year">2016</span></div>
                        <div class="timeline-content">
                            <h3 class="title">Web Desginer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacinia mi ultrices, luctus nunc ut, commodo enim. Vivamus sem erat.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-icon"><span class="year">2015</span></div>
                        <div class="timeline-content">
                            <h3 class="title">Web Developer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacinia mi ultrices, luctus nunc ut, commodo enim. Vivamus sem erat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <h1 style="color: #18a674;" class="card-title text-center mb-3">Our History</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline4">
                    <div class="timeline">
                        <span class="timeline-icon"></span>
                        <span class="year">2017</span>
                        <div class="timeline-content">
                            <h3 class="title">Web Desginer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis justo id pulvinar suscipit. Pellentesque rutrum vehicula erat sed dictum. Integer quis turpis magna. Suspendisse tincidunt elit at erat tincidunt, vel vulputate arcu dapibus. Etiam accumsan ornare posuere. Nullam est.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <span class="timeline-icon"></span>
                        <span class="year">2016</span>
                        <div class="timeline-content">
                            <h3 class="title">Web Developer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis justo id pulvinar suscipit. Pellentesque rutrum vehicula erat sed dictum. Integer quis turpis magna. Suspendisse tincidunt elit at erat tincidunt, vel vulputate arcu dapibus. Etiam accumsan ornare posuere. Nullam est.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <span class="timeline-icon"></span>
                        <span class="year">2015</span>
                        <div class="timeline-content">
                            <h3 class="title">Web Desginer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis justo id pulvinar suscipit. Pellentesque rutrum vehicula erat sed dictum. Integer quis turpis magna. Suspendisse tincidunt elit at erat tincidunt, vel vulputate arcu dapibus. Etiam accumsan ornare posuere. Nullam est.
                            </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <span class="timeline-icon"></span>
                        <span class="year">2014</span>
                        <div class="timeline-content">
                            <h3 class="title">Web Developer</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis justo id pulvinar suscipit. Pellentesque rutrum vehicula erat sed dictum. Integer quis turpis magna. Suspendisse tincidunt elit at erat tincidunt, vel vulputate arcu dapibus. Etiam accumsan ornare posuere. Nullam est.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection