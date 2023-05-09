@extends('layouts.app', [
    'title' => 'Create New Book',
    'active' => 'library',
    'breadcrumb' => [
        'title' => 'Create New Book',
        'map' => [
            'Dashboard' => 'home',
			'Library' => 'library',
            'Create New Book' => 'active',
        ]
    ],
    'assets' => 'pages.library.create'
])

@section('content')
<!-- Create new book section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create new Book</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewBook" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-book"></i> Book Info</h4>
			                    
                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="book_name">Book Name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="book_name" class="form-control" placeholder="e.g. Physics Book" name="book_name" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="page_number">Pages number <b>( OPTIONAL )</b></label>
		                            <div class="col-md-9">
		                            	<input type="number" id="page_number" class="form-control" placeholder="190" name="page_number">
		                            </div>
		                        </div>

                                {{-- <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="short_description">Short Description</label>
		                            <div class="col-md-9">
                                        <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="3" required></textarea>
		                            </div>
		                        </div> --}}

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="summary">Summary</label>
		                            <div class="col-md-9">
                                        <textarea name="summary" id="summary" required></textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="book_cover">
                                        Book Cover
                                        <br>
                                        <small><b>recommended size : 800w x 533h</b></small>
                                    </label>
		                            <div class="col-md-9">
		                            	<input type="file" id="book_cover" class="form-control" name="book_cover" required>
		                            </div>
		                        </div>

                                {{-- <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="book_background">
                                        Book Background
                                        <br>
                                        <small><b>recommended size : 1600w x 800h</b></small>
                                    </label>
		                            <div class="col-md-9">
		                            	<input type="file" id="book_background" class="form-control" name="book_background" required>
		                            </div>
		                        </div> --}}


								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Choose Book Type</label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseBookType" type="radio" name="choose_book_type" id="pdf" value="pdf" checked>
                                            <label class="form-check-label" for="pdf">PDF</label>
                                        </div>
                                        {{-- <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseBookType" type="radio" name="choose_book_type" id="drive" value="drive">
                                            <label class="form-check-label" for="drive">Google Drive Link</label>
                                        </div> --}}
		                            </div>
		                        </div>


								<div id="book_type_res"></div>
                                

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="download_avaliable">
                                        Download Avaliable
                                    </label>
		                            <div class="col-md-9">
		                            	<input type="checkbox" id="download_avaliable" name="download_avaliable" class="switchery" data-color="success" checked/>
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="button" class="btn btn-warning mr-1">
	                            	<i class="fa fa-remove"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-check"></i> Save
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create new book section end -->

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

<!-- Error Modal -->
<div class="modal" id="resModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<i class="fa fa-times text-danger" style="font-size: 100px;"></i>
				<h3>Error 405</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>
@endsection