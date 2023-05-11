@extends('coach.layouts.app',[
    'title' => 'جلسة بتاريخ : '.$coachSessionDate->date,
    'scripts' => 'pages.my-session.date'
])

@section('content')
<div class="page-section">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">
                
                <div class="page-separator">
                    <div class="page-separator__text">اضافة مواعيد جديدة جديدة</div>
                </div>

                <form id="addMoreAppointments">
                    {{ csrf_field() }}
                    <input type="hidden" name="coach_session_date_id" value="{{ $coachSessionDate->id }}">
                    <div class="row">
                        <div class="col-12">
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
                                                <label for="link">رابط الميعاد</label>
                                                <textarea name="link" class="form-control border-success"  id="link" cols="30" rows="3" required></textarea>
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
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check mx-2"></i>
                            اضافة المواعيد الجديدة
                        </button>
                    </div>
                </form>

                <div class="page-separator">
                    <div class="page-separator__text">مواعيد بتاريخ : {{ $coachSessionDate->date }}</div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>وقت بدء الجلسة</th>
                            <th>وقت انتهاء الجلسة</th>
                            <th>محجوز</th>
                            <th>مسح الميعاد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coachSessionDate->appointments as $appointment)
                        <tr id="tr_appointment_{{$appointment->id}}">
                            <td>
                                @php
                                    list($start_time, $start_time_attr) = explode(' ', date('h:i a', strtotime($appointment->start_time)));

                                @endphp

                                {{ $start_time }} {{ $start_time_attr == 'am' ? 'صباحا' : 'مساء' }}
                            </td>
                            <td>
                                @php
                                    list($end_time, $end_time_attr) = explode(' ', date('h:i a', strtotime($appointment->end_time)));
                                @endphp
                                
                                {{ $end_time }} {{ $end_time_attr == 'am' ? 'صباحا' : 'مساء' }}
                            </td>
                            <td class="{{ $appointment->isTaken == 1 ? 'text-success' : 'text-danger'}}">
                            @if($appointment->isTaken == 1)
                                <i class="fa fa-check mx-1"></i>
                                نعم
                            @else
                                <i class="fa fa-times mx-1"></i>
                                لا
                            @endif
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm font-weight-bold deleteAppointment" data-appointment-id="{{ $appointment->id }}">مسح الجلسة</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">

                <div class="page-separator">
                    <div class="page-separator__text">الحجوزات بتاريخ : {{ $coachSessionDate->date }}</div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>اسم العميل</th>
                            <th>الميعاد</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="{{ route('coach.my-session.appointment', ['my-session-title', '7-1-2021', 'soheil@gmail.com']) }}" class="text-info">
                                    احمد محمد محمود
                                </a>
                            </td>
                            <td>
                                من 1:00 مساء الي 2:00 مساء
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                @include('coach.includes.my-account', [
                    'active' => 'coach.my-sessions', 
                    'title' => 'جلساتي'
                ])

                <div class="card">
                    <div class="card-header text-center">
                        <button class="btn btn-danger btn-sm font-weight-bold" id="deleteDate" data-date-id="{{ $coachSessionDate->id }}" data-my-session-slug="{{ $coachSessionDate->belongsToCoachSession->slug }}">مسح هذا التاريخ</button>
                    </div>
                </div>
            </div>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body">
                {!! errorMsg('حدث خطاء ما') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal"> اغلاق النافذة </button>
            </div>
        </div>
    </div>
</div>
@endsection