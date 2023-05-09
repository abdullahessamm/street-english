@extends('layouts.app', [
    'title' => 'Registed Users in Exam : '.$exam->exam_name,
    'active' => 'enrolled-students',
    'breadcrumb' => [
        'title' => 'Registed Users in Exam : '.$exam->exam_name,
        'map' => [
            'Dashboard' => 'home',
            "Registed Users Exams" => 'registed-users-exams',
            'Registed Users in Exam :: <b>'.$exam->exam_name.'</b>' => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Append new Stuent',
			'id' => 'openAppendStuentModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.registed-users-exams.show'
])

@section('content')
<!-- List of all courses table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all registed users in exam : <b>{{ $exam->exam_name }}</b></h4>
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
                                    <th>Exam Name</th>
                                    <th>Remove Registed User</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($exam->registedUsers as $eachRegistedUser)
                                <tr id="tr_user_{{$eachRegistedUser->user_id}}">
                                    <td><a href="{{ route('student.show', $eachRegistedUser->belongsToStudent->id) }}">{{ $eachRegistedUser->belongsToStudent->name }}</a></td>
                                    <td>
                                        <button class="btn btn-danger font-weight-bold removeUser" data-user-id="{{ $eachRegistedUser->user_id }}">Remove User from this course</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Exam Name</th>
                                    <th>Remove Registed User</th>
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
<div class="modal fade" id="appendNewStudentModal" tabindex="-1" role="dialog" aria-labelledby="appendNewStudentModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="appendNewStudentModalLabel">Append new Stuent</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
        @if($not_registed_users->count() > 0)
		<form id="appendNewStudent">
			{{ csrf_field() }}
			<input type="hidden" name="exam_id" value="{{ $exam->id }}">
			<div class="modal-body">
				<select class="selectize-multiple" name="students[]" multiple>
                @foreach($not_registed_users as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
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
            <a href="{{ route('student.create') }}" class="btn btn-info">Create new Student</a>
        </div>
        @endif
	</div>
	</div>
</div>
@endsection