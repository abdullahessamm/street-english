@extends('layouts.app', [
    'title' => 'جلسة : '.$mySession->name ,
    'active' => 'my-sessions',
    'breadcrumb' => [
        'title' => 'جلسة : '.$mySession->name ,
        'map' => [
            'Dashboard' => 'home',
            'جلساتي' => 'coaches',
            'جلسة : '.$mySession->name => 'active'
        ]
    ],
	'header_right' => [
		'href' => [
			'text' => 'اضافة مواعيد لهذة الجلسة',
			'route' => [
				'route' => 'my-session.dates',
				'slugs' => $mySession->slug
			],
			'color' => 'info',
			'bold' => true,
		],
    ],
    'scripts' => 'pages.my-session.show'
])

@section('content')
<!-- Create coaches section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">تحديث جلسة : {{ $mySession->name }}</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
	                    <form id="updateSession" class="form form-horizontal striped-labels form-bordered">
                            {{ csrf_field() }}
							<input type="hidden" name="my_session_id" value="{{ $mySession->id }}">
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-user"></i> معلومات عن الجلسىة</h4>

			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="session_name">اسم الجلسة</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="session_name" class="form-control" placeholder="مثال : جلسة نفسية للاطفال" name="session_name" value="{{ $mySession->name }}" required>
		                            </div>
		                        </div>

								<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="description">
										عن الجلسة
										<br>
										<small class="font-weight-bold">( اختياري )</small>
									</label>
		                            <div class="col-md-9">
										<textarea name="description" id="description" class="form-control" cols="30" rows="10">{!! strip_tags($mySession->description) !!}</textarea>
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="submit" class="btn btn-primary">
	                                <i class="fa fa-check"></i> تحديث
	                            </button>
								<button type="submit" class="btn btn-danger" id="deleteMySession" data-my-session-id="{{ $mySession->id }}">
	                                <i class="fa fa-trash"></i> مسح الجلسة
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Create coaches section end -->

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

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteMySessionModal" tabindex="-1" role="dialog" aria-labelledby="deleteMySessionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmDeleteMySessionID">
				<h2>هل انت متأكد من انك تريد مسح الجلسة</h2>
				<h6><b class="text-warning">تحذير:</b> اذا تم مسح هذة الجلسة جميع التاريخ بمواعيدها بعملائها سيتم مسحها من قاعدة البيانات</h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmDeleteMySession">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
            </div>
        </div>
    </div>
</div>
@endsection