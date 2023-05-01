@extends('coach.layouts.app',[
    'title' => 'مقالاتي',
])

@section('content')
<div class="page-section">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">
                
                <div class="page-separator">
                    <div class="page-separator__text">انشاء مقالة جديدةة</div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('coach.my-blog.create') }}" class="btn btn-primary">اضغط هنا لانشاء مقالة جديدة</a>
                    </div>
                </div>
                
                <div class="row card-group-row">
                @foreach($coachPosts as $coachPost)
                    <div class="col-md-6 col-sm-12 card-group-row__col">

                        <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                            <img src="{{ asset('images/coaches/'.Auth::guard('coach')->user()->id.'/blogs/'.$coachPost->id.'/'.$coachPost->image) }}" alt="" class="card-img">
                            <div class="fullbleed bg-primary" style="opacity: .5"></div>
                            <div class="posts-card-popular__content">
                                <div class="card-body d-flex align-items-center">
                                    <div class="avatar-group flex">
                                        <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="Janell D.">
                                            <a href="">
                                                @if(isset(Auth::guard('coach')->user()->info) && Auth::guard('coach')->user()->info->image == null)
                                                <img src="{{ asset('assets/images/avatars/avatar2.png') }}" alt="Avatar" class="avatar-img rounded-circle">
                                                @else
                                                <img src="{{ asset('images/coaches/'.Auth::guard('coach')->user()->id.'/'.Auth::guard('coach')->user()->info->image) }}" alt="Avatar" class="avatar-img rounded-circle">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <a style="text-decoration: none;" class="d-flex align-items-center"href=""><i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i> <small>0</small></a>
                                </div>
                                <div class="posts-card-popular__title card-body">
                                    <small class="text-muted text-uppercase">sketch</small>
                                    <a class="card-title" href="{{ route('coach.my-blog.show', $coachPost->slug) }}">{{ $coachPost->title }}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
                </div>

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