@extends('layouts.app', [
    'title' => 'Zoom Course : '.$zoomCourseLevelSession->title,
	'active' => 'zoom-courses',
    'breadcrumb' => [
        'title' => $zoomCourseLevelSession->title,
        'map' => [
            'Dashboard' => 'home',
            'Zoom Courses' => 'zoom-courses',
            $zoomCourseLevelSession->belongsToZoomCourseLevel->belongsToZoomCourse->title => [
				'route' => 'zoom-course.show',
				'slug' => $zoomCourseLevelSession->belongsToZoomCourseLevel->belongsToZoomCourse->slug
			],
            $zoomCourseLevelSession->belongsToZoomCourseLevel->title => [
				'route' => 'zoom-course.level.show',
				'slug' => [
                    $zoomCourseLevelSession->belongsToZoomCourseLevel->belongsToZoomCourse->slug,
                    $zoomCourseLevelSession->belongsToZoomCourseLevel->slug,
                ]
			],
            $zoomCourseLevelSession->title => 'active'
        ]
    ],
    'assets' => 'pages.zoom-courses.session'
])

@section('content')
<!-- Update course section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update {{ $zoomCourseLevelSession->title }} details</h4>
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
						<form id="updateZoomCourseLevelSessionInfo" class="form form-horizontal striped-labels form-bordered">
							{{ csrf_field() }}
							<input type="hidden" name="zoom_course_level_session_id" value="{{ $zoomCourseLevelSession->id }}">
							<div class="form-body">
								<h4 class="form-section"><i class="icon-notebook"></i> Upate {{ $zoomCourseLevelSession->title }} Info</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="course_zoom_title">Course Zoom title</label>
									<div class="col-md-9">
										<input type="text" id="course_zoom_title" class="form-control" name="course_zoom_title" value="{{ $zoomCourseLevelSession->title }}" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="course_zoom_description">Course Zoom description</label>
									<div class="col-md-9">
										<textarea name="course_zoom_description" id="course_zoom_description" cols="30" rows="10">{!! $zoomCourseLevelSession->description !!}"</textarea>
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

<!-- Append New Students in Zoom Course Session section start -->
{{-- <section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Zoom Course Session - {{ $zoomCourseLevelSession->title }} - Users</h4>
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
						<form id="appendUsersInZoomCourseSession">
							{{ csrf_field() }}
							<input type="hidden" name="zoom_course_session_id" value="{{ $zoomCourseLevelSession->id }}">
							<div class="modal-body">
								<select class="selectize-multiple" name="users[]" multiple>
								@foreach($zoomCourseLevelSession->belongsToZoomCourseLevel->users as $eachEnrolledtudent)
									<option value="{{ $eachEnrolledtudent->id }}">{{ $eachEnrolledtudent->belongsToEnrolledZoomCourseUser->belongsToStudent->name.' - '.$eachEnrolledtudent->belongsToEnrolledZoomCourseUser->belongsToStudent->email }}</option>
								@endforeach
								</select>
							</div>
				
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Append</button>
							</div>
						</form>

                        <hr>

                        <table class="table table-striped table-bordered" id="zoom-course-session-users">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Joined at</th>
                                    <th>Remove user</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($zoomCourseLevelSession->users as $eachCourseSessionUser)
                                <tr>
                                    <td>{{ $eachCourseSessionUser->belongsToZoomCourseLevelUser->belongsToEnrolledZoomCourseUser->belongsToStudent->name }}</td>
                                    <td>{{ date('Y-m-d h:i a', strtotime($eachCourseSessionUser->belongsToZoomCourseLevelUser->belongsToEnrolledZoomCourseUser->create_at)) }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm">Remove User</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Username</th>
                                    <th>Joined at</th>
                                    <th>Remove user</th>
                                </tr>
                            </tfoot>
                        </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section> --}}
<!-- // Append New Students in Zoom Course Session section end -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Zoom User's Excercises</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>See User Answers</th>
                                <th>Has been corrected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exerciseUsers as $exerciseUser)
                            <tr>
                                <td>{{ $exerciseUser->belongsToLiveCourseUser->name }}</td>
                                <td>
                                    <a href="{{ route('zoom-course.level.session.user.answers', [$zoomCourseLevelSession->belongsToZoomCourseLevel->belongsToZoomCourse->slug, $zoomCourseLevelSession->belongsToZoomCourseLevel->slug, $zoomCourseLevelSession->slug, $exerciseUser->belongsToLiveCourseUser->id]) }}">See {{ $exerciseUser->belongsToLiveCourseUser->name }}'s Answers</a>
                                </td>
                                <td>{!! $exerciseUser->hasBeenCorrected == 0 ? '<span class="text-danger font-weight-bold">No</span>' : '<span class="text-success font-weight-bold">Yes</span>' !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update course section start -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $zoomCourseLevelSession->belongsToZoomCourseLevel->belongsToZoomCourse->title.' / '.$zoomCourseLevelSession->belongsToZoomCourseLevel->title.' / '.$zoomCourseLevelSession->title.' - Exercise' }}</h4>
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
                    @if($zoomCourseLevelSession->exersice_id == null)
                        <form id="chooseSessionExercise">
                            {{ csrf_field() }}
                            <input type="hidden" name="zoom_course_level_session_id" value="{{ $zoomCourseLevelSession->id }}">
                            <div class="form-group">
                                <div class="text-bold-600 font-medium-2">
                                    Please choose an Exercise for this session
                                </div>
                                <select class="select2 form-control" name="exercise_id">
                                    @foreach($exercises as $exercise)
                                    <option value="{{ $exercise->id }}">{{ $exercise->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-info mr-1">
                                    <i class="fa fa-check"></i> Update
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center">
                            <a href="{{ route('exercise.show', $zoomCourseLevelSession->exersice->slug) }}" class="btn btn-primary">Preview Exercise</a>
                        </div>
                    @endif
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