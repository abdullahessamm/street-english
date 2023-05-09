@extends('layouts.app', [
    'title' => 'User : '.$student->name ,
    'active' => 'students',
    'breadcrumb' => [
        'title' => 'User : '.$student->name ,
        'map' => [
            'Dashboard' => 'home',
            'Students' => 'students',
            'Student : '.$student->name => 'active'
        ]
    ],
    'scripts' => 'pages.students.show'
])

@section('content')
<!-- Create user section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update {{ $student->name }} data</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updateUser" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-user"></i> User Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Username</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="name" class="form-control" placeholder="e.g. John Doe" value="{{ $student->name }}" name="name" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="email">Email</label>
		                            <div class="col-md-9">
		                            	<input type="email" id="email" class="form-control" placeholder="johndoe@email.com" value="{{ $student->email }}" name="email" required>
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

	                    		<h4 class="form-section"><i class="fa fa-image"></i> User Image</h4>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="image">User Personal Image <b>(OPTIONAL)</b> </label>
                                    <div class="col-md-3">
		                            	<input type="file" id="image" class="form-control" name="image">
		                            </div>
                                    <div class="col-md-6 text-center">
                                    @if($student->image == null)
                                        <div class="jumbotron">
                                            <h3>No Image Avaliabe</h3>
                                        </div>
                                    @else
                                        <img src="{{ config('app.main_url').'/images/students/'.$student->id.'/'.$student->image }}" class="img-fluid" alt="{{ $student->name }}">
                                    @endif
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="reset" class="btn btn-danger mr-1">
	                            	<i class="fa fa-remove"></i> Reset
	                            </button>
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
</section>
<!-- // Create user section end -->

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