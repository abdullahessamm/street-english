@extends('layouts.app', [
    'title' => 'جلسة : '.$mySession->name ,
    'active' => 'my-sessions',
    'breadcrumb' => [
        'title' => 'جلسة : '.$mySession->name ,
        'map' => [
            'Dashboard' => 'home',
            'جلساتي' => 'coaches',
            'جلسة : '.$mySession->name => [
				'route' => 'my-session.show',
				'slug' => $mySession->slug
			],
			'التواريخ' => 'active'
        ]
    ],
	'header_right' => [
		'btn' => [
			'text' => 'انشاء تاريخ لهذة الجلسة',
			'id' => 'createSessionDate',
            'data' => [
                'my-session-id' => $mySession->id
            ],
			'color' => 'success',
			'bold' => true,
		]
    ],
    'assets' => 'pages.my-session.dates'
])

@section('content')
<!-- Create coaches section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">التواريخ</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
                        <div class="row">
                        @if($mySession->dates->count() > 0)
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>تاريخ الجلسة</th>
                                            <th>عدد المواعيد في هذا التاريخ</th>
                                            <th>مسح هذا التاريخ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mySession->dates as $mySessionDate)
                                        <tr id="tr_date_{{$mySessionDate->id}}">
                                            <td>{{ $mySessionDate->date }}</td>
                                            <td>
                                                <a href="{{ route('my-session.appointments', [$mySession->slug, $mySessionDate->slug]) }}">{{ $mySessionDate->appointments->count() }}</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm font-weight-bold deleteDate" data-date-id="{{ $mySessionDate->id }}">مسح التاريخ</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="jumbotron text-center">
                                    <h1>لا يوجد تاريخ بهذا الميعاد</h1>
                                </div>
                            </div>
                        @endif
                        </div>
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


<!-- Create Session Date Modal -->
<div class="modal" id="createSessionDateModal" tabindex="-1" role="dialog" aria-labelledby="createSessionDateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
			<form id="createMySessionDate">
				{{ csrf_field() }}
				<input type="hidden" name="my_session_id" value="{{ $mySession->id }}">
				<div class="modal-body text-left">
					<div class="form-group">
						<label for="date">تاريخ الجلسة</label>
						<input type="date" class="form-control" name="date" id="date" required>
					</div>	
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-success"> انشاء </button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
				</div>
			</form>
        </div>
    </div>
</div>
@endsection