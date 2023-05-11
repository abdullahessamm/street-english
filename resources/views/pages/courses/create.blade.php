@extends('layouts.app', [
    'title' => 'Create new Online Course',
	'active' => 'courses',
    'breadcrumb' => [
        'title' => 'Create new Online Course',
        'map' => [
            'Dashboard' => 'home',
            'Online Courses' => 'courses',
            'Create new Online Course' => 'active'
        ]
    ],
    'assets' => 'pages.courses.create'
])

@section('content')
<!-- Create online course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create Course details</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewCourse" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="icon-notebook"></i> Course Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="course_name">Course Name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="course_name" class="form-control" name="course_name" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="duration">Duration</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="duration" class="form-control" name="duration" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="level">Level</label>
									<div class="col-md-9">
		                            	<input type="text" id="level" class="form-control" name="level" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="language">Language</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="language" class="form-control" name="language" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="course_category_id">Choose Category</label>
		                            <div class="col-md-9">
										<select class="select2 form-control" id="course_category_id" name="course_category_id">
											@foreach($courseCategories as $courseCategory)
											<option value="{{ $courseCategory->id }}">{{ $courseCategory->category_name }}</option>
											@endforeach
										</select>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Course Price Options </label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="free" value="free" checked>
                                            <label class="form-check-label" for="free">Free</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="price" value="price">
                                            <label class="form-check-label" for="price">Price</label>
                                        </div>
										<div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="discount" value="discount">
                                            <label class="form-check-label" for="discount">Price with Discount</label>
                                        </div>
										<div class="form-check form-check-inline">
                                            <input class="form-check-input choosePriceOption" type="radio" name="choose_price_option" id="coupon" value="coupon">
                                            <label class="form-check-label" for="coupon">Discount with Coupon</label>
                                        </div>
		                            </div>
		                        </div>

								<div id="price_option_res"></div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="description">Description</label>
		                            <div class="col-md-9">
                                        <textarea name="description" id="description" required></textarea>
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
										<input type="file" id="thumbnail" class="form-control" name="thumbnail" required>
									</div>
								</div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Course Intro Media </label>
                                    <div class="col-md-9">
										<div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="image" value="image" checked>
                                            <label class="form-check-label" for="image">Image</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input chooseMedia" type="radio" name="choose_media" id="video" value="video">
                                            <label class="form-check-label" for="video">Video URL</label>
                                        </div>
		                            </div>
		                        </div>

								<div id="media_res"></div>

	                    		<h4 class="form-section"><i class="icon-user"></i> Course Instructor</h4>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">Choose coach(es)</label>
                                    <div class="col-md-9">
										<select multiple="multiple" name="coaches[]" size="10" class="duallistbox">
										@foreach($coaches as $coach)
											<option value="{{ $coach->id }}">{{ $coach->name }}</option>
										@endforeach
										</select>
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="fa fa-remove"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-check"></i> Create
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create online course section end -->

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
<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endsection