<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Responsive -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title>
	@isset($title)
		{{ $title }}
	@else
		{{ config('app.name') }}
	@endisset
	</title>

	@include('web.includes.assets.styles')

	<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
	<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body >

<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	
    <!-- Main Header-->
    <header class="main-header header-style-one">
		<!-- Header Top -->
        @include('web.includes.navs.top-header')
		
    	<!-- Header Upper -->
        @include('web.includes.navs.navbar')
        <!-- End Header Upper -->
        
		<!-- Mobile Menu  -->
        @include('web.includes.navs.mobile-nav')
		<!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->
	
	<main>
		@yield('content')
	</main>
	
	<!--Main Footer-->
    @include('web.includes.footer')
	
</div>
<!--End pagewrapper-->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-circle-up"></span></div>

<!-- Header Search -->
<div class="search-popup">
	<button class="close-search style-two"><span class="flaticon-multiply"></span></button>
	<button class="close-search"><span class="flaticon-up-arrow"></span></button>
	<form method="post" action="blog.html">
		<div class="form-group">
			<input type="search" name="search-field" value="" placeholder="Search Here" required="">
			<button type="submit"><i class="fa fa-search"></i></button>
		</div>
	</form>
</div>
<!-- End Header Search -->

<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

@include('web.includes.assets.scripts')
</body>
</html>