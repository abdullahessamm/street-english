@extends('layouts.app', [
    'title' => 'Append New Courses in : '.$bundle->name,
    'active' => 'bundles',
    'breadcrumb' => [
        'title' => 'Append New Courses in : '.$bundle->name,
        'map' => [
            'Dashboard' => 'home',
            'Bundles' => 'bundles',
            'Append New Courses in : '.$bundle->name => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Append new Courses',
			'id' => 'openaddNewCoursesModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.bundle.courses'
])

@section('content')
<!-- List of all Online Courses Bundle table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all online course in bundle</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered" id="bundles">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Remove Course</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bundle->bundleCourses as $eachBundleCourses)
                                <tr id="tr_bundle_course_{{$eachBundleCourses->id}}">
                                    <td>
                                        <a href="{{ route('course.show', $eachBundleCourses->belongsToCourse->slug) }}">
                                            {{ $eachBundleCourses->belongsToCourse->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger font-weight-bold removeBundleCourse" data-bundle-course-id="{{ $eachBundleCourses->id }}">Remove User from this course</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Remove Course</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ List of all Online Courses Bundle table -->

<!-- Create New Content Modal -->
<div class="modal fade" id="addNewCoursesModal" tabindex="-1" role="dialog" aria-labelledby="addNewCoursesModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addNewCoursesModalLabel">Create New Bundle</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="addNewCourseBundle">
			{{ csrf_field() }}
            <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
			<div class="modal-body">
				<div class="form-group">
					<label for="courses">
                        Bundle Courses
                    </label>
                    <select class="selectize-multiple" name="courses[]" multiple>
                        @foreach($not_add_courses as $onlineCourse)
                            <option value="{{ $onlineCourse->id }}">{{ $onlineCourse->name }}</option>
                        @endforeach
                    </select>
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