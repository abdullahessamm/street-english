@extends('layouts.app', [
    'title' => 'جلسة : '.$mySessionDate->belongsToMySession->name ,
    'active' => 'my-sessions',
    'breadcrumb' => [
        'title' => 'جلسة : '.$mySessionDate->belongsToMySession->name ,
        'map' => [
            'Dashboard' => 'home',
            'جلساتي' => 'coaches',
            'جلسة : '.$mySessionDate->belongsToMySession->name => [
				'route' => 'my-session.show',
				'slug' => $mySessionDate->belongsToMySession->slug
			],
			'تواريخ الجلسة' => [
                'route' => 'my-session.dates',
				'slug' => $mySessionDate->belongsToMySession->slug,
            ],
			'المواعيد الخاصة بهذا التاريخ : '.$mySessionDate->date => 'active'
        ]
    ],
    'assets' => 'pages.my-session.appointments'
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
                    <div class="row">
                        <div class="col-12">
                            <form id="createNewAppintment">
                                {{ csrf_field() }}
                                <input type="hidden" name="my_session_date_id" value="{{ $mySessionDate->id }}">

                                <div class="repeater-default">
									<div data-repeater-list="appointments">
										<div data-repeater-item>
											<div class="form-group row">
												<div class="col-3">
													<label for="start_time">وقت بدء الجلسة</label>
													<input type="time" class="form-control" name="start_time" id="start_time" required>
												</div>

                                                <div class="col-3">
													<label for="end_time">وقت انتهاء الجلسة</label>
													<input type="time" class="form-control" name="end_time" id="end_time" required>
												</div>

                                                <div class="col-3">
													<label for="link">رابط الجلسة</label>
													<input type="url" class="form-control" name="link" id="link" required>
												</div>
												
												<div class="col-2">
													<button type="button" class="btn btn-danger mt-2" data-repeater-delete> <i class="ft-x"></i> مسح</button>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group overflow-hidden">
										<div class="col-12">
											<button type="button" data-repeater-create class="btn btn-primary">
												<i class="ft-plus"></i> اضافة
											</button>
										</div>
									</div>
								</div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success"> انشاء المواعيد </button>
                                </div>
                            </form>
                        </div>
                    </div>

	                <div class="card-body row">
                    @if($mySessionDate->appointments->count() > 0)
	                    <table class="table col-12">
                            <thead>
                                <tr>
                                    <th>وقت بدء الجلسة</th>
                                    <th>وقت انتهاء الجلسة</th>
                                    <th>محجوز</th>
                                    <th>مسح</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mySessionDate->appointments as $appointment)
                                <tr id="tr_appointment_{{$appointment->id}}">
                                    <td>{{ date("h:i a", strtotime($appointment->start_time)) }}</td>
                                    <td>{{ date("h:i a", strtotime($appointment->end_time)) }}</td>
                                    <td>
                                    @if($appointment->isTaken == 1)
                                        <a href="{{ route('my-session.booking', [$mySessionDate->belongsToMySession->slug, $mySessionDate->slug, $appointment->id, $appointment->booking->slug]) }}" class="text-success font-weight-bold">نعم</a>
                                    @else
                                        <span class="text-danger font-weight-bold">لا</span>    
                                    @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm font-weight-bold deleteAppointment" data-appointment-id="{{ $appointment->id }}">مسح الميعاد</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-12">
                            <div class="jumbotron text-center">
                                <h1>ليس لديك مواعيد في هذا اليوم</h1>
                            </div>
                        </div>
                    @endif
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

@endsection