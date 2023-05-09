@extends('layouts.app', [
    'title' => 'Coach Catogries',
    'active' => 'coach.categories',
    'breadcrumb' => [
        'title' => 'Coach Catogries',
        'map' => [
            'Dashboard' => 'home',
            'Coach Catogries' => 'active',
        ]
    ],
    'header_right' => [
		'btn' => [
			'text' => 'Create New Coach Category',
			'id' => 'openCreateNewCoachCategoryModalForm',
			'color' => 'info',
			'bold' => true,
		],
    ],
    'scripts' => 'pages.coach.categories.index'
])

@section('content')
<!-- List of all Instructors table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of all coach catogries</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered" id="coaches">
                            <thead>
                                <tr>
                                    <th>اسم الفئة</th>
                                    <th>عدد المدربين</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>اسم الفئة</th>
                                    <th>عدد المدربين</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ List of all Instructors table -->

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

<!-- Create New Content Modal -->
<div class="modal fade" id="createNewCoachCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createNewCoachCategoryLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="createNewCoachCategoryLabel">Create New Coach Category</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form id="createNewCoachCategoryForm">
			{{ csrf_field() }}
			<div class="modal-body">
				<div class="form-body">
                    <label for="coach_category_name">Coach Category Name</label>
                    <input type="text" class="form-control" name="coach_category_name" id="coach_category_name" required>
                </div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Append</button>
			</div>
		</form>
	</div>
	</div>
</div>
@endsection