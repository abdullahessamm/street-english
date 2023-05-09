@extends('layouts.app', [
    'title' => 'Zoom Course : '.$zoomCourseLevel->title,
	'active' => 'zoom-courses',
    'breadcrumb' => [
        'title' => $zoomCourseLevel->title,
        'map' => [
            'Dashboard' => 'home',
            'Zoom Courses' => 'zoom-courses',
            $zoomCourseLevel->belongsToZoomCourse->title => [
				'route' => 'zoom-course.show',
				'slug' => $zoomCourseLevel->belongsToZoomCourse->slug
			],
            $zoomCourseLevel->title => 'active'
        ]
    ],
    'assets' => 'pages.zoom-courses.level'
])

@section('content')
<!-- Update course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update {{ $zoomCourseLevel->title }} details</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
						<form id="updateZoomCourseLevelInfo" class="form form-horizontal striped-labels form-bordered">
							{{ csrf_field() }}
							<input type="hidden" name="zoom_course_level_id" value="{{ $zoomCourseLevel->id }}">
							<div class="form-body">
								<h4 class="form-section"><i class="icon-notebook"></i> Upate {{ $zoomCourseLevel->title }} Info</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="course_zoom_title">Course Zoom title</label>
									<div class="col-md-9">
										<input type="text" id="course_zoom_title" class="form-control" name="course_zoom_title" value="{{ $zoomCourseLevel->title }}" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="course_zoom_description">Course Zoom description</label>
									<div class="col-md-9">
										<textarea name="course_zoom_description" id="course_zoom_description" cols="30" rows="10">{!! $zoomCourseLevel->description !!}"</textarea>
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
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Update course section end -->

<!-- Update course section start -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Zoom Course Level - {{ $zoomCourseLevel->title }} - Users</h4>
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
						<form id="appendUsersInZoomCourseLevel">
							{{ csrf_field() }}
							<input type="hidden" name="zoom_course_level_id" value="{{ $zoomCourseLevel->id }}">
							<div class="modal-body">
								<select class="selectize-multiple" name="users[]" multiple>
								@foreach($zoomCourse->enrolledStudents as $eachEnrolledtudent)
									<option value="{{ $eachEnrolledtudent->id }}">{{ $eachEnrolledtudent->belongsToStudent->name.' - '.$eachEnrolledtudent->belongsToStudent->email }}</option>
								@endforeach
								</select>
							</div>
				
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Append</button>
							</div>
						</form>
						<hr>

                        <table class="table table-striped table-bordered" id="zoom-course-level-users">
                            <thead>
                                <tr>
                                    <th>Username </th>
                                    <th>Joined at</th>
									<th>Remove User</th>
                                </tr>
                            </thead>
                            <tbody>
							@foreach($zoomCourseLevel->users as $eachCourseLevelUser)
								<tr id="tr_{{$eachCourseLevelUser->id}}">
									<td>{{ $eachCourseLevelUser->belongsToEnrolledZoomCourseUser->belongsToStudent->name }}</td>
									<td>{{ date("Y-m-d h:i a", $eachCourseLevelUser->belongsToEnrolledZoomCourseUser->create_at) }}</td>
									<td>
										<button class="btn btn-danger btn-sm remove-user" data-zoom-course-level-user-id="{{ $eachCourseLevelUser->id }}">Delete User</button>
									</td>
								</tr>
							@endforeach
							</tbody>
                            <tfoot>
                                <tr>
                                    <th>Username </th>
                                    <th>Joined at</th>
									<th>Remove User</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Update course section end -->

<!-- Update course section start -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Zoom Course  - {{ $zoomCourseLevel->title }} - Sessions</h4>
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
						<form id="appendZoomCourseLevelSessions" class="form form-horizontal striped-labels form-bordered">
							<input type="hidden" name="zoom_course_level_id" value="{{ $zoomCourseLevel->id }}">
							{{ csrf_field() }}
							<div class="form-group row">
								<label class="col-md-3 label-control" for="course_zoom_description">Sessions</label>
	
								<div class="col-md-9 sessions">
									<div data-repeater-list="sessions">
										<div class="input-group mb-1" data-repeater-item>
											<input type="tel" placeholder="Session 1" class="form-control" name="session_name" required>
											<span class="input-group-append" id="button-addon2">
												<button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
											</span>
										</div>
									</div>
	
									<button type="button" data-repeater-create class="btn btn-primary">
										<i class="ft-plus"></i> Add new session
									</button>
								</div>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-info mr-1">
									<i class="fa fa-check"></i> Append New Sessions
								</button>
							</div>
						</form>

						<hr>

                        <table class="table table-striped table-bordered" id="zoom-course-level-sessions">
                            <thead>
                                <tr>
                                    <th>Session Name</th>
                                    <th>Delete Session</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Session Name</th>
                                    <th>Delete Session</th>
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