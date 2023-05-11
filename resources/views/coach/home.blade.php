@extends('coach.layouts.app')

@section('content')
<div class="page-section">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">

                <div class="mb-24pt">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card border-1 border-left-3 border-left-accent text-center mb-lg-0">
                                <div class="card-body">
                                    <h4 class="h2 mb-0">&dollar;0</h4>
                                    <div>ارباحك هذا الشهر</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card text-center mb-lg-0">
                                <div class="card-body">
                                    <h4 class="h2 mb-0">&dollar;0</h4>
                                    <div>اجمالي مبيعاتك</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">عمليات الشراء</div>
                </div>

                <div class="card">
                    <table class="table table-flush table-nowrap">
                        <thead>
                            <tr>
                                <th>اسم الكورس</th>
                                <th>تاريخ عملية الشراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex flex-nowrap align-items-center">
                                        <a href="instructor-edit-course.html"
                                            class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                            <img src="{{ asset('public/assets/dashboard/images/paths/angular_routing_200x168.png') }}"
                                                    alt="course"
                                                    class="avatar-img rounded">
                                            <span class="overlay__content"></span>
                                        </a>
                                        <div class="flex">
                                            <a class="card-title js-lists-values-course"
                                                href="instructor-edit-course.html">Angular Routing In-Depth</a>
                                            <small class="text-muted mr-1">
                                                Invoice
                                                <a href="invoice.html"
                                                    style="color: inherit;"
                                                    class="js-lists-values-document">#8734</a> -
                                                &dollar;<span class="js-lists-values-amount">89</span> USD
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>12 Nov 2018</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">اخر التعليقات</div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-left mr-12pt">
                                <a href="#"
                                    class="avatar avatar-sm">
                                    <!-- <img src="{{ asset('public/assets/dashboard/images/people/110/guy-9.jpg') }}" alt="Guy" class="avatar-img rounded-circle"> -->
                                    <span class="avatar-title rounded-circle">LB</span>
                                </a>
                            </div>
                            <div class="media-body d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <a href="profile.html"
                                        class="card-title">Laza Bogdan</a>
                                    <small class="ml-auto text-muted">27 min ago</small><br>
                                </div>
                                <span class="text-muted">on <a href="instructor-edit-course.html"
                                        class="text-50"
                                        style="text-decoration: underline;">Data Visualization With Chart.js</a></span>
                                <p class="mt-1 mb-0 text-70">How can I load Charts on a page?</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                @include('coach.includes.my-account',[
                    'title' => 'صفحتي الشخصية',
                    'active' => 'coach.home'
                ])

                @include('coach.includes.popular-courses')
            </div>
        </div>

    </div>
</div>
@endsection
