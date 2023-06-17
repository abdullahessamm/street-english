@extends('web.layouts.app', [
    'active' => 'courses',
	'title' => $book->book_name,
    'assets' => 'pages.my-session.index'
])

@section('content')
<!-- Books Detail Section -->
<section class="books-detail-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="circle-one"></div>
    <div class="auto-container" style="margin-top: 50px;">
        <div class="row clearfix">
            
            <!-- Info Section -->
            <div class="info-column col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="image">
                        <img src="{{ asset('public/uploads/books/'.$book->id.'/cover/'.$book->book_cover) }}" alt="" />
                    </div>
                    @if($book->book_type == 'drive')
                    <a href="{{ $book->book }}" download="{{$book->book_name}}" class="theme-btn btn-style-two"><span class="txt">Download <i class="fa fa-download"></i></span></a>                        
                    @else
                    <a href="{{ $book->book }}" download="{{$book->book_name}}" class="theme-btn btn-style-two"><span class="txt">Download <i class="fa fa-download"></i></span></a>
                    @endif
                </div>
            </div>
            
            <!-- Content Section -->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
                <div class="inner-column">
                    <h2>{{ $book->book_name }}</h2>
                    <h4>Description</h4>
                    {!! $book->summary !!}
                </div>
            </div>
            
        </div>
        
    </div>
    
</section>
<!-- End Books Page Section -->
@endsection