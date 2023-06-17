@extends('web.layouts.app', [
    'active' => 'courses',
	'title' => 'Materials',
    'assets' => 'pages.my-session.index'
])

@section('content')
{{-- <!-- Page Title -->
<section class="page-title">
	<div class="auto-container">
		<h1>{{ config('app.links.ebooks.page') }}</h1>
		
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

<!-- Books Page Section -->
<section class="books-page-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="circle-one"></div>
    <div class="auto-container mt-5">
        <div class="sec-title">
            <h2>Materials</h2>
        </div>
        
        <div class="row justify-content-center clearfix">
            
            <!-- Category Section -->
            <div class="category-column col-lg-8 col-md-12 col-sm-12">
                <div class="inner-column">
                    
                    <div class="content">
                        <div class="row clearfix">
                            @foreach($books as $book)
                            <!-- Book Block -->
                            <div class="book-block col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="{{ $book->book_cover }}" alt="">
                                        <!-- Overlay Box -->
                                        <div class="overlay-box">
                                            <div class="overlay-inner">
                                                <div class="content">
                                                    <a href="{{ route('free-ebook.show', $book->slug) }}" class="link"><span class="icon fa fa-link"></span></a>
                                                    <a href="{{ asset('public/uploads/books/'.$book->id.'/cover/'.$book->book_cover) }}" data-fancybox="books" data-caption="" class="link"><span class="icon flaticon-full-screen"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="lower-box">
                                        <h6><a href="{{ route('free-ebook.show', $book->slug) }}">{{ $book->book_name }}</a></h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Widgets Section -->
            {{-- <div class="widgets-column col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    <h5>Popular Books</h5>
                    <div class="widgets-outer">
                        
                        <!-- Book Widget -->
                        <div class="book-widget">
                            <div class="widget-inner">
                                <div class="image">
                                    <a href="{{ route('free-ebook.show', 'ebook-title') }}"><img src="https://via.placeholder.com/100x120" alt="" /></a>
                                </div>
                                <a class="tag" href="{{ route('free-ebook.show', 'ebook-title') }}"><span class="fa fa-bookmark-o"></span></a>
                                <h6><a href="{{ route('free-ebook.show', 'ebook-title') }}">Don’t Make Me <br> Think</a></h6>
                                <div class="author">By Steve Krug</div>
                            </div>
                        </div>
                        
                        <!-- Book Widget -->
                        <div class="book-widget">
                            <div class="widget-inner">
                                <div class="image">
                                    <a href="{{ route('free-ebook.show', 'ebook-title') }}"><img src="https://via.placeholder.com/100x120" alt="" /></a>
                                </div>
                                <a class="tag" href="{{ route('free-ebook.show', 'ebook-title') }}"><span class="fa fa-bookmark-o"></span></a>
                                <h6><a href="{{ route('free-ebook.show', 'ebook-title') }}">Essential of <br> Interaction Design</a></h6>
                                <div class="author">By Alan Cooper</div>
                            </div>
                        </div>
                        
                        <!-- Book Widget -->
                        <div class="book-widget">
                            <div class="widget-inner">
                                <div class="image">
                                    <a href="{{ route('free-ebook.show', 'ebook-title') }}"><img src="https://via.placeholder.com/100x120" alt="" /></a>
                                </div>
                                <a class="tag" href="{{ route('free-ebook.show', 'ebook-title') }}"><span class="fa fa-bookmark-o"></span></a>
                                <h6><a href="{{ route('free-ebook.show', 'ebook-title') }}">Non Designers <br> Design Book</a></h6>
                                <div class="author">By Robin Williams</div>
                            </div>
                        </div>
                        
                        <!-- Book Widget -->
                        <div class="book-widget">
                            <div class="widget-inner">
                                <div class="image">
                                    <a href="{{ route('free-ebook.show', 'ebook-title') }}"><img src="https://via.placeholder.com/100x120" alt="" /></a>
                                </div>
                                <a class="tag" href="{{ route('free-ebook.show', 'ebook-title') }}"><span class="fa fa-bookmark-o"></span></a>
                                <h6><a href="{{ route('free-ebook.show', 'ebook-title') }}">Sketching User <br> Experience</a></h6>
                                <div class="author">By Bill Buxton</div>
                            </div>
                        </div>
                        
                        <!-- Book Widget -->
                        <div class="book-widget">
                            <div class="widget-inner">
                                <div class="image">
                                    <a href="{{ route('free-ebook.show', 'ebook-title') }}"><img src="https://via.placeholder.com/100x120" alt="" /></a>
                                </div>
                                <a class="tag" href="{{ route('free-ebook.show', 'ebook-title') }}"><span class="fa fa-bookmark-o"></span></a>
                                <h6><a href="{{ route('free-ebook.show', 'ebook-title') }}">Rocket Surgery <br> Made Easy</a></h6>
                                <div class="author">By Steve Krug</div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> --}}
            
        </div>
    </div>
</section>
<!-- End Books Page Section -->
@endsection