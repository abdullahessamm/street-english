@extends('student.layouts.app',[
    'title' => 'مواعيد جلساتي',
    'active' => 'student.my-sessions',
])

@section('content')
<div class="page-section">
    <div class="container page__container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>تاريخ الجلسة</th>
                            <th>وقت بدء الجلسة</th>
                            <th>وقت انتهاء الجلسة</th>
                            <th>تم حجز الجلسة بتاريخ</th>
                            <th>الغاء الجلسة</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection