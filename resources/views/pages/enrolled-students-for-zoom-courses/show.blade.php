@extends('layouts.app', [
    'title' => 'Enrolled Students in : '.$ZoomCourse->title,
    'active' => 'enrolled-students-for-zoom-courses',
    'breadcrumb' => [
        'title' => 'Enrolled Students in : '.$ZoomCourse->title,
        'map' => [
            'Dashboard' => 'home',
            'Enrolled Students' => 'enrolled-students-for-zoom-courses',
            'Enrolled Students in : <b>'.$ZoomCourse->title.'</b>' => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Append new Student',
			'id' => 'openAppednStudentModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.enrolled-students-for-zoom-courses.show'
])

@section('content')
<!-- List of all courses table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all Enrolled Stuents in <b>{{ $ZoomCourse->title }}</b></h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Suspend Student</th>
                                    <th>Delete Student</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ZoomCourse->enrolledStudents as $eachStudent)
                                <tr id="tr_student_{{$eachStudent->id}}">
                                    <td><a href="{{ route('zoom-course.user.show', $eachStudent->live_course_user_id) }}">{{ $eachStudent->belongsToStudent->name }}</a></td>
                                    <td>
                                        <input type="checkbox" id="switchery" class="switchery suspendOrUnSuspendStudent" data-student-id="{{ $eachStudent->id }}" {{ $eachStudent->suspend == 1 ? 'checked' : '' }}/>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger font-weight-bold removeUser" data-enrolled-student-id="{{ $eachStudent->id }}">Remove User from this course</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Suspend Student</th>
                                    <th>Delete Student</th>
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

<!-- Error Modal -->
<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
                <i class="text-danger fa fa-times" style="font-size: 100px;"></i>
                <h3>Error</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> Close Window </button>
            </div>
        </div>
    </div>
</div>

<!-- Create New Content Modal -->
<div class="modal fade" id="appendNewStudentModal" tabindex="-1" role="dialog" aria-labelledby="appendNewStudentModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="appendNewStudentModalLabel">Append New Student</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
        @if($not_registed_students->count() > 0)
		<form id="appendNewStudent">
			{{ csrf_field() }}
			<input type="hidden" name="zoom_course_id" value="{{ $ZoomCourse->id }}">
			<div class="modal-body">
				<select class="selectize-multiple" name="students[]" multiple>
                @foreach($not_registed_students as $student)
                    <option value="{{ $student->id }}">{{ $student->name.' - '.$student->email }}</option>
                @endforeach
                </select>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Append</button>
			</div>
		</form>
        @else
        <div class="jumbotron text-center">
            <h2>No Student remain for this course</h2>
            <a href="{{ route('zoom-course.user.create') }}" class="btn btn-info">Create new Student</a>
        </div>
        @endif
	</div>
	</div>
</div>
@endsection