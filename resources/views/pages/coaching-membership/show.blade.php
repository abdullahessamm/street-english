@extends('layouts.app', [
    'title' => 'Job application from : '.$workWithUsForm->fullname,
	'active' => 'instructor.create',
    'breadcrumb' => [
        'title' => 'Job application from : '.$workWithUsForm->fullname,
        'map' => [
            'Dashboard' => 'home',
            'Coaching Memberships' => 'coaching-memberships',
            'Job application from : '.$workWithUsForm->fullname => 'active'
        ]
    ],
    'scripts' => 'pages.coaching-membership.show'
])

@section('content')
<!-- Create coach section start -->
<section id="striped-label-form-layouts text-left" dir="ltr">
	<div class="row">
	    <div class="col-md-12">
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
	                    <form class="form form-horizontal striped-labels form-bordered">
	                    	<div class="form-body text-right">
	                    		<h4 class="form-section"><i class="fa fa-user"></i> Work with us form</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Name</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->fullname }}
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Email</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->email }}
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Phone Number</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->phone_number }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Date of Birth</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->dob }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Address</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->address }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Matrial Status</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->matrial_status }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Military Status</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->military_status }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Personal ID Number</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->personal_id_number }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Are you a .........?</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->are_you_a }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Graduation year - Current studying year</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->graduation_year }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Your Educational Background</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->educational_background }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Why are you applying as an English-language instructor at SEA?</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->why_are_you_applying }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">How long have you been working as an English Instructor?</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->how_long_have_you_been_working }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Name 3 places you've worked for and for how long?</label>
		                            <div class="col-md-9">
                                        {!! strip_tags($workWithUsForm->name_3_places) !!}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">What are your Extra Qualifications?</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->extra_qualifications }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Expected Hourly Rate</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->salaray }}
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="name">Date of Availability to start at SEA</label>
		                            <div class="col-md-9">
                                        {{ $workWithUsForm->work_date_availability }}
		                            </div>
		                        </div>
                            </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create coach section end -->

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