@extends('student.layouts.app',[
    'title' => 'اسم الدورة',
    'active' => 'student.my-courses',
])

@section('content')
<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">

                <div class="js-player card bg-primary text-center embed-responsive embed-responsive-16by9 mb-24pt">
                    <div class="player embed-responsive-item">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <p class="lead text-white-70 measure-lead">It’s not every day that one of the most important front-end libraries in web development gets a complete overhaul. Keep your skills relevant and up-to-date with this comprehensive introduction to Google’s popular community project.</p>

                            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center">
                                <a href="student-take-lesson.html"
                                   class="btn btn-white">Resume course</a>
                            </div>
                        </div>
                        <div class="player__embed d-none">
                            <iframe class="embed-responsive-item"
                                    src="https://player.vimeo.com/video/97243285?title=0&amp;byline=0&amp;portrait=0"
                                    allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>

                <div class="mb-24pt">
                    <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                        <i class="material-icons icon--left">schedule</i>
                        2h 46m
                    </span>
                    <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                        <i class="material-icons icon--left">assessment</i>
                        Beginner
                    </span>
                </div>

                <div class="row mb-32pt">
                    <div class="col-md-12">
                        <div class="page-separator">
                            <div class="page-separator__text">About this course</div>
                        </div>
                        <p class="text-70">This course will teach you the fundamentals o*f working with Angular 2. You *will learn everything you need to know to create complete applications including: components, services, directives, pipes, routing, HTTP, and even testing.</p>
                        <p class="text-70 mb-0">This course will teach you the fundamentals o*f working with Angular 2. You *will learn everything you need to know to create complete applications including: components, services, directives, pipes, routing, HTTP, and even testing.</p>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">المحاضرين</div>
                </div>

                <div class="media align-items-center mb-16pt">
                    <span class="media-left mr-16pt">
                        <img src="{{ asset('assets/dashboard/images/people/50/guy-6.jpg') }}"
                             width="40"
                             alt="avatar"
                             class="rounded-circle">
                    </span>
                    <div class="media-body">
                        <a class="card-title m-0"
                           href="teacher-profile.html">Eddie Bryan</a>
                        <p class="text-50 lh-1 mb-0">Instructor</p>
                    </div>
                </div>

                {{-- Feedback --}}

                {{-- <div class="page-separator">
                    <div class="page-separator__text">Student Feedback</div>
                </div>

                <div class="row mb-32pt">
                    <div class="col-md-3 mb-32pt mb-md-0">
                        <div class="display-1">4.7</div>
                        <div class="rating rating-24">
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star_border</span></span>
                        </div>
                        <p class="text-muted mb-0">20 ratings</p>
                    </div>
                    <div class="col-md-9">

                        <div class="row align-items-center mb-8pt"
                             data-toggle="tooltip"
                             data-title="75% rated 5/5"
                             data-placement="top">
                            <div class="col-md col-sm-6">
                                <div class="progress"
                                     style="height: 8px;">
                                    <div class="progress-bar bg-secondary"
                                         role="progressbar"
                                         aria-valuenow="75"
                                         style="width: 75%"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                <div class="rating">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-8pt"
                             data-toggle="tooltip"
                             data-title="16% rated 4/5"
                             data-placement="top">
                            <div class="col-md col-sm-6">
                                <div class="progress"
                                     style="height: 8px;">
                                    <div class="progress-bar bg-secondary"
                                         role="progressbar"
                                         aria-valuenow="16"
                                         style="width: 16%"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                <div class="rating">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-8pt"
                             data-toggle="tooltip"
                             data-title="12% rated 3/5"
                             data-placement="top">
                            <div class="col-md col-sm-6">
                                <div class="progress"
                                     style="height: 8px;">
                                    <div class="progress-bar bg-secondary"
                                         role="progressbar"
                                         aria-valuenow="12"
                                         style="width: 12%"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                <div class="rating">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-8pt"
                             data-toggle="tooltip"
                             data-title="9% rated 2/5"
                             data-placement="top">
                            <div class="col-md col-sm-6">
                                <div class="progress"
                                     style="height: 8px;">
                                    <div class="progress-bar bg-secondary"
                                         role="progressbar"
                                         aria-valuenow="9"
                                         style="width: 9%"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                <div class="rating">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-8pt"
                             data-toggle="tooltip"
                             data-title="0% rated 0/5"
                             data-placement="top">
                            <div class="col-md col-sm-6">
                                <div class="progress"
                                     style="height: 8px;">
                                    <div class="progress-bar bg-secondary"
                                         role="progressbar"
                                         aria-valuenow="0"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                <div class="rating">
                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pb-16pt mb-16pt border-bottom row">
                    <div class="col-md-3 mb-16pt mb-md-0">
                        <div class="d-flex">
                            <a href="student-profile.html"
                               class="avatar avatar-sm mr-12pt">
                                <!-- <img src="LB" alt="avatar" class="avatar-img rounded-circle"> -->
                                <span class="avatar-title rounded-circle">LB</span>
                            </a>
                            <div class="flex">
                                <p class="small text-muted m-0">2 days ago</p>
                                <a href="student-profile.html"
                                   class="card-title">Laza Bogdan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="rating mb-8pt">
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star_border</span></span>
                        </div>
                        <p class="text-70 mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                    </div>
                </div>

                <div class="pb-16pt mb-16pt border-bottom row">
                    <div class="col-md-3 mb-16pt mb-md-0">
                        <div class="d-flex">
                            <a href="student-profile.html"
                               class="avatar avatar-sm mr-12pt">
                                <!-- <img src="UK" alt="avatar" class="avatar-img rounded-circle"> -->
                                <span class="avatar-title rounded-circle">UK</span>
                            </a>
                            <div class="flex">
                                <p class="small text-muted m-0">2 days ago</p>
                                <a href="student-profile.html"
                                   class="card-title">Umberto Klass</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="rating mb-8pt">
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star_border</span></span>
                        </div>
                        <p class="text-70 mb-0">This course is absolutely amazing, Bryan goes* out of his way to really expl*ain things clearly I couldn&#39;t be happier, so glad I made this purchase!</p>
                    </div>
                </div>

                <div class="pb-16pt mb-24pt row">
                    <div class="col-md-3 mb-16pt mb-md-0">
                        <div class="d-flex">
                            <a href="student-profile.html"
                               class="avatar avatar-sm mr-12pt">
                                <!-- <img src="AD" alt="avatar" class="avatar-img rounded-circle"> -->
                                <span class="avatar-title rounded-circle">AD</span>
                            </a>
                            <div class="flex">
                                <p class="small text-muted m-0">2 days ago</p>
                                <a href="student-profile.html"
                                   class="card-title">Adrian Demian</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="rating mb-8pt">
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star</span></span>
                            <span class="rating__item"><span class="material-icons">star_border</span></span>
                        </div>
                        <p class="text-70 mb-0">This course is absolutely amazing, Bryan goes* out of his way to really expl*ain things clearly I couldn&#39;t be happier, so glad I made this purchase!</p>
                    </div>
                </div> --}}

            </div>
            <div class="col-lg-4">

                <div class="page-separator">
                    <div class="page-separator__text">1. الجزء الاول ( خاص بالتعرف علي الافكار التلقائية )</div>
                </div>

                <div class="media align-items-center mb-16pt">
                    <ul class="list-group list-group-flush w-100">
                        <li class="list-group-item">
                            <a href="" class="font-weight-bold" style="color: black;">Cras justo odio</a>
                            <div class="float-right">
                                <i class="fa fa-check text-success"></i>
                            </div>
                        </li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>


                <div class="page-separator">
                    <div class="page-separator__text">2. الجزء الثاني ( خصائص الافكار التلقائية )</div>
                </div>

                <div class="media align-items-center mb-16pt">
                    <ul class="list-group list-group-flush w-100">
                        <li class="list-group-item">
                            <a href="" class="font-weight-bold" style="color: black;">Cras justo odio</a>
                            <div class="float-right">
                                <i class="fa fa-check text-success"></i>
                            </div>
                        </li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection