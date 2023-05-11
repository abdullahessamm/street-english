@extends('coach.layouts.app',[
    'title' => 'دوراتي',
])

@section('content')
<div class="page-section">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">

                <div class="page-separator">
                    <div class="page-separator__text">انشاء دورة جديدة</div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('coach.my-course.create') }}" class="btn btn-primary">اضغط هنا لانشاء دورة جديد</a>
                    </div>
                </div>

                {{-- <div class="page-separator">
                    <div class="page-separator__text">Development Courses</div>
                </div> --}}

                <div class="row">
                @if($onlineCourseInstructor->count() > 0)
                    @foreach($onlineCourseInstructor as $eachCourse)
                    <div class="col-sm-6 col-xl-4">

                        <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary js-overlay mdk-reveal js-mdk-reveal "
                            data-overlay-onload-show
                            data-popover-onload-show
                            data-force-reveal
                            data-partial-height="44"
                            data-toggle="popover"
                            data-trigger="click">
                            <a href="{{ route('coach.my-course.show', $eachCourse->course->slug) }}"
                            class="js-image"
                            data-position="">
                                <img src="{{ asset('images/online-courses/'.$eachCourse->course->id.'/'.$eachCourse->course->thumbnail) }}" class="img-fluid" style="height: 150px;max-height: 150px;" alt="course">
                                <span class="overlay__content align-items-start justify-content-start">
                                    <span class="overlay__action card-body d-flex align-items-center">
                                        <i class="material-icons mr-4pt">edit</i>
                                        <span class="card-title text-white">Edit</span>
                                    </span>
                                </span>
                            </a>
                            <div class="mdk-reveal__content">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex">
                                            <a class="card-title mb-4pt"
                                            href="{{ route('coach.my-course.show', $eachCourse->course->slug) }}">{{ $eachCourse->course->name }}</a>
                                        </div>
                                        <a href="{{ route('coach.my-course.show', 'my-course-title') }}"
                                        class="ml-4pt material-icons text-20 card-course__icon-favorite">edit</a>
                                    </div>
                                    <div class="d-flex">
                                        <div class="rating flex">
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star_border</span></span>
                                        </div>
                                        <small class="text-50">6 hours</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="mb-32pt">
                        <ul class="pagination justify-content-start pagination-xsm m-0">
                            <li class="page-item disabled">
                                <a class="page-link"
                                href="#"
                                aria-label="Previous">
                                    <span aria-hidden="true"
                                        class="material-icons">chevron_left</span>
                                    <span>Prev</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"
                                href="#"
                                aria-label="Page 1">
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"
                                href="#"
                                aria-label="Page 2">
                                    <span>2</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"
                                href="#"
                                aria-label="Next">
                                    <span>Next</span>
                                    <span aria-hidden="true"
                                        class="material-icons">chevron_right</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="col-12">
                        <div class="jumbotron text-center">
                            <h3>ليس لديك اي دورات تدريبية</h3>
                        </div>
                    </div>
                @endif
                </div>

                
            </div>
            <div class="col-lg-4">
                @include('coach.includes.my-account',[
                    'title' => 'دوراتي التدريبية',
                    'active' => 'coach.my-courses'
                ])

                @include('coach.includes.popular-courses')
            </div>
        </div>

    </div>
</div>
@endsection