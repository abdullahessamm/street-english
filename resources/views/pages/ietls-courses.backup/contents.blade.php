@extends('layouts.app', [
    'title' => 'IETLS Course : '.$course->name,
	'active' => 'ietls-courses',
    'breadcrumb' => [
        'title' => $course->name,
        'map' => [
            'Dashboard' => 'home',
            'IETLS Courses' => 'courses',
            $course->name => [
				'route' => 'ietls-course.show',
				'slug' => $course->slug,
			],
			'Contents' => 'active'
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'Create new Content',
			'id' => 'openNewContentModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.ietls-courses.contents'
])

@section('content')
<!-- Update course section start -->
@if($course->contents->count() > 0)
	@foreach($course->contents as $content)
	<section id="striped-label-form-layouts">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title" id="striped-label-layout-basic">Content of : <b contenteditable="true" class="updateContentTitle" data-content-id="{{ $content->id }}" data-content-title="{{ $content->title }}">{{ $content->title }}</b></h4>
						<a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
								<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
								<li><a href="javascript:void(0);" class="deleteContent text-danger" data-content-id="{{ $content->id }}"><i class="ft-trash"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-content collapse show">
						<div class="card-body">
							<form class="addNewLessons">
								{{ csrf_field() }}
								<input type="hidden" name="ietls_course_id" value="{{ $content->belongsToCourse->id }}">
								<input type="hidden" name="content_id" value="{{ $content->id }}">

								<div class="form-group updateContentDescription" data-content-id="{{ $content->id }}" contenteditable="true">
									{{ $content->description }}
								</div>

								<hr>

								<div class="repeater-default">
									<div data-repeater-list="lessons">
										<div data-repeater-item>
											<div class="form-group row">
												<div class="col-3">
													<label for="lesson_title">Lesson Title</label>
													<input type="text" class="form-control" name="lesson_title" id="lesson_title" required>
												</div>
												<div class="col-3">
													<label for="video_type">Video Type</label>
													<select name="video_type" id="video_type" class="form-control">
														<option value="youtube" selected>Youtube</option>
														<option value="vimeo">Vimeo</option>
														<option value="drive">Google Drive</option>
													</select>
												</div>
												<div class="col-3">
													<label for="video_url">Video URL</label>
													<textarea name="video_url" id="video_url" class="form-control" cols="30" rows="3" dir="ltr"></textarea>
												</div>
												<div class="col-2">
													<button type="button" class="btn btn-danger mt-2" data-repeater-delete> <i class="ft-x"></i> Delete</button>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group overflow-hidden">
										<div class="col-12">
											<button type="button" data-repeater-create class="btn btn-primary">
												<i class="ft-plus"></i> Add
											</button>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">Upload Lessons</button>
								</div>
							</form>

							@if($content->lessons->count() > 0)
							<table class="table my-3">
								<thead>
									<tr>
										<th>Lesson</th>
										<th>Video</th>
										<th>Is Locked</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
								@foreach($content->lessons as $lesson)
									<tr id="tr_lesson_{{$lesson->id}}">
										<td class="updateLessonTitle" contenteditable="true" data-lesson-id="{{ $lesson->id }}">{{ $lesson->title }}</td>
										<td>
											<button class="btn btn-link previewLessonVideo" data-lesson-id="{{ $lesson->id }}">Preview video</button>
										</td>
										<td>
											<input type="checkbox" id="switchery" class="switchery lockOrUnlockLesson" data-lesson-id="{{ $lesson->id }}" {{ $lesson->isLocked == 1 ? 'checked' : '' }}/>
										</td>
										<td>
											<button class="btn btn-danger font-weight-bold deleteLesson" data-lesson-id="{{ $lesson->id }}">Delete this lesson</button>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endforeach					
@else
	<section id="striped-label-form-layouts">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title" id="striped-label-layout-basic">Course : <b>{{ $course->name }}</b> Content</h4>
						<a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-content collapse show">
						<div class="card-body">
							<div class="jumbotron text-center">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewContentModal">
									Create New Content
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endif
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
    <div class="modal-dialog modal-lg" role="document">
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

<!-- Create New Content Modal -->
<div class="modal fade" id="createNewContentModal" tabindex="-1" role="dialog" aria-labelledby="createNewContentModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="createNewContentModalLabel">Create New Content</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="createNewContent">
			{{ csrf_field() }}
			<input type="hidden" name="ietls_course_id" value="{{ $course->id }}">
			<div class="modal-body">
				<div class="form-group">
					<label for="content_name">Content Name</label>
					<input type="text" class="form-control" name="content_name" id="content_name" required>
				</div>
			</div>

			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</form>
	</div>
	</div>
</div>

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteContentModal" tabindex="-1" role="dialog" aria-labelledby="deleteContentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmDeleteContentID">
				<h2>Are you sure you want to delete this content ?</h2>
				<h6><b class="text-warning">WARNING:</b> If you delete this content all the lesson will be removed</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmDeleteContent">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection