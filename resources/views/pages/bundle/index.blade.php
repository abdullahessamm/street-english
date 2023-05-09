@extends('layouts.app', [
    'title' => 'Bundles',
    'active' => 'bundles',
    'breadcrumb' => [
        'title' => 'Bundles',
        'map' => [
            'Dashboard' => 'home',
            'Bundles' => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Create new Bundle',
			'id' => 'openCreateNewBundleModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'scripts' => 'pages.bundle.index'
])

@section('content')
<!-- List of all Bundles table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all bundles</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered" id="bundles">
                            <thead>
                                <tr>
                                    <th>Bundle Name</th>
                                    <th>No. of Courses</th>
                                    <th>Registed Users</th>
                                    <th>Created at</th>
                                    <th>Delete Bundle</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Bundle Name</th>
                                    <th>No. of Courses</th>
                                    <th>Registed Users</th>
                                    <th>Created at</th>
                                    <th>Delete Bundle</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ List of all Bundles table -->

<!-- Append New Courses Bundle Modal -->
<div class="modal fade" id="createNewBundleModal" tabindex="-1" role="dialog" aria-labelledby="createNewBundleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="createNewBundleModalLabel">Create New Bundle</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="createNewBundle">
			{{ csrf_field() }}
			<div class="modal-body">
				<div class="form-group">
					<label for="bundle_name">Bundle Name</label>
					<input type="text" class="form-control" name="bundle_name" id="bundle_name" required>
				</div>

                <div class="form-group">
					<label for="price">Bundle Price</label>
					<input type="text" class="form-control" name="price" id="price" pattern="[0-9]+" required>
				</div>

                <div class="form-group">
					<label for="thumbnail">
                        Bundle Thumbnail
                    </label>
					<input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
				</div>

                <div class="form-group">
					<label for="banner">
                        Bundle Banner
                        <small>(Optional)</small>
                    </label>
					<input type="file" class="form-control" name="banner" id="banner">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</form>
	</div>
	</div>
</div>

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