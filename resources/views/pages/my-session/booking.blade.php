@extends('layouts.app', [
    'title' => ' حجز باسم : '.$myAppointment->booking->name,
    'active' => 'my-sessions',
    'breadcrumb' => [
        'title' => ' حجز باسم : '.$myAppointment->booking->name,
        'map' => [
            'Dashboard' => 'home',
            'جلساتي' => 'my-sessions',
            'جلسة : '.$myAppointment->belongsToMySessionDate->belongsToMySession->name => [
				'route' => 'my-session.show',
				'slug' => $myAppointment->belongsToMySessionDate->belongsToMySession->slug
			],
			'تواريخ الجلسة' => [
                'route' => 'my-session.dates',
				'slug' => $myAppointment->belongsToMySessionDate->belongsToMySession->slug,
            ],
			'المواعيد الخاصة بهذا التاريخ : ' => [
                'route' => 'my-session.appointments',
                'slug' => [
                    $myAppointment->belongsToMySessionDate->belongsToMySession->slug,
                    $myAppointment->belongsToMySessionDate->slug
                ]
            ],
            ' حجز باسم : '.$myAppointment->booking->name => 'active',
        ]
    ],
    'scripts' => 'pages.my-session.booking'
])

@section('content')
<!-- Booking Details section start -->
<section id="striped-label-form-layouts">
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-basic">تفاصيل الحجز</h4>
	                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-content collapse show">
	                <div class="card-body">
                        <form class="form form-horizontal striped-labels form-bordered">
                            <div class="form-body">
                                <h4 class="form-section"><i class="fa fa-user"></i> معلومات عن العميل</h4>


                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="online_course_name">أسم المستخدم</label>
                                    <div class="col-md-9">
                                        {{ $myAppointment->booking->name }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="online_course_name">البريد الالكتروني</label>
                                    <div class="col-md-9">
                                        {{ $myAppointment->booking->email }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="online_course_name">رقم الهاتف</label>
                                    <div class="col-md-9">
                                        {{ $myAppointment->booking->whatsapp_number }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="online_course_name">قام بحجز ميعاد</label>
                                    <div class="col-md-9">
                                        من الساعة 
                                        @php
                                            list($start_time, $start_time_attr) = explode(' ', date("h:i a", strtotime($myAppointment->start_time)));
                                            $start_time_am_or_pm = $start_time_attr == 'am' ? 'صباحا' : 'مساء';

                                            list($end_time, $end_time_attr) = explode(' ', date("h:i a", strtotime($myAppointment->end_time)));
                                            $end_time_am_or_pm = $end_time_attr == 'am' ? 'صباحا' : 'مساء';
                                        @endphp
                                        <span class="text-success font-weight-bold">{{ $start_time.' '.$start_time_am_or_pm }}</span>
                                        الي الساعة
                                        <span class="text-danger font-weight-bold">{{ $end_time.' '.$end_time_am_or_pm }}</span>
                                        بتاريخ
                                        <span class="text-primary font-weight-bold" dir="ltr">{{ $myAppointment->belongsToMySessionDate->date }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="online_course_name">قام بحجز في تاريخ</label>
                                    <div class="col-md-9">
                                        {{ $myAppointment->booking->created_at }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="online_course_name">هل العميل مسجل لدينا</label>
                                    <div class="col-md-9">
                                        {!! $myAppointment->booking->user_id == null ? '<span class="text-danger font-weight-bold">ليس مسجل لدينا</span>' : '<a class="text-info font-weight-bold" href="'.route('student.show', $myAppointment->booking->user_id).'">نعم مسجل لدينا اضغط هنا لعرض الملف الشخصي</a>' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-danger mr-1" id="deleteBookingAppointment" data-appointment-booking-id="{{ $myAppointment->booking->my_session_appointment_id }}">
                                    <i class="fa fa-remove"></i> الغاء الحجز
                                </button>
                            </div>
                        </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<!-- // Booking Details section end -->

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
<div class="modal" id="deleteBookingAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="deleteBookingAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmdeleteBookingAppointmentID">
				<h2>هل انت متأكد من انك تريد مسح الحجز</h2>
				<button type="button" class="btn btn-danger" id="confirmdeleteBookingAppointment">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
            </div>
        </div>
    </div>
</div>

@endsection