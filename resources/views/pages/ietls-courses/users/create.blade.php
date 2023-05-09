@extends('layouts.app', [
    'title' => 'Create new IETLS User',
	'active' => 'ietls-course.user.create',
    'breadcrumb' => [
        'title' => 'Create new IETLS User',
        'map' => [
            'Dashboard' => 'home',
            'IETLS Courses Users' => 'active',
            'Create new IETLS User' => 'active'
        ]
    ],
    'scripts' => 'pages.ietls-courses.users.create'
])

@section('content')
<!-- Create User section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create Zoom Course User details</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewUser" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-user"></i> User Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Username</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="name" class="form-control" placeholder="e.g. John Doe" name="name" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="email">Email</label>
		                            <div class="col-md-9">
		                            	<input type="email" id="email" class="form-control" placeholder="johndoe@email.com" name="email" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="password">Password</label>
		                            <div class="col-md-9">
		                            	<input type="password" id="password" class="form-control" placeholder="********" name="password" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="repass">Confirm Password</label>
		                            <div class="col-md-9">
		                            	<input type="password" id="repass" class="form-control" placeholder="********" name="repass" required>
		                            </div>
		                        </div>

                                {{-- <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="whatsapp_number">Whatsapp Number</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="whatsapp_number" class="form-control" name="whatsapp_number">
		                            </div>
		                        </div>

	                    		<h4 class="form-section"><i class="fa fa-image"></i> User Image</h4>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">User Personal Image <b>(OPTIONAL)</b> </label>
                                    <div class="col-md-9">
		                            	<input type="file" id="image" class="form-control" name="image">
		                            </div>
		                        </div> --}}

								
							</div>

	                        <div class="form-actions">
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="fa fa-remove"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-check"></i> Create
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create User section end -->

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