@extends('layouts.app', [
    'title' => 'Create New Post',
    'active' => 'blogs',
    'breadcrumb' => [
        'title' => 'Create New Post',
        'map' => [
            'Dashboard' => 'home',
            'Blogs' => 'blogs',
            'Create New Post' => 'active',
        ]
    ],
    'assets' => 'pages.blogs.create'
])

@section('content')
<!-- Create new book section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create new Post</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewPost" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-edit"></i> Blog Data</h4>
			                    
                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="title">Post Title</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="title" class="form-control" name="title" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="short_description">Short Description</label>
		                            <div class="col-md-9">
                                        <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="3" maxlength="160" required></textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="content">Content</label>
		                            <div class="col-md-9">
                                        <textarea name="content" id="content" required></textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="background_cover">
                                        Background Cover
                                        <br>
                                        <small><b>recommended size : 1600w x 800h</b></small>
                                    </label>
		                            <div class="col-md-9">
		                            	<input type="file" id="background_cover" class="form-control" name="background_cover">
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="choose_media">
                                        Choose Media
                                    </label>
		                            <div class="col-md-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image" checked>
                                            <label class="form-check-label" for="image">Image</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                            <label class="form-check-label" for="video">Video</label>
                                        </div>
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="none" value="none">
                                            <label class="form-check-label" for="none">None</label>
                                        </div>
		                            </div>
		                        </div>

                                <div id="media_res"></div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="category">
                                        Choose Category
                                    </label>
		                            <div class="col-md-9">
										<select class="select2 form-control" id="category" name="category">
										@foreach($categories as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
										</select>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="posted_at">
                                        Posted at
										<br>
										<small><b>OPTIONAL</b></small>
                                    </label>
		                            <div class="col-md-9">
										<input type="date" class="form-control" name="posted_at" id="posted_at">
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
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<span class="fa fa-times text-danger" style="font-size: 100px;"></span>
				<h1>Error Occured</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection