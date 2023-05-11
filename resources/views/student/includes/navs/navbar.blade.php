<div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
    <div class="mdk-header__content">
        <div class="navbar navbar-expand navbar-light bg-white border-bottom" id="default-navbar" data-primary>
            <div class="container page__container">

                <!-- Navbar Brand -->
                <a href="{{ route('index') }}" class="navbar-brand mr-16pt">
                    <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                        <span class="avatar-title rounded bg-primary">
                            <img src="{{ asset('assets/dashboard/images/images/illustration/student/128/white.svg') }}" alt="logo" class="img-fluid" />
                        </span>
                    </span>
                    {{-- <span class="d-none d-lg-block">{{ config('app.name') }}</span> --}}
                </a>

                <!-- Navbar toggler -->
                <button class="navbar-toggler w-auto mr-16pt d-block rounded-0"
                        type="button"
                        data-toggle="sidebar">
                    <span class="material-icons">short_text</span>
                </button>

                <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="nav-link">الصفحة الرئيسية</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link">فكرة الموقع</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-caret="false">الدورات</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('courses') }}" class="dropdown-item">الدورات الاونلاين</a>
                            <a href="{{ route('training-courses') }}" class="dropdown-item">الدورات التدريبية</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('blogs') }}" class="nav-link">المقالات</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('instructors') }}" class="nav-link">المدربين</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link">اتصل بنا</a>
                    </li>
                </ul>
                

                <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-16pt" action="index.html" style="max-width: 230px">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                    <input type="text" class="form-control" placeholder="بحث عن كورسات">
                </form>

                <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">
                    <!-- Notifications dropdown -->
                    {{-- <div class="nav-item ml-16pt dropdown dropdown-notifications dropdown-xs-down-full"
                            data-toggle="tooltip"
                            data-title="الاشعارات"
                            data-placement="bottom"
                            data-boundary="window">
                        <button class="nav-link btn-flush dropdown-toggle"
                                type="button"
                                data-toggle="dropdown"
                                data-caret="false">
                            <i class="material-icons">notifications_none</i>
                            <span class="badge badge-notifications badge-accent">2</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div data-perfect-scrollbar
                                    class="position-relative">
                                <div class="dropdown-header"><strong>System notifications</strong></div>
                                <div class="list-group list-group-flush mb-0">

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action unread">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">3 minutes ago</small>

                                            <span class="ml-auto unread-indicator bg-accent"></span>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-accent">account_circle</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">

                                                <span class="text-black-70">Your profile information has not been synced correctly.</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">5 hours ago</small>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-primary">group_add</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">
                                                <strong class="text-black-100">Adrian. D</strong>
                                                <span class="text-black-70">Wants to join your private group.</span>
                                            </span>
                                        </span>
                                    </a>

                                    <a href="javascript:void(0);"
                                        class="list-group-item list-group-item-action">
                                        <span class="d-flex align-items-center mb-1">
                                            <small class="text-black-50">1 day ago</small>

                                        </span>
                                        <span class="d-flex">
                                            <span class="avatar avatar-xs mr-2">
                                                <span class="avatar-title rounded-circle bg-light">
                                                    <i class="material-icons font-size-16pt text-warning">storage</i>
                                                </span>
                                            </span>
                                            <span class="flex d-flex flex-column">

                                                <span class="text-black-70">Your deploy was successful.</span>
                                            </span>
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- // END Notifications dropdown -->

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link d-flex align-items-center dropdown-toggle"
                            data-toggle="dropdown"
                            data-caret="false">

                            <span class="avatar avatar-sm mr-8pt2">

                                <span class="avatar-title rounded-circle bg-primary"><i class="material-icons">account_box</i></span>

                            </span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header"><strong>حسابي</strong></div>
                            <a class="dropdown-item" href="javascript:void(0);">اعدادتي الشخصية</a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                الخروج
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>