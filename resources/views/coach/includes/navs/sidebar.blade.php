<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <a href="{{ route('coach.home') }}" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-primary">
                        <img src="{{ asset('assets/dashboard/images/illustration/student/128/white.svg') }}" class="img-fluid" alt="logo" />
                    </span>
                </span>

                <span>{{ config('app.name') }}</span>
            </a>

            <div class="sidebar-heading">القائمة الخاصة بي</div>

            <ul class="sidebar-menu">

                <li class="sidebar-menu-item {{ isset($active) && $active == 'coach.home' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('coach.home') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">صفحتي الشخصية</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'coach.my-courses' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('coach.my-courses') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                        <span class="sidebar-menu-text">كورساتي</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'coach.my-sessions' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('coach.my-sessions') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">calendar_today</span>
                        <span class="sidebar-menu-text">جلساتي</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'coach.my-blogs' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('coach.my-blogs') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                        <span class="sidebar-menu-text">مقالاتي</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">القائمة الخاصة بالموقع</div>

            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('index') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">الموقع الرئيسي</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('about') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">help</span>
                        <span class="sidebar-menu-text">فكرة الموقع</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button"
                       data-toggle="collapse"
                       href="#community_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                        الدورات
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="community_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('online-courses') }}">
                                <span class="sidebar-menu-text">الدورات الاونلاين</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('training-courses') }}">
                                <span class="sidebar-menu-text">الدورات التدريبية</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'coach.my-exams' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('blogs') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                        <span class="sidebar-menu-text">المقالات</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'coach.my-exams' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('instructors') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">people_outline</span>
                        <span class="sidebar-menu-text">المدربين</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ isset($active) && $active == 'coach.my-exams' ? 'active' : null }}">
                    <a class="sidebar-menu-button" href="{{ route('contact') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">poll</span>
                        <span class="sidebar-menu-text">اتصل بنا</span>
                    </a>
                </li>
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>