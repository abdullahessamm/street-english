@extends('layouts.app', [
    'title' => 'Training course : '.$trainingCourse->name,
	'active' => 'training-courses',
    'breadcrumb' => [
        'title' => $trainingCourse->name,
        'map' => [
            'Dashboard' => 'home',
            'Training Courses' => 'training-courses',
            $trainingCourse->name => 'active'
        ]
    ],
	'header_right' => [
		'href' => [
			'text' => 'Add content for this Training Course',
			'route' => [
				'route' => 'training-course.contents',
				'slugs' => $trainingCourse->slug
			],
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.training-courses.show'
])

@section('content')
<!-- Update course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update Course {{ $trainingCourse->name }}</h4>
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
							<input type="hidden" name="training_course_id" id="training_course_id" value="{{ $trainingCourse->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="icon-notebook"></i> Course Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="training_course_name">Course Name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="training_course_name" class="form-control" name="training_course_name" value="{{ $trainingCourse->name }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">Duration</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="duration" class="form-control" name="duration" value="{{ $trainingCourse->duration }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="level">Level</label>
		                            <div class="col-md-9">
										<select name="level" class="form-control" id="level">
											<option value="Basic" {{ $trainingCourse->level == 'Basic' ? 'selected' : '' }}>Basic</option>
											<option value="Intermediate" {{ $trainingCourse->level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
											<option value="Adavanced" {{ $trainingCourse->level == 'Adavanced' ? 'selected' : '' }}>Adavanced</option>
										</select>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="language">Language</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="language" class="form-control" name="language" value="{{ $trainingCourse->language }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="training_course_category_id">Choose Category</label>
		                            <div class="col-md-9">
										<select class="select2 form-control" id="training_course_category_id" name="training_course_category_id">
											@foreach($trainingCourseCategories as $trainingCourseCategory)
											<option value="{{ $trainingCourseCategory->id }}" {{ $trainingCourseCategory->id == $trainingCourse->training_course_category_id ? "selected" : null }}>{{ $trainingCourseCategory->category_name }}</option>
											@endforeach
										</select>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">Price</label>
		                            <div class="col-md-9">
		                            	<input type="number" min="0" id="price" class="form-control" name="price" value="{{ $trainingCourse->price }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="discount">Discount <b>(OPTIONAL)</b></label>
		                            <div class="col-md-9">
		                            	<input type="number" min="0" max="100" id="discount" class="form-control" value="{{ $trainingCourse->discount }}" name="discount">
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="description">Description</label>
		                            <div class="col-md-9">
                                        <textarea name="description" id="description" required>{{ $trainingCourse->description }}</textarea>
		                            </div>
		                        </div>

								<h4 class="form-section"><i class="icon-clock"></i> Date & time </h4>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="date">Date</label>
		                            <div class="col-md-9">
										<input type="date" class="form-control" name="date" id="date" value="{{ $trainingCourse->date }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="start_time">Start at</label>
		                            <div class="col-md-9">
										<input type="time" class="form-control" name="start_time" id="start_time" value="{{ $trainingCourse->start_time }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="end_time">Ent at</label>
		                            <div class="col-md-9">
										<input type="time" class="form-control" name="end_time" id="end_time" value="{{ $trainingCourse->end_time }}" required>
		                            </div>
		                        </div>

								<h4 class="form-section"><i class="icon-map"></i> Location </h4>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="map">
										Google Map
										<br>
										<small>Optional</small>
									</label>
                                    <div class="col-md-9">
										<textarea dir="ltr" name="map" class="form-control" id="map" cols="30" rows="10">{{ $trainingCourse->map }}</textarea>
										{!! $trainingCourse->map !!}
		                            </div>
		                        </div>

	                    		<h4 class="form-section"><i class="icon-picture"></i> Course Media</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="thumbnail">
										Course Thumbnail
										<br>
										<small><b>recommended size : 383w x 238h</b></small>
									</label>
									<div class="col-md-9">
										<input type="file" id="thumbnail" class="form-control" name="thumbnail">
										<img src="{{ config('app.main_url').'/images/training-courses/'.$trainingCourse->id.'/'.$trainingCourse->thumbnail }}" class="img-fluid" alt="{{ $trainingCourse->name }}">
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
										@if($trainingCourse->banner != null)
										<img src="{{ config('app.main_url').'/images/training-courses/'.$trainingCourse->id.'/'.$trainingCourse->banner }}" class="img-fluid" alt="{{ $trainingCourse->name }}">
										@endif
									</div>
								</div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Course Intro Media </label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="none" value="none" checked>
                                            <label class="form-check-label" for="none">
												{{ $trainingCourse->media_intro == 'image' ? 'Keep the intro image' : 'Keep the intro video url' }}
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
								<button type="button" class="btn btn-danger" id="deleteCourse" data-training-course-id="{{ $trainingCourse->id }}">
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