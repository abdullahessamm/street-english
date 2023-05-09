@extends('layouts.app', [
    'title' => 'Append New Users in : '.$bundle->name,
    'active' => 'bundles',
    'breadcrumb' => [
        'title' => 'Append New Users in : '.$bundle->name,
        'map' => [
            'Dashboard' => 'home',
            'Bundles' => 'bundles',
            'Append New Users in : '.$bundle->name => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Append New Users',
			'id' => 'openAppendNewUsersModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'assets' => 'pages.bundle.users'
])

@section('content')
<!-- List of all User Bundle table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all users in bundle</h4>
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
                                    <th>User Name</th>
                                    <th>Remove User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bundle->bundleUsers as $eachBundleUser)
                                <tr id="tr_bundle_user_{{$eachBundleUser->id}}">
                                    <td>
                                        <a href="{{ route('student.show', $eachBundleUser->belongsToStudent->id) }}">
                                            {{ $eachBundleUser->belongsToStudent->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger font-weight-bold removeBundleUser" data-bundle-user-id="{{ $eachBundleUser->id }}">Remove User from this course</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>User Name</th>
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
<!--/ List of all User Bundle table -->

<!-- Create New Content Modal -->
<div class="modal fade" id="appendNewUsersModal" tabindex="-1" role="dialog" aria-labelledby="appendNewUsersModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="appendNewUsersModalLabel">Append New User</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="appendNewUserBundle">
			{{ csrf_field() }}
            <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
			<div class="modal-body">
				<div class="form-group">
					<label for="users">
                        Bundle Users
                    </label>
                    <select class="selectize-multiple" name="users[]" multiple>
                        @foreach($not_registed_users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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