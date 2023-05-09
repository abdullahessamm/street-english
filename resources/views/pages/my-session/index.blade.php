@extends('layouts.app', [
    'title' => 'حجوزاتي',
    'active' => 'حجوزاتي',
    'breadcrumb' => [
        'title' => 'حجوزاتي',
        'map' => [
            'Dashboard' => 'home',
            'حجوزاتي' => 'active',
        ]
    ],
    'header_right' => [
		'href' => [
			'text' => 'انشاء جلسة جديدة',
			'route' => 'my-session.create',
			'color' => 'success',
			'bold' => true,
		]
    ],
    'scripts' => 'pages.my-session.index'
])

@section('content')
<!-- List of all Instructors table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">قائمة بجميع حجوزاتي</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered" id="my-sessions">
                            <thead>
                                <tr>
                                    <th>اسم الجلسة</th>
                                    <th>عدد الجلسات</th>
                                    <th>مسح الجلسة</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>اسم الجلسة</th>
                                    <th>عدد الجلسات</th>
                                    <th>مسح الجلسة</th>
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
@endsection