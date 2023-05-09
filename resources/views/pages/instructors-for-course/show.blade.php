@extends('layouts.app', [
    'title' => 'Instructors in Course : in : '.$Course->name,
    'active' => 'instructors-for-courses',
    'breadcrumb' => [
        'title' => 'Instructors in Course : in : '.$Course->name,
        'map' => [
            'Dashboard' => 'home',
            "Instructor's Courses" => 'instructors-for-courses',
            'Instructors in Course : <b>'.$Course->name.'</b>' => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Append new Instructor',
			'id' => 'openAppendInstrucorModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.instructors-for-course.show'
])

@section('content')
<!-- List of all courses table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all Instructors in <b>{{ $Course->name }}</b></h4>
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
                                    <th>Instructor Name</th>
                                    <th>Suspend Instructor</th>
                                    <th>Delete Instructor</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Course->instructors as $eachInstructor)
                                <tr id="tr_instructor_{{$eachInstructor->id}}">
                                    <td><a href="{{ route('coach.show', $eachInstructor->belongsToInstructor->id) }}">{{ $eachInstructor->belongsToInstructor->name }}</a></td>
                                    <td>
                                        <input type="checkbox" id="switchery" class="switchery suspendOrUnSuspendInstructor" data-coach-id="{{ $eachInstructor->id }}" {{ $eachInstructor->suspend == 1 ? 'checked' : '' }}/>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger font-weight-bold removeInstructor" data-coach-id="{{ $eachInstructor->id }}">Remove User from this course</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Instructor Name</th>
                                    <th>Suspend Instructor</th>
                                    <th>Delete Instructor</th>
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
<div class="modal fade" id="appendNewInstructorModal" tabindex="-1" role="dialog" aria-labelledby="appendNewInstructorModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="appendNewInstructorModalLabel">Append new Instructor</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
        @if($not_registed_instructors->count() > 0)
		<form id="appendNewInstructor">
			{{ csrf_field() }}
			<input type="hidden" name="course_id" value="{{ $Course->id }}">
			<div class="modal-body">
				<select class="selectize-multiple" name="instructors[]" multiple>
                @foreach($not_registed_instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
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
            <h2>No Instructor remain for this course</h2>
            <a href="{{ route('coach.create') }}" class="btn btn-info">Create new Instructor</a>
        </div>
        @endif
	</div>
	</div>
</div>
@endsection