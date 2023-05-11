@extends('layouts.app', [
    'title' => 'Meeting Confirmed',
    'active' => 'courses',
    'scripts' => 'pages.coach.meeting-confirmation'
])

@section('content')
<div class="container" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-right">
                <div class="card-header">
                    <h3>
                        <i class="fa fa-calendar"></i>
                        تفاصيل الجلسة
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>أسم العميل</td>
                                <td>{{ $coachSessionBooking->name }}</td>
                            </tr>
        
                            <tr>
                                <td>البريد الالكتروني</td>
                                <td>{{ $coachSessionBooking->email }}</td>
                            </tr>

                            <tr>
                                <td>رقم الهاتف</td>
                                <td>{{ $coachSessionBooking->whatsapp_number }}</td>
                            </tr>

                            <tr>
                                <td>تاريخ الجلسة</td>
                                <td>{{ $coachSessionBooking->belongsToAppointment->belongsToCoachSessionDate->date }}</td>
                            </tr>

                            <tr>
                                <td>وقت بدء الجلسة</td>
                                <td>
                                    @php
                                        list($start_time, $start_time_attr) = explode(' ', date("h:i a", strtotime($coachSessionBooking->belongsToAppointment->start_time)));
                                        $start_time_am_or_pm = $start_time_attr == 'am' ? 'صباحا' : 'مساء';
                                    @endphp
                                    {{ $start_time.' '.$start_time_am_or_pm }}
                                </td>
                            </tr>

                            <tr>
                                <td>وقت انتهاء الجلسة</td>
                                <td>
                                    @php
                                        list($end_time, $end_time_attr) = explode(' ', date("h:i a", strtotime($coachSessionBooking->belongsToAppointment->end_time)));
                                        $end_time_am_or_pm = $end_time_attr == 'am' ? 'صباحا' : 'مساء';
                                    @endphp
                                    {{ $end_time.' '.$end_time_am_or_pm }}
                                </td>
                            </tr>

                            <tr>
                                <td>العد التنازلي للجلسة</td>
                                <td>
                                    <p id="demo"></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection