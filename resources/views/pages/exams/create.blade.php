@extends('layouts.app', [
    'title' => 'Create new Exam',
    'breadcrumb' => [
        'title' => 'Create new Exam',
        'map' => [
            'Dashboard' => 'home',
            'Exams' => 'exams',
            'Create new Exam' => 'active'
        ]
    ],
    'assets' => 'pages.exams.create'
])

@section('content')
<!-- Create exam section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create exam details</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewWExam" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-file"></i> Exam Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="exam_name">Exam Name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="exam_name" class="form-control" placeholder="e.g. Math Exam" name="exam_name" required>
		                            </div>
		                        </div>

								<h4 class="form-section"><i class="fa fa-calendar"></i> Exam Time</h4>

		                        <div class="form-group row">
									<label class="col-md-3 label-control" for="exam_date">Choose Exam Type</label>
									<div class="col-md-9">
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" id="specific_date_and_time" name="choose_exam_time_type" class="custom-control-input chooseExamTimeType" value="specific_date_and_time" checked>
											<label class="custom-control-label" for="specific_date_and_time">Specific date & time</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" id="anytime" name="choose_exam_time_type" class="custom-control-input chooseExamTimeType" value="anytime">
											<label class="custom-control-label" for="anytime">Anytime</label>
										</div>
		                            </div>
		                        </div>

								<div id="choose_time_res"></div>
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
<!-- // Create exam section end -->

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