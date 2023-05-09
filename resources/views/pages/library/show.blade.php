@extends('layouts.app', [
    'title' => 'Book : '.$book->book_name,
    'active' => 'library',
    'breadcrumb' => [
        'title' => 'Book : '.$book->book_name,
        'map' => [
            'Dashboard' => 'home',
            'Library' => 'library',
            'Book : '.$book->book_name => 'active',
        ]
    ],
    'assets' => 'pages.library.show',
    'header_right' => [
        'btn' => [
            'text' => 'Delete this Book',
            'color' => 'danger',
            'bold' => true,
            'id' => 'deleteBook',
            'data' => [
                'book-id' => $book->id
            ]
        ],
    ]
])

@section('content')
<!-- Show book data section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">{{ 'Book : '.$book->book_name }}</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updateBookInfo" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-book"></i> Book Info</h4>
			                    
                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="book_name">Book Name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="book_name" class="form-control" placeholder="e.g. Physics Book" name="book_name" value="{{ $book->book_name }}" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="page_number">Pages number <b>( OPTIONAL )</b></label>
		                            <div class="col-md-9">
		                            	<input type="number" id="page_number" class="form-control" placeholder="190" name="page_number" value="{{ $book->page_number }}">
		                            </div>
		                        </div>

                                {{-- <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="short_description">Short Description</label>
		                            <div class="col-md-9">
                                        <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="3" required>{{ $book->short_description }}</textarea>
		                            </div>
		                        </div> --}}

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="summary">Summary</label>
		                            <div class="col-md-9">
                                        <textarea name="summary" id="summary" required>{{ $book->summary }}</textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="book_cover">
                                        Book Cover
                                        <br>
                                        <small><b>recommended size : 800w x 533h</b></small>
                                    </label>
		                            <div class="col-md-9">
                                        <img src="{{ config('app.main_url').'/public/uploads/books/'.$book->id.'/cover/'.$book->book_cover }}" class="img-fluid" alt="{{ $book->book_name }}">
		                            	<input type="file" id="book_cover" class="form-control" name="book_cover">
		                            </div>
		                        </div>

                                {{-- <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="book_background">
                                        Book Background
                                        <br>
                                        <small><b>recommended size : 1600w x 800h</b></small>
                                    </label>
		                            <div class="col-md-9">
                                        <img src="{{ config('app.main_url').'/public/uploads/books/'.$book->id.'/background/'.$book->book_background }}" class="img-fluid" alt="{{ $book->book_name }}">
		                            	<input type="file" id="book_background" class="form-control" name="book_background">
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Choose Book Type</label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseBookType" type="radio" name="choose_book_type" id="pdf" value="pdf" {{ $book->book_type == 'pdf' ? 'checked' : null }}>
                                            <label class="form-check-label" for="pdf">PDF</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseBookType" type="radio" name="choose_book_type" id="drive" value="drive" {{ $book->book_type == 'drive' ? 'checked' : null }}>
                                            <label class="form-check-label" for="drive">Google Drive Link</label>
                                        </div>
		                            </div>
		                        </div> --}}


								<div id="book_type_res"></div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="book">
                                        Book PDF
                                    </label>
		                            <div class="col-md-9">
                                        <p>
                                        @if($book->book_type == 'drive')
                                            <a href="{{ $book->book  }}" target="_blank">Go to book link</a>
                                        @else
                                            <a href="{{ config('app.main_url').'/public/uploads/books/'.$book->id.'/book/'.$book->book }}" target="_blank">Go to book link</a>
                                        @endif
                                        </p>
		                            </div>
		                        </div>
                                

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="download_avaliable">
                                        Download Avaliable
                                    </label>
		                            <div class="col-md-9">
		                            	<input type="checkbox" id="download_avaliable" name="download_avaliable" class="switchery" data-color="success" {{ $book->download_avaliable == 1 ? 'checked' : '' }} />
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="submit" class="btn btn-warning">
	                                <i class="fa fa-check"></i> update
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Show book data section end -->

<!-- Loading Modal -->
<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                <div class="progress text-right">
                    <div id="progressbar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <div id="res"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>
@endsection