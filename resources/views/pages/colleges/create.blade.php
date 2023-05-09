@extends('layouts.app', [
    'title' => 'Create New College',
    'active' => 'colleges',
    'breadcrumb' => [
        'title' => 'Create New College',
        'map' => [
            'Dashboard' => 'home',
            'Colleges' => 'colleges',
            'Create New College' => 'active',
        ]
    ],
    'scripts' => 'pages.colleges.create'
])

@section('content')
<!-- Create new book section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Create New College</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="createNewCollege" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-university"></i> College Data</h4>
			                    
                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="college_name">College name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="college_name" class="form-control" name="college_name" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="short_description">Short Description</label>
		                            <div class="col-md-9">
                                        <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="3" maxlength="160" required></textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="content">Content</label>
		                            <div class="col-md-9">
                                        <textarea name="content" id="content" required></textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="image">
                                        College Thumbnail
                                        <br>
                                        <small><b>recommended size : 383w x 238h</b></small>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" id="image" class="form-control" name="image" required>
                                    </div>
                                </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="cover">
                                        Banner
                                        <br>
                                        <small><b>recommended size : 1919w x 1000h</b></small>
                                    </label>
		                            <div class="col-md-9">
		                            	<input type="file" id="cover" class="form-control" name="cover" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="image">
                                        College Image
                                        <br>
                                        <small><b>recommended size : 773w x 411h</b></small>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" id="image" class="form-control" name="image" required>
                                    </div>
                                </div>
							</div>

	                        <div class="form-actions">
	                            <button type="button" class="btn btn-warning mr-1">
	                            	<i class="fa fa-remove"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-check"></i> Save
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create new book section end -->

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