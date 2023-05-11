@extends('student.layouts.app',[
    'title' => $myOnlineCourse->name,
    'active' => 'student.my-courses',
])

@section('content')
<div class="page-section border-bottom-2">
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-8">
                <div class="jumbotron text-center">
                    <h1>انت محظور من هذة الدورة</h1>
                    <h3>لا يمكنك متابعة هذة الدورة لان تم حظرك من قبل الادارة في دورة {{ $myOnlineCourse->name }}</h3>
                    <h6>اذا تريد متابعة هذة الدورة برجاء قم بارسال بريد الكتروني  الي : {{ config('app.email.support') }} </h6>
                </div>
            </div>
            <div class="col-lg-4">
                @include('student.includes.popular-courses')
            </div>
        </div>
    </div>
</div>
@endsection