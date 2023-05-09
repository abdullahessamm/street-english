@extends('layouts.app', [
    'title' => 'College - '.$college->college_name,
    'active' => 'colleges',
    'breadcrumb' => [
        'title' => 'College - '.$college->college_name,
        'map' => [
            'Dashboard' => 'home',
            'Colleges' => 'colleges',
            'College - '.$college->college_name => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Delete this college',
			'id' => 'deleteCollege',
            'data' => [
                'college-id' => $college->id
            ],
			'color' => 'danger',
			'bold' => true,
		]
    ],
    'scripts' => 'pages.colleges.show'
])

@section('content')
<!-- Create new college section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">{{ 'College - '.$college->college_name }}</h4>
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
                            <input type="hidden" name="college_id" value="{{ $college->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-university"></i> Update College Data</h4>
			                    
                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="college_name">College name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="college_name" class="form-control" name="college_name" value="{{ $college->college_name }}" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="short_description">Short Description</label>
		                            <div class="col-md-9">
                                        <textarea name="short_description" id="short_description" class="form-control" cols="30" rows="3" maxlength="160" required>{{ $college->short_description }}</textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="content">Content</label>
		                            <div class="col-md-9">
                                        <textarea name="content" id="content" required>{{ $college->content }}</textarea>
		                            </div>
		                        </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="image">
                                        College Thumbnail
                                        <br>
                                        <small><b>recommended size : 383w x 238h</b></small>
                                    </label>
                                    <div class="col-md-9">
                                        <img src="{{ config('app.main_url').'/images/colleges/'.$college->id.'/'.$college->thumbnail }}" class="img-fluid" alt="{{ $college->college_name }}">
                                        <input type="file" id="image" class="form-control" name="thumbnail">
                                    </div>
                                </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="cover">
                                        Cover
                                        <br>
                                        <small><b>recommended size : 1919w x 1000h</b></small>
                                    </label>
		                            <div class="col-md-9">
                                        <img src="{{ config('app.main_url').'/images/colleges/'.$college->id.'/'.$college->cover }}" class="img-fluid" alt="{{ $college->college_name }}">
		                            	<input type="file" id="cover" class="form-control" name="cover">
		                            </div>
		                        </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="image">
                                        College Image
                                        <br>
                                        <small><b>recommended size : 773w x 411h</b></small>
                                    </label>
                                    <div class="col-md-9">
                                        <img src="{{ config('app.main_url').'/images/colleges/'.$college->id.'/'.$college->image }}" class="img-fluid" alt="{{ $college->college_name }}">
                                        <input type="file" id="image" class="form-control" name="image">
                                    </div>
                                </div>
							</div>

	                        <div class="form-actions">
	                            <button type="submit" class="btn btn-warning">
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
<!-- // Create new college section end -->

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