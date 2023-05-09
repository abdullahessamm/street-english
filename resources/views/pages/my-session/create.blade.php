@extends('layouts.app', [
    'title' => 'انشاء جلسة جديدة',
	'active' => 'instructor.create',
    'breadcrumb' => [
        'title' => 'انشاء جلسة جديدة',
        'map' => [
            'Dashboard' => 'home',
            'حجوزاتي' => 'my-sessions',
            'انشاء جلسة جديدة' => 'active'
        ]
    ],
    'scripts' => 'pages.my-session.create'
])

@section('content')
<!-- Create coach section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">انشاء جلسة جديدة</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewSession" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-user"></i> معلومات عن الجلسىة</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="session_name">اسم الجلسة</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="session_name" class="form-control" placeholder="مثال : جلسة نفسية للاطفال" name="session_name" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="description">
										عن الجلسة
										<br>
										<small class="font-weight-bold">( اختياري )</small>
									</label>
		                            <div class="col-md-9">
										<textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="fa fa-remove"></i> الغاء
	                            </button>
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-check"></i> انشاء
	                            </button>
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