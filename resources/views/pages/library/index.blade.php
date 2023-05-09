@extends('layouts.app', [
    'title' => 'Library',
    'active' => 'library',
    'breadcrumb' => [
        'title' => 'Library',
        'map' => [
            'Dashboard' => 'home',
            'Library' => 'active',
        ]
    ],
    'header_right' => [
		'href' => [
			'text' => 'Create New Book',
			'route' => 'library.book.create',
			'color' => 'info',
			'bold' => true,
		]
    ]
])

@section('content')
<!-- Content types section start -->
<section id="content-types">
	<div class="row">
		<div class="col-12 mt-3 mb-1">
			<h4 class="text-uppercase">List of all Books</h4>
		</div>
	</div>

	<div class="row match-height">
		@foreach($books as $book)
		<div class="col-xl-4 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-content">
					<img class="card-img-top img-fluid" src="{{ config('app.main_url').'/images/books/'.$book->id.'/cover/'.$book->book_cover }}" alt="{{ $book->book_name }}">
					<div class="card-body">
						<h4 class="card-title">{{ $book->book_name }}</h4>
						<a href="{{ route('library.book.show', [$book->slug]) }}" class="btn btn-outline-pink">See {{ $book->book_name }} info</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</section>
<!-- Content types section end -->
@endsection