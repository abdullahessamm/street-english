@extends('layouts.app', [
    'title' => 'Zoom Course : '.$zoomCourse->title,
	'active' => 'zoom-courses',
    'breadcrumb' => [
        'title' => $zoomCourse->title,
        'map' => [
            'Dashboard' => 'home',
            'Zoom Courses' => 'zoom-courses',
            $zoomCourse->title => 'active'
        ]
    ],
	'header_right' => [
        'btn' => [
            'text' => 'Delete this Zoom Course',
            'color' => 'danger',
            'bold' => true,
            'id' => 'deleteZoomCourse',
            'data' => [
                'zoom-course-id' => $zoomCourse->id
            ]
        ],
	],
    'assets' => 'pages.zoom-courses.show'
])

@section('content')
<!-- Update course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update Zoom Course details</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body row">
						<div class="col-md-8">
							<form id="updateZoomCourseInfo" class="form form-horizontal striped-labels form-bordered">
								{{ csrf_field() }}
								<input type="hidden" name="course_zoom_id" value="{{ $zoomCourse->id }}">
								<div class="form-body">
									<h4 class="form-section"><i class="icon-notebook"></i> Upate Zoom Course Info</h4>
	
									<div class="form-group row">
										<label class="col-md-3 label-control" for="course_zoom_title">Course Zoom title</label>
										<div class="col-md-9">
											<input type="text" id="course_zoom_title" class="form-control" name="course_zoom_title" value="{{ $zoomCourse->title }}" required>
										</div>
									</div>
	
									<div class="form-group row">
										<label class="col-md-3 label-control" for="course_zoom_description">Course Zoom description</label>
										<div class="col-md-9">
											<textarea name="course_zoom_description" id="course_zoom_description" cols="30" rows="10">{!! $zoomCourse->description !!}"</textarea>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-3 label-control" for="private_price">Private Price</label>
										<div class="col-md-9">
											<input type="number" class="form-control" name="private_price" id="private_price" min="0" value="{{ $zoomCourse->private_price }}" required pattern="[0-9]+">
										</div>
									</div>
	
									<div class="form-group row">
										<label class="col-md-3 label-control" for="group_price">Group Price</label>
										<div class="col-md-9">
											<input type="number" class="form-control" name="group_price" id="group_price" min="0" value="{{ $zoomCourse->group_price }}" required pattern="[0-9]+">
										</div>
									</div>
								</div>
	
								<div class="form-actions">
									<button type="submit" class="btn btn-info mr-1">
										<i class="fa fa-check"></i> Update Zoom Course Details
									</button>
								</div>
							</form>
						</div>

						<div class="col-md-4">
							<form id="updateZoomCourseImage">
								{{ csrf_field() }}
								<input type="hidden" name="course_zoom_id" value="{{ $zoomCourse->id }}">
								<div class="form-group">
									<label class="label-control" for="course_zoom_image">Course Zoom Image</label>
									<input type="file" id="course_zoom_image" class="form-control" name="course_zoom_image" required>
									<div class="mt-2 text-center">
										@if($zoomCourse->image == null)
										<div class="jumbotron text-center">
											<h3>No Image Avaliable</h3>
										</div>											
										@else
										<img src="{{ config('app.main_url').'/public/images/zoom-courses/'.$zoomCourse->id.'/'.$zoomCourse->image }}" class="img-fluid" alt="">
										@endif
									</div>
								</div>
	
								<div class="form-actions">
									<button type="submit" class="btn btn-info mr-1">
										<i class="fa fa-check"></i> Update Image
									</button>
									<button type="button" class="btn btn-danger mr-1" data-zoom-course-id="{{ $zoomCourse->id }}" id="removeZoomCourseImage">
										<i class="fa fa-trash"></i> Remove Image
									</button>
								</div>
							</form>
						</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Update course section end -->

<!-- Append uses to this level section start -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Zoom Course {{ $zoomCourse->title }} levels</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
						<form id="appendZoomCourseLevel" class="form form-horizontal striped-labels form-bordered">
							<input type="hidden" name="course_zoom_id" value="{{ $zoomCourse->id }}">
							{{ csrf_field() }}
							<div class="form-group row">
								<label class="col-md-3 label-control" for="course_zoom_description">Levels</label>
	
								<div class="col-md-9 levels">
									<div data-repeater-list="levels">
										<div class="input-group mb-1" data-repeater-item>
											<input type="tel" placeholder="Level 1" class="form-control" name="level_name" required>
											<span class="input-group-append" id="button-addon2">
												<button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
											</span>
										</div>
									</div>
	
									<button type="button" data-repeater-create class="btn btn-primary">
										<i class="ft-plus"></i> Add new level
									</button>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-info mr-1">
									<i class="fa fa-check"></i> Append New Levels
								</button>
							</div>
						</form>

						<hr>

                        <table class="table table-striped table-bordered" id="zoom-course-levels">
                            <thead>
                                <tr>
                                    <th>Level Name</th>
                                    <th>Sessions Numbers</th>
                                    <th>Delete Level</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Level Name</th>
                                    <th>Sessions Numbers</th>
                                    <th>Delete Level</th>
                                    <th>Created at</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Append uses to this level section end -->


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