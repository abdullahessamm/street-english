@extends('coach.layouts.app',[
    'title' => 'اسم الجلسة',
    'scripts' => 'pages.my-session.show'
])

@section('content')
<div class="page-section">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">
                <div class="page-separator">
                    <div class="page-separator__text">تحديث بيانات الجلسة</div>
                </div>

                <form id="updateSession">
                    {{ csrf_field() }}
                    <input type="hidden" name="my_session_id" value="{{$coachSession->id}}">
                    <div class="form-group">
                        <label for="session_name">اسم الجلسة</label>
                        <input type="text" class="form-control border-success" name="session_name" id="session_name" value="{{ $coachSession->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">
                            عن الجلسة
                            <small>(اختياري)</small>
                        </label>
                        <textarea name="description" id="description" class="form-control border-success" cols="30" rows="3">{{ strip_tags($coachSession->description) }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mx-2"></i>
                            تحديث البيانات
                        </button>
                    </div>
                </form>

                <div class="page-separator">
                    <div class="page-separator__text">اضافة تاريخ جديد</div>
                </div>

                <form id="addNewSessionDates">
                    {{ csrf_field() }}
                    <input type="hidden" name="coach_session_id" value="{{$coachSession->id}}">
                    <input type="hidden" name="coach_session_slug" value="{{$coachSession->slug}}">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="session_date">تاريخ الجلسة</label>
                            <input type="date" class="form-control border-success" name="session_date" id="session_date" required>
                        </div>
                    </div>

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
                            انشاء الجلسة
                        </button>
                    </div>
                </form>

                <div class="page-separator">
                    <div class="page-separator__text">تواريخ الجلسة</div>
                </div>

                @if($coachSessionDates->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>تاريخ الجلسة</th>
                            <th>مسح التاريخ الخاص بالجلسة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coachSessionDates as $eachDate)
                        <tr>
                            <td>
                                <a href="{{ route('coach.my-session.date', [$eachDate->belongsToCoachSession->slug, $eachDate->slug]) }}" class="text-info">
                                    {{ $eachDate->date }}
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm font-weight-bold">مسح الميعاد</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="row">
                    <div class="col-12">
                        <div class="jumbotron text-center">
                            <h3>ليس لديك اي تواريخ بهذا الميعاد</h3>
                        </div>
                    </div>
                </div>  
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header text-center">
                        <button type="button" class="btn btn-danger" id="deleteMySession" data-my-session-id="{{ $coachSession->id }}">
                            <i class="fa fa-trash mx-2"></i> مسح الجلسة
                        </button>
                    </div>
                </div>

                @include('coach.includes.my-account', [
                    'active' => 'coach.my-sessions', 
                    'title' => 'جلساتي'
                ])

                @include('coach.includes.popular-courses')
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

<!-- Delete Content Confirmation Modal -->
<div class="modal" id="deleteMySessionModal" tabindex="-1" role="dialog" aria-labelledby="deleteMySessionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-right">
            <div class="modal-body text-center">
				<input type="hidden" id="confirmDeleteMySessionID">
				<h2>هل انت متأكد من انك تريد مسح الجلسة</h2>
				<h6><b class="text-warning">تحذير:</b> اذا تم مسح هذة الجلسة جميع التاريخ بمواعيدها بعملائها سيتم مسحها </h6>
				<hr>
				<button type="button" class="btn btn-danger" id="confirmDeleteMySession">نعم</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="onCloseModal">لا</button>
            </div>
        </div>
    </div>
</div>
@endsection