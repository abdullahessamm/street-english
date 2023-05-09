@extends('layouts.app', [
    'title' => 'Coach : '.$coach->name ,
    'active' => 'Coachs',
    'breadcrumb' => [
        'title' => 'Coach : '.$coach->name ,
        'map' => [
            'Dashboard' => 'home',
            'Coaches' => 'coaches',
            'Coach : '.$coach->name => 'active'
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'Delete this coach',
			'id' => 'deleteCoach',
            'data' => [
                'coach-id' => $coach->id
            ],
			'color' => 'danger',
			'bold' => true,
		]
    ],
    'assets' => 'pages.coach.show'
])

@section('content')
<!-- Create coaches section start -->
<section id="striped-label-form-layouts">
	<div class="row">

	    <div class="col-md-8">
			<!-- update coach info form -->
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
							<form id="updateCoachInfo" class="form form-horizontal striped-labels form-bordered">
								{{ csrf_field() }}
								<input type="hidden" name="coach_id" value="{{ $coach->id }}">
								<h4 class="form-section"><i class="fa fa-user"></i> Update {{ $coach->name }} Info</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="name">Username</label>
									<div class="col-md-9">
										<input type="text" id="name" class="form-control" placeholder="e.g. John Doe" value="{{ $coach->name }}" name="name" required>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="email">Email</label>
									<div class="col-md-9">
										<input type="email" id="email" class="form-control" placeholder="johndoe@email.com" value="{{ $coach->email }}" name="email" required>
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

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="title">Title</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="title" class="form-control" placeholder="e.g. Professor" name="title" value="{{ isset($coach->info) && $coach->info->title ? $coach->info->title : null }}">
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="about">About Instructor</label>
		                            <div class="col-md-9">
										<textarea name="about" id="about" class="form-control" cols="30" rows="10">{{ isset($coach->info) && $coach->info->about ? $coach->info->about : null }}</textarea>
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
			<!-- // update coach info form -->

			<!-- update coach social media form -->
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
							<form id="updateCoachSocialMedia" class="form form-horizontal striped-labels form-bordered">
								{{ csrf_field() }}
								<input type="hidden" name="coach_id" value="{{$coach->id}}">
								<h4 class="form-section"><i class="fa fa-globe"></i> Update {{ $coach->name }} Social Media</h4>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="facebook">Facebook</label>
									<div class="col-md-9">
										<input type="url" id="facebook" class="form-control" name="facebook" {{ isset($coach->info) && $coach->info->facebook ? $coach->info->facebook : null }}>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="twitter">Twitter</label>
									<div class="col-md-9">
										<input type="url" id="twitter" class="form-control" name="twitter" {{ isset($coach->info) && $coach->info->twitter ? $coach->info->twitter : null }}>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="linkedIn">LinkedIn</label>
									<div class="col-md-9">
										<input type="url" id="linkedIn" class="form-control" name="linkedIn" {{ isset($coach->info) && $coach->info->linkedIn ? $coach->info->linkedIn : null }}>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="gmail">Gmail</label>
									<div class="col-md-9">
										<input type="url" id="gmail" class="form-control" name="gmail" {{ isset($coach->info) && $coach->info->gmail ? $coach->info->gmail : null }}>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 label-control" for="whatsapp_number">Whatsapp Number</label>
									<div class="col-md-9">
										<input type="text" id="whatsapp_number" class="form-control" name="whatsapp_number">
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
			<!-- // update coach social media form -->

			<!-- update coach permissions form -->
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
							<form>
								<h4 class="form-section"><i class="fa fa-user"></i> Update {{ $coach->name }} Permissions</h4>
        
								<div class="form-group row">
									<label class="col-md-6 label-control" for="permission_to_make_sessions">Permission to make sessions</label>
									<div class="col-md-6">
										<input type="checkbox" id="permission_to_make_sessions" class="switchery" data-color="success" data-coach-id="{{ $coach->id }}" {{ isset($coach->info) && $coach->info->isAllowedForMakingSession == 1 ? 'checked' : ''}} />
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-6 label-control" for="permission_to_publish_courses">Permission to publish courses</label>
									<div class="col-md-6">
										<input type="checkbox" id="permission_to_publish_courses" class="switchery" data-color="success" data-coach-id="{{ $coach->id }}" {{ isset($coach->info) && $coach->info->isAllowedForPublishCourses == 1 ? 'checked' : ''}} />
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-6 label-control" for="permission_to_publish_blog">Permission to make publish blogs</label>
									<div class="col-md-6">
										<input type="checkbox" id="permission_to_publish_blog" class="switchery" data-color="success" data-coach-id="{{ $coach->id }}" {{ isset($coach->info) && $coach->info->isAllowedForPublishBlogs == 1 ? 'checked' : ''}} />
									</div>
								</div>
							</form>
						</div>
	                </div>
	            </div>
	        </div>
			<!-- // update coach permissions form -->
	    </div>

		<!-- update coach image form -->
		<div class="col-md-4">
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
							<form id="updateCoachImage">
								{{ csrf_field() }}
								<input type="hidden" name="coach_id" value="{{$coach->id}}">
								<h4 class="form-section"><i class="fa fa-image"></i>Update {{ $coach->name }} Image</h4>

								<div class="form-group">
									<input type="file" id="image" class="form-control" name="image" required>
									
									<div class="my-1 text-center">
									@if(isset($coach->info) && $coach->info->image != null)
										<img src="{{ config('app.main_url').'/public/images/coaches/'.$coach->id.'/'.$coach->info->image }}" class="img-fluid" alt="{{ $coach->name }}">
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
	    </div>
		<!-- // update coach image form -->
	</div>
</section>
<!-- // Create coaches section end -->

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