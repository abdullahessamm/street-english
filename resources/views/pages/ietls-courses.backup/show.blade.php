@extends('layouts.app', [
    'title' => 'IETLS course : '.$course->name,
	'active' => 'ietls-courses',
    'breadcrumb' => [
        'title' => $course->name,
        'map' => [
            'Dashboard' => 'home',
            'IETLS courses' => 'courses',
            $course->name => 'active'
        ]
    ],
	'header_right' => [
		'href' => [
			'text' => 'Add content for this course',
			'route' => [
				'route' => 'ietls-course.contents',
				'slugs' => $course->slug
			],
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.ietls-courses.show'
])

@section('content')
<!-- Update course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update Course {{ $course->name }}</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updateCourse" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
							<input type="hidden" name="ietls_course_id" id="ietls_course_id" value="{{ $course->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="icon-notebook"></i> Course Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="ietls_course_name">Course Name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="ietls_course_name" class="form-control" name="ietls_course_name" value="{{ $course->name }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">Duration</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="duration" class="form-control" name="duration" value="{{ $course->duration }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="level">Level</label>
									<div class="col-md-9">
		                            	<input type="text" id="level" class="form-control" name="level" value="{{ $course->level }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="language">Language</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="language" class="form-control" name="language" value="{{ $course->language }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Course Price Options </label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="free" value="free" {{ $course->isFree != null ? 'checked' : null }}>
                                            <label class="form-check-label" for="free">Free</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="price" value="price" {{ $course->price != null ? 'checked' : null }}>
                                            <label class="form-check-label" for="price">Course Fee</label>
                                        </div>
										<div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="discount" value="discount" {{ isset($course->discount) ? 'checked' : null }}>
                                            <label class="form-check-label" for="discount">Price with Discount</label>
                                        </div>
										<div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="coupon" value="coupon" {{ isset($course->coupon) ? 'checked' : null }}>
                                            <label class="form-check-label" for="coupon">Discount with Coupon</label>
                                        </div>
		                            </div>
		                        </div>

								<div id="price_option_res"></div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="description">Description</label>
		                            <div class="col-md-9">
                                        <textarea name="description" id="description" required>{{ $course->description }}</textarea>
		                            </div>
		                        </div>

	                    		<h4 class="form-section"><i class="icon-picture"></i> Course Media</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="thumbnail">
										Course Thumbnail
										<br>
										<small><b>recommended size : 307w x 200h</b></small>
									</label>
									<div class="col-md-9">
										<input type="file" id="thumbnail" class="form-control" name="thumbnail">
										<img src="{{ config('app.main_url').'/public/images/ietls-courses/'.$course->id.'/'.$course->thumbnail }}" class="img-fluid" alt="{{ $course->name }}">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="banner">
										Course Banner <b>(OPTIONAL)</b>
										<br>
										<small><b>recommended size : 1920w x 510h</b></small>
									</label>
									<div class="col-md-9">
										<input type="file" id="banner" class="form-control" name="banner">
										@if($course->banner != null)
										<img src="{{ config('app.main_url').'/public/images/ietls-courses/'.$course->id.'/'.$course->banner }}" class="img-fluid" alt="{{ $course->name }}">
										@endif
									</div>
								</div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Course Intro Media </label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="none" value="none" checked>
                                            <label class="form-check-label" for="none">
												{{ $course->media_intro == 'image' ? 'Keep the intro image' : 'Keep the intro video url' }}
											</label>
                                        </div>
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image">
                                            <label class="form-check-label" for="image">Update Image</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                            <label class="form-check-label" for="video">Update Video URL</label>
                                        </div>

										<div class="my-2">
											@switch($course->video_intro_type)
												@case('youtube')
												<div class="embed-responsive embed-responsive-16by9">
													<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$course->video_url}}" allowfullscreen></iframe>
												</div>
												@break

												@case('vimeo')
												<div class="embed-responsive embed-responsive-16by9">
													<iframe src="https://player.vimeo.com/video/{{$course->video_url}}" allow="autoplay; fullscreen" allowfullscreen></iframe>
												</div>
												@break

												@case('drive')
												<div class="embed-responsive embed-responsive-16by9">
													{!!$course->video_url!!}
												</div>
												@break
											@endswitch
										</div>
		                            </div>
		                        </div>

								<div id="media_res"></div>
							</div>

	                        <div class="form-actions">
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="fa fa-remove"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-info mr-1">
	                                <i class="fa fa-check"></i> Update
	                            </button>
								<button type="button" class="btn btn-danger" id="deleteCourse" data-course-id="{{ $course->id }}">
	                                <i class="fa fa-trash"></i> Delete tthis Course
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Update course section end -->

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
<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<i class="fa fa-times text-danger" style="font-size: 100px;"></i>
				<h3>Error Occured</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmdeleteCourseID">
				<h2>Are you sure you want to delete this course ?</h2>
				<h6><b class="text-warning">WARNING:</b> If you delete this course all the contents with it's lessons will be removed. Choose carefully</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmdeleteCourse">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection