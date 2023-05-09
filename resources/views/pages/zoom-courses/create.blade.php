@extends('layouts.app', [
    'title' => 'Create new Zoom Course',
	'active' => 'courses',
    'breadcrumb' => [
        'title' => 'Create new Zoom Course',
        'map' => [
            'Dashboard' => 'home',
            'Zoom Courses' => 'zoom-courses',
            'Create new Zoom Course' => 'active'
        ]
    ],
    'assets' => 'pages.zoom-courses.create'
])

@section('content')
<!-- Create Zoom Course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create Zoom Course details</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewZoomCourse" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="icon-notebook"></i> Course Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="course_zoom_title">Course Zoom title</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="course_zoom_title" class="form-control" name="course_zoom_title" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="course_zoom_image">Course Zoom Image</label>
		                            <div class="col-md-9">
		                            	<input type="file" id="course_zoom_image" class="form-control" name="course_zoom_image" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="course_zoom_description">Course Zoom description</label>
		                            <div class="col-md-9">
										<textarea name="course_zoom_description" id="course_zoom_description" cols="30" rows="10"></textarea>
		                            </div>
		                        </div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="private_price">Private Price</label>
									<div class="col-md-9">
                                        <input type="number" class="form-control" name="private_price" id="private_price" min="0" required pattern="[0-9]+">
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-md-3 label-control" for="group_price">Group Price</label>
									<div class="col-md-9">
                                        <input type="number" class="form-control" name="group_price" id="group_price" min="0" required pattern="[0-9]+">
									</div>
								</div>

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
<!-- // Create Zoom Course section end -->

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