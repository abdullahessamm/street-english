@extends('layouts.app', [
    'title' => 'Post - '.$post->title,
    'active' => 'blogs',
    'breadcrumb' => [
        'title' => 'Post - '.$post->title,
        'map' => [
            'Dashboard' => 'home',
            'Blogs' => 'blogs',
            'Post : '.$post->title => 'active',
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'Delete this post',
			'id' => 'deletePost',
            'data' => [
                'post-id' => $post->id
            ],
			'color' => 'danger',
			'bold' => true,
		]
    ],
    'assets' => 'pages.blogs.show'
])

@section('content')
<!-- Create new book section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">{{ 'Post : '.$post->title }}</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updatePost" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-edit"></i> Blog Data</h4>
			                    
                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="title">Post Title</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="title" class="form-control" name="title" value="{{ $post->title }}" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="short_description">Short Description</label>
		                            <div class="col-md-9">
                                        <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="3" maxlength="160" required>{{ $post->short_description }}</textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="content">Content</label>
		                            <div class="col-md-9">
                                        <textarea name="content" id="content" required>{{ $post->content }}</textarea>
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
										<img src="{{ config('app.main_url').'/public/uploads/blogs/'.$post->id.'/'.$post->image }}" class="img-fluid" alt="">
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="choose_media">
                                        Update Media
                                    </label>
		                            <div class="col-md-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="none" value="none" checked>
                                            <label class="form-check-label" for="none">
                                                Keep the main {{ $post->media_type == 'image' ? 'image' : 'youtube video' }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image">
                                            <label class="form-check-label" for="image">Image</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                            <label class="form-check-label" for="video">Video</label>
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
											<option value="">Pick a category</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}" {{ $category->id == $post->post_category_id ? 'selected' : ''}}>{{ $category->name }}</option>
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
										<input type="date" class="form-control" name="posted_at" id="posted_at" value="{{ $post->posted_at }}">
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="submit" class="btn btn-warning">
	                                <i class="fa fa-check"></i> Update
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
@endsection