@extends('layouts.app', [
    'title' => $bundle->name,
    'active' => 'bundles',
    'breadcrumb' => [
        'title' => $bundle->name,
        'map' => [
            'Dashboard' => 'home',
            'Bundles' => 'bundles',
            $bundle->name => 'active'
        ]
    ],
    'scripts' => 'pages.bundle.show'
])

@section('content')
<!-- Update bundle form table -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">Update Bundle Data</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updateBundleInfo" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
                            <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-user"></i> Bundle Info</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="bundle_name">Bundle Name</label>
		                            <div class="col-md-9">
                                        <input type="text" class="form-control" name="bundle_name" id="bundle_name" value="{{ $bundle->name }}" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="price">Bundle Price</label>
		                            <div class="col-md-9">
                                        <input type="text" class="form-control" name="price" id="price" value="{{ $bundle->price }}" required>
		                            </div>
		                        </div>

                                <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="thumbnail">Bundle Thumbnail</label>
		                            <div class="col-md-9">
                                        <input type="file" class="form-control" name="thumbnail" id="thumbnail">

                                        <div class="my-2">
                                            <img src="{{ config('app.main_url').'/images/bundles/'.$bundle->id.'/'.$bundle->thumbnail }}" class="img-fluid" alt="">
                                        </div>
		                            </div>
		                        </div>

							</div>

	                        <div class="form-actions">
	                            <button type="button" data-bundle-id="{{ $bundle->id }}" id="deleteBundle" class="btn btn-danger mr-1">
	                            	<i class="fa fa-remove"></i> Delete this bundle
	                            </button>
	                            <button type="submit" class="btn btn-info">
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
<!--/ Update bundle form table -->

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