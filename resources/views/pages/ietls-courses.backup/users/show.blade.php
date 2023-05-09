@extends('layouts.app', [
    'title' => 'IETLS Courses User : '.$ieltsUser->name ,
    'active' => 'IETLS-course.users',
    'breadcrumb' => [
        'title' => 'IETLS Courses User : '.$ieltsUser->name ,
        'map' => [
            'Dashboard' => 'home',
            'IETLS Courses Users' => 'active',
            'User : '.$ieltsUser->name => 'active'
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'Delete this user',
			'id' => 'deleteIETLSCourseUser',
            'data' => [
                'IETLS-course-user-id' => $ieltsUser->id
            ],
			'color' => 'danger',
			'bold' => true,
		]
    ],
    'scripts' => 'pages.ietls-courses.users.show'
])

@section('content')
<!-- Create IETLS Courses Users section start -->
<section id="striped-label-form-layouts">
	<div class="row">

	    <div class="col-md-8">
			<!-- update IETLS Courses User info form -->
	        <div class="card">
	            <div class="card-header">
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <div class="form-body">
							<form id="updateIETLSCourseUserInfo" class="form form-horizontal striped-labels form-bordered">
								{{ csrf_field() }}
								<input type="hidden" name="ietls_course_user_id" value="{{ $ieltsUser->id }}">
								<h4 class="form-section"><i class="fa fa-user"></i> Update {{ $ieltsUser->name }} Info</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="name">Username</label>
									<div class="col-md-9">
										<input type="text" id="name" class="form-control" placeholder="e.g. John Doe" value="{{ $ieltsUser->name }}" name="name" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="email">Email</label>
									<div class="col-md-9">
										<input type="email" id="email" class="form-control" placeholder="johndoe@email.com" value="{{ $ieltsUser->email }}" name="email" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="password">Password</label>
									<div class="col-md-9">
										<input type="password" id="password" class="form-control" placeholder="********" name="password">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="repass">Confirm Password</label>
									<div class="col-md-9">
										<input type="password" id="repass" class="form-control" placeholder="********" name="repass">
									</div>
								</div>

                                {{-- <div class="form-group row">
									<label class="col-md-3 label-control" for="whatsapp_number">Whatsapp Number</label>
									<div class="col-md-9">
										<input type="text" id="whatsapp_number" class="form-control" name="whatsapp_number" value="{{ isset($ieltsUser->info) && $ieltsUser->info->whatsapp_number != null ? $ieltsUser->info->whatsapp_number : null }}">
									</div>
								</div> --}}

								<div class="form-actions">
									<button type="submit" class="btn btn-warning text-dark">
										<i class="fa fa-check"></i> Update
									</button>
								</div>
							</form>
						</div>
	                </div>
	            </div>
	        </div>
			<!-- // update IETLS Courses User info form -->
	    </div>

		<!-- update IETLS Courses User image form -->
		{{-- <div class="col-md-4">
	        <div class="card">
	            <div class="card-header">
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <div class="form-body">
							<form id="updateIETLSCourseUserImage">
								{{ csrf_field() }}
								<input type="hidden" name="live_course_user_id" value="{{$ieltsUser->id}}">
								<h4 class="form-section"><i class="fa fa-image"></i>Update {{ $ieltsUser->name }} Image</h4>

								<div class="form-group">
									<input type="file" id="image" class="form-control" name="image" required>
									
									<div class="my-1 text-center">
									@if(isset($ieltsUser->info) && $ieltsUser->info->image != null)
										<img src="{{ config('app.main_url').'/public/images/IETLS-course-users/'.$ieltsUser->id.'/'.$ieltsUser->info->image }}" class="img-fluid" alt="{{ $ieltsUser->name }}">
									@else
										<div class="jumbotron text-center">
											<h3>No Image Avaliabe</h3>
										</div>
									@endif
									</div>
								</div>

								<div class="form-actions">
									<button type="submit" class="btn btn-warning text-dark">
										<i class="fa fa-check"></i> Update
									</button>
								</div>
							</form>
						</div>
	                </div>
	            </div>
	        </div>
	    </div> --}}
		<!-- // update IETLS Courses User image form -->
	</div>
</section>
<!-- // Create IETLS Courses Users section end -->

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