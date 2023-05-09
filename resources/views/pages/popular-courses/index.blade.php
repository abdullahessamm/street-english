@extends('layouts.app', [
    'title' => 'Popular Online Courses',
    'active' => 'popular-courses',
    'breadcrumb' => [
        'title' => 'Popular Online Courses',
        'map' => [
            'Dashboard' => 'home',
            'Popular Online Courses' => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Add Favorite Online Course',
			'id' => 'openAddCourseModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.popular-courses.index'
])

@section('content')
<!-- List of all courses table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all Popular Online Courses</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered" id="popular-courses">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Remove</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ List of all courses table -->

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

<!-- Create New Content Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="addCourseModalLabel">Append New Student</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
        @if($get_remain_courses->count() > 0)
		<form id="addPopularCourse">
			{{ csrf_field() }}
			<div class="modal-body">
				<select class="selectize-multiple" name="courses[]" multiple required>
                @foreach($get_remain_courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
                </select>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Add</button>
			</div>
		</form>
        @else
        <div class="jumbotron text-center">
            <h2>No Student remain for this course</h2>
            <a href="{{ route('student.create') }}" class="btn btn-info">Create new Student</a>
        </div>
        @endif
	</div>
	</div>
</div>
@endsection